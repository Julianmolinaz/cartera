<?php

namespace App\Classes\Contabilidad\Reportes;
use \App\Http\Controllers as Ctrl;

use Exception;
use App as _;
use DB;

class ComprasRtmSoat
{
    protected $ini;
    protected $end;
    protected $reporte = [];
    protected $factura = [];
    protected $facturas = [];
    protected $consecutivo;
    protected $reporFactura;
    protected $reportConsecutivo = [];


    public function __construct($ini, $end ,$consecutivo)
    {
        $this->ini = $ini;
        $this->end = $end;
        $this->consecutivo = intval($consecutivo);
        $this->reporte[] = $this->header();
    }

    public function make()
    {
        $this->getFacturas();

        foreach ($this->facturas as $factura) {
            
            $this->factura = $factura;
            
            
            if ($this->factura->expedido_a) {

                $this->reporFactura = [];
                
                if ($this->factura->nombre === 'R.T.M') {
                    $this->rtm();
                    
    
                } else if ($this->factura->nombre === 'SOAT') {
                    $this->soat();                
                }
                
                $this->reporte = array_merge($this->reporte, $this->reporFactura);
                
                $this->consecutivo ++;
            }

        }

        return $this->reporte;
    }

    public function getFacturas()
    {
        $this->facturas = DB::table('ref_productos')
            ->join('productos','ref_productos.producto_id','=','productos.id')
            ->join('terceros','ref_productos.proveedor_id','=','terceros.id')
            ->join('precreditos','ref_productos.precredito_id','=','precreditos.id')
            ->whereBetween('ref_productos.fecha_exp',[$this->ini, $this->end])
            ->whereIn('precreditos.cartera_id', [6, 32])
            ->select('ref_productos.*','terceros.num_doc','precreditos.id')
            ->get();
    }

    public function rtm()
    {
        if ($this->factura->expedido_a === 'Gora') {

            $this->porGora();

        } else if ($this->factura->expedido_a === 'Cliente') {

            $this->porCliente();
        }
    }

    // STRUCT RTM POR GORA // STRUCT RTM POR GORA // STRUCT RTM POR GORA

    public function porGora()
    {
        $this->costoRtmGora();
        $this->ivaRtmGora();
        $this->otrosRtmGora();
        $this->totalRtmGora();
    }

    public function costoRtmGora()
    {
        $struct = $this->struct();

        $struct->cod_cuenta = '62050102';
        $struct->cod_prod = '02';
        $struct->accion = '+';
        $struct->cant_prod = '1,00';
        $struct->debito = $this->factura->costo ? $this->factura->costo : '0';

        $this->reporFactura[] = (array)$struct;
    }

    public function ivaRtmGora()
    {
        $struct = $this->struct();

        $struct->cod_cuenta = '24081001';
        $struct->cod_prod = '02';
        $struct->accion = '+';
        $struct->cant_prod = '1,00';
        $struct->cod_impuesto = '1';
        $struct->debito = $this->factura->iva ? $this->factura->iva : '0';

        $this->reporFactura[] = (array)$struct;
    }

    public function otrosRtmGora()
    {
        $struct = $this->struct();

        $struct->cod_cuenta = '62050102';
        $struct->cod_prod = '02';
        $struct->accion = '+';
        $struct->cant_prod = '1,00';
        $struct->debito = $this->factura->otros ? $this->factura->otros : '0';

        $this->reporFactura[] = (array)$struct;
    }

    public function totalRtmGora()
    {
        $struct = $this->struct();

        $struct->cod_cuenta = '22050501';
        $struct->credito = $this->factura->costo + $this->factura->iva + $this->factura->otros;

        $this->reporFactura[] = (array)$struct;
    }

    // STRUCT RTM POR CLIENTE // STRUCT RTM POR CLIENTE // STRUCT RTM POR CLIENTE

    public function porCliente()
    {
        $this->costoRtmCliente();
        $this->ivaRtmCliente();
        $this->otrosRtmCliente();
        $this->totalRtmCliente();
    }

    public function costoRtmCliente()
    {
        $struct = $this->struct();

        $struct->cod_cuenta = '28150501';
        $struct->cod_prod = '03';
        $struct->accion = '+';
        $struct->cant_prod = '1,00';
        $struct->debito = $this->factura->costo ? $this->factura->costo : '0';

        $this->reporFactura[] = (array)$struct;
    }

    public function ivaRtmCliente()
    {
        $struct = $this->struct();

        $struct->cod_cuenta = '28150501';
        $struct->cod_prod = '03';
        $struct->accion = '+';
        $struct->cant_prod = '1,00';
        $struct->debito = $this->factura->iva ? $this->factura->iva : '0';

        $this->reporFactura[] = (array)$struct;
    }

    public function otrosRtmCliente()
    {
        $struct = $this->struct();

        $struct->cod_cuenta = '28150501';
        $struct->cod_prod = '03';
        $struct->accion = '+';
        $struct->cant_prod = '1,00';
        $struct->debito = $this->factura->otros ? $this->factura->otros : '0';

        $this->reporFactura[] = (array)$struct;
    }

    public function totalRtmCliente()
    {
        $struct = $this->struct();

        $struct->cod_cuenta = '22050501';
        $struct->credito = $this->factura->costo + $this->factura->iva + $this->factura->otros;

        $this->reporFactura[] = (array)$struct;
    }

    // STRUCT SOAT // STRUCT SOAT // STRUCT SOAT

    public function soat()
    {
        $this->costoSoat();
        $this->ivaSoat();
        $this->otrosSoat();
        $this->totalSoat(); 
    }
    
    public function costoSoat()
    {
        $struct = $this->struct();

        $struct->cod_cuenta = '28150502';
        $struct->cod_prod = '01';
        $struct->accion = '+';
        $struct->cant_prod = '1,00';
        $struct->debito = $this->factura->costo ? $this->factura->costo : '0';

        $this->reporFactura[] = (array)$struct;

    }

    public function ivaSoat()
    {
        $struct = $this->struct();

        $struct->cod_cuenta = '28150502';
        $struct->cod_prod = '01';
        $struct->accion = '+';
        $struct->cant_prod = '1,00';
        $struct->debito = '0';

        $this->reporFactura[] = (array)$struct;
    }

    public function otrosSoat()
    {
        $struct = $this->struct();

        $struct->cod_cuenta = '28150502';
        $struct->cod_prod = '01';
        $struct->accion = '+';
        $struct->cant_prod = '1,00';
        $struct->debito = $this->factura->otros ? $this->factura->otros : '0';

        $this->reporFactura[] = (array)$struct;
    }

    public function totalSoat()
    {
        $struct = $this->struct();

        $struct->cod_cuenta = '22050501';
        $struct->credito = $this->factura->costo + $this->factura->iva + $this->factura->otros;

        $this->reporFactura[] = (array)$struct;
    }

    public function struct()
    {
        return (object)[
            'tipo_comp' => '16',
            'cons_comp' => $this->consecutivo,
            'fecha_elab' => str_replace('-', '/', $this->factura->fecha_exp),
            'sigla_moneda' => '',
            'tasa_cambio' => '',
            'cod_cuenta' => '', 
            'iden_tercero' => $this->factura->num_doc,
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
            'descripcion' => $this->factura->num_fact,
            'cod_cc' => '',
            'debito' => '',
            'credito' => '',
            'obs' => '',
            'base_grab_lib_comp' => '',
            'base_exen_lib_comp' => '',
            'mes_cierre' => '',
            'solicitud' => $this->factura->id,
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
            'solicitud',
        ];
    }
}