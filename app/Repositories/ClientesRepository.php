<?php

namespace App\Repositories;

use App\Cliente;
use DB;


class ClientesRepository
{
    public static function find($clienteId)
    {
        return DB::table("clientes")
            ->join('municipios', 'clientes.municipio_id', '=', 'municipios.id')
            ->where("clientes.id", $clienteId)
            ->select(
                'clientes.*',
                'municipios.nombre as municipio',
                'municipios.departamento as departamento'
            )
            ->first();
    }

    public static function incrementarNumeroDeCreditos($clienteId)
    {
        $cliente = Cliente::find($clienteId);
        $cliente->numero_de_creditos ++;
        $cliente->save();
    }

    public static function findBySolicitud($solicitudId)
    {
        $cliente = DB::table('clientes')
            ->join('precreditos', 'clientes.id', '=', 'precreditos.cliente_id')
            ->where('precreditos.id', $solicitudId)
            ->select('clientes.*')
            ->first();

        return $cliente;
    }

    public static function findByCredito($creditoId)
    {
        $cliente = DB::table('clientes')
            ->join('precreditos', 'clientes.id', '=', 'precreditos.cliente_id')
            ->join('creditos', 'precreditos.id', '=', 'creditos.precredito_id')
            ->select('clientes.*')
            ->where('creditos.id', $creditoId)
            ->first();

        return $cliente;
    }
}