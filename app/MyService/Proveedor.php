<?php

namespace App\MyService;


class Proveedor
{
    public static function getProveedores()
    {
        $terceros = \App\Tercero::where('tipo','Proveedor')->get();

        foreach($terceros as $tercero){
          $tercero->nombre = $tercero->nombre;
        }

        $collection = collect($terceros);
        $sorted = $collection->sortBy('nombre');

        $proveedores = $sorted->values()->all();

        return $proveedores;
    }
}