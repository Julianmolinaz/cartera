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

    public static function pagosByCredito($creditoId)
    {
        $pagos = DB::table('pagos')
            ->join('facturas', 'pagos.factura_id', '=', 'facturas.id')
            ->join('users', 'facturas.user_create_id', '=', 'users.id')
            ->where('facturas.credito_id', $creditoId)
            ->orderBy('facturas.created_at', 'desc')
            ->select(
                'facturas.id as recibo_id',
                'facturas.num_fact as recibo_num',
                'facturas.credito_id as credito_id',
                'facturas.fecha as recibo_fecha',
                'facturas.total as recibo_total',
                'facturas.tipo as recibo_tipo_pago',
                'facturas.descuento as es_descuento',
                'facturas.banco as recibo_banco',
                'pagos.concepto as concepto',
                'pagos.abono as abono',
                'pagos.debe as debe',
                'pagos.estado as estado',
                'pagos.pago_desde as desde',
                'pagos.pago_hasta as hasta',
                'users.name as created_by',
                'pagos.created_at'
            )
            ->get();

        return $pagos;
    }
}