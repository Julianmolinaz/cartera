<?php

namespace App\Repositories;

use DB;

class CodeudoresRepository
{
    public static function findByCliente($clienteId)
    {
        $codeudor = DB::table('codeudores')
            ->join('clientes', 'codeudores.id', '=', 'clientes.codeudor_id')
            ->join('municipios', 'codeudores.municipio_id', '=', 'municipios.id')
            ->where('clientes.id', $clienteId)
            ->select(
                'codeudores.*',
                'municipios.nombre as municipio',
                'municipios.departamento as departamento',
            )
            ->first();

        return $codeudor;
    }
}