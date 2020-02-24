<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Precredito;
use Carbon\Carbon;
use App\Llamada;
use Auth;
use DB;

class CajaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('start.cajas.index');
    }

    public function get_cash_report($date)
    {
        $res = [ 'error'  => false, 'dat' => cajaHp( $date,Auth::user()->id )];
        
        return response()->json($res);
    }

    public function get_cashes_report($date) 
    {
        $res = [ 'error'  => false, 'dat' => cajasHp( $date )];
        
        return response()->json($res);
    }

    public function ventas_mes($date)
    {
        $res = [ 'error'  => false, 
            'ventas' => ventasMesHp( new Carbon($date), Auth::user()->id )];
            
        return response()->json($res);
    }

   
}
