<?php

namespace App\Http\Controllers\V3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories as Repo;
use Src\Credito\Services;

class RefinanciacionController extends Controller
{
    public function create($creditoPadreId)
    {
        $solicitud = Repo\SolicitudRepository::find($creditoPadreId);
        $credito = Repo\CreditoRepository::find($creditoPadreId);

        $useCase = new Services\DataParaCrearSolicitudService(
            $solicitud->cliente_id
        );
        $insumos = $useCase->execute();

        return view("start.precreditosV3.refinanciacion.create.index")
            ->with("solicitud", $solicitud)
            ->with("credito", $credito)
            ->with("insumos", $insumos);
    }

    public function store(Request $request, $creditoPadreId)
    {

    }

    public function destroy($creditoId)
    {

    }
}
