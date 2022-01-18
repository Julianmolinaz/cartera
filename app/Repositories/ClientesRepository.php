<?php

namespace App\Repositories;

use App\Cliente;
use DB;


class ClientesRepository
{
    public static function find($clienteId)
    {
        return DB::table("clientes")
            ->where("id", $clienteId)
            ->first();
    }

    public static function incrementarNumeroDeCreditos($clienteId)
    {
        $cliente = Cliente::find($clienteId);
        $cliente->numero_de_creditos ++;
        $cliente->save();
    }
}