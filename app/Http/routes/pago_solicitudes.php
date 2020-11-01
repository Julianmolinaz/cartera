<?php

//FACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECRED

//PRECREDITO CRATE//
Route::get('start/fact_precreditos/create/{precredito_id}',[
	'middleware' => ['permission:valores_iniciales'],
	'uses' => 'FactPrecreditoController@create', 
	'as' => 'start.fact_precreditos.create'
]);

//PRECREDITO PRINT//
Route::get('start/precredito-invoice-print/{factura_id}',[
	'uses' => 'FactPrecreditoController@invoice_to_print',
	'as' => 'start.precredito_factura.print']);

//PRECREDITO FACTURA//
Route::post('start/fact_precreditos','FactPrecreditoController@store');

/*
|--------------------------------------------------------------------------
| PrecredPagos
|--------------------------------------------------------------------------
*/

Route::get('start/precred_pagos/{fact_precredito_id}',[
	'uses'   => 'PrecredPagosController@show',
	'as' => 'start.precred_pagos.show'
]);

Route::post('start/anular_precred_pagos',[
	'uses'   => 'PrecredPagosController@anular',
	'as' => 'start.precred_pagos.anular'
]);


