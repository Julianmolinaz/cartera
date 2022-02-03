<?php

namespace App\Http\Controllers\V3;

use Illuminate\Http\Request;

use App\Cliente;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories as Repo;
use Src\Credito\Services\SalvarSolicitudService;
use Src\Credito\Services\ActualizarSolicitudService;
use Src\Credito\Services\ConsultarCreditoService;
use Src\Credito\Services\DataParaCrearSolicitudService;
use Src\Credito\Services\ReglasPreviasCreacionSolicitudService;
use Src\Credito\Services\AprobarSolicitudService;
use Src\Credito\Services;

class PrecreditoController extends Controller
{
    public function __construct()
    {
        // 
    }


    public function create($clienteId)
    {
        try {
            ReglasPreviasCreacionSolicitudService::make($clienteId);
    
            $useCase = new DataParaCrearSolicitudService($clienteId);
            $data = $useCase->execute();
            $insumosCredito = $data->insumosCredito;

            unset($data->insumosCredito);

    
            return view('start.precreditosV3.create.index')
                ->with('data', $data->insumosSolicitud)
                ->with('insumos', $data->insumosVenta)
                ->with('cliente', $data->cliente)
                ->with('solicitud', null)
                ->with('ventas', null)
                ->with('credito', null)
                ->with('modo', 'Crear Solicitud')
                ->with('insumos_credito', $insumosCredito);

        } catch (\Exception $e) {
            if (substr($e->getMessage(), 0, 2) === "**") {
                $str = json_decode(substr($e->getMessage(), 2));
                $response = '';

                foreach ($str as $error) {
                    $response .= $error ."<br>";
                }
            } else {
                $response = $e->getMessage();
            }
            flash()->error($response);
            return redirect()->route('start.clientes.show', $clienteId);
        }
    }


    public function show($solicitudId)
    {
        $useCase = ConsultarCreditoService::make($solicitudId);
        $data = $useCase->data;
        $opcionesAprobacion = getEnumValues2('precreditos', 'aprobado');

        return view("start.precreditosV3.show.index")
            ->with('data', $data)
            ->with('opcionesAprobacion', $opcionesAprobacion);
    }


    public function edit($solicitudId)
    {
        $solicitud = Repo\SolicitudRepository::find($solicitudId);
        $ventas = Repo\VentasRepository::findBySolicitud($solicitudId);
        $credito = Repo\CreditoRepository::findBySolicitud($solicitudId);
    
        $useCase = new DataParaCrearSolicitudService($solicitud->cliente_id);
        $data = $useCase->execute();

        return view('start.precreditosV3.create.index')
            ->with('insumos_credito', $data->insumosCredito)
            ->with('data', $data->insumosSolicitud)
            ->with('insumos', $data->insumosVenta)
            ->with('cliente', $data->cliente)
            ->with('solicitud', $solicitud)
            ->with('ventas', $ventas)
            ->with('credito', $credito)
            ->with('modo', ($credito) ? 'Editar Credito' : 'Editar Solicitud');
    }


    public function store(Request $request) 
    {
        try {
            $case = new SalvarSolicitudService($request->all());
            $solicitud = $case->make();

            return resHp(true, $solicitud, "Solicitud creada exitosamente");
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

    public function aprobar(Request $request)
    {
        try {
            $useCase = new AprobarSolicitudService($request->aprobado, $request->solicitudId);
            $solicitud = $useCase->execute();
    
            flash()->success('La aprobación fue modificada');
            return redirect()->route('start.precreditosV3.show', $request->solicitudId);
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->route('start.precreditosV3.show', $request->solicitudId);
        }
    }

    public function updateObservaciones(Request $request)
    {
        try {
            $useCase = new Services\ActualizarObservacionesService(
                $request->observaciones,
                $request->solicitudId
            );

            $useCase->execute();

            flash()->success('Las observaciones fueron modificadas');
            return redirect()->route('start.precreditosV3.show', $request->solicitudId);
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->route('start.precreditosV3.show', $request->solicitudId);
        }
    }
}
