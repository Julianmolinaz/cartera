<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Variable;
use App\Credito;

class EstadoCuentaController extends Controller
{
    public $report;
    public $encabezado;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getEstadoCuenta($credito_id)
    {
        $credito = Credito::find($credito_id);

        $this->getStructEncabezadoTr();
        
        $this->getPagosTr($credito);
    }

    public function getStructEncabezadoTr()
    {
        $this->encabezado = [
            'tipo_doc'      => '',
            'num_doc'       => '',
            'nombre'        => '',
            'vlr_cuota'     => '',
            'num_cts'       => '',
            'dias_de_pago'  => '',
            'vlr_credito'   => '',
            'pagos'         => []
        ];
    }

    public function getPagosTr($credito)
    {
        $facturas = $credito->facturas;
        $total_a_pagar = $credito->valor_credito;
        $array_facturas = [];

        foreach( $facturas as $factura) {
            $abonos_cta = $this->getAbonoTr($factura);
            $sanciones = $this->getAbonoSancionesTr($factura);
  

            $temp = [
                'fecha'         => $factura->fecha,
                'num_fact'      => $factura->num_fact,
                'abonos'        => $abonos_cta,
                'sanciones$'    => $sanciones['abono_sanciones'],
                'sancionesNo'   => $sanciones['num_sanciones'],
                'total_a_pagar' => $total_a_pagar,
                'saldo'         => $total_a_pagar - $factura->total
            ];

            $total_a_pagar = $total_a_pagar - $factura->total;

            array_push($array_facturas, $temp);

        }

        dd($array_facturas);
    }   

    public function getAbonoTr($factura)
    {
        $abono_cuota = 0;

        foreach($factura->pagos as $pago){
            if ($pago->concepto == 'Cuota' || $pago->concepto == 'Cuota Parcial') {
                $abono_cuota += $pago->abono;
            }
        }
        return $abono_cuota;
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
}
