<?php

namespace App\Repositories;

use App\Repositories\Contratos\ITerceros;
use DB;

class TercerosQueryBuilderRepository implements ITerceros
{

    public function getProveedoresActivos()
    {
        $proveedores = DB::table('terceros')
            ->join('municipios','terceros.mun_id','=','municipios.id')
            ->select('terceros.id', 'razon_social as nombre','municipios.nombre as municipio')
            ->where('terceros.estado', 'Activo')
            ->orderBy('terceros.razon_social')
            ->get();
    
        return $proveedores;
    }

}