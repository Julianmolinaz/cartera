<?php

namespace App\Http\Controllers\V3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories as Repo;
use App\Http\Controllers\Controller;

use Src\Credito\Services\ActualizarSolicitudService;
use Src\Credito\Services\ActivarCreditoService;
use Src\Credito\Services\DataParaCrearSolicitudService;
use Src\Credito\Services\ActivarCreditoRefinanciadoService;
use Src\Credito\Services\ConsultarCreditoService;

class CreditoController extends Controller
{
    public function __construct()
    {
        // 
    }

    public function show($creditoId)
    {
        $credito = Repo\CreditoRepository::find($creditoId);

        $useCase = ConsultarCreditoService::make($credito->precredito_id);
        $data = $useCase->data;

        return view("start.precreditosV3.show.index")
            ->with('data', $data);
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

            return resHp(true, $solicitud, 'Crédito actualizada exitosamente.');
        } catch (\Exception $e) {
            if (substr($e->getMessage(), 0, 2) === "**") {
                $response = resHp(false, 1, substr($e->getMessage(), 2));
            } else {
                $response = resHp(false, 2, $e->getMessage());
            }
            return $response;
        }
    }

    public function refinanciar($creditoId)
    {
        $cliente = Repo\ClientesRepository::findByCredito($creditoId);
        $useCase = new DataParaCrearSolicitudService($cliente->id, $creditoId);
        $data = $useCase->execute();

        return view('start.precreditosV3.create.index')
            ->with('insumos_credito', $data->insumosCredito)
            ->with('modo', 'Refinanciar Credito')
            ->with('data', $data->insumosSolicitud)
            ->with('insumos', $data->insumosVenta)
            ->with('cliente', $data->cliente)
            ->with('solicitud', null)
            ->with('ventas', null)
            ->with('credito', null);
    }

    public function storeRefinanciacion(Request $request, $creditoRefinanciadoId)
    {
        try {       
            $useCase = new ActivarCreditoRefinanciadoService(
                $request->all(),
                $creditoRefinanciadoId
            );
    
            $solicitud = $useCase->execute();

            return resHp(true, $solicitud, 'El crédito se refinanció exitosamente.');
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
