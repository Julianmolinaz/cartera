<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Credito;
use DB;

/**
 * Definiciones: 
 * $costo_total = total costo (SUM centros de costo de c/u creditos)
 */

function financiero($f_ini, $f_fin)
 {
      $ini     = Carbon::create(ano($f_ini),mes($f_ini),dia($f_ini),00,00,00);
      $fin     = Carbon::create(ano($f_fin),mes($f_fin),dia($f_fin),23,59,59);
      $rango   = array('ini' => $ini->format('d-m-Y'), 'fin' => $fin->format('d-m-Y')); 


      $vlr_fin_total 					          = 0; 
      $vlr_a_recaudar 					        = 0; 
      $vlr_recaudado_en_cuotas 			    = 0;
      $vlr_recaudado_en_sanciones 		  = 0;
      $vlr_recaudado_prejuridico 		    = 0;
      $vlr_recaudado_juridico 			    = 0;
      $creditos_ideales             	  = 0;
      $creditos_0_1_pago            	  = 0;
      $creditos_promedio            	  = 0;
      $pago_menos_costo             	  = 0;
      $porcien_0_1_pago             	  = 0;
      $porcien_ideales              	  = 0;
      $porcien_promedio    				      = 0;
      $ingreso_esperado    				      = 0;
      $total_ingresos_adicionales   	  = 0;
      $total_vlr_fin_creditos_ideales 	= 0;
      $total_vlr_fin_creditos_0_1_pago  = 0;
      $total_vlr_fin_creditos_promedio  = 0;
      $total_costo_cartera              = 0;
      $saldo_menos_cartera              = 0;
      $data_creditos                    = array();  // información de creditos que se mostrará en la vista
   

      //CONSULTA DE CREDITOS POR RANGO DE FECHA
      //$creditos = Credito::whereBetween('created_at',[$ini, $fin])->get();
      $creditos = Credito::
        //whereIn('id',[780,821,1043,1871,1884])
        where('credito_refinanciado_id',null)
        ->whereBetween('created_at',[$ini, $fin])
        ->get();

      $num_creditos	= count($creditos);

      if($num_creditos <= 0){
        dd('Lo sentimos no hay créditos registrados en este periodo ');
      }

      $total_listados = [
  			'vlr_a_recaudar' 			      => 0,
  			'vlr_financiado' 			      => 0,
  			'vlr_recaudado_en_cuotas' 	=> 0,
  			'vlr_recaudado_prejuridico' => 0,
  			'vlr_recaudado_juridico'    => 0,
  			'vlr_recaudado_en_sanciones'=> 0
      ]; 

      foreach($creditos as $credito)
      {

      	$vlr_fin_total	+= $credito->precredito->vlr_fin;
      	$vlr_a_recaudar += $credito->valor_credito;


      	$pagos_credito = total_pagos_credito($credito);

    		$vlr_recaudado_en_cuotas 			+= $pagos_credito['total_pagos_credito'];
    		$vlr_recaudado_prejuridico    += $pagos_credito['total_pagos_prejuridico_credito'];
    		$vlr_recaudado_juridico       += $pagos_credito['total_pagos_juridico_credito'];
    		$vlr_recaudado_en_sanciones   += $pagos_credito['total_pagos_sanciones_credito'];      	  
      //FALTA TIPIFICAR
  		//CREDITOS IDEALES

        //Contador de creditos ideales

    		if($pagos_credito['total_pagos_credito'] >= $credito->precredito->vlr_fin)
    		{
    			$creditos_ideales ++;
    		}

        //Contador de creditos 0-1 pago
    		//CREDITOS 0 - 1 PAGO (CON EL 20% 0 MENOS DEL VLR A FINANCIAR PAGADO)

    		elseif($pagos_credito['total_pagos_credito'] <= ($credito->precredito->vlr_fin * 0.2))
    		{
    			$creditos_0_1_pago ++;
    			$total_vlr_fin_creditos_0_1_pago += $credito->precredito->vlr_fin - $pagos_credito['total_pagos_credito'];

    		}

    		//CREDITOS PROMEDIO POR ENCIMA DEL 20 % Y MENOS DEL 100% DEL VLR A FINANCIAR PAGADO
        	
    		elseif($pagos_credito['total_pagos_credito'] > ($credito->precredito->vlr_fin * 0.2) 
    	       && ($pagos_credito['total_pagos_credito'] < $credito->precredito->vlr_fin))
    		{
    			$creditos_promedio ++;
    			$total_vlr_fin_creditos_promedio += $credito->precredito->vlr_fin - $pagos_credito['total_pagos_credito'];
    		}

    		$temp = [
    			'id' 						            => $credito->id,
    			'cliente' 					        => $credito->precredito->cliente->nombre,
    			'documento' 				        => $credito->precredito->cliente->num_doc,
    			'cuotas'					          => $credito->precredito->cuotas,
    			'vlr_a_recaudar' 			      => $credito->valor_credito,
    			'vlr_financiado' 			      => $credito->precredito->vlr_fin,
    			'vlr_recaudado_en_cuotas' 	=> $pagos_credito['total_pagos_credito'],
    			'vlr_recaudado_prejuridico' => $pagos_credito['total_pagos_prejuridico_credito'],
    			'vlr_recaudado_juridico'    => $pagos_credito['total_pagos_juridico_credito'],
    			'vlr_recaudado_en_sanciones'=> $pagos_credito['total_pagos_sanciones_credito'],
    			'created_at'				        => $credito->created_at 
    		];

     
    		$total_listados['vlr_a_recaudar']				     +=  $credito->valor_credito;
    		$total_listados['vlr_financiado']				     +=  $credito->precredito->vlr_fin;
    		$total_listados['vlr_recaudado_en_cuotas']	 +=  $pagos_credito['total_pagos_credito'];
    		$total_listados['vlr_recaudado_prejuridico'] +=  $pagos_credito['total_pagos_prejuridico_credito'];
    		$total_listados['vlr_recaudado_juridico']		 +=  $pagos_credito['total_pagos_juridico_credito'];
    		$total_listados['vlr_recaudado_en_sanciones']+=  $pagos_credito['total_pagos_sanciones_credito'];


      	array_push($data_creditos,$temp);

      }//.foreach

  	  $pago_menos_costo = $vlr_recaudado_en_cuotas - $vlr_fin_total;


  	  $porcien_0_1_pago             = ($creditos_0_1_pago * 100 / $num_creditos);
      $porcien_ideales              = ($creditos_ideales  * 100 / $num_creditos);
      $porcien_promedio    			    = ($creditos_promedio * 100 / $num_creditos);

      $ingreso_esperado				      = $vlr_a_recaudar - $vlr_fin_total;
      $total_ingresos_adicionales   = $vlr_recaudado_en_sanciones + $vlr_recaudado_prejuridico + $vlr_recaudado_juridico;

      $total_costo_cartera          = $total_vlr_fin_creditos_0_1_pago + $total_vlr_fin_creditos_promedio;


      $data = [
      	'num_creditos'				        => $num_creditos,
      	'vlr_fin_total' 			        => $vlr_fin_total,
      	'vlr_a_recaudar'			        => $vlr_a_recaudar,
      	'ingreso_esperado'			      => $ingreso_esperado,
      	'vlr_recaudado_en_cuotas' 	  => $vlr_recaudado_en_cuotas,
      	'vlr_recaudado_en_sanciones'  => $vlr_recaudado_en_sanciones,
      	'vlr_recaudado_prejuridico'   => $vlr_recaudado_prejuridico,
      	'vlr_recaudado_juridico'      => $vlr_recaudado_juridico,
      	'creditos_ideales'   	        => $creditos_ideales,
      	'creditos_0_1_pago'			      => $creditos_0_1_pago,
      	'creditos_promedio'			      => $creditos_promedio,
      	'pago_ideal'      			      => $pago_menos_costo,
      	'porcien_0_1_pago'			      => $porcien_0_1_pago,
      	'porcien_promedio'			      => $porcien_promedio,
      	'porcien_ideales'    		      => $porcien_ideales,
      	'total_ingresos_adicionales'  => $total_ingresos_adicionales,
      	'vlr_fin_creditos_ideales'    => 0,
      	'vlr_fin_creditos_0_1_pago'   => $total_vlr_fin_creditos_0_1_pago,
      	'vlr_fin_creditos_promedio'   => $total_vlr_fin_creditos_promedio,
      	'total_costo_cartera'		      => $total_costo_cartera,
      	'total_listados'              => $total_listados,
      	'creditos'					          => $data_creditos
      ];

      return $data;
 }


function total_pagos_credito($credito)
{
	$pagos = calculadora_pagos_credito($credito);

	if($credito->refinanciacion == 'Si')
	{
		$pagos_refinanciacion = calculadora_pagos_credito($credito->refinanciado);

		$pagos['total_pagos_credito'] 				      += $pagos_refinanciacion['total_pagos_credito'];
		$pagos['total_pagos_prejuridico_credito'] 	+= $pagos_refinanciacion['total_pagos_prejuridico_credito'];
		$pagos['total_pagos_juridico_credito'] 		  += $pagos_refinanciacion['total_pagos_juridico_credito'];
		$pagos['total_pagos_sanciones_credito'] 	  += $pagos_refinanciacion['total_pagos_sanciones_credito'];

	}

	return $pagos;
}

function calculadora_pagos_credito($credito)
{
	$total_pagos_credito 				        = 0;
	$total_pagos_prejuridico_credito	  = 0;
	$total_pagos_juridico_credito       = 0;
	$total_pagos_sanciones_credito      = 0;

	foreach($credito->pagos as $pago)
  	{
  		// SUMATORIA DE PAGOS C/U DESCRIMINADOS POR CONCEPTO

  		if($pago->concepto == 'Cuota Parcial' || $pago->concepto == 'Cuota' )
  		{
  			$total_pagos_credito += $pago->abono;
  		}
  		elseif($pago->concepto == 'Prejuridico')
  		{
  			$total_pagos_prejuridico_credito += $pago->abono;
  		}
  		elseif($pago->concepto == 'Juridico')
  		{
  			$total_pagos_juridico_credito += $pago->abono;
  		}

  	}

	foreach($credito->sanciones as $sancion)
  	{
  		if($sancion->estado == 'Ok')
  		{
  			$total_pagos_sanciones_credito += $sancion->valor;
  		}
  	}

  	return [
  		'total_pagos_credito' 				    => $total_pagos_credito,
  		'total_pagos_prejuridico_credito'	=> $total_pagos_prejuridico_credito,
  		'total_pagos_juridico_credito'    => $total_pagos_juridico_credito,
  		'total_pagos_sanciones_credito'   => $total_pagos_sanciones_credito
  	];
}

	function seleccion_datos_credito($credito)
	{
		$data = [
			'id' 		        => $credito->id,
			'cliente' 	    => $credito->precredito->cliente->nombre,
			'documento'     => $credito->precredito->cliente->num_doc,
			'cuotas'	      => $credito->precredito->cuotas,
			'vlr_financiado'=> $credito->valor_credito,
			'vlr_a_recaudar'=> $credito->precredito->vlr_fin
		];

		return $data;

	//	dd($data);
	}

