<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Precredito;
use Carbon\Carbon;
use App\Llamada;
use App as _;
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
        $cajas =  cajasHp( $date );
        $ids_puntos = [];
        $ids_users  = [];
        
        foreach ($cajas as $caja ) {
            array_push($ids_puntos, $caja['punto']['id']);
            array_push($ids_users, $caja['user']['id']);
        }

        $puntos = _\Punto::orderBy('nombre')->whereIn('id',$ids_puntos)->get();
        $users = _\User::orderBy('name')->whereIn('id',$ids_users)->get();
        
        $res = [ 
            'error'  => false, 
            'dat' => [
                'cajas' => $cajas,
                'puntos' => $puntos,
                'users' => $users
            ]
        ];
        
        return response()->json($res);
    }

    public function ventas_mes($date)
    {
        $res = [ 'error'  => false, 
            'ventas' => ventasMesHp( new Carbon($date), Auth::user()->id )];
            
        return response()->json($res);
    }

   
}
