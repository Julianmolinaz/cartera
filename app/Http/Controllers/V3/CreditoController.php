<?php

namespace App\Http\Controllers\V3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Src\Credito\Services\ActualizarSolicitudService;
use Src\Credito\Services\ActivarCreditoService;

class CreditoController extends Controller
{
    public function __construct()
    {
        // 
    }

    public function store(Request $request)
    {
        try {
            $useCase = ActivarCreditoService::make($request->all());

            flash()->success('El crédito fue activado exitosamente.');
            return redirect()->route('start.precreditosV3.show', $request->solicitudId);

        } catch (\Exception $e) {
            if (substr($e->getMessage(), 0, 2) === "**") {
                $msg = "";
                foreach (json_decode(substr($e->getMessage(), 2)) as $error) $msg .= $error . '<br>';
                flash()->error($msg);
            } else {
                flash()->error($e->getMessage());
            }
            return redirect()->route('start.precreditosV3.show', $request->solicitudId);
        }
    }

    public function update(Request $request)
    {   
        try {
            $case = new ActualizarSolicitudService($request->all());
            $solicitud = $case->make();

            return resHp(true, $solicitud, 'Solicitud actualizada exitosamente.');
        } catch (\Exception $e) {
            if (substr($e->getMessage(), 0, 2) === "**") {
                $response = resHp(false, 1, substr($e->getMessage(), 2));
            } else {
                $response = resHp(false, 2, $e->getMessage());
            }
            return $response;
        }
    }
}
