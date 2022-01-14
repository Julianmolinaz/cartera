<?php

namespace App\Http\Controllers\V3;

use Illuminate\Http\Request;

use App\Cliente;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Src\Credito\Services\InsumosVentasService;
use Src\Credito\Services\InsumosSolicitudService;
use Src\Credito\Services\InsumosCreditoService;

use App\Repositories as Repo;
use Src\Credito\Services\SalvarSolicitudService;
use Src\Credito\Services\ActualizarSolicitudService;

class PrecreditoController extends Controller
{
    public function __construct()
    {
        // 
    }


    public function create($cliente_id)
    {
        //validar que un cliente no tenga mas precréditos o créditos en proceso

        // if ( $this->existen_solicitudes_pendientes_tr( $cliente_id ) ) {

        //     flash()->error('@ No se puede crear la solicitud, existen trámites vigentes!');
        //     return redirect()->route('start.clientes.show',$cliente_id);
        // }

        $insumos = new InsumosVentasService(
            new Repo\TercerosQueryBuilderRepository(),
            new Repo\TipoVehiculosQueryBuilderRepository()
        );
        $insumos = $insumos->execute();

        $data = new InsumosSolicitudService();
        $data = $data->execute();
        
        $insumosCreditoUseCase = new InsumosCreditoService();
        $insumos_credito = $insumosCreditoUseCase->execute();

        $cliente = Repo\ClientesRepository::find($cliente_id); 

        return view('start.precreditosV3.create.index')
            ->with('data', $data)
            ->with('insumos', $insumos)
            ->with('cliente', $cliente)
            ->with('solicitud', null)
            ->with('ventas', null)
            ->with('modo', 'Crear Solicitud')
            ->with('insumos_credito', $insumos_credito);
    }

    public function show($precreditoId)
    {
        return view("start.precreditosV3.show.index");
    }

    public function edit($solicitudId)
    {
        $insumos = new InsumosVentasService(
            new Repo\TercerosQueryBuilderRepository(),
            new Repo\TipoVehiculosQueryBuilderRepository()
        );
        $insumos = $insumos->execute();

        $data = new InsumosSolicitudService();
        $data = $data->execute();
        
        $insumosCreditoUseCase = new InsumosCreditoService();
        $insumos_credito = $insumosCreditoUseCase->execute();

        $solicitud = Repo\SolicitudRepository::find($solicitudId);
        $cliente = Repo\ClientesRepository::find($solicitud->cliente_id);
        $ventas = Repo\VentasRepository::findBySolicitud($solicitudId);

        return view('start.precreditosV3.create.index')
            ->with('data', $data)
            ->with('insumos', $insumos)
            ->with('cliente', $cliente)
            ->with('solicitud', $solicitud)
            ->with('ventas', $ventas)
            ->with('modo', 'Editar Solicitud')
            ->with('insumos_credito', $insumos_credito);
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
}
