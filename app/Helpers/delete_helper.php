<?php 

namespace App\Http\Controllers;

function deletePagosCreditoHp($credito_id)
{
    try {

        \DB::table('pagos')
            ->where('credito_id',$credito_id)
            ->delete();
    
        \DB::table('facturas')
            ->where('credito_id',$credito_id)
            ->delete();    

        return true;    

    } catch (\Exception $e) {
        return $e->getMessage();
    }   

}

function deleteSancionesCreditoHp($credito_id)
{
    try {

        \DB::table('sanciones')
            ->where('credito_id',$credito_id)
            ->delete();

        return true;    

    } catch (\Exception $e) {
        return $e->getMessage();
    } 
}


function deleteLlamadasCreditoHp($credito_id)
{
    try {

        \DB::table('llamadas')
            ->where('credito_id',$credito_id)
            ->delete();

        return true;    

    } catch (\Exception $e) {
        return $e->getMessage();
    } 
}

function deleteFechaCobrosCreditoHp($credito_id)
{
    try {

        \DB::table('fecha_cobros')
            ->where('credito_id',$credito_id)
            ->delete();

        return true;    

    } catch (\Exception $e) {
        return $e->getMessage();
    } 
}
