<?php


//FACTURAS LISTAR
Route::get('start/facturas',[
    'middleware' => ['permission:ver_pagos_credito'],
    'uses'  => 'FacturaController@index',
    'as'    => 'start.facturas.index'
]);

//FACTURAS GUARDAR
Route::post('start/facturas',[
    'middleware' => ['permission:hacer_pago'],
    'uses'  => 'FacturaController@store',
    'as'    => 'start.facturas.store'
]);

//FACTURAS CREAR
Route::get('start/facturas/create/{id}',[
    'middleware' => ['permission:hacer_pago'],
    'uses'  => 'FacturaController@create',
    'as'    => 'start.facturas.create'
]);

//FACTURAS VER
Route::get('start/facturas/{factura}',[
    'middleware' => ['permission:ver_pagos_credito'],
    'uses'  => 'FacturaController@show',
    'as'    => 'start.facturas.show'
]);

//FACTURAS ACTUALIZAR
Route::put('start/facturas/{factura}',[
    'middleware' => ['permission:anular_pago_credito'],
    'uses'  => 'FacturaController@update',
    'as'    => 'start.facturas.update'
]);

Route::post('start/facturas/abonos',[
    'middleware' => ['permission:ver_pagos_credito'],
    'uses' =>'FacturaController@abonos'
]);


Route::get('start/invoice-print/{factura_id}',[ 
    'middleware' => ['permission:imprimir_pago_credito'],
	'uses' => 'FacturaController@invoice_to_print',
    'as'   => 'start.factura.print'
]);

// Imprimir factura

Route::get('start/invoice-print/{factura_id}',[
	'uses' => 'FacturaController@invoice_to_print',
    'as'   => 'start.factura.print']);


Route::get('start/facturas/{id}/consultar_factura',[
    'middleware' => ['permission:hacer_pago'],
    'uses' => 'FacturaController@consultar_factura'
]);


//PAGOS LISTAR

Route::get('start/pagos',[
    'middleware' => ['permission:ver_pagos_credito'],
    'uses' => 'FacturaController@pagos',
    'as'   => 'start.pagos'
]); //*




Route::get('start/factura_pdf/{factura_id}',
	['uses' => 'FacturaController@get_pdf','as' => 'start.facturas.pdf']);

Route::post('start/facturas/fecha_pago','FacturaController@fecha_pago');
    

