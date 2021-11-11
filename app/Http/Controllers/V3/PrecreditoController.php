<?php

namespace App\Http\Controllers\V3;

use Illuminate\Http\Request;

use App\Cliente;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Src\Credito\Services\InsumosVentasService;
use Src\Credito\Services\InsumosSolicitudService;
use Src\Credito\Services\InsumosCreditoService;



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

        $insumos = new InsumosVentasService();
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
