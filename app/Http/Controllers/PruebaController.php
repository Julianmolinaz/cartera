<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Traits\LogTrait;

use App\Egreso;
use Excel;
use DB;

class PruebaController extends Controller
{
    use LogTrait;

    public function log()
    {
        return $this->logFacturaTr();
    }


    public function invertirFecha()
    {
        DB::beginTransaction();
        try {

            $egresos = Egreso::all();

            foreach ($egresos as $egreso) {
                $fecha = $egreso->fecha;
                if(substr($fecha, 2, 1) == '-'){
                    $y = substr($fecha, 6,4);
                    $m = substr($fecha, 3,2);
                    $d = substr($fecha, 0,2);

                    $nueva_fecha = $y.'-'.$m.'-'.$d;
        
                    DB::table('egresos')
                        ->where('id',$egreso->id)
                        ->update(['fecha' => $nueva_fecha]);
                }
            }     
            
            DB::commit();

            dd('cambio exitoso');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }



    }
}
