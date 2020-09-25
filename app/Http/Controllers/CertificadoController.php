<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Credito;
use App\Cliente;
use Carbon\Carbon;

class CertificadoController extends Controller
{
    public function paz_y_salvo($cliente_id)
    {
        $data = $this->getDataPazYSalvo($cliente_id);

        $view = \View::make('start.certificados.paz_y_salvo',compact('data'))->render();

        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHtml($view);

        return $pdf->stream('paz_y_salvo_'.$data->numero_documento.'.pdf');
    }

    public function getDataPazYSalvo($cliente_id)
    {
        $cliente = Cliente::find($cliente_id);
        $fecha = Carbon::now();

        return (object)[
            'fecha' => $fecha->format('d/m/Y'),
            'nombre' => $cliente->nombre,
            'tipo_documento' => $cliente->tipo_doc,
            'numero_documento' => $cliente->num_doc
        ];
    }
}
