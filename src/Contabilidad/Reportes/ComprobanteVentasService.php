<?php

namespace Src\Contabilidad\Reportes;
use App\Repositories as Repo;

class ComprobanteVentasService
{
    protected $ini;
    protected $end;                                                      
    protected $invoice;
    protected $primerSoat;
    protected $consecutivo;
    public    $reporte = [];

    const IVA = 0.19;
    const NIT = 900975741;
    const VENCE = "31/12/2022";
    const COD_FORMA_PAGO = 2;

    public function __construct($ini, $end, $consecutivo)
    {
        $this->ini = $ini;
        $this->end = $end;
        $this->consecutivo = intval($consecutivo);
    }

    public function execute($conHeader)
    {
        if ($conHeader) {
            $this->reporte[] = $this->header();
        }
        
        $solicitudes = $this->getPrecreditos();
        $this->recorrerInvoices($solicitudes);
    }

    protected function recorrerInvoices($solicitudes)
    {
        foreach ($solicitudes as $key => $solicitud) {
            $this->primerSoat = false;
            foreach ($solicitud as $invoice) {
                $this->invoice = $invoice;

                if ($invoice->producto_id === 1) {
                    $this->rtm();
                } else if ($invoice->producto_id === 2) {
                    $this->soat();
                }
                $this->consecutivo ++;
            }
        }
    }

    protected function rtm()
    {
        if ($this->invoice->expedido_a === "Gora") {
            $this->rtmExpedidoAGora(); 
        } else if ($this->invoice->expedido_a === "Cliente") {
            $this->rtmExpedidoAlCliente(); 
        }
    }

    protected function rtmExpedidoAGora()
    {
        $venta = $this->getValorVenta();
        $valorUnitario = $venta / (self::IVA + 1);
        
        $temp = $this->struct();
        $temp->cod_prod = '02';
        $temp->cod_cargo = '28';
        $temp->vlr_form_pago = number_format(floor($venta), 0);
        $temp->vlr_und = number_format(floor($valorUnitario), 0);
        $temp->iden_tercero = $this->invoice->cliente_num_documento;

        $this->reporte[] = (array)$temp;
    }

    protected function rtmExpedidoAlCliente()
    {
        $venta = $this->getValorVenta();

        $temp = $this->struct();
        $temp->cod_prod = '03';
        $temp->vlr_form_pago = number_format(floor($venta), 0);
        $temp->vlr_und = number_format(floor($venta), 0);

        $this->reporte[] = (array)$temp;
    }

    protected function soat()
    {
        $venta = $this->getValorVenta();

        $temp = $this->struct();
        $temp->cod_prod = '01';
        $temp->vlr_form_pago = number_format(floor($venta), 0);
        $temp->vlr_und = number_format(floor($venta), 0);

        $this->reporte[] = (array)$temp;
    }


    protected function getValorVenta()
    {
        $cuotaInicial = 0;

        if ($this->esPrimerSoat()) {
            $cuotaInicial = $this->invoice->solicitud_cuota_inicial;
            $this->primerSoat = true;
        } 

        $iva = ($this->invoice->id == 2) ? 0 : $this->invoice->iva;
        $factor = $this->getFactor();
        $costo = $this->invoice->costo + $iva + $this->invoice->otros;
        $vlrFin = $costo - $cuotaInicial;
        $interes = ($vlrFin * $factor ) - $vlrFin;
        $venta = $costo + $interes;

        return $venta;
    }

    protected function getPrecreditos()
    {
        $invoices = Repo\FacturasRepository::findByRango(
            $this->ini,
            $this->end,
            [6, 32]
        );
        $collection = collect($invoices);
        return $collection->groupBy('precreditoId');
    }

    protected function getFactor()
    {
        $factorPeriodo = ($this->invoice->solicitud_periodo === "Quincenal") ? 2 : 1;
        $meses = $this->invoice->solicitud_cuotas / $factorPeriodo;
        $factor = Repo\FactoresRepository::getFactores($meses);
        return $factor;
    }

    protected function esPrimerSoat()
    {
        $result = false;

        if (!$this->primerSoat && $this->invoice->producto_id === 2) {
            $primerVentaSoat = Repo\VentasRepository::firstVentaSoat(
                $this->invoice->precredito_id
            );
            if ($primerVentaSoat) {
                if ($primerVentaSoat->id === $this->invoice->venta_id) {
                    $result = true;
                }
            }
        }

        return $result;
    }

    protected function struct()
    {
        return (object)[
            '222' => '1',
            'consecu' => $this->consecutivo,
            'iden_tercero' => $this->invoice->cliente_num_documento,
            'sucursal' => '',
            'cod_cc' => '',
            'fecha_elab' => str_replace('-', '/', $this->invoice->fecha_exp),
            'sigla_moneda' => '',
            'tasa_cambio' => '',
            'nom_contac' => '',
            'email_contac' => '',
            'ord_compra' => '',
            'ord_entrega' => '',
            'fecha_ord_entrega' => '',
            'cod_prod' => '', 
            'desc_prod' => '', 
            'ident_vende' => self::NIT,
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
            'cod_form_pago'=> self::COD_FORMA_PAGO,
            'vlr_form_pago'=> '',
            'fecha_venc' => self::VENCE,
            'obs' => '',
            'solicitud' => $this->invoice->precredito_id,
            'novedad' => ''
        ];
    }

    protected function header() 
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