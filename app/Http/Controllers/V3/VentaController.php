<?php

namespace App\Http\Controllers\V3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Src\Ventas;

class VentaController extends Controller
{
    public function updateValor(Request $request)
    {
        $index = $request->index;
        try {
            $case = new Ventas\EditarValorProductoService(
                $request->valor, $request->ventaId
            );

            $case->execute();

            flash()->success("Se editó el valor del producto {$index} exitosamente");
            return redirect()->route('start.precreditosV3.show', $request->solicitudId);
        } catch (\Exception $e) {
            \Log::error($e);
            flash()->error($e->getMessage());
            return redirect()->route('start.precreditosV3.show', $request->solicitudId);
        }
    }
}
