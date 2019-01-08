<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Precredito;
use App\Punto;
use Auth;

class FactPrecreditoCotroller extends Controller
{
    public function create($precredito_id)
    {
    	$precredito = Precredito::find($precredito_id);
    	$tipo_pago  = getEnumValues('fact_precreditos','tipo');
    	$punto      = Punto::find(Auth::user()->punto_id);

    	return view('start.facturas.fact_precredito.create')
    		->with('precredito',$precredito)
    		->with('tipo_pago',$tipo_pago)
    		->with('punto',$punto);
    }
}

