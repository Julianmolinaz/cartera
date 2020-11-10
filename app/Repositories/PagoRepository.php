<?php

namespace App\Repositories;

use DB;

class PagoRepository
{
    public function getDebeDeJuridicos($credito_id)
    {
        return  DB::table('extras')
        ->where([['credito_id','=',$credito_id],
                 ['concepto','=','Juridico'],
                 ['estado','=','Debe']])
        ->first();
    }

    public function getDebeDeSanciones($credito_id)
    {

        return  \App\Sancion::where('credito_id',$credito_id)
            ->where('estado','Debe')
            ->get();
    }

    public function getDebeJuridicos($credito_id)
    {
        return DB::table('pagos')
          ->where([['credito_id','=',$credito_id],
                   ['concepto','=','Juridico'],
                   ['estado','=','Debe']])
          ->first();
    }

    public function getDebePrejuridico($credito_id)
    {
        return DB::table('extras')
            ->where([['credito_id','=',$credito_id],
            ['concepto','=','Prejuridico'],
            ['estado','=','Debe']])
            ->first();    
    }

    public function getDebeExcedentesPrejuridico($credito_id)
    {
        return DB::table('pagos')
            ->where([['credito_id','=',$credito_id],
            ['concepto','=','Prejuridico'],
            ['estado','=','Debe']])
            ->first();
    }

    public function partialPayment($credito_id)
    {   
        return DB::table('pagos')
            ->where([['credito_id','=',$credito_id],
                    ['concepto','=','Cuota Parcial'],
                    ['estado','=','Debe']])
            ->orderBy('pago_hasta','asc')
            ->first();  
    }
}