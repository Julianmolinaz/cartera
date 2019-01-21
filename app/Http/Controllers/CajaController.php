<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use App\Llamada;
use Auth;
use DB;

class CajaController extends Controller
{
    public function index()
    {
    	$fecha = Carbon::now();

    	return view('start.cajas.index')
    		->with('cantidad_llamadas', $this->cantidad_llamadas($fecha));
    }

    Public function cantidad_llamadas($fecha)
    {
        return Llamada::where('created_at','like','%'.$fecha->toDateString().'%')
                            ->where('user_create_id',Auth::user()->id)
                            ->count();
    }

    public function cantidad_solicitudes($fecha)
    {

    }
}
