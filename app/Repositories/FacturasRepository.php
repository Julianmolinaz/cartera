<?php

namespace App\Repositories;
use App\Invoice;
use DB;

class FacturasRepository
{
    public static function listarVentasConFacturas($solicitudId)
    {
        $arr = [];
        $query = DB::table("ventas")
            ->join("productos", "ventas.producto_id", "=", "productos.id")
            ->leftJoin("vehiculos", "ventas.vehiculo_id", "=", "vehiculos.id")
            ->leftJoin("tipo_vehiculos", "vehiculos.tipo_vehiculo_id", "=", "tipo_vehiculos.id")
            ->leftJoin("invoices", "ventas.id", "=", "invoices.venta_id")
            ->where("ventas.precredito_id", $solicitudId)
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
                "tipo_vehiculos.nombre as tipo_vehiculo",
                "invoices.id as factura_id",
                "invoices.estado as factura_estado",
                "invoices.fecha_exp as factura_fecha_exp",
                "invoices.costo as factura_costo",
                "invoices.iva as factura_iva",
                "invoices.num_fact as factura_num_fact",
                "invoices.otros as factura_otros",
                "invoices.expedido_a as factura_expedido_a",
                "invoices.observaciones as factura_observaciones",
                "invoices.proveedor_id as factura_proveedor_id",
                "invoices.precredito_id as factura_precredito_id",
                "invoices.venta_id as factura_venta_id",
                "invoices.created_by as factura_created_by",
                "invoices.updated_by as factura_updated_by",
                "invoices.created_at as factura_created_at",
                "invoices.updated_at as factura_updated_at"
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
                ],
                'factura' => (! $element->con_invoice) ? null :[
                    "id" => $element->factura_id,
                    "estado" => $element->factura_estado,
                    "fecha_exp" => $element->factura_fecha_exp,
                    "costo" => $element->factura_costo,
                    "iva" => $element->factura_iva,
                    "num_fact" => $element->factura_num_fact,
                    "otros" => $element->factura_otros,
                    "expedido_a" => $element->factura_expedido_a,
                    "observaciones" => $element->factura_observaciones,
                    "proveedor_id" => $element->factura_proveedor_id,
                    "venta_id" => $element->factura_venta_id,
                    "precredito_id" => $element->factura_precredito_id,
                    "created_by" => $element->factura_created_by,
                    "updated_by" => $element->factura_updated_by,
                    "created_at" => $element->factura_created_at,
                    "updated_at" => $element->factura_updated_at
                ]
            ];

            $arr[] = $temp;
        }

        return $arr;
    }

    public static function find($facturaId)
    {
        $factura = DB::table('invoices')
            ->where('id', $facturaId)
            ->first();

        return $factura;
    }

    public static function findByNumFactura($numFactura)
    {
        $factura = DB::table('invoices')->where('num_fact', $numFactura)->first();

        return $factura;
    }

    public static function findByNumFacturaWithId($numFactura, $facturaId)
    {
        $factura = DB::table('invoices')
            ->where('num_fact', $numFactura)
            ->where('id', '<>', $facturaId)
            ->first();

        return $factura;
    }

    public static function saveFactura($dataFactura)
    {
        $factura = new Invoice();
        $factura->fill($dataFactura);
        $factura->created_by = 1;
        $factura->save();

        return $factura;
    }

    public static function actualizarFactura($dataFactura)
    {
        $factura = Invoice::find($dataFactura['id']);
        $factura->fill($dataFactura);
  
        if (!$factura->isDirty()) {
            throw new \Exception("No existen cambios en la factura.", 400);
        }
        
        $factura->updated_by = 1;
        $factura->save();
        return $factura;
    }

    public static function facturasBySolicitud($solicitudId)
    {
        $facturas = DB::table('invoices')
            ->join('ventas', 'invoices.venta_id', '=', 'ventas.id')
            ->where('ventas.precredito_id', $solicitudId)
            ->select('invoices.*')
            ->get();

        return $facturas;
    }
}