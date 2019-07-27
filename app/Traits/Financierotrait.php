<?php
namespace App\Traits;

use App\Repositories\EgresosRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Helpers;
use App\Credito;
use DB;

trait Financierotrait
{

  function financiero_sucursal($ini,$fin, $sucursal_id)
  {
      $creditos = DB::table('creditos')
        ->join('precreditos','creditos.precredito_id','=','precreditos.id')
        ->join('users','precreditos.user_create_id','=','users.id')
        ->where('users.punto_id',$sucursal_id)
        ->whereBetween('precreditos.created_at',[$ini,$fin])
        ->select('creditos.id as id')
        ->get();

      $ids = array_pluck($creditos, 'id');

      $creditos = Credito::find($ids);
         
      // EGRESOS

      $total_egresos  = $this->egresos_repo->get_egresos_punto($ini, $fin, $sucursal_id);
  
      $info = $this->reporte_financiero($creditos);

      return array(
        'total_egresos'         => $total_egresos, 
        'egresos_por_concepto'  => 
            $this->egresos_repo->get_egresos_sucursal_por_conceptos($ini,$fin,$sucursal_id),
        'info' => $info
      );
  }

  /*
  |--------------------------------------------------------------------------
  | financiero
  |--------------------------------------------------------------------------
  | permite generar un reporte general fiananciero acotado por fecha.
  | recibe dos fechas carbon de inicio $ini y final $fin
  | retorna el reporte financiero
  |
  */

  function financiero($ini,$fin)
  {
      $creditos = Credito::
        where('credito_refinanciado_id',null)
        ->whereBetween('created_at',[$ini, $fin])
        ->get();
              
      // EGRESOS

      $total_egresos  = $this->egresos_repo->get_sum_egresos($ini, $fin);
      $info           = $this->reporte_financiero($creditos);
      $iniciales       = $this->egresos_repo->iniciales($ini, $fin);

      return array(
        'total_egresos'         => $total_egresos, 
        'egresos_por_concepto'  => $this->egresos_repo->get_egresos_general_por_conceptos($ini,$fin),
        'info' => $info,
        'iniciales' => $iniciales
      );
  }

  /*
  |--------------------------------------------------------------------------
  | financiero_por_sucursales
  |--------------------------------------------------------------------------
  | permite generar un reporte financiero por sucursales acotado por fecha.
  | recibe dos fechas carbon de inicio $ini (fecha inicial) $fin (fecha inicial)
  | y una $sucursal_id (id de la sucursal o punto)
  | retorna el reporte financiero para esa sucursal
  |
  */  

  function financiero_por_sucursales($ini, $fin, $sucursal_id)
  {
    $array = [];
    $creditos = DB::table('creditos')
      ->join('precreditos','creditos.precredito_id','=','precreditos.id')
      ->join('users','precreditos.user_create_id','=','users.id')
      ->join('puntos','users.punto_id','=','puntos.id')
      ->select('creditos.id as id')
      ->where('puntos.id','=',$sucursal_id)
      ->whereBetween('creditos.created_at',[$ini,$fin])
      ->get();

    foreach($creditos as $credito){
      array_push($array, $credito->id);
    }

    $credits = Credito::find($array);

    return $this->reporte_financiero($credits);
  }

  /*
  |--------------------------------------------------------------------------
  | reporte_financiero
  |--------------------------------------------------------------------------
  | generador de reportes
  | recibe un array de $creditos
  | retorna el reporte financiero con toda LA INFORMACIÓN REQUERIDA
  |
  */  

  function reporte_financiero($creditos)
   {
        $vlr_fin_total 					          = 0; //sumatoria del valor a financiar 
        $iniciales                        = 0; //sumatoria cuotas iniciales 
        $vlr_a_recaudar 					        = 0; //sumatoria del valor total del crédito (incluye intereses)
        $vlr_recaudado_en_cuotas 			    = 0; //sumatoria del recaudo en cuotas (incluye refinanciados)
        $vlr_recaudado_en_sanciones 		  = 0; //sumatorio del recaudo por sanciones (incluye refinanciados)
        $vlr_recaudado_prejuridico 		    = 0; //sumatorio del recaudo prejuridico (incluye refinanciados)
        $vlr_recaudado_juridico 			    = 0; //sumatorio del recaudo juridico (incluye refinanciados)
        $creditos_ideales             	  = 0; //cantidad de créditos que su recaudo en cuotas es >= al valor a financiar

        $creditos_0_1_pago            	  = 0; //cantidad de créditos que su recaudo en cuotas es >= al 20 % del valor del credito
        $creditos_promedio            	  = 0; //cantidad de créditos que su recaudo en cuotas es > al 20 % del valor del credito y < que el 100 % del valor a financiar
        $pago_menos_costo             	  = 0; //resta del valor recaudado en cuotas de todos los creditos y el valor total a financiar de los creditos
        $porcien_0_1_pago             	  = 0; //porcentaje de creditos 0 – 1 pago
        $porcien_ideales              	  = 0; //porcentaje de creditos que han cubierto el 100% del valor a financiar (el valor se cubre con el total de pagos por cuota)
        $porcien_promedio    				      = 0; //porcentaje de creditos que deben entre el 20% del valor a financiar y el 100%
        $ingreso_esperado    				      = 0; //valor total que se espera como ganancia de la colocación
        $total_ingresos_adicionales   	  = 0; //total del recaudo por otros conceptos  (sanciones, prejuridico, juridico)
        $total_debe_vlr_fin_creditos_ideales 	 = 0; // vlr a fianciar que se debe = 0
        $total_debe_vlr_fin_creditos_0_1_pago  = 0; // sumatoria de lo que adeudan los creditos 0-1 pago (ver definicion $creditos_0_1_pago), total del valor a financiar – total de lo que se ha pagado por cuotas
        $total_debe_vlr_fin_creditos_promedio  = 0; // sumatoria de lo que adeudan los creditospromedio (ver definicion XXXXXXXX), total del valor a financiar – total de lo que se ha pagado por cuotas de creditos promedio
        $total_costo_cartera              = 0; // La cartera es el total de lo que deben los creditos promedio y 0₁ pago sobre el valor financiado

        $saldo_menos_cartera              = 0;  
        $total_saldo                      = 0; // total de los saldos de los creditos
        $data_creditos                    = array();  // información de creditos que se mostrará en la vista
        $limite_0_1_pago                  = 0.2;

        $num_creditos	= count($creditos);

        if($num_creditos <= 0){
          return '0 creditos';
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
          $iniciales      += $credito->precredito->cuota_inicial;
        	$vlr_fin_total	+= $credito->precredito->vlr_fin;
        	$vlr_a_recaudar += $credito->valor_credito;
          $total_saldo    += $credito->saldo;

        	$pagos_credito = $this->total_pagos_credito($credito);

      		$vlr_recaudado_en_cuotas 			+= $pagos_credito['total_pagos_credito'];
      		$vlr_recaudado_prejuridico    += $pagos_credito['total_pagos_prejuridico_credito'];
      		$vlr_recaudado_juridico       += $pagos_credito['total_pagos_juridico_credito'];
      		$vlr_recaudado_en_sanciones   += $pagos_credito['total_pagos_sanciones_credito'];      	  

        //FALTA TIPIFICAR
    		//CREDITOS IDEALES

          //TIPOS DE CREDITO

      		if($pagos_credito['total_pagos_credito'] >= $credito->precredito->vlr_fin){	
            $creditos_ideales ++;	} //IDEALES

      		elseif($pagos_credito['total_pagos_credito'] <= ($credito->precredito->vlr_fin * $limite_0_1_pago)){ //0-1-PAGO
      			$creditos_0_1_pago ++;
      			$total_debe_vlr_fin_creditos_0_1_pago += $credito->precredito->vlr_fin - $pagos_credito['total_pagos_credito'];	}        	

      		elseif($pagos_credito['total_pagos_credito'] > ($credito->precredito->vlr_fin * $limite_0_1_pago)  //PROMEDIO
      	       && ($pagos_credito['total_pagos_credito'] < $credito->precredito->vlr_fin)){
      			$creditos_promedio ++;
      			$total_debe_vlr_fin_creditos_promedio += $credito->precredito->vlr_fin - $pagos_credito['total_pagos_credito'];	}

       
      		$total_listados['vlr_a_recaudar']				     +=  $credito->valor_credito;
      		$total_listados['vlr_financiado']				     +=  $credito->precredito->vlr_fin;
      		$total_listados['vlr_recaudado_en_cuotas']	 +=  $pagos_credito['total_pagos_credito'];
      		$total_listados['vlr_recaudado_prejuridico'] +=  $pagos_credito['total_pagos_prejuridico_credito'];
      		$total_listados['vlr_recaudado_juridico']		 +=  $pagos_credito['total_pagos_juridico_credito'];
      		$total_listados['vlr_recaudado_en_sanciones']+=  $pagos_credito['total_pagos_sanciones_credito'];

        /* 	array_push($data_creditos,$temp);*/

        }//.foreach

    	  $pago_menos_costo = $vlr_recaudado_en_cuotas - $vlr_fin_total;

    	  $porcien_0_1_pago             = ($creditos_0_1_pago * 100 / $num_creditos);
        $porcien_ideales              = ($creditos_ideales  * 100 / $num_creditos);
        $porcien_promedio    			    = ($creditos_promedio * 100 / $num_creditos);

        $ingreso_esperado				      = $vlr_a_recaudar - $vlr_fin_total;
        $total_ingresos_adicionales   = $vlr_recaudado_en_sanciones + $vlr_recaudado_prejuridico + $vlr_recaudado_juridico;

        $total_costo_cartera          = $total_debe_vlr_fin_creditos_0_1_pago + $total_debe_vlr_fin_creditos_promedio;

        $saldo_menos_cartera          = $total_saldo - $total_costo_cartera;
        $total_pendiente_para_cubrir_vlr_a_recaudar = $vlr_a_recaudar - $vlr_recaudado_en_cuotas;
        
        $data = [
        	'num_creditos'				                   => $num_creditos,
          'vlr_fin_total' 			                   => $vlr_fin_total,
          'iniciales'                              => $iniciales,
        	'vlr_a_recaudar'			                   => $vlr_a_recaudar + $iniciales,
        	'ingreso_esperado'			                 => $ingreso_esperado,
        	'vlr_recaudado_en_cuotas' 	             => $vlr_recaudado_en_cuotas,
        	'vlr_recaudado_en_sanciones'             => $vlr_recaudado_en_sanciones,
        	'vlr_recaudado_prejuridico'              => $vlr_recaudado_prejuridico,
        	'vlr_recaudado_juridico'                 => $vlr_recaudado_juridico,
        	'creditos_ideales'   	                   => $creditos_ideales,
        	'creditos_0_1_pago'			                 => $creditos_0_1_pago,
        	'creditos_promedio'			                 => $creditos_promedio,
        	'pago_ideal'      			                 => $pago_menos_costo,
        	'porcien_0_1_pago'			                 => round($porcien_0_1_pago,2),
        	'porcien_promedio'			                 => round($porcien_promedio,2),
        	'porcien_ideales'    		                 => round($porcien_ideales,2),
        	'total_ingresos_adicionales'             => $total_ingresos_adicionales,
        	'total_debe_vlr_fin_creditos_ideales'    => 0,
        	'total_debe_vlr_fin_creditos_0_1_pago'   => $total_debe_vlr_fin_creditos_0_1_pago,
        	'total_debe_vlr_fin_creditos_promedio'   => $total_debe_vlr_fin_creditos_promedio,
        	'total_costo_cartera'		                 => $total_costo_cartera,
        	'total_listados'                         => $total_listados,
        	//'creditos'					                     => $data_creditos,
          'saldo_menos_cartera'                    => $saldo_menos_cartera,
          'total_pendiente_para_cubrir_vlr_a_recaudar' => $total_pendiente_para_cubrir_vlr_a_recaudar
        ];

        return $data;
   }


  /*
  |--------------------------------------------------------------------------
  | total_pagos_credito
  |--------------------------------------------------------------------------
  | adiciona los pagos de un credito refinanciado a su credito origen (credito padre)
  | los creditos refinanciados.
  | recibe un credito
  | retorna los pagos discriminados por criterio
  |
  */ 

  function total_pagos_credito($credito)
  {
  	$pagos = $this->calculadora_pagos_credito($credito);

  	if($credito->refinanciacion == 'Si')
  	{
  		$pagos_refinanciacion = $this->calculadora_pagos_credito($credito->refinanciado);

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

  	}

    function quarts($year)
    {

        $date = new Carbon($year.'-01-01');
        $enero = $date->toDateString();
        $abril = $date->addQuarter()->toDateString();
        $julio = $date->addQuarter()->toDateString();
        $octubre = $date->addQuarter()->toDateString(); 
        $enero_other = $date->addQuarter()->toDateString(); 

        $enero_ini = new Carbon($enero);
        $enero_fin = new Carbon($abril);
        $enero_fin->subDay()->endOfDay();

        $marzo_ini = new Carbon($abril);
        $marzo_fin = new Carbon($julio);
        $marzo_fin->subDay()->endOfDay();
  
        $julio_ini = new Carbon($julio);
        $julio_fin = new Carbon($octubre);
        $julio_fin->subDay()->endOfDay();

        $octubre_ini = new Carbon($octubre);
        $octubre_fin = new Carbon($enero_other);
        $octubre_fin->subDay()->endOfDay();

        $cuartos = [
          ['ini' => $enero_ini , 'fin' => $enero_fin],
          ['ini' => $marzo_ini , 'fin' => $marzo_fin],
          ['ini' => $julio_ini , 'fin' => $julio_fin],
          ['ini' => $octubre_ini , 'fin' => $octubre_fin]
        ];

        return $cuartos;
    }

    public function egresos($ini,$fin)
    {
      return $this->egresos_repo->get_sum_egresos($ini, $fin) ;
    }

}
