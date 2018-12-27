<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Precredito;


class FactPrecreditoCotroller extends Controller
{
    public function create($precredito_id)
    {
    	$precredito = Precredito::find($precredito_id);
    	return view('start.facturas.fact_precredito.create')
    		->with('precredito',$precredito);
    }
}

