<?php

namespace App\Repositories;
use DB;

class ProductoRepository
{
    /**
     * True si existen ventas asociadas al producto
     */

    public function seUtilizoEsteProducto($productoId)
    {
        $result = DB::table("ventas")
            ->where("producto_id", $productoId)
            ->count();

        return !! $result;
    }

    public function existenSolicitudesAsociadas($productoId)
    {
        $result = DB::table("precreditos")
            ->where("producto_id", $productoId)
            ->count();

        return !! $result;
    }

    public function destroy($productoId)
    {
        DB::table('productos')
            ->where('id', $productoId)
            ->delete();
    }
}