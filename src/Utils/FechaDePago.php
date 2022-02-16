<?php

namespace Src\Utils;

use App\Http\Controllers as Ctrl;
use Carbon\Carbon;

class FechaDePago
{
    const DIAS = 7;

    public static function calcular(
        $fechaInicial, 
        $periodo, 
        $primerFecha, 
        $segundaFecha
    ) {
        $fecha_pago = Ctrl\calcularFecha(
            $fechaInicial,
            $periodo,
            1, 
            $primerFecha,
            $segundaFecha,
            true
        );

        $ini = new Carbon($fecha_pago['fecha_ini']);
        $hoy = Carbon::now();

        if ($ini->diffInDays($hoy) > self::DIAS) {
            $fecha = $ini->format('Y-m-d');
        } else {
            $fecha = Ctrl\inv_fech($fecha_pago['fecha_fin']);
        }

        return $fecha;
    }
}