<?php

namespace App\Classes;
use \App\Http\Controllers as Ctrl;

use DB;

class ReporteRecibosCaja
{
    protected $ini;
    protected $end;

    public function __construct($ini, $end)
    {
        $this->ini = $ini;
        $this->end = $end;
    }

    public function make()
    {
        return $this->struct();
    }

    public function getPagos($ini, $end)
    {
        
    }

    public function struct()
    {
        return (object)[
            'tipo_comp' => '',
            'cons_comp' => '',
            'fecha_elab' => '',
            'sigla_moneda' => '',
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
            'cod_cc' => '',
            'debito' => '',
            'credito' => '',
            'obs' => '',
            'base_grab_lib_comp' => '',
            'base_exen_lib_comp' => '',
            'mes_cierre' => '',
        ];
    }

    public function getDebito($fact)
    {
        // Validar tipo de pago y valor total
    }

    public function setCuentas($pay)
    {
        // Validar pagos
    }

    public function getCaja()
    {
        // validar si es concepto cuota o cuota parcial y validar numero de cuota
    }

    public function getMora()
    {
        //validar si es concepto mora
    }

    public function getJuridico()
    {
        //validar si es concepto Juridico
    }

    public function getPrejuridico()
    {
        //validar si es concepto Prejuridico
    }

    public function getBancos()
    {
        //validar si es concepto Bancos
    }
}
