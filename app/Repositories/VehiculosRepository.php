<?php

namespace App\Repositories;
use App\Vehiculo;
use DB;

class VehiculosRepository
{
    public static function find($vehiculoId)
    {
        return DB::table('vehiculos')
            ->where('id', $vehiculoId)
            ->first();
    }

    public static function saveVehiculo($data)
    {
        $vehiculo = new Vehiculo();
        $vehiculo->fill($data);
        $vehiculo->save();

        return $vehiculo;
    }

    public static function updateVehiculo($dataVehiculo, $vehiculoId)
    {
        $vehiculo = Vehiculo::find($vehiculoId);
        $vehiculo->fill($dataVehiculo);
        $vehiculo->save();
        return $vehiculo;
    }
}