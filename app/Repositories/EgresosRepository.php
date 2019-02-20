<?php

namespace App\Repositories;
use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use Auth;
use DB;

 

class EgresosRepository
{
    public function get_egresos_por_rango($ini, $fin)
    {
        return  DB::table('egresos')
        ->join('users','egresos.user_create_id','=','users.id')
        ->join('puntos','users.punto_id','=','puntos.id')
        ->whereBetween('egresos.created_at',[$ini,$fin])
        ->get();
    }

    public function get_sum_egresos($ini, $fin)
    {
        return  DB::table('egresos')
        ->join('users','egresos.user_create_id','=','users.id')
        ->join('puntos','users.punto_id','=','puntos.id')
        ->whereBetween('egresos.created_at',[$ini,$fin])
        ->sum('egresos.valor');
    }

    public function get_egresos_punto($ini, $fin, $punto_id)
    {
        return  DB::table('egresos')
        ->join('users','egresos.user_create_id','=','users.id')
        ->join('puntos','users.punto_id','=','puntos.id')
        ->where('puntos.id','=',$punto_id)
        ->whereBetween('egresos.created_at',[$ini,$fin])
        ->sum('egresos.valor');
    }
}