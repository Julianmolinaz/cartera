<?php

namespace App\Repositories;
use App as _;
use DB;

class ReciboCajaRepository
{

    /**
     * @param $ini : date yyyy-mm-dd
     * @param $end : date yyyy-mm-dd
     */

    public function getCreditos($ini, $end)
    {
        return _\Credito::where('created_at', '>=', $ini);
    }
}