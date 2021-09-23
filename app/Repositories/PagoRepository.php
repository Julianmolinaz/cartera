<?php

namespace App\Repositories;

use DB;

class PagoRepository
{
    public function getDebeDeJuridicos($credito_id)
    {
        return  DB::table('extras')
            ->where('credito_id', $credito_id)
            ->where('concepto', 'Juridico')
            ->where('estado', 'Debe')
            ->first();
    }

    public function getDebeDeSanciones($credito_id)
    {
        return  \App\Sancion::where('credito_id',$credito_id)
            ->where('estado','Debe')
            ->get();
    }

    /**
     * **PAGOS**
     * Incluye descuentos
     */

    public function getDebeJuridicos($credito_id)
    {
        return DB::table('pagos')
            ->where('credito_id', $credito_id)
            ->where('concepto', 'Juridico')
            ->where('estado', 'Debe')
            ->first();
    }

    public function getDebePrejuridico($credito_id)
    {
        return DB::table('extras')
            ->where('credito_id', $credito_id)
            ->where('concepto','Prejuridico')
            ->where('estado','=','Debe')
            ->first();    
    }

    /**
     * **PAGOS**
     * Incluye descuentos
     */

    public function getDebeExcedentesPrejuridico($credito_id)
    {
        return DB::table('pagos')
            ->where('credito_id', $credito_id)
            ->where('concepto', 'Prejuridico')
            ->where('estado', 'Debe')
            ->first();
    }
    
    /**
     * **PAGOS**
     * Incluye descuentos
     */

    public function partialPayment($credito_id)
    {   
        return DB::table('pagos')
            ->where(
                [
                    ['credito_id','=',$credito_id],
                    ['concepto','=','Cuota Parcial'],
                    ['estado','=','Debe']
                ]
            )
            ->first();  
    }   
}