<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use App\Llamada;
use App\Precredito;
use Auth;
use DB;

class CajaController extends Controller
{
    public function index()
    {
        return view('start.cajas.index');
    }

    public function get_cash_report($date)
    {
        
        return response()->json( caja($date,Auth::user()->id ));
    }

   
}
