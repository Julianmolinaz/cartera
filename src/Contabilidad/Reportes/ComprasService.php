<?php

namespace Src\Contabilidad\Reportes;

use App\Repositories as Repo;

class ComprasService
{
    protected $ini;
    protected $end;
    public    $reporte = [];
    protected $invoice = [];
    protected $facturas = [];
    protected $consecutivo;
    protected $reporFactura;
    protected $reportConsecutivo = [];

    public function __construct($ini, $end ,$consecutivo)
    {
        $this->ini = $ini;
        $this->end = $end;
        $this->consecutivo = intval($consecutivo);
    }

    public function execute($usarHeader)
    {
        if ($usarHeader) $this->reporte[] = $this->header();

        $this->getFacturas();
        $this->recorrerFacturas();
    }

    protected function recorrerFacturas()
    {
        foreach ($this->facturas as $factura) {
            $this->factura = $factura;
            $this->reporFactura = [];

            if ($this->factura->id === 1) {
                $this->revisarFacturaPorRtm();
            } else if ($this->factura->id === 2) {
                $this->revisarFacturaPorSoat();
            }

            $this->reporte = array_merge($this->reporte, $this->reporFactura);
            $this->consecutivo ++;
        }
    }

    protected function revisarFacturaPorRtm()
    {
        if ($this->factura->expedido_a === 'Gora') {
            $this->facturaRtmExpedidaAGora();
        } else if ($this->factura->expedido_a === 'Cliente') {
            $this->facturaRtmExpedidaAlCliente();
        }
    }

    protected function revisarFacturaPorSoat()
    {
        $this->costoSoat();
        $this->ivaSoat();
        $this->otrosSoat();
        $this->totalSoat();      
    }

    protected function facturaRtmExpedidaAGora()
    {
        $this->costoRtmGora();
        $this->ivaRtmGora();
        $this->otrosRtmGora();
        $this->totalRtmGora();
    }

    protected function facturaRtmExpedidaAlCliente()
    {
        $this->costoRtmCliente();
        $this->ivaRtmCliente();
        $this->otrosRtmCliente();
        $this->totalRtmCliente();
    }

    /*
    |-------------------------------------------------
    | Registros por SOAT
    |-------------------------------------------------
    */ 

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

    /*
    |-------------------------------------------------
    | Registros por RTM expedida a GORA
    |-------------------------------------------------
    */    

    protected function costoRtmGora()
    {
        $struct             = $this->struct();
        $struct->cod_cuenta = '62050102';
        $struct->cod_prod   = '02';
        $struct->accion     = '+';
        $struct->cant_prod  = '1,00';
        $struct->debito     = $this->factura->costo ? $this->factura->costo : '0';

        $this->reporFactura[] = (array)$struct;
    }

    protected function ivaRtmGora() 
    {
        $struct                 = $this->struct();
        $struct->cod_cuenta     = '24081001';
        $struct->cod_prod       = '02';
        $struct->accion         = '+';
        $struct->cant_prod      = '1,00';
        $struct->cod_impuesto   = '1';
        $struct->debito         = $this->factura->iva ? $this->factura->iva : '0';

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

    /*
    |-------------------------------------------------
    | Registros por RTM expedida a Cliente
    |-------------------------------------------------
    */    

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

    protected function getFacturas()
    {
        $this->facturas = Repo\FacturasRepository::findByRango(
            $this->ini,
            $this->end,
            [6, 32]
        );
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
            'iden_tercero' => $this->factura->cliente_num_documento,
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
    
    protected function header() 
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