<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;
use DB;

	function caja($date, $user_id)
	{

		// Llamadas

		$calls      = calls($date, $user_id);

		// Cantidad de llamadas

		$num_calls  = count($calls);

		// Información del usuario (funcionario)

		$user       = User::find($user_id);

		// Solicitudes

		$precreditos = precreditos($date, $user_id);

		// Cantidad de solicitudes

		$num_precreditos = count($precreditos);


		// Valor de negocios mensual

		$valor_negocios = valor_negocios($date, $user_id);

		// Listado de abonos 

		$abonos = abonos($date, $user_id);

		return [
			'calls' 		  => $calls,
			'num_calls' 	  => $num_calls,
			'user'   		  => $user,
			'punto'  		  => $user->punto,
			'precreditos' 	  => $precreditos,
			'num_precreditos' => $num_precreditos,
			'valor_negocios'  => $valor_negocios,
			'abonos'          => $abonos

		];
	}

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
      		->where('user_create_id',$user_id)
      		->where('created_at','like',$date.'%')
    		->get();
    }

    function valor_negocios($date, $user_id)
    {
        return DB::table('creditos')
        	->join('precreditos','creditos.precredito_id','=','precreditos.id')
        	->where('precreditos.user_create_id', $user_id)
        	->where('creditos.created_at','like',$date.'%')
        	->sum('creditos.valor_credito');
    }

    function abonos($date, $user_id)
    {
    	return DB::table('facturas')
    		->where('created_at','like',$date.'%')
    		->where('user_create_id',$user_id)
    		->get();
    }