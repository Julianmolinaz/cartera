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
            ->where("concepto_id", 2)
            ->first();

        return $pago;
    }

    public static function getPagosBySolicitud($solicitudId)
    {
        $pagos = DB::table('precred_pagos')
            ->join('fact_precreditos', 'precred_pagos.fact_precredito_id', '=', 'fact_precreditos.id')
            ->join('fact_precred_conceptos', 'precred_pagos.concepto_id', '=', 'fact_precred_conceptos.id')
            ->join('users', 'precred_pagos.user_create_id', '=', 'users.id')
            ->where('fact_precreditos.precredito_id', $solicitudId)
            ->select(
                'fact_precreditos.id as recibo_id',
                'fact_precreditos.num_fact as recibo_num',
                'fact_precreditos.total as recibo_total',
                'fact_precreditos.tipo as tipo',
                'fact_precred_conceptos.nombre as concepto',
                'precred_pagos.precredito_id as solicitud_id',
                'precred_pagos.subtotal as abono',
                'precred_pagos.created_at',
                'users.name as created_by'
            )
            ->get();

        return $pagos;
    }
}