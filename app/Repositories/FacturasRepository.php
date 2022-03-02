<?php

namespace App\Repositories;
use App\Invoice;
use Src\Libs\Time;
use Auth;
use DB;

class FacturasRepository
{
    /*
    |---------------------------------------------------
    | listarVentasConFacturas
    |---------------------------------------------------
    | Listar toda la información relacionada a una venta
    | venta, vehiculo, invoice, producto, quien modifico
    |
    */ 

    public static function listarVentasConFacturas($solicitudId)
    {
        $arr = [];
        $query = DB::table("ventas")
            ->join("productos", "ventas.producto_id", "=", "productos.id")
            ->leftJoin("vehiculos", "ventas.vehiculo_id", "=", "vehiculos.id")
            ->leftJoin("tipo_vehiculos", "vehiculos.tipo_vehiculo_id", "=", "tipo_vehiculos.id")
            ->leftJoin("invoices", "ventas.id", "=", "invoices.venta_id")
            ->leftJoin("users as creator", "invoices.created_by", "=", "creator.id")
            ->leftJoin("users as updator", "invoices.updated_by", "=", "updator.id")
            ->leftJoin("users as aprobador", "invoices.aprobado_by", "=", "aprobador.id")
            ->leftJoin("users as pagador", "invoices.pagado_by", "=", "pagador.id")
            ->where("ventas.precredito_id", $solicitudId)
            ->select(
                "ventas.id as id",
                "ventas.precredito_id",
                "ventas.cantidad",
                "ventas.valor",
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
                
                "creator.name as factura_creator",
                "invoices.created_by as factura_created_by",
                "invoices.created_at as factura_created_at",

                "aprobador.name as factura_aprobador",
                "invoices.aprobado_by as factura_aprobado_by",
                "invoices.aprobado_at as factura_aprobado_at",
                
                "pagador.name as factura_pagador",
                "invoices.pagado_by as factura_pagado_by",
                "invoices.pagado_at as factura_pagado_at",

                "updator.name as factura_updator",
                "invoices.updated_by as factura_updated_by",
                "invoices.updated_at as factura_updated_at"
            )
            ->get();

        foreach ($query as $element) {
            $temp = [
                'id' => $element->id,
                'precredito_id' => $element->precredito_id,
                'valor' => $element->valor,
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
                'factura' => (! $element->factura_id) ? null :[
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
                    
                    "creator" => $element->factura_creator,
                    "created_by" => $element->factura_created_by,
                    "created_at" => $element->factura_created_at,

                    "updator" => $element->factura_updator,
                    "updated_by" => $element->factura_updated_by,
                    "updated_at" => $element->factura_updated_at,

                    "aprobador" => $element->factura_aprobador,
                    "aprobado_by" => $element->factura_aprobado_by,
                    "aprobado_at" => $element->factura_aprobado_at,

                    "pagador" => $element->factura_pagador,
                    "pagado_by" => $element->factura_pagado_by,
                    "pagado_at" => $element->factura_pagado_at,
                ]
            ];

            $arr[] = $temp;
        }

        return $arr;
    }
    
    /*
    |-------------------------------------------------
    | find
    |-------------------------------------------------
    | Buscar invoice por id
    */  

    public static function find($facturaId)
    {
        $factura = DB::table('invoices')
            ->where('id', $facturaId)
            ->first();

        return $factura;
    }

    /*
    |-------------------------------------------------
    | findByNumFactura
    |-------------------------------------------------
    | Buscar por numero de factura (invoice)
    */  

    public static function findByNumFactura($numFactura)
    {
        $factura = DB::table('invoices')->where('num_fact', $numFactura)->first();
        return $factura;
    }

    /*
    |-------------------------------------------------
    | findByNumFacturaWithId
    |-------------------------------------------------
    | Buscar por numero de factura excluyendo determinada
    | factura (invoice)
    */      

    public static function findByNumFacturaWithId($numFactura, $facturaId)
    {
        $factura = DB::table('invoices')
            ->where('num_fact', $numFactura)
            ->where('id', '<>', $facturaId)
            ->first();

        return $factura;
    }
    
    /*
    |-------------------------------------------------
    | findByAprobadaByRango
    |-------------------------------------------------
    | Buscar por estado de aprobación, rango : 
    | fecha inicial (start) y fecha final (end) 
    | carteras (de tipo array, ej: [6, 12])
    */    

    public static function findByRango(
        $start, 
        $end,
        $carteras
    ) {
        $precreditos = DB::table("invoices")
            ->join("precreditos", "invoices.precredito_id", "=", "precreditos.id")
            ->join("clientes", "precreditos.cliente_id", "=", "clientes.id")
            ->join("ventas", "invoices.venta_id", "=", "ventas.id")
            ->join("productos", "ventas.producto_id", "=", "productos.id")
            ->select(
                "invoices.*",
                "precreditos.id as precredito_id",
                "precreditos.cuota_inicial as solicitud_cuota_inicial",
                "precreditos.periodo as solicitud_periodo",
                "precreditos.cuotas as solicitud_cuotas",
                "productos.id as producto_id",
                "clientes.num_doc as cliente_num_documento"
            )
            ->whereBetween('invoices.fecha_exp',[$start, $end])
            ->whereIn("precreditos.cartera_id", $carteras)
            ->orderBy("precreditos.id")
            ->get();

        return $precreditos;
    }

    /*
    |-------------------------------------------------
    | saveFactura
    |-------------------------------------------------
    | Guardar factura (Invoice)
    */    

    public static function saveFactura($dataFactura)
    {
        $now = Time::now()->format('Y-m-d h:i:s');

        $factura = new Invoice();
        $factura->fill($dataFactura);
        $factura->created_by = Auth::user()->id;
        $factura->created_at = $now;
        $factura->save();

        return $factura;
    }

    /*
    |-------------------------------------------------
    | actualizarFactura
    |-------------------------------------------------
    | Actualizar factura (Invoice)
    */ 

    public static function actualizarFactura($dataFactura)
    {
        $factura = Invoice::find($dataFactura['id']);
        $estadoAnterior = $factura->estado;
        $factura->fill($dataFactura);
        $estadoPosterior = $factura->estado;
        $now = Time::now()->format('Y-m-d h:i:s');
        
        if ($factura->isDirty()) {

            if ($estadoAnterior === $estadoPosterior) {
                $factura->updated_by = Auth::user()->id;
                $factura->updated_at = $now;
            } else if ($estadoAnterior !== $estadoPosterior) {
                if ($estadoPosterior == 'Aprobado') {
                    $factura->aprobado_by = Auth::user()->id;
                    $factura->aprobado_at = $now;
                } else if ($estadoPosterior == 'Pagado') {
                    $factura->pagado_by = Auth::user()->id;
                    $factura->pagado_at = $now;
                }
            }

            $factura->save();
        }
        
        return $factura;
    }
    
    /*
    |-------------------------------------------------
    | facturasBySolicitud
    |-------------------------------------------------
    | Buscar invoices por solicitud
    */ 

    public static function facturasBySolicitud($solicitudId)
    {
        $facturas = DB::table('invoices')
            ->join('ventas', 'invoices.venta_id', '=', 'ventas.id')
            ->where('ventas.precredito_id', $solicitudId)
            ->select('invoices.*')
            ->get();

        return $facturas;
    }

    /*
    |-------------------------------------------------
    | destroy
    |-------------------------------------------------
    | Eliminar invoice
    */     

    public static function destroy($facturaId)
    {
        $factura = Invoice::find($facturaId);
        $factura->delete();
    }

    /*
    |-------------------------------------------------
    | firstBySolicitud
    |-------------------------------------------------
    | Obtener primera factura ordenada por fecha de expedición
    */  

    public static function firstBySolicitud($solicitudId)
    {
        $primeraFactura = DB::table('invoices')
            ->where('precredito_id', $solicitudId)
            ->orderBy('fecha_exp')
            ->first();

        return $primeraFactura;
    } 
}