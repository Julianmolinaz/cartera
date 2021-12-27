<?php

namespace App\Http\Controllers\V3;

use Illuminate\Http\Request;

use App\Cliente;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Src\Credito\Services\InsumosVentasService;
use Src\Credito\Services\InsumosSolicitudService;
use Src\Credito\Services\InsumosCreditoService;
use Src\Credito\UseCases\ValidarProcesosPendientesdUseCase;

use App\Repositories as Repo;

class PrecreditoController extends Controller
{
    public function __construct()
    {
        // 
    }


    public function create($cliente_id)
    {
        $validation = new ValidarProcesosPendientesdUseCase($cliente_id);

        if ( $validation->execute() ) {
            flash()->error('@ No se puede crear la solicitud, existen trámites vigentes!');
            return redirect()->route('start.clientes.show',$cliente_id);
        }


        $insumos = new InsumosVentasService(
            new Repo\TercerosQueryBuilderRepository(),
            new Repo\TipoVehiculosQueryBuilderRepository()
        );
        $insumos = $insumos->execute();

        $data = new InsumosSolicitudService();
        $data = $data->execute();
        $data['status'] = 'create';
        
        $creditos = new InsumosCreditoService();
        $creditos = $creditos->execute();

        $cliente = Cliente::find($cliente_id); 

        return view('start.precreditosV3.create.index')
            ->with('data', $data)
            ->with('insumos', $insumos)
            ->with('creditos', $creditos);
    }

}
