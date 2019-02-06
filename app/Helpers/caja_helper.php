<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use App\User;
use Auth;
use DB;

	function cajas($date) {

		$cajas = [];

		$users = DB::table('users')
			->join('puntos','users.punto_id','=','puntos.id')
			->where('users.estado','Activo')
			->select('users.id as user_id',
			         'puntos.nombre as punto')
			->orderBy('puntos.nombre')
			->get();

		foreach ($users as $user) {
			$temp = caja($date,$user->user_id);
			array_push($cajas, $temp);
		}

		return $cajas;
	}


	function caja($date, $user_id)
	{
		$calls = calls($date, $user_id); // Llamadas

		$num_calls  = count($calls);  // Cantidad de llamadas

		$user = User::find($user_id); // Información del usuario (funcionario)

		$precreditos = precreditos($date, $user_id); // Solicitudes

		$num_precreditos = count($precreditos); // Cantidad de solicitudes

		$pagos = pagos($date, $user_id);  // pagos a creditos

		$total_pagos = total_pagos($pagos); // total pagos a creditos

		$pagos_solicitudes = pagos_solicitudes($date, $user_id); // pagos por solicitudes

		$total_solicitudes = total_pagos($pagos_solicitudes); // total pagos por solicitudes

		$estudios  = estudios($pagos_solicitudes); // pagos de estudios
 
		$total_estudios = total_pagos($estudios); // total pagos de estudios

		$iniciales = iniciales($pagos_solicitudes); // pagos de cuotas iniciales

		$total_iniciales = total_pagos($iniciales); // total pago cuotas iniciales

		$total_caja = $total_pagos + $total_solicitudes; // total caja

		$anuladas  = anuladas($date, $user_id); // facturas anuladas

		// $num_anuladas = count($anuladas);

		return [
			'calls' 		  	=> $calls,
			'num_calls' 	  	=> $num_calls,
			'user'   		  	=> $user,
			'punto'  		  	=> $user->punto,
			'precreditos' 	  	=> $precreditos,
			'num_precreditos' 	=> $num_precreditos,
			'abonos'          	=> $pagos,
			'total_abonos'    	=> $total_pagos,
			'pagos_solicitudes' => $pagos_solicitudes,
			'total_estudios'  	=> $total_estudios,
			'total_iniciales' 	=> $total_iniciales,
			'total_caja'      	=> $total_caja,
			'date'              => $date,
			'anuladas'          => $anuladas,
			// 'num_anuladas'      => $num_anuladas
		];
	}

	// function anuladas($date, $user_id)
	// {
	// 	return DB::table('anuladas')
	// 		->join('clientes','anuladas.cliente_id','=','clientes.id')
	// 		->select('anuladas.id as id',
	// 		         'anuladas.cliente.num_doc')
	// 		->where('anuladas.user_create_id',$user_id)
	// 		->where('anuladas.created_at','like',$date.'%')
	// 		->orderBy('anuladas.created_at','DESC')
    // 		->get();
	// }

	function calls($date, $user_id)
	{
    	return DB::table('llamadas')
    		->where('user_create_id',$user_id)
    		->where('created_at','like',$date.'%')
    		->get();
	}


    function precreditos($date, $user_id)
    {
      	return DB::table('precreditos')
      		->join('clientes','precreditos.cliente_id','=','clientes.id')
      		->select('precreditos.id as id', 
      			     'precreditos.vlr_fin as vlr_fin',
      			     'clientes.nombre as cliente',
      			     'clientes.num_doc as documento')
      		->where('precreditos.user_create_id',$user_id)
      		->where('precreditos.created_at','like',$date.'%')
    		->get();
    }


    function abonos($pagos, $date, $user_id)
    {
    	$collection = collect($pagos);

    	$filtered 	= $collection->filter(function($element, $key)
    	{
    		return ( $element->concepto == 'Cuota' ) ||  ( $element->concepto == 'Cuota Parcial' ); 
    	});

    	return $filtered;
    }

    function sanciones($pagos, $date, $user_id)
    {
    	$collection = collect($pagos);

    	return $collection->filter(function($element, $key)
    	{
    		return ( $element->concepto == 'Mora' ); 
    	});

    }

    function total_pagos($pagos)
    {
    	$collection = collect($pagos);

    	return $collection->reduce(function($carry, $item) {
    		return $carry + $item->subtotal;
    	});
    }


    function pagos($date, $user_id)
    {
		return DB::table('facturas')
			->join('pagos','facturas.id','=','pagos.factura_id')
			->select('facturas.num_fact as num_fact',
		             'pagos.concepto as concepto',
		             'pagos.abono as subtotal',
		             'facturas.total as total',
		             'facturas.credito_id as credito')
			->where('facturas.created_at','like',$date.'%')
			->where('facturas.user_create_id',$user_id)
			->get();
    }

    function pagos_solicitudes($date, $user_id)
    {
		return DB::table('fact_precreditos')
			->join('precred_pagos','fact_precreditos.id','=','precred_pagos.fact_precredito_id')
			->join('fact_precred_conceptos','precred_pagos.concepto_id','=','fact_precred_conceptos.id')
			->select('fact_precreditos.num_fact as num_fact',
		             'fact_precred_conceptos.nombre as concepto',
		             'precred_pagos.subtotal as subtotal',
		             'fact_precreditos.total as total',
		             'fact_precreditos.precredito_id')
			->where('fact_precreditos.created_at','like',$date.'%')
			->where('fact_precreditos.user_create_id',$user_id)
			->get();
    }

    function estudios($pagos)
    {
    	$collection = collect($pagos);

    	return $collection->filter(function($element, $key)
    	{
    		return ( $element->concepto == 'Estudio tipico' ) ||
    		       ( $element->concepto == 'Estudio domicilio' );
    	});

    }

    function iniciales($pagos)
    {
    	$collection = collect($pagos);

    	return $collection->filter(function($element, $key)
    	{
    		return ( $element->concepto == 'Cuota inicial' );
    	});

    }
	

	
