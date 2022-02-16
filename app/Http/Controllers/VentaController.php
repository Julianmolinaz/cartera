<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Src\Ventas\EliminarVentaService;

class VentaController extends Controller
{
    public function destroy($ventaId)
    {
        try {
            $useCase = new EliminarVentaService($ventaId);
            $useCase->execute();

            return resHp(true, '', 'La venta fue eliminada exitosamente');
        } catch (\Exception $e) {
            return resHp(false, '', $e->getMessage());
        }
    }
}
