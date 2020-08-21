<?php


//FACTURAS LISTAR
Route::get('start/facturas',[
    'uses'  => 'FacturaController@index',
    'as'    => 'start.facturas.index'
])->middleware('facturas_listar');

//FACTURAS GUARDAR
Route::post('start/facturas',[
    'uses'  => 'FacturaController@store',
    'as'    => 'start.facturas.store'
])->middleware('facturas_guardar');

//FACTURAS CREAR
Route::get('start/facturas/create/{id}',[
    'uses'  => 'FacturaController@create',
    'as'    => 'start.facturas.create'
])->middleware('facturas_crear');

//FACTURAS VER
Route::get('start/facturas/{factura}',[
    'uses'  => 'FacturaController@show',
    'as'    => 'start.facturas.show'
])->middleware('facturas_ver');

//FACTURAS EDITAR
Route::get('start/facturas/{factura}/edit',[
    'uses'  => 'FacturaController@edit',
    'as'    => 'start.facturas.edit'
]);

//FACTURAS ACTUALIZAR
Route::put('start/facturas/{factura}',[
    'uses'  => 'FacturaController@update',
    'as'    => 'start.facturas.update'
]);

Route::get('start/factura_pdf/{factura_id}',[
    'uses'  => 'FacturaController@get_pdf',
    'as'     => 'start.facturas.pdf'
]);

Route::get('start/facturas/{id}/consultar_factura','FacturaController@consultar_factura');
Route::post('start/facturas/fecha_pago','FacturaController@fecha_pago');
Route::post('start/facturas/abonos','FacturaController@abonos');


//PAGOS LISTAR

Route::get('start/pagos',[
    'uses' => 'FacturaController@pagos',
    'as'   => 'start.pagos'
])->middleware('pagos_listar');

Route::get('start/invoice-print/{factura_id}',[
	'uses' => 'FacturaController@invoice_to_print',
	'as'   => 'start.factura.print'])
->middleware('facturas_listar');