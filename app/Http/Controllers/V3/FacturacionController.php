<?php

namespace App\Http\Controllers\V3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Src\Facturacion\InsumosFacturacionService;
use App\Repositories as Repo;

class FacturacionController extends Controller
{
    public function index($solicitudId)
    {
        $solicitud = Repo\SolicitudRepository::find($solicitudId);
        $ventas = Repo\FacturasRepository::listarVentasConFacturas($solicitudId);
        $insumosService = InsumosFacturacionService::make();

        return view('start.precreditosV3.facturacion.index')
            ->with("insumos", $insumosService->insumos)
            ->with("solicitud", $solicitud)
            ->with("ventas", $ventas);
    }

    public function store(Request $request)
    {
        \Log::info($request->all());
        return resHp(true, $request->all(), 'Ok');
    }
}
