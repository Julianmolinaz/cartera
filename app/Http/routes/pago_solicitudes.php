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
