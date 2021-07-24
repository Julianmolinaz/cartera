<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use App\Cliente;
use Auth;
use DB;



function middleware($roles)
{
	$aceptado = false;

	foreach($roles as $rol)
	{
		if( $rol == Auth::user()->rol )
		{
			$aceptado = true;
		}
	}

	return $aceptado;

}//.middleware
