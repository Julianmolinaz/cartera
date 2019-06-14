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
    public $report;
    public $struct;
    public $credito;
    public $sanciones;

    public function __construct()
    {
        $this->middleware('auth');

        $this->struct = [
            'tipo_doc'      => '',
            'num_doc'       => '',
            'nombre'        => '',
            'fecha_creacion'=> '',
            'referencia'    => '',
            'periodo'       => '',
            'vlr_cuota'     => '',
            'num_cts'       => '',
            'dias_de_pago'  => '',
            'vlr_credito'   => '',
            'saldo_total'   => '',
            'pagos'         => [],
            'total_abonos$'       => 0,
            'total_sanciones$'    => 0,
            'total_sancionesNo'   => 0,
            'total_prejuridico$'  => 0,
            'total_juridico$'     => 0,
            'total_facturas' => 0
        ];
    }

    public function getEstadoCuenta($credito_id)
    {
        $this->credito = Credito::find($credito_id);

        // se cargan los datos generales de la obligación
        $this->setInfoGeneral();
        $this->struct['vlr_credito'] = $this->credito->valor_credito;
        
        // se cargan todos los pagos realizados hasta la fecha
        $this->getPagos();

        //se traen las sanciones de la obligacion
        $this->sanciones = DB::table('sanciones')->where('credito_id',$credito_id)->get();

        //inicialización del saldo total
        $this->struct['saldo_total'] = $this->credito->valor_credito;
        
        $this->getSaldos();

        return view('admin.estado_de_cuenta.index')
            ->with('cuenta', $this->struct);
    }

    public function getPagos()
    {
        $facturas = $this->credito->facturas;
        $array_facturas = [];

        foreach( $facturas as $factura) {
           $pagos = $this->getAbonosPorConcepto($factura);
  
            $temp = [
                'fecha'         => $factura->fecha,
                'num_fact'      => $factura->num_fact,
                'factura_total' => $factura->total,
                'abonos$'       => $pagos['abono_cuota'],
                'sanciones$'    => $pagos['abono_sanciones'],
                'sancionesNo'   => $pagos['num_sanciones'],
                'prejuridico$'  => $pagos['abono_prejuridico'],
                'juridico$'     => $pagos['abono_juridico'],
                'created_at'    => $factura->created_at,
                'total_a_pagar' => $total_a_pagar,
                'saldo'         => $total_a_pagar - $factura->total
            ];
            
            $total_a_pagar = $total_a_pagar - $factura->total;
            
            $this->struct['total_facturas'] += $factura->total;
            
            array_push($array_facturas, $temp);

        }

        $this->struct['pagos'] = $array_facturas;
    }
    
    public function getSaldos()
    {
        $ini = new Carbon($this->credito->created_at);
        $ini = $ini->startOfDay();


        if ( ($this->struct['pagos']) > 0) {
            
            $this->struct['pagos'][0]['total_a_pagar'] = $this->credito->valor_credito;

            foreach($this->struct['pagos'] as $pago){
                $fin = new Carbon($pago['created_at']);
                $fin = $fin->endOfDay();

                // obtiene las sanciones entre el rango del los pagos
                $sanciones = $this->getSanciones($ini, $fin);
                $pre_juridicos = $this->getPrejuridicos($ini, $fin);
                $ini = $fin;
            }

            $fin = Carbon::now()->endOfDay();

            $sanciones = $this->getSanciones($ini, $fin);
            
        }
    }

    public function getSanciones($ini, $fin)
    {
        $sum_sanciones = 0;
        $count_sanciones = 0;

        foreach($this->sanciones as $sancion) {

            if( $sancion->estado == 'Debe' || $sancion->estado == 'Ok' ) {
                $created = new Carbon($sancion->created_at);

                if ($created->gt($ini) && $created->lte($fin)) {
                    $count_sanciones ++;
                    $sum_sanciones += $sancion->valor;
                }
            }
        }
        
        $this->struct['total_sanciones$']   += $sum_sanciones;
        $this->struct['total_sancionesNo']  += $count_sanciones;
    
        return [
            'sum_sanciones' => $sum_sanciones,
            'count_sanciones' => $count_sanciones
        ];

    }

    public function setInfoGeneral() 
    {
        $this->struct['tipo_doc'] = $this->credito->precredito->cliente->tipo_doc;
        $this->struct['num_doc'] = $this->credito->precredito->cliente->num_doc; 
        $this->struct['nombre'] = $this->credito->precredito->cliente->nombre;
        $this->struct['fecha_creacion'] = $this->credito->created_at;
        $this->struct['referencia'] = $this->credito->id;
        $this->struct['periodo'] = $this->credito->precredito->periodo;
        $this->struct['vlr_cuota'] = $this->credito->precredito->vlr_cuota;
        $this->struct['num_cts']   = $this->credito->precredito->cuotas;
        $this->struct['dias_de_pago'] =
            ( $this->credito->precredito->s_fecha) ? 
              $this->credito->precredito->p_fecha.'-'.$this->credito->precredito->s_fecha 
            : $this->credito->precredito->p_fecha;        
    }

    public function getAbonosPorConcepto($factura)
    {
        $abono_cuota = 0;
        $abono_prejuridico = 0;
        $abono_juridico = 0;
        $abono_sanciones = 0;
        $num_sanciones   = 0;

        foreach($factura->pagos as $pago){
            if ($pago->concepto == 'Cuota' || $pago->concepto == 'Cuota Parcial') {
                $abono_cuota += $pago->abono;
                $this->struct['total_abonos$'] += $pago->abono;
            }
            else if ($pago->concepto == 'Prejuridico') {
                $abono_prejuridico += $pago->abono;
                $this->struct['total_prejuridico$'] += $pago->abono;
            }
            else if ($pago->concepto == 'Juridico') {
                $abono_juridico += $pago->abono;
                $this->struct['total_juridico$'] += $pago->abono;
            }
            else if ($pago->concepto == 'Mora') {
                $abono_sanciones = $pago->abono;
                $num_sanciones = $abono_sanciones / Variable::all()[0]->vlr_dia_sancion;
                $this->struct['total_sancionesNo'] += $num_sanciones;
                $this->struct['total_sanciones$'] += $pago->abono;
            }
        }
        return [
            'abono_cuota' => $abono_cuota,
            'abono_sanciones' =>  $abono_sanciones,
            'num_sanciones' => $num_sanciones,
            'abono_prejuridico' => $abono_prejuridico,
            'abono_juridico' => $abono_juridico
        ];
    }

    public function getAbonoSancionesTr($factura)
    {
        $abono_sanciones = 0;
        $num_sanciones   = 0;

        foreach($factura->pagos as $pago){
            if ($pago->concepto == 'Mora') {
                $abono_sanciones = $pago->abono;
            }
        }

        $num_sanciones = $abono_sanciones / Variable::all()[0]->vlr_dia_sancion;

        return [
            'abono_sanciones' => $abono_sanciones,
            'num_sanciones'   => (int)$num_sanciones
        ];
    }


    public function print_A4($credito_id)
    {
        $credito = Credito::find($credito_id);
        $this->setInfoGeneral($credito);

        $this->struct['vlr_credito'] = $credito->valor_credito;
        
        $this->getPagos($credito);
    }
}
