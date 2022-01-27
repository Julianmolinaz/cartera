<?php

namespace App\Repositories;

use App\Repositories\Contratos\ITipoVehiculos;
use DB;

class TipoVehiculosQueryBuilderRepository implements ITipoVehiculos
{
    public function getTipoVehiculosActivos()
    {
        $list_tipo_vehiculo = DB::table('tipo_vehiculos')
            ->select('id', 'nombre')
            ->where('estado','Activo')
            ->orderBy('nombre')
            ->get();

        return $list_tipo_vehiculo;
    }
}