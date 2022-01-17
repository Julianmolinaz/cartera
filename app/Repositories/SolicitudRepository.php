<?php

namespace App\Repositories;
use App\Precredito as Solicitud;
use DB;

class SolicitudRepository
{
    public static function saveSolicitud($data)
    {
        $solicitud = new Solicitud();
        $solicitud->fill($data);
        $solicitud->save();

        return $solicitud;
    }

    public static function find($solicitudId)
    {
        return DB::table("precreditos")->where("id", $solicitudId)->first();
    }

    public static function findByNumFact($numFact)
    {
        return DB::table('precreditos')->where('numFact', $numFact)->get();
    }

    public static function findByNumFactDiffId($numFact, $solicitudId)
    {
        $solicitudes = DB::table('precreditos')
            ->where('num_fact', $numFact)
            ->where('id', "<>", $solicitudId)
            ->get();

        return $solicitudes;
    }

    public static function updateSolicitud($dataSolicitud, $solicitudId)
    {
        $solicitud = Solicitud::find($solicitudId);
        $solicitud->fill($dataSolicitud);

        if ($solicitud->isDirty()) {
            $solicitud->user_update_id = 1;
            $solicitud->save();
        }

        return $solicitud;
    }

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
}