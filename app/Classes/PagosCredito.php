<?php

namespace App\Classes;

use App\Repositories as Repo;
use App\Repositories\PagoRepository;
use App\Http\Controllers as Ctrl;
use Carbon\Carbon;
use Exception;
use App as _;
use Log;
use DB;

/**
 * Las fechas de pago se mueven solamente cuando se hacen pagos por cuota
 * o segunga cuota parcial total.
 */

class PagosCredito
{
    protected $credito;         
    protected $recibo;
    protected $fecha;           // Fecha del pago dd-mm-yyyy
    protected $monto;           // Valor total del pago
    protected $auto;            // true genera consecutivo, false num_fact manual
    protected $pagos;           // Array con los conceptos de pago, ver struct App\Classes\Abono@struct
    protected $banco;           // Se especifíca el banco si el tipo de pago es consignación
    protected $tipo_pago;       // Efectivo o Consignación
    protected $num_recibo;      // Número del recibo de caja
    protected $funcionario;     // Funcionario que realizó el pago
    protected $num_consignacion; // Se especifíca el número de consignación si el tipo de pago es consignación
    protected $movio_fecha;     // Se marca en uno si la fecha de pago se mueve de lo contratio es 0
    protected $pago_hasta;      // Fecha de pago hasta en la que se encontraba el crédito
    protected $descuento;       // true, si es un descuento a crédito

    public function __construct (
        $num_fact,
        $fecha,
        $monto,
        $tipo_pago,
        $auto,
        $pagos,
        $banco,
        $credito_id,
        $num_consignacion,
        $descuento,
        $user_create_id
    )
    {
        try {

            $this->funcionario     = _\User::find($user_create_id);
            $this->num_recibo      = $num_fact;
            $this->fecha           = $fecha;
            $this->monto           = $monto;
            $this->tipo_pago       = $tipo_pago;
            $this->auto            = $auto;
            $this->pagos           = $pagos;
            $this->banco           = $banco;
            $this->credito         = _\Credito::find($credito_id);
            $this->num_consignacion = $num_consignacion;
            $this->movio_fecha     = 0;
            $this->pago_hasta      = $this->credito->fecha_pago->fecha_pago;
            $this->descuento       = $descuento;
            $this->repo = new PagoRepository();

        } catch (\Exception $e) {
            throw new \Exception('__construct PagosCedito .. '. $e->getMessage(), 1);
            
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Make
    |--------------------------------------------------------------------------
    | Función principal que ejecuta el proceso de pago de un recibo
    | partiendo de la información entregada por un generador de pagos
    |
    */    

    public function make()
    {
        DB::beginTransaction();

        try {

            $this->getFechaRecibo();
            $this->getConsecutivo();
            $this->hacerRecibo();
            $this->hacerPagos();
            
            if ($this->ultimaCuota()) {
                $this->cancelarCredito();
            }

            $this->cerrarAcuerdoDePago();
            $this->crearLog();

            $this->moverFechaMasProxima();

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            throw new Exception($e->getMessage(), 1);
        }

    }

    protected function moverFechaMasProxima()
    {
        $fecha_anterior = new Carbon($this->pago_hasta);
        $fecha_posterior = new Carbon($this->credito->fecha_pago->fecha_pago);

        if ($fecha_anterior->eq($fecha_posterior) && $this->credito->cuotas_faltantes > 0) {

            $porcentaje_vlr_permitido = 
                ($this->credito->precredito->cartera->porcentaje_pago_parcial > 0) 
                ? intval($this->credito->precredito->cartera->porcentaje_pago_parcial) 
                : 60;

            $vlr_permitido = $this->recibo->total * $porcentaje_vlr_permitido / 100;

            if ($this->recibo->total >= $vlr_permitido ) {
                $this->buscarFechaCercana();
            }
        }
    }


    protected function buscarFechaCercana()
    {    
        $fecha = DB::table('fecha_cobros')
            ->where('credito_id', $this->credito->id)
            ->first();

        $now = Carbon::now();

        $fecha_pago = new Carbon($fecha->fecha_pago);

        if ($fecha_pago->lte($now) && !$this->descuento) {
            $fecha_cercana = Ctrl\fecha_cercana (
                $now, 
                $this->credito->precredito->periodo, 
                $this->credito->precredito->p_fecha, 
                $this->credito->precredito->s_fecha
            );

            DB::table('fecha_cobros')
                ->where('credito_id', $this->credito->id)
                ->update([ 'fecha_pago' => Ctrl\inv_fech($fecha_cercana)]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | getFechaRecibo
    |--------------------------------------------------------------------------
    | Generador de fecha segun la variable auto (boolean)
    |
    */    

    protected function getFechaRecibo() 
    {
        if ($this->auto) {
            if (! $this->fecha) 
                $this->fecha = Carbon::now(); 
            else 
                $this->fecha = new Carbon($this->fecha);
        } else {
            $this->fecha = Carbon::now();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | getConsecutivo
    |--------------------------------------------------------------------------
    | Si la variable auto es true genera un consecutivo automático utilizando
    | el prefijo del punto, si no se utiliza el número suministrado por el 
    | usuario que realiza el pago
    |
    */    
    
    protected function getConsecutivo() 
    {
        if ($this->auto) {

            $punto            = _\Punto::find( $this->funcionario->punto_id ); 
            $prefijo          = $punto->prefijo;
            $punto->increment ++;
            $consecutivo      = $punto->increment;
            $punto->save();

            $this->num_recibo = $prefijo .''. $consecutivo;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Hacer recibo
    |--------------------------------------------------------------------------
    | Genera un recibo de pago (Factura 
    |
    */

    protected function hacerRecibo()
    {
        $this->recibo                     = new _\Factura();
        $this->recibo->num_fact           = $this->num_recibo;
        $this->recibo->fecha              = $this->fecha->format('d-m-Y');
        $this->recibo->credito_id         = $this->credito->id;
        $this->recibo->total              = $this->monto;
        $this->recibo->tipo               = $this->tipo_pago;
        $this->recibo->num_consignacion   = isset($this->num_consignacion) ? $this->num_consignacion : null;
        $this->recibo->banco              = ($this->tipo_pago == 'Consignacion' || $this->tipo_pago == 'Consignación') ? $this->banco : null;
        $this->recibo->user_create_id     = $this->funcionario->id;
        $this->recibo->user_update_id     = $this->funcionario->id;
        $this->recibo->fecha_proximo_pago = $this->pago_hasta;
        $this->recibo->descuento          = $this->descuento;
        $this->recibo->save();
    }

    public function get()
    {
        return $this->recibo;
    }

    /*
    |--------------------------------------------------------------------------
    | Hacer pagos
    |--------------------------------------------------------------------------
    | Orquestador que evalua el concepto de pago y lo distribuye 
    | a la funcion que lo de deba procesar 
    |
    */

    protected function hacerPagos()
    {
        foreach ($this->pagos as $pago) {

            switch ($pago['concepto']) {
                case 'Juridico':
                    $this->pagoJuridico($pago);
                    break;
                case 'Prejuridico':
                    $this->pagoPrejuridico($pago);
                    break;
                case 'Mora':
                    $this->pagoMora($pago);
                    break;
                case 'Cuota':
                    $this->pagoCuota($pago);
                    break;
                case 'Cuota Parcial':
                    $this->pagoCuotaParcial($pago);
                    break;
                case 'Saldo a Favor':
                    $this->saldoFavor($pago);
                    break;
                case 'Total':
                    $this->total($pago);
                    break;
                default:
                    throw new Exception("Error, concepto desconocido =( : " . $pago['concepto'], 1);
                    break;
            }
        }
    }


    protected function pagoJuridico($pay) 
    {
        $juridico = $this->repo->getDebeDeJuridicos($this->credito->id);
        $pago_anterior = $this->repo->getDebeJuridicos($this->credito->id);

        $nuevo_pago = $this->structPay();
        $nuevo_pago->concepto = 'Juridico';
        $nuevo_pago->abono = $pay['subtotal'];
        
        if ($pago_anterior) {

            $nuevo_pago->debe = $pago_anterior->debe - $pay['subtotal'];
            $nuevo_pago->abono_pago_id = 'p'.$pago_anterior->id.'.m'.$juridico->id; 

            // Se actuliza el pago anterior de estado 'Debe' a estado 'Ok'

            $pago_anterior = _\Pago::find($pago_anterior->id);
            $pago_anterior->estado = 'Ok';
            $pago_anterior->save();
            
        } else {
            $nuevo_pago->debe = $juridico->valor - $pay['subtotal'];
            $nuevo_pago->abono_pago_id = 'p(--)'.'.m'.$juridico->id; 
        }

        // Actualización del estado

        if (intval($nuevo_pago->debe) == 0) {

            $nuevo_pago->estado = 'Ok';

            $juridico = _\Extra::find($juridico->id);
            $juridico->estado = 'Ok';
            $juridico->save();

        } else {
            $nuevo_pago->estado = 'Debe';
        }

        $nuevo_pago->save();
        $this->descontarSaldo($nuevo_pago->abono);
    }


    /*
    |--------------------------------------------------------------------------
    | Pago Prejuridico
    |--------------------------------------------------------------------------
    | 
    */

    protected function pagoPrejuridico ($pay) 
    {
        $prejuridico   = $this->repo->getDebePrejuridico($this->credito->id);
        $pago_anterior = $this->repo->getDebeExcedentesPrejuridico($this->credito->id);

        $nuevo_pago = $this->structPay();
        $nuevo_pago->concepto = 'Prejuridico';
        $nuevo_pago->abono = $pay['subtotal'];
        
        if ($pago_anterior) {

            $nuevo_pago->debe = $pago_anterior->debe - $pay['subtotal'];

            // Se actuliza el pago anterior de estado 'Debe' a estado 'Ok'
            $nuevo_pago->abono_pago_id = 'p'.$pago_anterior->id.'.m'.$prejuridico->id; 
            $pago_anterior = _\Pago::find($pago_anterior->id);
            $pago_anterior->estado = 'Ok';
            $pago_anterior->save();
            
        } else {
            $nuevo_pago->debe = $prejuridico->valor - $pay['subtotal'];
            $nuevo_pago->abono_pago_id = 'p(--)'.'.m'.$prejuridico->id; 
        }

        // Actualización del estado

        if (intval($nuevo_pago->debe) == 0) {

            $nuevo_pago->estado = 'Ok';

            $prejuridico = _\Extra::find($prejuridico->id);
            $prejuridico->estado = 'Ok';
            $prejuridico->save();

        } else {
            $nuevo_pago->estado = 'Debe';
        }

        $nuevo_pago->save();

        $this->descontarSaldo($nuevo_pago->abono);

    }

    protected function igualarSanciones($sanciones_debe)
    {
        $cantidad_sanciones_debe = count($sanciones_debe);

        if ( ! ($cantidad_sanciones_debe == $this->credito->sanciones_debe )) {
            $this->credito->sanciones_debe = $cantidad_sanciones_debe;
            $this->credito->save();
        }
    }
    
    /*
    |--------------------------------------------------------------------------
    | Pago por mora
    |--------------------------------------------------------------------------
    | Genera los pagos referentes a las sanciones diarias del crédito 
    | Si existe un descuento se exoneran las sanciones, si no se ponen en Ok.    
    |
    */

    protected function pagoMora($pay) 
    {
        $nuevo_pago = $this->structPay();
        $nuevo_pago->concepto = 'Mora';
        $nuevo_pago->abono = $pay['subtotal'];
        $nuevo_pago->estado = 'Ok';
        $nuevo_pago->save();

        $sanciones_debe = $this->repo->getDebeDeSanciones($this->credito->id);

        $this->igualarSanciones($sanciones_debe);

        for ($i = 0; $i < $pay['cant']; $i ++) {
            
            $sancion = _\Sancion::find($sanciones_debe[$i]->id);
            $sancion->pago_id = $nuevo_pago->id;
            $sancion->estado = $this->descuento ? 'Exonerada' : 'Ok';
            $sancion->save();
            
            $this->credito->sanciones_debe --;

            $this->descuento 
                ? $this->credito->sanciones_exoneradas ++  
                : $this->credito->sanciones_ok ++;
            
            $this->credito->save();
        }

        $this->descontarSaldo($nuevo_pago->abono);
    }

    /*
    |--------------------------------------------------------------------------
    | Pago por cuota parcial
    |--------------------------------------------------------------------------
    | Genera los pagos no completados en su totalidad 
    |
    */

    protected function pagoCuotaParcial($pay)
    {
        $nuevo_pago = $this->structPay();
        $nuevo_pago->concepto = 'Cuota Parcial';
        $nuevo_pago->abono = $pay['subtotal'];
        $nuevo_pago->pago_desde = $pay['ini'];
        $nuevo_pago->pago_hasta = $pay['fin'];

        $cuota_parcial = $this->repo->partialPayment($this->credito->id);

        // Si existen cuotas parciales con estado debe

        if ($cuota_parcial) {

            $nuevo_pago->debe = $cuota_parcial->debe - $pay['subtotal'];

            if ($nuevo_pago->debe == 0) {
                $nuevo_pago->estado = 'Ok';
                $this->credito->cuotas_faltantes --; 
            } else {
                $nuevo_pago->estado = 'Debe';
            }
            
            $nuevo_pago->abono_pago_id = $cuota_parcial->id;

            // Se pone en Ok la cuota parcial anterior

            $cuota_parcial_obj = _\Pago::find($cuota_parcial->id);
            $cuota_parcial_obj->estado = 'Ok';
            $cuota_parcial_obj->save();

        } else {
            $nuevo_pago->debe = $this->credito->precredito->vlr_cuota - $pay['subtotal'];
            $nuevo_pago->estado = 'Debe';
        }

        $this->descontarSaldo($nuevo_pago->abono);
        $this->descontarARendimiento($nuevo_pago->abono);
        $this->actualizarFecha($nuevo_pago->pago_hasta);

        $nuevo_pago->save();

    }


    /*
    |--------------------------------------------------------------------------
    | Pago cuota
    |--------------------------------------------------------------------------
    | Pago por concepto de cuota
    |
    */    

    protected function pagoCuota($pay) 
    {
        $nuevo_pago = $this->structPay();
        $nuevo_pago->concepto = 'Cuota';
        $nuevo_pago->estado = 'Ok';
        $nuevo_pago->abono = $pay['subtotal'];
        $nuevo_pago->pago_desde = $pay['ini'];
        $nuevo_pago->pago_hasta = $pay['fin'];
        $nuevo_pago->save();

        $this->descontarSaldo($nuevo_pago->abono);
        $this->descontarCuotas($pay['cant']);
        $this->descontarARendimiento($nuevo_pago->abono);
        $this->actualizarFecha($nuevo_pago->pago_hasta);
    }

    /*
    |--------------------------------------------------------------------------
    | Saldo a favor
    |--------------------------------------------------------------------------
    | Saldo sobrante del pago que se debe registrar por control y en el caso
    | de que un cliente haga una reclamación del saldo positivo
    |
    */      
    
    protected function saldoFavor($pay) 
    {
        $nuevo_pago = $this->structPay();
        $nuevo_pago->concepto = 'Saldo a Favor';
        $nuevo_pago->abono = $pay['subtotal'];
        $nuevo_pago->estado = 'Debe';
        $nuevo_pago->save();

        $this->credito->saldo_favor += $nuevo_pago->abono;
        $this->credito->save();
    }

    /*
    |--------------------------------------------------------------------------
    | Total
    |--------------------------------------------------------------------------
    | Se agrega el total de la factura 
    |
    */ 
    
    protected function total($pay) 
    {
        $this->recibo->total = $pay['subtotal'];
        $this->recibo->save();
    }

    /*
    |--------------------------------------------------------------------------
    | Descontar saldo
    |--------------------------------------------------------------------------
    | Recive un valor y descuenta este al saldo del crédito
    |
    */

    protected function descontarSaldo($valor) 
    {
        $this->credito->saldo -= $valor;

        if ($this->credito->saldo < 0) {
            throw new Exception("Saldo del crédito negativo al descontar pago {$this->credito->id}", 1);             
        } 

        $this->credito->user_update_id = $this->funcionario->id;
        $this->credito->save();
    }
    
    /*
    |--------------------------------------------------------------------------
    | Descontar cuotas
    |--------------------------------------------------------------------------
    | Recive un número de cuotas a descontar de cuotas faltantes del crédito
    |
    */

    protected function descontarCuotas($num_cuotas) 
    {
        if ($this->credito->cuotas_faltantes < $num_cuotas) {
            throw new Exception("El número de cuotas a pagar ({$num_cuotas}) es mayor que el número de cuotas faltantes (".$this->credito->cuotas_faltantes.") =(", 1);
        }

        $this->credito->cuotas_faltantes -= $num_cuotas;
        $this->credito->user_update_id = $this->funcionario->id;
        $this->credito->save();
    }

    /*
    |--------------------------------------------------------------------------
    | Struct Pay
    |--------------------------------------------------------------------------
    | Crea un pago vacio con número de factura y número de crédito 
    |
    */

    protected function structPay()
    {
        $pago = new _\Pago();
        $pago->factura_id = $this->recibo ? $this->recibo->id : null;
        $pago->credito_id = $this->credito->id;
        $pago->debe = 0;

        return $pago;
    }

    /*
    |--------------------------------------------------------------------------
    | Struct Pay
    |--------------------------------------------------------------------------
    | Crea un pago vacio con número de factura y número de crédito 
    |
    */

    protected function ultimaCuota()
    {
        if ($this->credito->cuotas_faltantes == 0) {
            return true;
        } else {
            return false;
        }
    }

    protected function cancelarCredito()
    {
        $this->credito->estado = 'Cancelado';
        $this->credito->user_update_id = $this->funcionario->id;
        $this->credito->save();
    }

    protected function cerrarAcuerdoDePago()
    {
        if (isset($this->credito->acuerdo) && $this->credito->acuerdo == 'Abierto') {
            
            $this->credito->acuerdo = 'Cerrado';
            $this->credito->save();
        }
    }

    protected function crearLog()
    {
        // pendiente
    }

    protected function actualizarFecha($fecha)
    {
        if (!$this->descuento) {
            $fecha_cobro = _\FechaCobro::where(
                'credito_id', $this->credito->id
            )->first();
            
            DB::table('fecha_cobros')
                ->where('credito_id', $this->credito->id)
                ->update(['fecha_pago' => $fecha]);
        } 
    }

    protected function descontarARendimiento($monto)
    {
        if ($this->descuento) {
            $credito = Repo\CreditoRepository::find($this->credito->id);
            $nuevoRendimiento = $credito->rendimiento - $monto;

            if ($nuevoRendimiento < 0 ) {
                throw new \Exception("Al calcular el rendimiento, se genera un valor negativo", 400);    
            }

            Repo\CreditoRepository::updateCredito([
                'rendimiento' => $nuevoRendimiento
            ], $this->credito->id);
        }
    }
}