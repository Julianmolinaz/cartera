<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Src\Vehiculo;

class VehiculoController extends Controller
{
    public function update(Request $request)
    {
        try {
            $useCase = new Vehiculo\ActualizarVehiculo($request->all(), $request->index);
            $vehiculo = $useCase->execute();

            flash()->success('Se editó el vehículo exitosamente');
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
}
