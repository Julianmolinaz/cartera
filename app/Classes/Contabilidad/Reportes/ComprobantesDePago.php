<?php

namespace App\Classes\Contabilidad\Reportes;
use \App\Http\Controllers as Ctrl;

use Exception;
use App as _;
use DB;

class ComprobantesDePago
{
    protected $ini;
    protected $end;
    protected $recibo;
    protected $reporte = [];
    protected $temporal = [];
    protected $bancos_no_encontrados;
    protected $consecutivo;

    public function __construct($ini, $end)
    {
        $this->ini = $ini;
        $this->end = $end;

        $this->reporte[] = $this->header();
    }


    public function make()
    {
        $ids = $this->getIdsRecibos();

        foreach ($ids as $e) {

            $this->temporal = [];

            $this->recibo = _\Factura::find($e->id);

            // generar el consecutivo

            $this->getConsecutivo();

            // la cuenta de caja o bancos Debito

            $this->cuentasDebito();

            // conceptos Credito

            $this->cuentasCredito();   
            
            $this->validarPartida();

            $this->reporte = array_merge($this->reporte, $this->temporal);
        }
        // dd($this->reporte);
        return $this->reporte;
    }

    /**
     * Valida que la partida contable sea equilibrada
     * si es positiva se especifica como un saldo a favor
     * si es negativa va a una cuenta diferente
     * si es igual a 0 la partida esta equilibrada
     */

    public function validarPartida()
    {
        // suma los elementos desde la posición 1
        $suma = 0;

        for ($i = 1; $i < count($this->temporal); $i++){
            
            $suma += $this->temporal[$i]['credito'];
            // dd($suma);
        }

        $diferencia = $this->temporal[0]['debito'] - $suma;

        if ($diferencia < 0) {

            throw new Exception("El debito es mayor que el credito en: " . $this->recibo->num_fact, 1);
            
        } else if($diferencia > 0) {

            $item = $this->struct();
            $item->descripcion = $this->recibo->num_fact;
            $item->fecha_elab = $this->recibo->fecha;
            $item->iden_tercero = $this->recibo->credito->precredito->cliente->num_doc;
            $item->cod_prod = $this->recibo->credito->precredito->producto->nombre;
            $item->debito = $this->recibo->total;
            $item->tipo = $this->recibo->tipo;
            $item->banco = $this->recibo->banco;
            $item->cod_cuenta = '23809501';

            $this->temporal[] = (array) $item;
            
        }

        // compara la sumatoria con los elemento 0

        // si la diferencia es diferente de cero
        // lanzar una excepcion 
        // si no , continuar 
    }


    public function cuentasCredito()
    {
        if (! isset($this->recibo->credito)) {
            throw new \Exception("No se encuentra un crédito para el recibo ". $this->recibo->id, 1);
        }
       
        $pagos = $this->recibo->pagos;
        
        foreach ($pagos as $pago){     

            switch ($pago->concepto) {
                    case 'Juridico':
                        $this->go($pago,'42100503');
                        break;
                    case 'Prejuridico':
                        $this->go($pago, '42100502');
                        break;
                    case 'Mora':
                        $this->go($pago, '42100501');
                        break;
                    case 'Cuota Parcial':
                        $this->go($pago, '13050501');
                        break;
                    case 'Cuota':
                        $this->go($pago, '13050501');
                        break;
                    case 'Saldo a Favor':
                        $this->go($pago, '23809501');
                        break;
                    case 'Diferencia':
                        $this->go($pago, '23809502');
                        break;
                default:
                    throw new Exception('No existe el concepto: ' . $pago->concepto, 1);
                    break;
            }
        }
    }

    public function go($pago, $cuenta)
    {
        $item = $this->struct();

        if ($cuenta == '13050501')
        {
            $item->prefijo = 'CC';
            $item->consec = '1';
            $item->no_cuota = '1';
            $item->fecha_venc = '31/12/2020';
        }

        $item->cod_cuenta = $cuenta;
        $item->descripcion = $this->recibo->num_fact;
        $item->fecha_elab = $this->recibo->fecha;
        $item->iden_tercero = $this->recibo->credito->precredito->cliente->num_doc;
        $item->cod_prod = $this->recibo->credito->precredito->producto->nombre;  
        $item->credito = $pago->abono;
        $item->tipo = $this->recibo->tipo;
        $item->banco = $this->recibo->banco;

        $this->temporal[] = (array) $item;
    }


    public function cuentasDebito()
    {
        $item = $this->struct();

        if (! isset($this->recibo->credito)) {
            throw new \Exception("No se encuentra un crédito para el recibo ". $this->recibo->id, 1);
        }

        if ($this->recibo->tipo === 'Efectivo' || !$this->getCuentaBanco($this->recibo->banco) ) {
            $item->cod_cuenta = '11050501';

        } else {

            // $this->recibo->tipo === 'Consignacion';

            $item->banco = $this->recibo->banco;
            $item->cod_cuenta = $this->getCuentaBanco($item->banco);
        }

        $item->descripcion = $this->recibo->num_fact;
        $item->fecha_elab = $this->recibo->fecha;
        $item->iden_tercero = $this->recibo->credito->precredito->cliente->num_doc;
        $item->cod_prod = $this->recibo->credito->precredito->producto->nombre;
        $item->debito = $this->recibo->total;
        $item->tipo = $this->recibo->tipo;
        $item->banco = $this->recibo->banco;

        $this->temporal[] = (array) $item;

    }

    public function getConsecutivo()
    {
        // hace la consulta y la guarda en una variable
        $this->consecutivo = DB::table('consecutivos')
            ->find(2)
            ->incrementable;

        // incrementa en uno la variable
        $this->consecutivo ++;

        // guarda el nuevo valor en la tabla;
        DB::table('consecutivos')->where('id', 2)->update(['incrementable' => $this->consecutivo]);
    }

    public function getCuentaBanco($banco)
    {
        switch (strtolower($banco)) {

            case 'pse av villas':
                return '11100501';
                break;

            case 'banco av villas':
                return '11100501';
                break;

            case 'bancolombia':
                return '11100503';
                break;

            case 'davivienda':
                return '11200501';
                break;
            
            case 'apostar':
                return '11200502';
                break;

            case 'gana gana':
                return '11200503';
                break;

            case 'su suerte':
                return '11200502';
                break;

            case 'susuerte';    
                return '11200502';
                break;

            default:
                $this->bancos_no_encontrados[] = $banco;
                return false;
                break;
        }
    }

    
    public function getIdsRecibos()
    {
        
        $date_str = "CONCAT(SUBSTRING(facturas.fecha, 7,4),'-',SUBSTRING(facturas.fecha, 4,2),'-', SUBSTRING(facturas.fecha, 1,2))";

        $ids = DB::select(
            "select facturas.id
                from facturas 
                inner join creditos on facturas.credito_id = creditos.id
                inner join precreditos on creditos.precredito_id = precreditos.id
                where 
                (   
                    date_format( ".$date_str.", '%Y-%m-%d') >= ?
                    and
                    date_format( ".$date_str.", '%Y-%m-%d') <= ?    
                )
                    and facturas.credito_id is not null
                    and precreditos.cartera_id in (6,32)"
                
                , [$this->ini, $this->end]
            );

        return $ids;
    }



    public function struct()
    {
        return (object)[
            'tipo_comp' => 18,
            'cons_comp' => $this->consecutivo,
            'fecha_elab' => '',
            'sigla_moneda' => 'COP',
            'tasa_cambio' => '',
            'cod_cuenta' => '',
            'iden_tercero' => '',
            'sucursal' => '',
            'cod_prod' => '',
            'cod_bodega' => '',
            'accion' => '',
            'cant_prod' => '',
            'prefijo' => '',
            'consec' => '',
            'no_cuota' => '',
            'fecha_venc' => '',
            'cod_impuesto' => '',
            'cod_grupo_act_fijo' => '',
            'cod_act_fijo' => '',
            'descripcion' => '',
            'cod_cc' => '',
            'debito' => '',
            'credito' => '',
            'obs' => '',
            'base_grab_lib_comp' => '',
            'base_exen_lib_comp' => '',
            'mes_cierre' => '',
            'tipo' => '',
            'banco' => '',
        ];
    }

    public function header() 
    {
        return [
            'Tipo de comprobante',
            'Consecutivo comprobante',
            'Fecha de elaboración',
            'Sigla moneda',
            'Tasa de cambio',
            'Código cuenta contable',
            'Identificación tercero',
            'Sucursal',
            'Código producto',
            'Código de bodega',
            'Acción',
            'Cantidad producto',
            'Prefijo',
            'Consecutivo',
            'No. cuota',
            'Fecha vencimiento',
            'Código impuesto',
            'Código grupo activo fijo',
            'Código activo fijo',
            'Descripción',
            'Código centro/subcentro de costos',
            'Débito',
            'Crédito',
            'Observaciones',
            'Base gravable libro ventas  ',
            'Base exenta libro ventas',
            'Mes de cierre',
            'Tipo',
            'Banco'
        ];
    }

}
