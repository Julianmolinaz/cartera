<?php

namespace App\Classes\Contabilidad\Reportes;
use \App\Http\Controllers as Ctrl;

// use App\Classes\ConsolidadoComprobantesPago as Consolidado;
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
    protected $prerecibos;              // todos los pagos por solicitud en el rango de fecha
    protected $trash = [];
    protected $status;                  // 'credito', 'solicitud'
    protected $prerecibo;               // contendor del pago por solicitud
    protected $clientes = [];           // Array de cllientes

    public function __construct($ini, $end, $consecutivo)
    {
        $this->ini = $ini;
        $this->end = $end;

       $this->consecutivo = intval($consecutivo);
    }


    public function make($header)
    {
        if ($header)
             $this->reporte[] = $this->header();

        set_time_limit(400);
        
        
        $this->makePagosPorSolicitud();


        // dd($this->reporte);

        $this->makePagosPorCredito();

        /**
         * Descomentar para sacar consolidado
         */

        // $consolidado = new ConsolidadoComprobantesPago($this->reporte);

        // $reporte_consolidado = array_merge([$this->header()], $consolidado->make());
        
        // return $reporte_consolidado;

        // dd($reporte_consolidado);

        return array_merge([$this->header()], $this->reporte);
    }

    public function makePagosPorCredito()
    {

        $this->status = 'credito';

        $ids = $this->getIdsRecibos();

        foreach ($ids as $e) {

            $this->temporal = [];

            $this->recibo = _\Factura::find($e->id);

            if ($this->recibo->pagos) {
    
                $this->getConsecutivo();
    
                // la cuenta de caja o bancos
    
                $this->cuentasDebito();
    
                $this->cuentasCredito();  
                
                // CUENTA POR INICIAL
                
                $this->validarPartida();
    
                $this->reporte = array_merge($this->reporte, $this->temporal);
            }

        }

    }

    public function makePagosPorSolicitud() 
    {

        $this->status = 'solicitud';
        $this->getPagosSolicitud();

        foreach ($this->prerecibos as $prerecibo) {

            $this->getConsecutivo();

            $this->prerecibo = $prerecibo;

            $this->temporal = [];
            
            foreach ($prerecibo->pagos as $pago) {

                if ($pago->concepto_id == 2) {

                    $struct = $this->struct();
                    $struct->cod_cuenta = '11050501';
                    $struct->debito = $pago->subtotal;

                    $this->temporal[] = (array) $struct;

                    $struct = $this->struct();
                    $struct->cod_cuenta = '13050501';
                    $struct->credito = $pago->subtotal;
                    $struct->prefijo = 'CC';
                    $struct->consec = '1';
                    $struct->no_cuota = '1';
                    $struct->fecha_venc = '31/12/2021';

                    $this->temporal[] = (array) $struct;


                }
            }

            
            if ($this->temporal) {

                $this->reporte = array_merge($this->reporte, $this->temporal);
            }
            
        }
       
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

        for ($i = 1; $i < count($this->temporal); $i++) {
            
            $suma += $this->temporal[$i]['credito'];
            // dd($suma);
        }

        $diferencia = $this->temporal[0]['debito'] - $suma;

        if ($diferencia < 0) {

            $item = $this->struct();
            $item->cod_cuenta = '13802005';
            $item->debito = $diferencia * -1;

            $this->temporal[] = (array) $item;

            $this->trash[] = $this->recibo;
            
        } else if($diferencia > 0) {

            $item = $this->struct();
            $item->cod_cuenta = '23809501';
            $item->credito = $diferencia;

            $this->temporal[] = (array) $item;
            $this->trash[] = $this->recibo;
        }
    }


    public function cuentasCredito()
    {
        if (! isset($this->recibo->credito)) {
            throw new \Exception("No se encuentra un crédito para el recibo ". $this->recibo->id, 1);
        }
       
        $pagos = $this->recibo->pagos;
        
        foreach ($pagos as $pago) {     

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
                    $this->go($pago, '13802005');
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
            $item->fecha_venc = '31/12/2021';
        }

        $item->cod_cuenta = $cuenta;
        $item->credito = $pago->abono;

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
            $item->cod_cuenta = $this->getCuentaBanco($item->banco);
        }
        
        $item->debito = $this->recibo->total;
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
        // $clientes =  $this->clientes();

        $ids = DB::select(
            "select facturas.id
                from facturas 
                inner join creditos on facturas.credito_id = creditos.id
                inner join precreditos on creditos.precredito_id = precreditos.id
                inner join clientes on precreditos.cliente_id = clientes.id
                where 
                (   
                    date_format( ".$date_str.", '%Y-%m-%d') >= ?
                    and
                    date_format( ".$date_str.", '%Y-%m-%d') <= ?    
                )
                    and facturas.credito_id is not null
                    and precreditos.cartera_id in (6,32)
                    and clientes.num_doc in ?"
                
                , [$this->ini, $this->end, $this->clientes]
            );
            
        return $ids;
    }

    public function getPagosSolicitud():void
    { 
        // $clientes =  $this->clientes2();
        
        $this->prerecibos = _\Factprecredito::
              join('precreditos', 'fact_precreditos.precredito_id','=','precreditos.id')
            ->join('clientes','precreditos.cliente_id', '=', 'clientes.id')
            ->select('fact_precreditos.*')
            ->where('fact_precreditos.fecha','>', $this->ini)
            ->where('fact_precreditos.fecha','<', $this->end)
            ->whereIn('precreditos.cartera_id',[6, 32])
            ->whereIn('clientes.num_doc', $this->clientes)
            ->with('precredito.credito', 'precredito.cliente')
            ->get();
    }

    public function struct()
    {
        return (object)[
            'tipo_comp' => 18,
            'cons_comp' => $this->consecutivo,
            'fecha_elab' => ($this->status == 'credito') ? str_replace('-', '/', $this->recibo->fecha) :  str_replace('-', '/', $this->prerecibo->fecha),
            'sigla_moneda' => 'COP',
            'tasa_cambio' => '',
            'cod_cuenta' => '',
            'iden_tercero' => ($this->status == 'credito') ? $this->recibo->credito->precredito->cliente->num_doc : $this->prerecibo->precredito->cliente->num_doc,
            'sucursal' => '',
            'cod_prod' => ($this->status == 'credito') ? '' : '',
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
            'descripcion' => ($this->status == 'credito') ? $this->recibo->num_fact : $this->prerecibo->num_fact,
            'cod_cc' => '',
            'debito' => '',
            'credito' => '',
            'obs' => ($this->status == 'credito') ? 'Abono a credito' : 'Inicial',
            'base_grab_lib_comp' => '',
            'base_exen_lib_comp' => '',
            'mes_cierre' => '',
            'tipo' => ($this->status == 'credito') ? $this->recibo->tipo : $this->prerecibo->tipo,
            'banco' => ($this->status == 'credito') ? $this->recibo->banco : ''
        ];
    }

    public function header() 
    {
        return 
		[
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
