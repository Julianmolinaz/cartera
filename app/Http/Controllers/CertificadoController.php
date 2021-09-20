<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Credito;
use App\Cliente;
use Carbon\Carbon;
use Exception;

class CertificadoController extends Controller
{
    public function paz_y_salvo($credito_id,$tipo)
    {
        $data = $this->getDataPazYSalvo($credito_id, $tipo);
        
        $view = \View::make('start.certificados.paz_y_salvo',compact('data'))->render();

        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHtml($view);

        return $pdf->stream('paz_y_salvo_'.$data->numero_documento.'.pdf');
    }

    public function getDataPazYSalvo($credito_id, $tipo)
    {
        $fecha = Carbon::now();
        $credito = Credito::find($credito_id);
        $data = [];
        
        if ($tipo == 'cliente') {
            $data = (object)[
                'fecha' => $fecha->format('d/m/Y'),
                'nombre' => $credito->precredito->cliente->nombre,
                'tipo_documento' => $credito->precredito->cliente->tipo_doc,
                'numero_documento' => $credito->precredito->cliente->num_doc
            ];

        } else if ($tipo == 'codeudor') {

            if ($credito->precredito->cliente->version == 1) {
                $data = (object)[
                    'fecha' => $fecha->format('d/m/Y'),
                    'nombre' => $credito->precredito->cliente->codeudor->nombrec,
                    'tipo_documento' => $credito->precredito->cliente->codeudor->tipo_docc,
                    'numero_documento' => $credito->precredito->cliente->codeudor->num_docc
                ];

            } else if ($credito->precredito->cliente->version == 2) {
                $data = (object)[
                    'fecha' => $fecha->format('d/m/Y'),
                    'nombre' => $credito->precredito->cliente->codeudor->nombre,
                    'tipo_documento' => $credito->precredito->cliente->codeudor->tipo_doc,
                    'numero_documento' => $credito->precredito->cliente->codeudor->num_doc
                ];
            }

        } else {
            throw new Exception("El tipo de cliente no corresponde a cliente o a codeudor", 1);
            
        }
        
        if ($data->tipo_documento == 'Cedula Ciudadanía') {
            $data->tipo_documento = 'Cédula de Ciudadanía';
        }
        
        $data->credito_id = $credito_id;

        return $data;

    }

    /**
     * Preaviso Centrales
     */

    public function preavisoCentrales($credito_id,$tipo)
    {
        $data = $this->getDataPreavisoCentrales($credito_id, $tipo);
        
        $view = \View::make('start.certificados.preaviso_centrales',compact('data'))->render();

        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHtml($view);

        return $pdf->stream('preaviso_centrales_'.$data->numero_documento.'.pdf');
    }

    public function getDataPreavisoCentrales($credito_id, $tipo)
    {
        $fecha = Carbon::now();
        $credito = Credito::find($credito_id);
        $data = [];
        
        if ($tipo == 'cliente') {
            $data = (object)[
                'fecha' => $fecha->format('d/m/Y'),
                'nombre' => $credito->precredito->cliente->nombre,
                'tipo_documento' => $credito->precredito->cliente->tipo_doc,
                'numero_documento' => $credito->precredito->cliente->num_doc,
                'telefono' => $credito->precredito->cliente->movil,
                'municipio' => $credito->precredito->cliente->municipio->nombre,
                'departamento' => $credito->precredito->cliente->municipio->departamento,
                'producto' => $credito->precredito->producto->nombre,
                'sanciones' => $credito->sanciones_debe,
                'saldo' => $credito->saldo,
            ];

        } else if ($tipo == 'codeudor') {

            $data = (object)[
                'fecha' => $fecha->format('d/m/Y'),
                'nombre' => $credito->precredito->cliente->codeudor->nombre,
                'tipo_documento' => $credito->precredito->cliente->codeudor->tipo_doc,
                'numero_documento' => $credito->precredito->cliente->codeudor->num_doc,
                'telefono' => $credito->precredito->cliente->codeudor->movil,
                'municipio' => $credito->precredito->cliente->codeudor->municipio->nombre,
                'departamento' => $credito->precredito->cliente->codeudor->municipio->departamento,
                'producto' => $credito->precredito->producto->nombre,
                'sanciones' => $credito->sanciones_debe,
                'saldo' => $credito->saldo,
            ];

        } else {
            throw new Exception("El tipo de cliente no corresponde a cliente o a codeudor", 1);
            
        }
        
        if ($data->tipo_documento == 'Cedula Ciudadanía') {
            $data->tipo_documento = 'Cédula de Ciudadanía';
        }
        
        $data->credito_id = $credito_id;

        return $data;

    }
}
