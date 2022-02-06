<?php

namespace App\Repositories;
use DB;

class LlamadasRepository
{
    public static function llamadasByCredito($creditoId)
    {
        $llamadas = DB::table('llamadas')
            ->join('criterios', 'llamadas.criterio_id', '=', 'criterios.id')
            ->join('users', 'llamadas.user_create_id', '=', 'users.id')
            ->where('llamadas.credito_id', $creditoId)
            ->select(
                'criterios.criterio',
                'llamadas.agenda',
                'llamadas.efectiva',
                'llamadas.observaciones',
                'users.name as created_by',
                'llamadas.created_at'
            )
            ->orderBy('llamadas.created_at', 'desc')
            ->get();

        return $llamadas;
    }
}