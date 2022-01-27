<?php

namespace App\Repositories;

use App\FechaCobro;

class FechaCobrosRepository
{
    public static function saveFechaCobro($data)
    {
        $fechaCobro = new FechaCobro();
        $fechaCobro->fill($data);
        $fechaCobro->save();

        return $fechaCobro;
    }
}