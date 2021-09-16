<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Credito;
use Carbon\Carbon;

use DB;


function saludar(){
	return "Buenos dias";

}


function generar_sanciones($credito_id){

	$num_pagos 	= DB::table('pagos')->where('credito_id',$credito_id)->count();
	$credito 	= Credito::find($credito_id);
	$now 		= Carbon::today();

	
	if ( $num_pagos == 0 ){

		$fecha_tope = calcularFecha(
			$credito->precredito->fecha , 
			$credito->precredito->periodo , 	
			1 , 
			$credito->precredito->p_fecha , 
			$credito->precredito->s_fecha , 
			true
		);

		$fecha_tope = $fecha_tope['fecha_ini'];
	}
	else{
		$pago  = DB::table('pagos')
			->where('credito_id',$credito_id)
			->where('concepto','Cuota')
			->orWhere('concepto','Abono a cuota' )
			->orderBy('pago_hasta','desc')
			->first();
				 	
		$fecha_tope = $pago->pago_hasta;		 	
		 
	}

	$fecha_tope = Carbon::create(ano($fecha_tope) , mes($fecha_tope) , dia($fecha_tope) ,00,00,00);

	$validacion = $fecha_tope->gt($now);

	if( $validacion == true ){
		if( $credito->estado != 'Al dia' ){
			$credito->estado  = 'Al dia';
			$credito->save();
		}
	}
	else{
		if( $credito->estado == 'Al dia' ){
			$credito->estado  = 'Prejuridico';
			$credito->save();
		}
	}

	return $credito->estado;
	
}	



?>