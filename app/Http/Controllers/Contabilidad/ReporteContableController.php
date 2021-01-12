<?php

namespace App\Http\Controllers\Contabilidad;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes\ReporteRecibosCaja;
use Carbon\Carbon;

class ReporteContableController extends Controller
{


    public function __construct()
    {

    }

    // public function go(Request $request)
    public function go()
    {
        $ini = Carbon::create('2020', '01', '10');
        $end = Carbon::create('2020', '30', '10');

        $repor_caja = new ReporteRecibosCaja($ini, $end);

        dd($repor_caja->make());
    }

}
