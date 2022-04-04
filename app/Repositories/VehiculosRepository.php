<?php

namespace App\Repositories;
use App\Vehiculo;
use Src\Libs\Time;
use Auth;
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
        $vehiculo->created_by = Auth::user()->id;
        $vehiculo->created_at = Time::now();
        $vehiculo->save();

        return $vehiculo;
    }

    public static function updateVehiculo($dataVehiculo, $vehiculoId)
    {
        $vehiculo = Vehiculo::find($vehiculoId);
        $vehiculo->fill($dataVehiculo);
        $vehiculo->updated_by = Auth::user()->id;
        $vehiculo->updated_at = Time::now();
        $vehiculo->save();
        return $vehiculo;
    }

    public static function destroyVehiculo($vehiculoId)
    {
        $vehiculo = Vehiculo::find($vehiculoId);
        $vehiculo->delete();
    }

    public static function listVehiculosByClient($placa)
    {
        $clients = DB::table('vehiculos')
            ->join('ventas','vehiculos.id','=','ventas.vehiculo_id')
            ->join('precreditos','ventas.precredito_id','=','precreditos.id')
            ->join('clientes','precreditos.cliente_id','=','clientes.id')
            ->select(
                'clientes.nombre',
                'clientes.tipo_doc',
                'clientes.num_doc',
                'clientes.id',
                'clientes.placa'
            )
            ->where('vehiculos.placa','like','%'.$placa.'%')
            ->groupBy('clientes.id')
            ->get();

        return $clients;
    }
}