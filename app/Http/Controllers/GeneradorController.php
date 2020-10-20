<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Credito;
use App\Sancion;
use DB;

class GeneradorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function set()
    {
       $creditos = DB::table('creditos')->get();
       
       foreach($creditos as $credito)
       {
            DB::table('creditos')
                ->where('id',$credito->id)
                ->update([
                    'sanciones_debe'        => $this->getSancionesDebe($credito),
                    'sanciones_ok'          => $this->getSancionesOk($credito),
                    'sanciones_exoneradas'  => $this->getSancionesExoneradas($credito)
                ]);
       }
       
    }

    public function getSancionesDebe($credito)
    {
        return DB::table('sanciones')
            ->where('credito_id',$credito->id)
            ->where('estado','Debe')
            ->count();
    }

    public function getSancionesOk($credito)
    {
        return DB::table('sanciones')
            ->where('credito_id',$credito->id)
            ->where('estado','Ok')
            ->count();
    }

    public function getSancionesExoneradas($credito)
    {
        return DB::table('sanciones')
            ->where('credito_id',$credito->id)
            ->where('estado','Exonerada')
            ->count();        
    }
}
