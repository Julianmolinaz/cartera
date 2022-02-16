<?php

namespace App\Repositories;
use DB;

class TipoVehiculosRepository
{
    public static function list()
    {
        $tipos = DB::table('tipo_vehiculos')
            ->orderBy('nombre')
            ->get();

        return $tipos;
    }
}