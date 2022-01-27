<?php

namespace App\Classes\Contabilidad\Reportes;
use \App\Http\Controllers as Ctrl;

use Carbon\Carbon;
use Exception;
use App as _;
use DB;

class ComprobanteVentas
{
    protected $ini;                             
    protected $end;                                                                           
    protected $factura;  
    protected $iva;                       
    protected $facturas;
    protected $primerSoat;
    protected $consecutivo;
    protected $reporte = [];
    protected $reportConsecutivo = [];
    protected $precredito;

    public function __construct($ini, $end, $consecutivo)
    {
        $this->ini = $ini;
        $this->end = $end;
        $this->iva = 0.19;

        $this->consecutivo = intval($consecutivo);
    }

    public function make($header)
    {        
        if ($header) 
            $this->reporte[] = $this->header();

        $ids_precreditos = $this->getPrecreditos();

        foreach ($ids_precreditos as $id_precredito) {
            $this->precredito = _\Precredito::find($id_precredito->id);
            $this->primerSoat = false;
            
            foreach ($this->precredito->ref_productos as $factura) {
                
                $this->factura = $factura;
                
                if ($this->factura->expedido_a && $this->facturaEnRango()) {

                    if ($this->factura->nombre === 'R.T.M') {

                        $this->rtm();  
                             
                    } else if ($this->factura->nombre === 'SOAT') {

                        $this->soat();                
                    }

                    $this->consecutivo ++;
                } 
                
            }

        }
        // dd($this->reporte);
        return $this->reporte;

    }

    public function rtm()
    {
        if ($this->factura->expedido_a === 'Gora') {

            $this->porGora();

        } else if ($this->factura->expedido_a === 'Cliente') {

            $this->porCliente();
        }
    }


    public function facturaEnRango()
    {

        
        $fecha_exp = new Carbon($this->factura->fecha_exp);

        if ($fecha_exp->gte($this->ini) && $fecha_exp->lte($this->end)){
            return true;
        } else {
            return false;
        }

    }


    /*
    |--------------------------------------------------------------------------
    | RTM EXPEDIDA A GORA 
    |--------------------------------------------------------------------------
    |
    | Genera la estrucutura para RTM facturada a GORA
    | El valor de la venta total se divide por el 1.19 y se resta a a la venta 
    |
    */
    
    public function porGora()
    {
        if ($this->validarIntegridad(true, true, true, false)) {

            $struct = $this->struct();
            $venta = $this->getVenta();

            $vlr_und = $venta / ($this->iva + 1);
            $struct->novedad = $this->factura->iva > 0 ? '' : 'rtm sin iva';
            $struct->cod_prod = '02';
            $struct->cod_cargo = '28';
            $struct->vlr_form_pago = $this->numNoRound($venta);
            $struct->vlr_und = $this->numNoRound($vlr_und);
            
            $this->reporte[] = (array)$struct;
        }
       
    }

    /*
    |--------------------------------------------------------------------------
    | RTM EXPEDIDA A CLIENTE

    |--------------------------------------------------------------------------
    |
    | Genera la estrucutura para RTM facturada a cliente 
    |
    */

    public function porCliente()
    {
        if ($this->validarIntegridad(true, true, true, false)) {
            $struct = $this->struct();
            $venta = $this->getVenta();

            $struct->cod_prod = '03';
            $struct->vlr_form_pago = $this->numNoRound($venta);
            $struct->vlr_und = $this->numNoRound($venta);

            $this->reporte[] = (array)$struct;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SOAT
    |--------------------------------------------------------------------------
    |
    | Genera la estrucutura para SOAT
    |
    */

    public function soat()
    {
        if ($this->validarIntegridad(true, true, false, false)) {
            $struct = $this->struct();
            $venta = $this->getVenta();

            $struct->cod_prod = '01';
            $struct->vlr_form_pago = $this->numNoRound($venta);
            $struct->vlr_und = $this->numNoRound($venta);

            $this->reporte[] = (array)$struct;
        }
    }

    public function validarIntegridad($costo, $fecha_exp, $iva, $otros)
    {
        $validado = true;

        if ($costo) {
            if (!$this->factura->costo)
            $validado = false;
        }
        if ($fecha_exp) {
            if (!$this->factura->fecha_exp || $this->factura->fecha_exp == '0000-00-00')
            $validado = false;
        }
        if ($iva) {
            if (!$this->factura->iva)
            $validado = false;
        }
        if ($otros) {
            if (!$this->factura->otros)
            $validado = false;
        }

        return $validado;
    }

    public static function numNoRound($value) 
    {
        return number_format(floor($value),0);
    }

    /*
    |--------------------------------------------------------------------------
    | VENTA GENERAL 
    |--------------------------------------------------------------------------
    |
    | Valida que si el producto es diferente de producto_id = 1, 2 
    | Si el valor es diferente calcula la venta por combo 
    | Si el valor es igual calcula la venta para un producto 
    |
    */

    public function getVenta()
    {
        if ($this->factura->producto_id != 1 || $this->factura->producto_id != 2) {

            return $this->calcularVentaVariosProductos();


        } else if ($this->factura->producto_id = 1 || $this->factura->producto_id = 2) {

            return $this->calcularVenta($this->factura->inicial);
        }
    }

    public function calcularVentaVariosProductos()
    {
        if (!$this->primerSoat) {

            if ($this->factura->nombre == 'SOAT') {

                $soats = DB::table('ref_productos')
                    ->where('precredito_id', $this->precredito->id)
                    ->where('fecha_exp', '<>', '0000-00-00')
                    ->where('nombre', 'SOAT')
                    ->orderBy('fecha_exp')
                    ->get();

                if ($soats && $soats[0]->id == $this->factura->id) {
                    $this->primerSoat = true;
                    return $this->calcularVenta($this->precredito->cuota_inicial);
                } else {
                    return $this->calcularVenta(0);
                }

            } else {

                return $this->calcularVenta(0);
            }
            
        } else {

            return $this->calcularVenta(0);
        }
    }


    public function calcularVenta($inicial)
    {

        $iva = ($this->factura->nombre == 'SOAT') ? 0 : $this->factura->iva;

        $factor = $this->getFactor($this->precredito->cuotas, $this->precredito->periodo);
        

        $costo = $this->factura->costo + $this->factura->iva + $this->factura->otros;


        $vlr_fin = $costo - $inicial;


        $interes = ($vlr_fin * $factor ) - $vlr_fin;


        $venta = $costo + $interes;

        // echo "inicial: {$inicial}, costo: {$this->factura->costo}, iva: {$this->factura->iva}, otros: {$this->factura->otros}<br> COSTO: {$costo}, vlr_fin:  {$vlr_fin}, interes: {$interes}, venta: {$venta}<br>";

        return $venta;       
    }

    public function getFactor($cuotas, $periodo)
    {

        $meses = 0;

        if ($this->precredito->periodo == 'Quincenal') {

            $meses = $cuotas / 2;

        } else {

            $meses = $cuotas;
        }

        switch ($meses) {
            case 1:
                return 1.10006;
                break; 
            case 2:
                return 1.20016;
                break;
            case 3:
                return 1.3002;
                break;
            case 4:
                return 1.40008;
                break;
            case 5:
                return 1.4004;
                break;
            case 6:
                return 1.50036;
                break;
            case 7:
                return 1.49996;
                break;   
            case 8:
                return 1.5; 
                break;
            default:
                return 1.5; 
                break;
                throw new Exception('Se superan el numero de meses, ver solicitud: '. $this->precredito->id, 400);
        }
    }

    public function getPrecreditos()
    {
        $precreditosId = DB::table('ref_productos')
            ->join('precreditos','ref_productos.precredito_id','=','precreditos.id')
            ->whereBetween('ref_productos.fecha_exp',[$this->ini, $this->end])
            ->whereIn('precreditos.cartera_id', [6, 32])
            ->where('precreditos.id', 35082)
            ->where('precreditos.aprobado', 'Si')
            ->select('ref_productos.precredito_id as id')
            ->groupBy('precreditos.id')
            ->orderBy('ref_productos.fecha_exp')
            ->get();  

        return $precreditosId;
    }

    public function struct()
    {
        return (object)[
            '222' => '1',
            'consecu' => $this->consecutivo,
            'iden_tercero' => $this->precredito->cliente->num_doc,
            'sucursal' => '',
            'cod_cc' => '',
            'fecha_elab' => str_replace('-', '/', $this->factura->fecha_exp),
            'sigla_moneda' => '',
            'tasa_cambio' => '',
            'nom_contac' => '',
            'email_contac' => '',
            'ord_compra' => '',
            'ord_entrega' => '',
            'fecha_ord_entrega' => '',
            'cod_prod' => '', 
            'desc_prod' => '', 
            'ident_vende' => '900975741',
            'cod_bodega' => '',
            'cant_prod' => '1,00',
            'vlr_und' => '',
            'vlr_desc' => '',
            'base_aui'=> '',
            'cod_cargo'=> '',
            'cod_cargo_dos'=> '',
            'cod_rete'=> '',
            'cod_rete_ica'=> '',
            'cod_rete_iva'=> '',
            'cod_form_pago'=> '2',
            'vlr_form_pago'=> '',
            'fecha_venc' => '31/12/2021',
            'obs' => '',
            'solicitud' => $this->precredito->id,
            'novedad' => ''

        ];
    }

    public function header() 
    {
        return [
            '222',
            'Consecutivo',
            'Identificación tercero',
            'Sucursal',
            'Código centro/subcentro de costos',
            'Fecha de elaboración',
            'Sigla moneda',
            'Tasa de cambio',
            'Nombre contacto',
            'Email Contacto',
            'Orden de compra',
            'Orden de entrega',
            'Fecha orden de entrega',
            'Código producto',
            'Descripción producto',
            'Identificación vendedor',
            'Código de bodega',
            'Cantidad producto',
            'Valor unitario',
            'Valor Descuento',
            'Base AIU',
            'Código impuesto cargo',
            'Código impuesto cargo dos',
            'Código impuesto retención',
            'Código ReteICA',
            'Código ReteIVA',
            'Código forma de pago',
            'Valor Forma de Pago',
            'Fecha Vencimiento',
            'Observaciones',
            'solicitud',      
            'novedad' 
        ];
    }
}
