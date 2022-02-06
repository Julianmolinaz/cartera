<?php

namespace App\Repositories;

use App\FechaCobro;

class FechaCobrosRepository
{
    public static function saveFechaCobro($data)
    {
        $fechaCobro = new FechaCobro();
        $fechaCobro->fill($data);
        $fechaCobro->save();

        return $fechaCobro;
    }

    public static function deleteByCredito($creditoId)
    {
        FechaCobro::where('credito_id', $creditoId)->delete();
    }

    public static function updateByCredito($fechaPago, $creditoId) 
    {
        $fecha = FechaCobro::where('credito_id', $creditoId)
            ->update(['fecha_pago' => $fechaPago]);

        return $fecha;
    }
}