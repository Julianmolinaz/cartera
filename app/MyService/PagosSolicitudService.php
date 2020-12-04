<?php

namespace App\MyService;
use App\Http\Controllers as Ctrl;
use Exception;
use App as _;
use Auth;
use DB;

class PagosSolicitudService
{
    protected $recibo;

    public function __construct()
    {
        $this->recibo = new _\FactPrecredito();
    }

    public function make($recibo, $pagos)
    {

        try {

            $this->recibo->fill($recibo);
            $this->recibo->user_create_id = Auth::user()->id;
            $this->auto();
            $this->recibo->save();

            $this->set_pagos($pagos);
            
        } catch (\Exception $e) {
            throw new Exception($e, 1);
            
        }
    }


    /**
     * Generador automatico de fecha acvtual y número de factura
     * ejemplo PER1
     */
    public function auto()
    {
        $punto                 = _\Punto::find(Auth::user()->punto_id); 
        $punto->increment      = $punto->increment + 1;   
        $this->recibo->num_fact  = $punto->prefijo.$punto->increment;
        $punto->save();
    }

    /**
     * crea pagos contenidos en una factura
     * @input $factura generada en la vista
     */

    public function set_pagos($pagos) 
    {
        try {

            foreach( $pagos as $pago ){
                $buy = new _\PrecreditoPago();
                $buy->concepto_id         = $pago['concepto_id'];
                $buy->fact_precredito_id  = $this->recibo->id;
                $buy->precredito_id       = $pago['precredito_id'];
                $buy->subtotal            = $pago['subtotal'];
                $buy->user_create_id      = Auth()->user()->id;
                $buy->save();
            }

        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
