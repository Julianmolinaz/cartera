<?php

namespace App\Repositories;
use App\Precredito as Solicitud;
use Auth;
use DB;

class SolicitudRepository
{
    /*
    |-------------------------------------------------
    | Salvar solicitud
    |-------------------------------------------------
    */

    public static function saveSolicitud($data)
    {
        $solicitud = new Solicitud();
        $solicitud->fill($data);
        $solicitud->user_create_id = Auth::user()->id;
        $solicitud->save();

        return $solicitud;
    }

    /*
    |-------------------------------------------------
    | find
    |-------------------------------------------------
    | Buscar solicitud por id
    */

    public static function find($solicitudId)
    {
        $solicitud = DB::table("precreditos")
            ->leftJoin('productos', 'precreditos.producto_id', '=', 'productos.id')
            ->where("precreditos.id", $solicitudId)
            ->select(
                'precreditos.*',
                'productos.nombre as producto_nombre'
            )
            ->first();

        return $solicitud;
    }

    /*
    |-------------------------------------------------
    | findByNumFact
    |-------------------------------------------------
    | Buscar solicitud por número de factura
    */

    public static function findByNumFact($numFact)
    {
        return DB::table('precreditos')->where('num_fact', $numFact)->get();
    }

    /*
    |-------------------------------------------------
    | findByNumFactDiffId
    |-------------------------------------------------
    | Buscar solicitud por número de factura diferente
    | excluyendo determinado solicitud por id
    */

    public static function findByNumFactDiffId($numFact, $solicitudId)
    {
        $solicitudes = DB::table('precreditos')
            ->where('num_fact', $numFact)
            ->where('id', "<>", $solicitudId)
            ->get();

        return $solicitudes;
    }

    /*
    |-------------------------------------------------
    | findSolicitudesActivasByCliente
    |-------------------------------------------------
    | Buscar solicitud activas por cliente
    */

    public static function findSolicitudesActivasByCliente($clienteId)
    {
        $solicitudes = DB::table("precreditos")
            ->join("clientes", "precreditos.cliente_id", "=", "clientes.id")
            ->leftJoin("creditos", "precreditos.id", "=", "creditos.precredito_id")
            ->where("clientes.id", "=", $clienteId)
            ->where("aprobado", "Si")
            ->whereNull("creditos.id")
            ->select("precreditos.*", "creditos.estado as credito_estado")
            ->get();
        
        $arr = [];

        foreach ($solicitudes as $solicitud) {
            $estado = $solicitud->credito_estado;

            if (!$estado) {
                $arr[] = $solicitud;
            } else {
                if ($estado !== "Cancelado" && $estado !== "Cancelado por refinanciacion") {
                    $arr[] = $solicitud;
                }
            }
        }
    
        return $arr;
    }

    /*
    |-------------------------------------------------
    | updateSolicitud
    |-------------------------------------------------
    | Actualizar solicitud
    */
    
    public static function updateSolicitud($dataSolicitud, $solicitudId)
    {
        $solicitud = Solicitud::find($solicitudId);
        $solicitud->fill($dataSolicitud);

        if ($solicitud->isDirty()) {
            $solicitud->user_update_id = Auth::user()->id;
            $solicitud->save();
        }

        return $solicitud;
    }

    /*
    |-------------------------------------------------
    | findTotal
    |-------------------------------------------------
    | Buscar solicitud y mostrar toda su información 
    | relacionada
    */

    public static function findTotal($solicitudId)
    {
        $solicitud = Solicitud::find($solicitudId);
        $solicitud->user_create;
        $solicitud->user_update;
        $solicitud->funcionario;
        $solicitud->cartera;
        $solicitud->credito;
        $solicitud->facturas;
        $solicitud->procesos;
        $solicitud->cliente;

        return $solicitud;
    }

    /*
    |-------------------------------------------------
    | updateAprobacion
    |-------------------------------------------------
    | Cambiar el estado de aprobación de una solicitud
    */


    public static function updateAprobacion($opcion, $solicitudId)
    {
        $solicitud = Solicitud::find($solicitudId);
        $solicitud->aprobado = $opcion;
        
        if ($solicitud->isDirty()) {
            $solicitud->user_update_id = Auth::user()->id;
            $solicitud->save();
        }

        return $solicitud;
    }

    /*
    |-------------------------------------------------
    | pendientes
    |-------------------------------------------------
    | Buscar solicitudes pendientes de aprobación para
    | determinado cliente
    */

    public static function pendientes($userId)
    {
        $solicitudes = DB::table('precreditos')
            ->where('user_create_id', $userId)
            ->where('aprobado', 'En estudio')
            ->get();

        return $solicitudes;
    }

}