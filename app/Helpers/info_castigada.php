<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Castigada;
use DB;

function reporte_castigada($fecha_1, $fecha_2){

	// conversion de fechas para trabajar

	$ini     = Carbon::create(ano($fecha_1),mes($fecha_1),dia($fecha_1),00,00,00);
  	$fin     = Carbon::create(ano($fecha_2),mes($fecha_2),dia($fecha_2),23,59,59);
  	$rango   = array('ini' => $ini->format('d-m-Y'), 'fin' => $fin->format('d-m-Y')); 


	$castigadas = 
	  DB::table('castigadas')
	      ->whereBetween('fecha_limite',[$ini,$fin])
	      ->select('id')
	      ->get();

	$castigadas_array = array();

	// convertir ids de castigadas en un array
	  
	foreach ($castigadas as $castigada) {
	      	array_push($castigadas_array,$castigada->id);
	      }   

	// traer castigadas en forma de objeto       

	$castigadas = Castigada::find($castigadas_array); 

	// procesamiento de carteras para sumar la cartera castigada a cada una.

    $carteras           = DB::table('carteras')->select('id','nombre')->get();
	$array_carteras     = array();

	foreach($carteras as $cartera){ 
	    $temp = array('id' => $cartera->id, 'nombre' => $cartera->nombre, 'cartera_castigada' => 0);
	    array_push($array_carteras,$temp);
	}  

		

  	foreach($castigadas as $castigada){ 
      	for($i = 0; $i < count($array_carteras); $i++){

            if($array_carteras[$i]['nombre'] == $castigada->credito->precredito->cartera->nombre){ 

            	$array_carteras[$i]['cartera_castigada'] = $array_carteras[$i]['cartera_castigada'] + $castigada->saldo;
              	break; 
          }}}


	  return array(
	  	'castigadas' 		=> $castigadas,
	  	'rango'				=> $rango,
	  	'carteras' 			=> $array_carteras
	  	); 
}

