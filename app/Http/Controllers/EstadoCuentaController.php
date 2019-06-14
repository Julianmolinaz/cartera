<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Variable;
use App\Credito;
use PDF;

class EstadoCuentaController extends Controller
{
    public $report;
    public $struct;

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
        $credito = Credito::find($credito_id);

        $this->setInfoGeneral($credito);

        $this->struct['vlr_credito'] = $credito->valor_credito;
        
        $this->getPagos($credito);

        return view('admin.estado_de_cuenta.index')
            ->with('cuenta', $this->struct);
    }

    public function getPagos($credito)
    {
        $facturas = $credito->facturas;
        $total_a_pagar = $credito->valor_credito;
        $array_facturas = [];

        foreach( $facturas as $factura) {
           $pagos = $this->getAbonosPorConcepto($factura);
  
            $temp = [
                'fecha'         => $factura->fecha,
                'num_fact'      => $factura->num_fact,
                'abonos$'       => $pagos['abono_cuota'],
                'sanciones$'    => $pagos['abono_sanciones'],
                'sancionesNo'   => $pagos['num_sanciones'],
                'prejuridico$'  => $pagos['abono_prejuridico'],
                'juridico$'     => $pagos['abono_juridico'],
                'factura_total' => $factura->total,
                'total_a_pagar' => $total_a_pagar,
                'saldo'         => $total_a_pagar - $factura->total
            ];
            
            $total_a_pagar = $total_a_pagar - $factura->total;

            $this->struct['total_facturas'] += $factura->total;

            array_push($array_facturas, $temp);

        }

        $this->struct['pagos'] = $array_facturas;
    }   

    public function setInfoGeneral($credito) 
    {
        $this->struct['tipo_doc'] = $credito->precredito->cliente->tipo_doc;
        $this->struct['num_doc'] = $credito->precredito->cliente->num_doc; 
        $this->struct['nombre'] = $credito->precredito->cliente->nombre;
        $this->struct['fecha_creacion'] = $credito->created_at;
        $this->struct['referencia'] = $credito->id;
        $this->struct['periodo'] = $credito->precredito->periodo;
        $this->struct['vlr_cuota'] = $credito->precredito->vlr_cuota;
        $this->struct['num_cts']   = $credito->precredito->cuotas;
        $this->struct['dias_de_pago'] =
            ( $credito->precredito->s_fecha) ? 
              $credito->precredito->p_fecha.'-'.$credito->precredito->s_fecha 
            : $credito->precredito->p_fecha;        
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
