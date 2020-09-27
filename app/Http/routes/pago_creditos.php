<?php

Route::get('start/pagos/inicio',[ 
    'middleware' => ['permission:hacer_pagos'],
    'uses' => 'PagoController@inicio', 
    'as'   => 'start.pagos.inicio'	
]);

//FACTURAS LISTAR
Route::get('start/facturas',[
    'middleware' => ['permission:ver_pagos_credito'],
    'uses'  => 'FacturaController@index',
    'as'    => 'start.facturas.index'
]);

//PAGOS LISTAR

Route::get('start/pagos',[
    'middleware' => ['permission:ver_pagos_credito'],
    'uses' => 'FacturaController@pagos',
    'as'   => 'start.pagos'
]); //*

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

// ANULADA facturas

Route::post('admin/anuladas',[
    'middleware' => ['permission:anular_pago_credito'],
    'uses' => 'AnuladaController@store',
    'as' => 'admin.anuladas.store'
]);

//lista facturas anuladas

Route::get('start/anuladas/index',[ 
    'middleware' => ['permission:listar_pagos_anulados'],
    'uses' => 'AnuladaController@index', 
    'as'   => 'start.anuladas.index'
]);

Route::get('start/invoice-print/{factura_id}',[ 
    'middleware' => ['permission:imprimir_pago_credito'],
	'uses' => 'FacturaController@invoice_to_print',
    'as'   => 'start.factura.print'
]); //*


Route::get('start/invoice-print/{factura_id}',[
	'uses' => 'FacturaController@invoice_to_print',
    'as'   => 'start.factura.print']);
    

Route::get('start/pagos/index_otros_ingresos',[
    'uses' => 'PagoController@index_otros_ingresos', 
    'as' => 'start.pagos.index_otros_ingresos']);



Route::get('start/pagos/create',[
    'middleware' => ['permission:hacer_pago'],
    'uses' => 'PagoController@create', 
    'as'   => 'start.pagos.create'	
]);

Route::get('start/pagos/hay_creditos/{doc}',[
    'middleware' => ['permission:hacer_pagos'],
    'PagoController@hay_creditos'
]);


