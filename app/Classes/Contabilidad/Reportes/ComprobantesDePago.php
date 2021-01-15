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
    protected $bancos_no_encontrados;

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

            $this->recibo = _\Factura::find($e->id);

            // la cuenta de caja o bancos Debito

            $this->cuentasDebito();

            // conceptos Credito

            $this->cuentasCredito();    
        }
        // dd($this->reporte);
        return $this->reporte;

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
        $item->cod_cuenta = $cuenta;
        $item->cons_comp = $this->recibo->num_fact;
        $item->fecha_elab = $this->recibo->fecha;
        $item->iden_tercero = $this->recibo->credito->precredito->cliente->num_doc;
        $item->cod_prod = $this->recibo->credito->precredito->producto->nombre;  
        $item->credito = $pago->abono;
        $item->tipo = $this->recibo->tipo;
        $item->banco = $this->recibo->banco;

        $this->reporte[] = (array) $item;
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

        $item->cons_comp = $this->recibo->num_fact;
        $item->fecha_elab = $this->recibo->fecha;
        $item->iden_tercero = $this->recibo->credito->precredito->cliente->num_doc;
        $item->cod_prod = $this->recibo->credito->precredito->producto->nombre;
        $item->debito = $this->recibo->total;
        $item->tipo = $this->recibo->tipo;
        $item->banco = $this->recibo->banco;

        $this->reporte[] = (array) $item;

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
        // $ids = DB::table('facturas')
        //     ->where('fecha', '>=', ctrl\inv_fech($this->ini))
        //     ->where('fecha', '<=', ctrl\inv_fech($this->end))
        //     ->whereNotNull('credito_id')
        //     ->select('id')
        //     ->get();

        $date_str = "CONCAT(SUBSTRING(fecha, 7,4),'-',SUBSTRING(fecha, 4,2),'-', SUBSTRING(fecha, 1,2))";

        $ids = DB::select("select id
            from facturas where (
                date_format( ".$date_str.", '%Y-%m-%d') >= ?
                and
                date_format( ".$date_str.", '%Y-%m-%d') <= ?)", [$this->ini, $this->end]
            );

        return $ids;
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
