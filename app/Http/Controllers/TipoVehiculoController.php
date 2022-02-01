<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories as Repo;

class TipoVehiculoController extends Controller
{
    public function getTipoVehiculos()
    {
        $tipos = Repo\TipoVehiculosRepository::list();

        return resHp(true, $tipos, 'Ok');
    }
}
