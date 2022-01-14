<?php

namespace App\Repositories;
use App\Venta;
use DB;

class VentasRepository
{
    public static function saveVenta($data)
    {
        $venta = new Venta();
        $venta->fill($data);
        $venta->save();

        return $venta;
    }

    public static function find($ventaId)
    {
        $venta = DB::table('ventas')
            ->where('id', $ventaId)
            ->first();

        return $venta;
    }   

    public static function findBySolicitud($solicitudId)
    {
        $arr = [];
        $query = DB::table("ventas")
            ->join("productos", "ventas.producto_id", "=", "productos.id")
            ->leftJoin("vehiculos", "ventas.vehiculo_id", "=", "vehiculos.id")
            ->where("precredito_id", $solicitudId)
            ->select(
                "ventas.id as id",
                "ventas.precredito_id",
                "ventas.cantidad",
                "productos.nombre as producto_nombre",
                "productos.id as producto_id",
                "productos.con_vehiculo",
                "vehiculos.placa",
                "vehiculos.id as vehiculo_id",
                "vehiculos.vencimiento_soat as vencimiento_soat",
                "vehiculos.vencimiento_rtm as vencimiento_rtm",
                "vehiculos.modelo as modelo",
                "vehiculos.cilindraje as cilindraje",
                "vehiculos.tipo_vehiculo_id"
            )
            ->get();

        foreach ($query as $element) {
            $temp = [
                'id' => $element->id,
                'precredito_id' => $element->precredito_id,
                'producto' => [
                    'nombre' => $element->producto_nombre,
                    'cantidad' => $element->cantidad,
                    'producto_id' => $element->producto_id,
                    'con_vehiculo' => $element->con_vehiculo,
                ],
                'vehiculo' => (! $element->con_vehiculo) ? null : [
                    'id' => $element->vehiculo_id,
                    'placa' => $element->placa,
                    'vencimiento_soat' => $element->vencimiento_soat,
                    'vencimiento_rtm' => $element->vencimiento_rtm,
                    'cilindraje' => $element->cilindraje,
                    'modelo' => $element->modelo,
                    'tipo_vehiculo_id' => $element->tipo_vehiculo_id
                ]
            ];

            $arr[] = $temp;
        }

        return $arr;
    }

    public static function updateVenta($dataVenta, $ventaId)
    {
        $venta = Venta::find($ventaId);
        $venta->fill($dataVenta);

        if ($venta->isDirty()) {
            $venta->save();
        }

        return $venta;
    }
}