<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Src\Certificados\PreavisoCentrales\GetDataPreavisoCentralesService;
use Src\Certificados\PazySalvo\GetDataPazySalvoService;
use App\Http\Requests;
use App\Credito;
use App\Cliente;
use Carbon\Carbon;
use Exception;

class CertificadoController extends Controller
{
    public function paz_y_salvo($credito_id,$tipo)
    {
        $useCase = GetDataPazySalvoService::make($credito_id, $tipo);
        $data = $useCase->data;
        
        $view = \View::make('start.certificados.paz_y_salvo',compact('data'))->render();

        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHtml($view);

        return $pdf->stream('paz_y_salvo_'.$data->numero_documento.'.pdf');
    }

    /**
     * Preaviso Centrales
     */

    public function preavisoCentrales($credito_id,$tipo)
    {
        $useCase = GetDataPreavisoCentralesService::make($credito_id, $tipo);
        $data = $useCase->data;
        
        $view = \View::make('start.certificados.preaviso_centrales',compact('data'))->render();

        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHtml($view);

        return $pdf->stream('preaviso_centrales_'.$data->numero_documento.'.pdf');
    }

}
