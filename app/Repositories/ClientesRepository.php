<?php

namespace App\Repositories;
use DB;


class ClientesRepository
{
    public static function find($clienteId)
    {
        return DB::table("clientes")
            ->where("id", $clienteId)
            ->first();
    }
}