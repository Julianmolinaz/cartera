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
        ->get();
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
          ->get();
    }

    public function getDebePrejuridico($credito_id)
    {
        return DB::table('extras')
            ->where([['credito_id','=',$credito_id],
            ['concepto','=','Prejuridico'],
            ['estado','=','Debe']])
            ->get();    
    }

    public function getDebeExcedentesPrejuridico($credito_id)
    {
        return DB::table('pagos')
            ->where([['credito_id','=',$credito_id],
            ['concepto','=','Prejuridico'],
            ['estado','=','Debe']])
            ->get();
    }

    
}