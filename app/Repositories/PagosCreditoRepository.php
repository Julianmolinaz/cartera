<?php

namespace App\Repositories;

use DB;

class PagosCreditoRepository
{
    public static function cuotaParcialDebe($creditoId)
    {
        $pago = DB::table('pagos')
            ->join('facturas', 'pagos.factura_id', '=', 'facturas.id')
            ->where('facturas.credito_id', $creditoId)
            ->where('facturas.descuento', false)
            ->where('pagos.concepto', 'Cuota Parcial')
            ->where('pagos.estado', 'Debe')
            ->select('pagos.*')
            ->first();

        return $pago;
    }

    public static function totalDescuentosByCredito($creditoId)
    {
        $descuentos = DB::table('facturas')
            ->where('descuento', true)
            ->where('credito_id', $creditoId)
            ->sum('total');
    }

    public static function totalPagosByCredito($creditoId)
    {
        $totalPagos = DB::table('facturas')
            ->where('descuento', false)
            ->where('credito_id', $creditoId)
            ->sum('total');

        return $totalPagos;
    }
}