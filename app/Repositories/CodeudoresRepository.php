<?php

namespace App\Repositories;

use DB;

class CodeudoresRepository
{
    public static function findByCliente($clienteId)
    {
	$codeudor = DB::table('codeudores')
            ->join('clientes', 'codeudores.id', '=', 'clientes.codeudor_id')
            ->leftJoin('municipios', 'codeudores.municipio_id', '=', 'municipios.id')
            ->leftJoin('municipios as municipios_', 'codeudores.municipioc_id', '=', 'municipios_.id')
            ->where('clientes.id', $clienteId)
            ->select(
                'codeudores.*',
                'municipios.nombre as municipio',
                'municipios.departamento as departamento',
                'municipios_.nombre as municipio_',
                'municipios_.departamento as departamento_',
            )
            ->first();

        return $codeudor;
    }
}
