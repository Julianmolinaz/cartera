<?php

namespace App\Repositories;
use DB;

class ProductoRepository
{

    public static function find($productoId)
    {
        $producto = DB::table('productos')
            ->where('id', $productoId)
            ->first();

        return $producto;
    }

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

    public static function getProductosPorSolicitud($solicitudId)
    {
        $productos = DB::table('ventas')
            ->join('productos', 'ventas.producto_id', '=', 'productos.id')
            ->where('ventas.precredito_id', $solicitudId)
            ->select(
                'productos.id',
                'productos.nombre',
            )
            ->get();

        return $productos;
    }

}