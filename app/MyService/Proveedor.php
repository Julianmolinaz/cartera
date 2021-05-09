<?php

namespace App\MyService;


class Proveedor
{
    public static function getProveedores()
    {
	$proveedores = \DB::table('terceros')
            ->leftJoin('municipios', 'terceros.mun_id', '=', 'municipios.id')
            ->where('terceros.tipo', 'Proveedor')
            ->where('terceros.estado','Activo')
            ->select(
                'terceros.id',
                'terceros.razon_social',
                'terceros.nombre_comercial',
                'terceros.pnombre',
                'terceros.snombre',
                'terceros.papellido',
                'terceros.sapellido',
                'municipios.nombre as municipio'
            )
            ->orderBy('municipios.nombre')
            ->get();

        return $proveedores;
    }

    public static function getProveedoresALosQueSeLesDebe()
    { 
      $ids = \DB::table('ref_productos')
        ->select('proveedor_id as id')
        ->groupBy('proveedor_id')
        ->where('estado','En proceso')
        ->get();

      $proveedores_en_debe = \App\Tercero::find(collect($ids)->pluck('id')->all());

      foreach ($proveedores_en_debe as $proveedor) {
        $debe = \DB::table('ref_productos')
            ->where('proveedor_id',$proveedor->id)
            ->where('estado','=','En proceso')
            ->sum('costo');

        $proveedor->debe = $debe;
        $proveedores[] = $proveedor;
    }

      return $proveedores_en_debe;

    }


}
