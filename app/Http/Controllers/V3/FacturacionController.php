<?php

namespace App\Http\Controllers\V3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Src\Facturacion\InsumosFacturacionService;
use App\Repositories as Repo;
use Src\Facturacion\CrearFacturaService;
use Src\Facturacion\ActualizarFacturaService;

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
        try {
            $useCase = new CrearFacturaService($request->all());
            $factura = $useCase->execute();

            return resHp(true, '', 'Se creó la factura exitosamente');
        } catch (\Exception $e) {
            if (substr($e->getMessage(), 0, 2) === "**") {
                $response = resHp(false, 1, substr($e->getMessage(), 2));
            } else {
                $response = resHp(false, 2, $e->getMessage());
            }
            return $response;
        }
    }

    public function update(Request $request)
    {
        try {
            $useCase = new ActualizarFacturaService($request->all());
            $factura = $useCase->execute();

            return resHp(true, '', 'Se actualizó la factura exitosamente');
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
