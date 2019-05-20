<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Requests;
use Carbon\Carbon;
use App\Egreso;
use Auth;
use DB;

 

class EgresosRepository
{
    public function get_egresos_general_por_conceptos($ini,$fin)
    {
        return DB::table('egresos')
            ->whereBetween('created_at',[$ini,$fin])
            ->select('concepto',DB::raw('SUM(valor) as valor'))
            ->groupBy('concepto')
            ->get();

    }

    public function get_egresos_sucursal_por_conceptos($ini,$fin,$sucursal_id)
    {
        return DB::table('egresos')
            ->where('punto_id',$sucursal_id)
            ->whereBetween('created_at',[$ini,$fin])
            ->select('concepto',DB::raw('SUM(valor) as valor'))
            ->groupBy('concepto')
            ->get();

    }

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
            ->where('punto_id',$punto_id)
            ->whereBetween('created_at',[$ini,$fin])
            ->sum('valor');
    }

    public function filter($string, $paginate)
    {
        $ids = DB::table('egresos')
            ->join('carteras','egresos.cartera_id','=','carteras.id')
            ->join('puntos','egresos.punto_id','=','puntos.id')
            ->leftJoin('proveedores','egresos.proveedor_id','=','proveedores.id')
            ->where('egresos.comprobante_egreso','like','%'.$string.'%')
            ->orWhere('egresos.fecha','like','%'.$string.'%')
            ->orWhere('egresos.concepto','like','%'.$string.'%')
            ->orWhere('puntos.nombre','like','%'.$string.'%')
            ->select('egresos.id as id')
            ->get();

        $collection = collect($ids);
        $ids = $collection->pluck('id');

        $egresos = Egreso::whereIn('id',$ids)
            ->orderBy('updated_at','desc')
            ->with('proveedor')
            ->with('cartera')
            ->with('punto')
            ->paginate($paginate);  

        return $egresos;

    }

    
}