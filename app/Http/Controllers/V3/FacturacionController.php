<?php

namespace App\Http\Controllers\V3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Src\Facturacion\InsumosFacturacionService;
use App\Repositories as Repo;
use Src\Facturacion\CrearFacturaService;
use Src\Facturacion\ActualizarFacturaService;
use Src\Facturacion\EliminarFacturaService;

class FacturacionController extends Controller
{
    public function index($solicitudId)
    {
        $solicitud = Repo\SolicitudRepository::find($solicitudId);
        $ventas = Repo\FacturasRepository::listarVentasConFacturas($solicitudId);
        $insumosService = InsumosFacturacionService::make();
        $cliente = Repo\ClientesRepository::find($solicitud->cliente_id);
        $credito = Repo\CreditoRepository::findBySolicitud($solicitud->id);

        return view('start.precreditosV3.facturacion.index')
            ->with("insumos", $insumosService->insumos)
            ->with("solicitud", $solicitud)
            ->with("ventas", $ventas)
            ->with("cliente", $cliente)
            ->with("credito", $credito);
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

    public function destroy($facturaId)
    {
        try {
            $useCase = new EliminarFacturaService($facturaId);
            $factura = $useCase->factura;
            $useCase->execute();

            flash()->success("Se eliminó exitosamente la factura");
            return redirect()->route('start.facturacion.index', $factura->precredito_id);
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->route('start.facturacion.index', $factura->precredito_id);
        }
    }
}
