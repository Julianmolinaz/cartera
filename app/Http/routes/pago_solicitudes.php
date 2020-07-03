<?php

//FACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECRED

Route::get('start/fact_precreditos/create/{precredito_id}',[
	'middleware' => ['permission:'],
	'uses' => 'FactPrecreditoController@create', 
	'as' => 'start.fact_precreditos.create'
]);
Route::get('start/precredito-invoice-print/{factura_id}',[
	'uses' => 'FactPrecreditoController@invoice_to_print',
	'as'   => 'start.precredito_factura.print']);

Route::post('start/fact_precreditos','FactPrecreditoController@store');
