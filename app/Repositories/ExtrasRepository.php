<?php

namespace App\Repositories;

use App\Extra;
use DB;

class ExtrasRepository
{
    public static function getJuridicoDebeByCredito($creditoId)
    {
        $juridico = Extra::where('credito_id',$creditoId)
            ->where('concepto','Juridico')
            ->where('estado','Debe')
            ->first();

        return $juridico;
    }

    public static function getPrejuridicoDebeByCredito($creditoId)
    {
        $prejuridico = Extra::where('credito_id',$creditoId)
            ->where('concepto','Prejuridico')
            ->where('estado','Debe')
            ->first();

        return $prejuridico;
    }

    public static function getPagosPrejuridicoDebe($creditoId)
    {
        $pagoPrejuridico = DB::table('pagos')
            ->where('credito_id', $creditoId)
            ->where('concepto', 'Prejuridico')
            ->where('estado', 'Debe')
            ->first();

        return $pagoPrejuridico;
    }
}