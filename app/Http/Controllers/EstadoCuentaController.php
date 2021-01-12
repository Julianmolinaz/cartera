<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Variable;
use App\Credito;
use Carbon\Carbon;
use PDF;
use DB;

class EstadoCuentaController extends Controller
{
    public $struct;
    public $credito;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getPDF($credito_id)
    {
        // cargar credito
        $this->credito = Credito::find($credito_id);

        // cargar datos

        $this->cargarDatosGenerales();

        //generar historial

        $this->cargarHistorico();
        $now = Carbon::now();

        $data = $this->struct;
        $now = $now->toDateString();

        $view = \View::make('admin.estado_de_cuenta.index', compact('data','now'))
            ->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('report.pdf');

        

    }

    public function getEstadoCuenta($credito_id)
    {
        // cargar credito
        $this->credito = Credito::find($credito_id);

        // cargar datos

        $this->cargarDatosGenerales();

        //generar historial

        $this->cargarHistorico();
        $now = Carbon::now();

        //  dd($this->struct);

        return view('admin.estado_de_cuenta.index')
            ->with('data', $this->struct)
            ->with('now',$now->toDateString());
    }

    public function cargarDatosGenerales()
    {
        // generar estructura general
        $this->getStruct();

        //cargar datos generales
        $this->setDatosGenerales();

    }

    public function getStruct()
    {
        $this->struct = [
            'cliente' => [
                'nombre'    => '',
                'doc_type'  => '',
                'num_doc'   => '',
            ],
            'credito' => [
                'id'            => '',
                'periodo'       => '',
                'vlr_cta'       => '',
                'num_cts'       => '',
                'dias_pago'     => '',
                'vlr_credito'   => '',
                'fecha_apertura'=> ''
            ],
            'items'     => [],
            'totales' => [
                'total_cuota'           => 0,
                'total_cuota_parcial'   => 0,
                'total_num_sanciones'   => 0,
                'total_sanciones'       => 0,
                'total_prejuridico'     => 0,
                'total_juridico'        => 0,
                'total_saldo'           => 0
            ]
        ];
    }

    public function setDatosGenerales()
    {
        $segunda_fecha = '';
        if($this->credito->precredito->s_fecha){
            $segunda_fecha = '-'.$this->credito->precredito->s_fecha;
        }

        $this->struct['cliente']['nombre']      = $this->credito->precredito->cliente->nombre;
        $this->struct['cliente']['doc_type']    = $this->credito->precredito->cliente->tipo_doc;
        $this->struct['cliente']['num_doc']     = $this->credito->precredito->cliente->num_doc;
        $this->struct['credito']['id']          = $this->credito->id;
        $this->struct['credito']['periodo']     = $this->credito->precredito->periodo;
        $this->struct['credito']['vlr_cta']     = $this->credito->precredito->vlr_cuota;
        $this->struct['credito']['num_cts']     = $this->credito->precredito->cuotas;
        $this->struct['credito']['dias_pago']   = $this->credito->precredito->p_fecha.''.$segunda_fecha;
        $this->struct['credito']['vlr_credito'] = $this->credito->valor_credito;
        $this->struct['credito']['fecha_apertura'] = $this->credito->created_at;
    }

    public function cargarHistorico()
    {
        // generar estructura por cada factura
        $this->cargarFacturas();

        // definir rangos y cargar cobros
        $this->cargarCobros();

        // generar totales
        $this->cargarTotales();

    }

    public function cargarFacturas()
    {
        $facturas = $this->credito->facturas;

        if ($facturas) {
            foreach ($facturas as $factura) {
                // FACTURA
                $item = $this->getStructItem();
                $item['factura']['fecha'] = $factura->created_at;
                $item['factura']['num']   = $factura->num_fact;
                $item['factura']['valor'] = $factura->total;
                
                foreach ($factura->pagos as $pago) {
                    $temp = [
                        'concepto' => $pago->concepto,
                        'valor'    => $pago->abono
                    ];
                    array_push($item['factura']['pagos'], $temp);
                }
                //PAGO
                array_push($this->struct['items'], $item);
            }
        }
    }

    public function getStructItem()
    {
        return [
            'factura' => [
                'fecha'       => '',
                'num'         => '',
                'valor'       => 0,
                'pagos'       => []
            ],
            'estado' => [
                'total_pagar'     => 0,
                'saldo'           => 0,
                'valor_sanciones' => 0,
                'num_sanciones'   => 0,
                'prejuridicos'    => [],
                'juridicos'       => []
            ]
        ];
    }

    public function cargarCobros() 
    {
        $ini = new Carbon($this->struct['credito']['fecha_apertura']);

        $fin = null;
        //echo 'ini'.$ini->toDateString().'--';

        $i = 0;

        for ($i; $i < count($this->struct['items']); $i++) {

            $fin = new Carbon( $this->struct['items'][$i]['factura']['fecha'] );
            //  echo 'fin'.$fin->toDateString().'<br>';

            // cargar cobros
            $item = $this->analizarCobros($ini, $fin);
            $this->struct['items'][$i]['estado']['num_sanciones'] = $item['num_sanciones']; 
            $this->struct['items'][$i]['estado']['valor_sanciones'] = $item['valor_sanciones']; 
            $this->struct['items'][$i]['estado']['prejuridicos'] = $item['prejuridicos']; 
            $this->struct['items'][$i]['estado']['juridicos'] = $item['juridicos']; 

            $ini = $fin;
            //echo 'ini'.$ini->toDateString().'--';
        }

        if ($this->credito->estado == 'Cancelado' || 
            $this->credito->estado == 'Cancelado por refinanciación'){
            $ini = null;
             
        } else {
            $fin = Carbon::now();
            // cargar cobros
            $item2 = $this->analizarCobros($ini, $fin);
            $this->struct['items'][$i]['estado']['num_sanciones'] = $item2['num_sanciones']; 
            $this->struct['items'][$i]['estado']['valor_sanciones'] = $item2['valor_sanciones']; 
            $this->struct['items'][$i]['estado']['prejuridicos'] = $item2['prejuridicos']; 
            $this->struct['items'][$i]['estado']['juridicos'] = $item2['juridicos']; 
        }
    }

    public function analizarCobros($ini, $fin)
    {
        $sanciones = $this->getSanciones($ini, $fin);
        $extras    = $this->getPrejuridicos($ini, $fin);

        return [
            'num_sanciones'   => $sanciones['num'],
            'valor_sanciones' => $sanciones['vlr'],
            'prejuridicos'    => $extras['prejuridicos'],
            'juridicos'       => $extras['juridicos']
        ];
    }

    public function getSanciones($ini,$fin)
    {
        // echo $ini->startOfDay().'****'.$fin->endOfDay().'<bR>';
        $sanciones =  DB::table('sanciones')
            ->where('credito_id',$this->credito->id)
            ->where('estado','<>','Exonerada')
            ->where('created_at','>=',$ini)
            ->where('created_at','<',$fin)
            ->get();
            
        $vlr_sanciones = 0;
        foreach($sanciones as $sancion){
            $vlr_sanciones += $sancion->valor;
        }

        return [
            'num' => count($sanciones),
            'vlr' => $vlr_sanciones
        ];
    }

    public function getPrejuridicos($ini, $fin)
    {
        $prejuridicos = DB::table('extras')
            ->where('credito_id',$this->credito->id)
            ->where('concepto','Prejuridico')
            ->where('created_at','>=',$ini)
            ->where('created_at','<',$fin)
            ->sum('valor');

        $juridicos = DB::table('extras')
            ->where('credito_id',$this->credito->id)
            ->where('concepto','Juridico')
            ->where('created_at','>=',$ini)
            ->where('created_at','<',$fin)
            ->sum('valor');
        
        return [
            'prejuridicos' => $prejuridicos,
            'juridicos'    => $juridicos
        ];
    }

    public function cargarTotales()
    {
        try {
            //code...
            $total_pagar = $this->credito->valor_credito;
            $saldo  = 0;
            $i      = 0;
            for ($i; $i < count($this->struct['items']); $i++) {

                $total_pagar = (float)$total_pagar +
                (float)$this->struct['items'][$i]['estado']['valor_sanciones'] +
                (float)$this->struct['items'][$i]['estado']['prejuridicos'] + 
                (float)$this->struct['items'][$i]['estado']['juridicos'];
    
                if (isset($this->struct['items'][$i]['factura'])) {

                    foreach ($this->struct['items'][$i]['factura']['pagos'] as $pago) {
                        if ($pago['concepto'] == 'Cuota') {
                            $this->struct['totales']['total_cuota'] += $pago['valor'];

                        } else if ($pago['concepto'] == 'Cuota Parcial') {
                            $this->struct['totales']['total_cuota_parcial'] += $pago['valor'];

                        } else if ($pago['concepto'] == 'Mora') {
                            $this->struct['totales']['total_sanciones'] += $pago['valor'];

                        } else if ($pago['concepto'] == 'Prejuridico') {
                            $this->struct['totales']['total_prejuridico'] += $pago['valor'];

                        } else if ($pago['concepto'] == 'total_juridico') {
                            $this->struct['totales']['total_juridico'] += $pago['valor'];
                        }

                    }


                    $this->struct['items'][$i]['estado']['total_pagar'] = $total_pagar;
                    $saldo = $total_pagar - $this->struct['items'][$i]['factura']['valor'];
                    $this->struct['items'][$i]['estado']['saldo']= $saldo;
                    
                    $total_pagar = $saldo;
                } else {
                    $this->struct['items'][$i]['estado']['total_pagar'] = $total_pagar;
                    $this->struct['items'][$i]['estado']['saldo']= $total_pagar;
                }
            }



        } catch (\Exception $e) {
            dd($e);
        }
    }
}
