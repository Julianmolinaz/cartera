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
use Src\Credito\Services\EliminarCreditoService;
use Src\Credito\Services;

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
        $opcionesAprobacion = getEnumValues2('precreditos', 'aprobado');

        return view("start.precreditosV3.show.index")
            ->with('data', $data)
            ->with('opcionesAprobacion', $opcionesAprobacion);
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
            \Log::error($e);
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
    
    public function destroy($creditoId)
    {  
        $credito = Repo\CreditoRepository::find($creditoId);      
        try {
            $useCase = new EliminarCreditoService($creditoId);
            $useCase->execute();
            flash()->success('El crédito fue eliminado exitosamente');
            return redirect()->route('start.precreditosV3.show', $credito->precredito_id);
        } catch (\Exception $e) {
            \Log::error($e);
            flash()->error('No es posible eliminar el crédito');
            return redirect()->route('start.precreditosV3.show', $credito->precredito_id);
        }
    }

    public function updateRecordatorio(Request $request)
    { 
        try {
            $useCase = new Services\ActualizarRecordatorioService(
                $request->recordatorio,
                $request->creditoId
            );

            $useCase->execute();

            flash()->success('El recordatorio fue modificado');
            return redirect()->route('start.v3.creditos.show', $request->creditoId);
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->route('start.v3.creditos.show', $request->creditoId);
        }
    }
}
