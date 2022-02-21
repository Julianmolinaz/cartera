<?php

namespace App\Classes;

use Auth;
use App;
use DB;


class AnularPagoCredito
{
    protected $repo_recibo;
    protected $motivo;
    public $recibo;
    protected $pago;
    public $recibo_anulado;

    public function __construct($recibo_id, $motivo)
    {
        $this->repo_recibo = new App\Repositories\ReciboRepository();
        $this->recibo = $this->repo_recibo->getReciboById($recibo_id);
        $this->motivo = $motivo;
    }

    public function make()
    {
        if (!$this->esUltimoRecibo()) {
            throw new \Exception ('No se puede eliminar el recibo de pago con numero: '.$this->recibo->num_fact.', recuerde que puede eliminar en orden descendente de la mas actual a la mas antigua. Gracias!!!', 400);    
        }

        $this->crearRegistroDeAnulacion();
        $this->procesarConceptosDePago();

    }

    /**
     * @return bool, true si es el ultimo recibo, false si no
     */

    public function esUltimoRecibo() 
    {
        $ultimo_recibo = $this->repo_recibo->getUltimoRecibo($this->recibo->credito->id);

        if ($ultimo_recibo) {

            if ($ultimo_recibo->id === $this->recibo->id) {
                return true;
            } else {
                return false;
            }

        } else {
            return true;
        }
    }

    public function crearRegistroDeAnulacion()
    {
        $this->recibo_anulado                    = new App\Anulada();
        $this->recibo_anulado->cliente_id        = $this->recibo->credito->precredito->cliente_id;
        $this->recibo_anulado->factura_id        = $this->recibo->id;
        $this->recibo_anulado->precredito_id     = $this->recibo->credito->precredito_id;
        $this->recibo_anulado->credito_id        = $this->recibo->credito_id;
        $this->recibo_anulado->num_fact          = $this->recibo->num_fact;
        $this->recibo_anulado->fecha             = $this->recibo->fecha;
        $this->recibo_anulado->total             = $this->recibo->total;
        $this->recibo_anulado->pagos             = "";
        $this->recibo_anulado->motivo_anulacion  = $this->motivo;
        $this->recibo_anulado->user_anula        = (Auth::user()) ? Auth::user()->id : 2;
        $this->recibo_anulado->user_create_id    = $this->recibo->user_create_id;
    }

    public function procesarConceptosDePago()
    {
        foreach ($this->recibo->pagos as $pago) {
            $this->pago = $pago;

            switch ($this->pago->concepto) {
                case 'Juridico':
                    $this->anularPreyJuridicos();
                    break;
                case 'Prejuridico':
                    $this->anularPreyJuridicos();
                    break;
                case 'Mora':
                    $this->anularMoras();
                    break;
                case 'Cuota':
                    $this->anularCuota();
                    break;
                case 'Cuota Parcial':
                    $this->anularCuotaParcial();
                    break;
                case 'Saldo a Favor':
                    $this->anularSaldoAFavor();
                    break;
            }
        }
    }

    public function anularCuotaParcial()
    {

    }

    public function anularCuota()
    {

    }

    public function anularMoras()
    {

    }

    public function anularPreyJuridicos()
    {
           
        $cadena = $this->pago->abono_pago_id;
        $multa_id = "";
        $bandera = 0;

        for ($i = 0; $i < strlen($cadena); $i++) {

            if ($cadena[$i] == '.' || $bandera == 1) {
                            
                if ($bandera == 0) {
                    $i = $i + 2;
                }

                $multa_id .= $cadena[$i];
                $bandera = 1;
            }
        }
                    
        $multas_vigentes = DB::table('extras')
                            ->where([['credito_id','=',$credito->id],['estado','=','Debe']])
                            ->first();

        // trae el pago anterior para cambiarlo de estado ok a debe    
        $pago_a_modificar_id  = ""; 

        for($i = 1; $i < strlen($cadena); $i++){
            if( $cadena[$i] == '.'){
                $i = strlen($cadena);
            } else {
                $pago_a_modificar_id = $pago_a_modificar_id.$cadena[$i];
            }
        }    
                    
        //si existen multas vigentes     

        if (count($multas_vigentes) > 0) {
            
            if ($multas_vigentes->id == $multa_id) {

                $credito->saldo = $credito->saldo + $pago->abono;

                $pago_a_modificar = Pago::find($pago_a_modificar_id);

                if ($pago_a_modificar != null) {
                    $pago_a_modificar->estado = 'Debe';
                    $pago_a_modificar->save();
                }

            } 
            //si hay una multa vigente diferente a la referencia del pago
            else {

                DB::rollback();
                flash()->error('Exíste una multa en "Debe" diferente de la que se quiere anular, se recomienda saldar la multa en "Debe" temporalmente para poder hacer la transacción de anulación deseada.');
                return redirect()->route('start.facturas.index');        
            }
        } 
        //si no existen multas vigentes
        else {
            $credito->saldo = $credito->saldo + $pago->abono;
            $credito->save();

                $pago_a_modificar = Pago::find($pago_a_modificar_id);

                if($pago_a_modificar != null){
                    $pago_a_modificar->estado = 'Debe';
                    $pago_a_modificar->save();
                }
                $multa = Extra::find($multa_id);
                $multa->estado = 'Debe';
                $multa->save();
            }

        }//end else if juridico
}