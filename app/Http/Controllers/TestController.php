<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MyService\FormatDate;
use DB;

class TestController extends Controller
{
    public function make()
    {
       $format = new FormatDate('12-08-2012');
    //    return $format->getDay();
    //    return $format->getMonth();
    //    return $format->getYear();
        return $format->carbon();
    }

    public function some()
    {
        $precredito = \App\Precredito::find(26890);
        $factura = \App\RefProducto::find(6654);

        $soats = DB::table('ref_productos')
            ->where('precredito_id', 26890)
            ->where('fecha_exp', '<>', '0000-00-00')
            ->where('nombre', 'SOAT')
            ->orderBy('fecha_exp')
            ->get();

        if ($soats && $soats[0]->id == $factura->id) {
            dd('cargar_inicial');
        } else {
            dd('no cargar inicial');
        }

        return $soats;
    }
}
