<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Src\Credito\Services;

class FechaCobroController extends Controller
{
    public function updateFechaPago(Request $request) 
    {
        try {
            $useCase = new Services\ActualizarFechaPagoService($request->all());
            $useCase->execute();

            flash()->success('La fecha de pago fue actualizada exitosamente');
            return redirect()->route('start.v3.creditos.show', $request->creditoId);
        } catch (\Exception $e) {
            if (substr($e->getMessage(), 0, 2) === "**") {
                $msg = "";
                foreach (json_decode(substr($e->getMessage(), 2)) as $error) $msg .= $error . '<br>';
                flash()->error($msg);
            } else {
                flash()->error($e->getMessage());
            }
            return redirect()->route('start.v3.creditos.show', $request->creditoId);
        }
    }
}
