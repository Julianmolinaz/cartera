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

    public static function findFull($ventaId)
    {
        $venta = DB::table('ventas')
            ->leftJoin('invoices', 'ventas.id', '=', 'invoices.venta_id')
            ->join('productos', 'ventas.producto_id', '=', 'productos.id')
            ->leftJoin('vehiculos', 'ventas.vehiculo_id', '=', 'vehiculos.id')
            ->select(
                'ventas.id',
                'invoices.fecha_exp as factura_fecha_expedicion',
                'productos.id as producto_id',
                'productos.con_vehiculo as producto_con_vehiculo',
                'vehiculos.id as vehiculo_id',
                'vehiculos.placa as vehiculo_placa',
                'invoices.id as factura_id'
            )
            ->where('ventas.id', $ventaId)
            ->first();

        return $venta;
    }

    public static function listFullBySolicitud($solicitudId)
    {
        $venta = DB::table('ventas')
            ->leftJoin('invoices', 'ventas.id', '=', 'invoices.venta_id')
            ->join('productos', 'ventas.producto_id', '=', 'productos.id')
            ->leftJoin('vehiculos', 'ventas.vehiculo_id', '=', 'vehiculos.id')
            ->select(
                'ventas.id',
                'invoices.fecha_exp as factura_fecha_expedicion',
                'productos.id as producto_id',
                'productos.con_vehiculo as producto_con_vehiculo',
                'vehiculos.id as vehiculo_id',
                'vehiculos.placa as vehiculo_placa'
            )
            ->where('ventas.precredito_id', $solicitudId)
            ->orderBy('ventas.id')
            ->get();

        return $venta;
    }

    public static function findBySolicitud($solicitudId)
    {
        $arr = [];
        $query = DB::table("ventas")
            ->join("productos", "ventas.producto_id", "=", "productos.id")
            ->leftJoin("vehiculos", "ventas.vehiculo_id", "=", "vehiculos.id")
            ->leftJoin("tipo_vehiculos", "vehiculos.tipo_vehiculo_id", "=", "tipo_vehiculos.id")
            ->where("precredito_id", $solicitudId)
            ->select(
                "ventas.id as id",
                "ventas.precredito_id",
                "ventas.cantidad",
                "productos.nombre as producto_nombre",
                "productos.id as producto_id",
                "productos.con_vehiculo",
                "productos.con_invoice",
                "vehiculos.placa",
                "vehiculos.id as vehiculo_id",
                "vehiculos.vencimiento_soat as vencimiento_soat",
                "vehiculos.vencimiento_rtm as vencimiento_rtm",
                "vehiculos.modelo as modelo",
                "vehiculos.cilindraje as cilindraje",
                "vehiculos.tipo_vehiculo_id",
                "tipo_vehiculos.nombre as tipo_vehiculo"
            )
            ->orderBy('ventas.id')
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
                    'con_invoice' => $element->con_invoice,
                ],
                'vehiculo' => (! $element->con_vehiculo) ? null : [
                    'id' => $element->vehiculo_id,
                    'placa' => $element->placa,
                    'vencimiento_soat' => $element->vencimiento_soat,
                    'vencimiento_rtm' => $element->vencimiento_rtm,
                    'cilindraje' => $element->cilindraje,
                    'modelo' => $element->modelo,
                    'tipo_vehiculo_id' => $element->tipo_vehiculo_id,
                    'tipo_vehiculo' => $element->tipo_vehiculo
                ]
            ];

            $arr[] = $temp;
        }

        return $arr;
    }

    public static function findBySolicitudWithInvoices($solicitudId)
    {
        $arr = [];

        $ventas = DB::table('ventas')
            ->join("productos", "ventas.producto_id", "=", "productos.id")
            ->leftJoin("vehiculos", "ventas.vehiculo_id", "=", "vehiculos.id")
            ->leftJoin("tipo_vehiculos", "vehiculos.tipo_vehiculo_id", "=", "tipo_vehiculos.id")
            ->leftJoin('invoices', 'ventas.id', '=', 'invoices.venta_id')
            ->leftJoin('terceros', 'invoices.proveedor_id', '=', 'terceros.id')
            ->select(
                'ventas.id as id',
                'ventas.precredito_id as precredito_id',
                'ventas.cantidad as producto_cantidad',
                'productos.id as producto_id',
                'productos.nombre as producto_nombre',
                'productos.con_vehiculo as con_vehiculo',
                'productos.con_invoice as con_invoice',
                "vehiculos.placa as vehiculo_placa",
                "vehiculos.id as vehiculo_id",
                "vehiculos.tipo_vehiculo_id as tipo_vehiculo_id",
                "vehiculos.vencimiento_soat as vehiculo_vencimiento_soat",
                "vehiculos.vencimiento_rtm as vehiculo_vencimiento_rtm",
                "vehiculos.modelo as vehiculo_modelo",
                "vehiculos.cilindraje as vehiculo_cilindraje",
                "tipo_vehiculos.nombre as tipo_vehiculo",
                "invoices.id as invoice_id",
                "invoices.estado as invoice_estado",
                "invoices.fecha_exp as invoice_fecha_exp",
                "invoices.costo as invoice_costo",
                "invoices.iva as invoice_iva",
                "invoices.num_fact as invoice_num_fact",
                "invoices.otros as invoice_otros",
                "invoices.expedido_a as invoice_expedido_a",
                "terceros.razon_social as proveedor_razon_social"
            )
            ->where("ventas.precredito_id", $solicitudId)
            ->orderBy('ventas.id')
            ->get();

        foreach($ventas as $venta) {
            $temp = [
                'id' => $venta->id,
                'precredito_id' => $venta->precredito_id,
                'cantidad' => $venta->producto_cantidad,
                'producto' => [
                    'id' => $venta->producto_id,
                    'nombre' => $venta->producto_nombre,
                    'con_vehiculo' => $venta->con_vehiculo,
                    'con_invoice' => $venta->con_invoice,
                ],
                'vehiculo' => ($venta->vehiculo_id) ? [
                    'id' => $venta->vehiculo_id,
                    'placa' => $venta->vehiculo_placa,
                    'vencimiento_soat' => $venta->vehiculo_vencimiento_soat,
                    'vencimiento_rtm' => $venta->vehiculo_vencimiento_rtm,
                    'cilindraje' => $venta->vehiculo_cilindraje,
                    'modelo' => $venta->vehiculo_modelo,
                    'tipo_vehiculo_id' => $venta->tipo_vehiculo_id,
                    'tipo_vehiculo' => $venta->tipo_vehiculo
                ] : [],
                'invoice' => ($venta->invoice_id) ? [
                    "id" => $venta->invoice_id,
                    "estado" => $venta->invoice_estado,
                    "fecha_exp" => $venta->invoice_fecha_exp,
                    "costo" => $venta->invoice_costo,
                    "iva" => $venta->invoice_iva,
                    "num_fact" => $venta->invoice_num_fact,
                    "otros" => $venta->invoice_otros,
                    "expedido_a" => $venta->invoice_expedido_a,
                    "proveedor" => $venta->proveedor_razon_social
                ]: []
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

    public static function destroyVenta($ventaId)
    {
        $venta = Venta::find($ventaId);
        $venta->delete();
    }
}