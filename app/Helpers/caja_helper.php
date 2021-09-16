<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use App\User;
use Auth;
use DB;

	function cajasHp($date) {

		$cajas = [];

		$users = DB::table('users')
			->join('puntos','users.punto_id','=','puntos.id')
			->where('users.estado','Activo')
			->select('users.id as user_id',
			         'puntos.nombre as punto')
			->orderBy('puntos.nombre')
			->get();

		foreach ($users as $user) {
			$temp = cajaHp($date,$user->user_id);
			array_push($cajas, $temp);
		}

		return $cajas;
	}


	function cajaHp($date, $user_id)
	{
		$calls = calls($date, $user_id); // Llamadas

		$num_calls  = count($calls);  // Cantidad de llamadas

		$user = User::find($user_id); // Información del usuario (funcionario)

		$precreditos = precreditosHp($date, $user_id); // Solicitudes

		$num_precreditos = count($precreditos); // Cantidad de solicitudes

		$pagos = pagosHp($date, $user_id);  // pagos a creditos

		$total_pagos = totalPagosHp($pagos); // total pagos a creditos

		$pagos_solicitudes = pagosSolicitudesHp($date, $user_id); // pagos por solicitudes

		$total_solicitudes = totalPagosHp($pagos_solicitudes); // total pagos por solicitudes

		$estudios  = estudiosHp($pagos_solicitudes); // pagos de estudios
 
		$total_estudios = totalPagosHp($estudios); // total pagos de estudios

		$iniciales = inicialesHp($pagos_solicitudes); // pagos de cuotas iniciales

		$total_iniciales = totalPagosHp($iniciales); // total pago cuotas iniciales
		
    	$anuladas  = anuladasHp($date, $user_id); // facturas anuladas
		
		$num_anuladas = count($anuladas); 
		
		$egresos   = getEgresosHp($date, $user_id);
		
		$total_egresos = totalEgresosHp($egresos);

		$otros_pagos = otrosPagosHp($date, $user_id);
		
		$total_otros_pagos = totalOtrosPagosHp($otros_pagos);

		$total_caja = $total_pagos + $total_solicitudes + $total_otros_pagos; // total caja

		$descuentos = descuentosHp($date, $user_id);  // descuento a creditos

		$total_descuentos = totalDescuentosHp($descuentos); // total descuento a creditos

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
			'num_anuladas'      => $num_anuladas,
			'egresos'			=> $egresos,
			'total_egresos'     => $total_egresos,
			'otros_pagos'	    => $otros_pagos,
			'total_otros_pagos'	=> $total_otros_pagos,
			'descuentos'		=> $descuentos,
			'total_descuentos'	=> $total_descuentos

		];
	}

	function totalDescuentosHp($descuentos)
    {
    	$collection = collect($descuentos);

    	return $collection->reduce(function($carry, $item) {
			
    		return $carry + $item->subtotal;
    	});
    }

	function descuentosHp($date, $user_id)
    {
		return DB::table('facturas')
			->join('pagos','facturas.id','=','pagos.factura_id')
			->select('facturas.num_fact as num_fact',
		             'pagos.concepto as concepto',
		             'pagos.abono as subtotal',
								 'facturas.total as total',
								 'facturas.banco as banco',
		             'facturas.credito_id as credito')
			->where('facturas.descuento', true)
			->where('facturas.created_at','like',$date.'%')
			->where('facturas.user_create_id',$user_id)
			->get();
    }

	function otrosPagosHp($date, $user_id)
	{
		$otros_pagos = DB::table('otros_pagos')
		->join('facturas','otros_pagos.factura_id','=','facturas.id')
		->join('carteras','otros_pagos.cartera_id','=','carteras.id')
		->select('facturas.num_fact as num_fact',
				'otros_pagos.concepto as concepto',
				'otros_pagos.subtotal as subtotal',
				'carteras.nombre as cartera',
				'facturas.tipo as tipo')
		->where('otros_pagos.created_at','like',$date.'%')
		->where('facturas.user_create_id',$user_id)
		->get();

		return $otros_pagos;
	}

	function totalOtrosPagosHp($otros_pagos)
	{
		$collection = collect($otros_pagos);
		
		return $collection->reduce(function($carry, $item) {
    		return $carry + $item->subtotal;
    	});
	}

	function anuladasHp($date, $user_id)
	{
		return DB::table('anuladas')
			->join('clientes','anuladas.cliente_id','=','clientes.id')
			->join('users','anuladas.user_anula','=','users.id')
			->select('anuladas.id as id',
					 'clientes.num_doc as num_doc',
					 'anuladas.num_fact as num_fact',
					 'anuladas.fecha as fecha',
					 'anuladas.credito_id as credito_id',
					 'anuladas.precredito_id as precredito_id',
					 'users.name as anula')
			->where('anuladas.user_create_id',$user_id)
			->where('anuladas.created_at','like',$date.'%')
			->orderBy('anuladas.created_at','DESC')
    	->get();
	}

	function calls($date, $user_id)
	{
		return DB::table('llamadas')
			->where('user_create_id',$user_id)
			->where('created_at','like',$date.'%')
			->get();
	}

	function getEgresosHp($date, $user_id)
	{
		return DB::table('egresos')
			->where('user_create_id',$user_id)
			->where('created_at','like',$date.'%')
			->get();
	}

	function totalEgresosHp($egresos)
	{
		$sumatoria = 0;

		foreach($egresos as $egreso){
			$sumatoria += $egreso->valor;
		}

		return $sumatoria;
	}


    function precreditosHp($date, $user_id)
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


    function abonosHp($pagos, $date, $user_id)
    {
    	$collection = collect($pagos);

    	$filtered 	= $collection->filter(function($element, $key)
    	{
    		return ( $element->concepto == 'Cuota' ) ||  ( $element->concepto == 'Cuota Parcial' ); 
    	});

    	return $filtered;
    }

    function sancionesHp($pagos, $date, $user_id)
    {
    	$collection = collect($pagos);

    	return $collection->filter(function($element, $key)
    	{
    		return ( $element->concepto == 'Mora' ); 
    	});

    }

    function totalPagosHp($pagos)
    {
    	$collection = collect($pagos);

    	return $collection->reduce(function($carry, $item) {
			
    		return $carry + $item->subtotal;
    	});
    }

	/**
	 * **PAGOS**
	 */

    function pagosHp($date, $user_id)
    {
		return DB::table('facturas')
			->join('pagos','facturas.id','=','pagos.factura_id')
			->select('facturas.num_fact as num_fact',
		             'pagos.concepto as concepto',
		             'pagos.abono as subtotal',
								 'facturas.total as total',
								 'facturas.banco as banco',
		             'facturas.credito_id as credito')
			->where('facturas.descuento', 0)
			->where('facturas.created_at','like',$date.'%')
			->where('facturas.user_create_id',$user_id)
			->get();
    }

    function pagosSolicitudesHp($date, $user_id)
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

    function estudiosHp($pagos)
    {
    	$collection = collect($pagos);

    	return $collection->filter(function($element, $key)
    	{
    		return ( $element->concepto == 'Estudio tipico' ) ||
    		       ( $element->concepto == 'Estudio domicilio' );
    	});

    }

    function inicialesHp($pagos)
    {
    	$collection = collect($pagos);

    	return $collection->filter(function($element, $key)
    	{
    		return ( $element->concepto == 'Cuota inicial' );
    	});

	}
	
	function ventasMesHp($date, $user_id)
	{
		try {
			$month = $date->month;
			$anio  = $date->year;
			$mes = '';

			switch ($month) {
				case '1': $mes = 'Enero'; break;
				case '2': $mes = 'Febrero'; break;
				case '3': $mes = 'Marzo'; break;
				case '4': $mes = 'Abril'; break;
				case '5': $mes = 'Mayo'; break;
				case '6': $mes = 'Junio'; break;
				case '7': $mes = 'Julio'; break;
				case '8': $mes = 'Agosto'; break;
				case '9': $mes = 'Septiembre'; break;
				case '10': $mes = 'Octubre'; break;
				case '11': $mes = 'Noviembre'; break;
				case '12': $mes = 'Diciembre'; break;
			}

			$res =  \DB::table('creditos')
				->join('precreditos','creditos.precredito_id','=','precreditos.id')
				->join('users','precreditos.user_create_id','=','users.id')
				->where('creditos.anio', $anio)
				->where('creditos.mes', $mes)
				->where('users.id',$user_id)
			//	->where( function($query){
			//	      $query->whereNotIn('creditos.mes',
			//			['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre'])
			//			->where('creditos.anio','2019');
			//		})
				->sum('precreditos.vlr_fin');


			if($res) {
				return $res;
			} else {
				return 0;
			}
		} catch (\Exception $e) {
			return $e->getMessage();
		}

	}

	
	

	
