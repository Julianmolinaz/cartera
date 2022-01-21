<?php

namespace App\Repositories;

use DB;

class PagosSolicitudRepository
{
    public static function getPagosEstudioSolicitud($solicitudId)
    {
        $pago = DB::table("precred_pagos")
            ->where("precredito_id", $solicitudId)
            ->where("concepto_id", 1)
            ->first();

        return $pago;
    }

    public static function getPagosInicialSolicitud($solicitudId)
    {
        $pago = DB::table("precred_pagos")
            ->where("precredito_id", $solicitudId)
            ->where("concepto", 2)
            ->first();

        return $pago;
    }
}