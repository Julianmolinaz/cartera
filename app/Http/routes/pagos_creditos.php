<?php


//FACTURAS LISTAR
Route::get('start/facturas',[
    'middleware' => ['permission:listar_pago_credito'],
    'uses'  => 'FacturaController@index',
    'as'    => 'start.facturas.index'
]);

//FACTURAS GUARDAR
Route::post('start/facturas',[
    'middleware' => ['permission:agregar_pagos'],
    'uses'  => 'FacturaController@store',
    'as'    => 'start.facturas.store'
]);

//FACTURAS CREAR
Route::get('start/facturas/create/{id}',[
    'middleware' => ['permission:crear_pagos'],
    'uses'  => 'FacturaController@create',
    'as'    => 'start.facturas.create'
]);

//FACTURAS VER
Route::get('start/facturas/{factura}',[
    'middleware' => ['permission:ver_pagos'],
    'uses'  => 'FacturaController@show',
    'as'    => 'start.facturas.show'
]);

//FACTURAS EDITAR
Route::get('start/facturas/{factura}/edit',[
    'middleware' => ['permission:editar_pagos'],
    'uses'  => 'FacturaController@edit',
    'as'    => 'start.facturas.edit'
]);

//FACTURAS ACTUALIZAR
Route::put('start/facturas/{factura}',[
    'middleware' => ['permission:editar_pagos'],
    'uses'  => 'FacturaController@update',
    'as'    => 'start.facturas.update'
]);

Route::get('start/factura_pdf/{factura_id}',[
    'middleware' => ['permission:exportar_recibos'],
    'uses'  => 'FacturaController@get_pdf',
    'as'     => 'start.facturas.pdf'
]);

Route::get('start/facturas/{id}/consultar_factura',[
    'middleware' => ['permission:ver_recibos'],
    'FacturaController@consultar_factura'
]);

Route::post('start/facturas/fecha_pago',[
    'middleware' => ['permission:ver_recibos'],
    'FacturaController@fecha_pago'
]);
Route::post('start/facturas/abonos',[
    'middleware' => ['permission:ver_recibos'],
    'FacturaController@abonos'
]);


//PAGOS LISTAR

Route::get('start/pagos',[
    'middleware' => ['permission:listar_recibos'],
    'uses' => 'FacturaController@pagos',
    'as'   => 'start.pagos'
]);

Route::get('start/invoice-print/{factura_id}',[ 
    'middleware' => ['permission:imprimir_recibos'],
	'uses' => 'FacturaController@invoice_to_print',
    'as'   => 'start.factura.print'
]);

//PAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOS

//PAGOS LISTAR

Route::get('start/pagos',[
    'middleware' => ['permission:hacer_pagos'],
    'uses' => 'FacturaController@pagos',
    'as'   => 'start.pagos'
    ]);

Route::get('start/invoice-print/{factura_id}',[
	'uses' => 'FacturaController@invoice_to_print',
	'as'   => 'start.factura.print']);

//OTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOS

Route::get('start/pagos/index_otros_ingresos',
	['uses' => 'PagoController@index_otros_ingresos', 'as' => 'start.pagos.index_otros_ingresos'])->middleware('otros_ingresos_listar');

// Route::get('start/pagos/inicio',[ 
//     'middleware' => ['permission:hacer_pagos'],
//     'uses' => 'PagoController@inicio', 
//     'as'   => 'start.pagos.inicio'	
// ]);

Route::get('start/pagos/create',[
    'middleware' => ['permission:crear_pagos'],
    'uses' => 'PagoController@create', 
    'as'   => 'start.pagos.create'	
]);

Route::get('start/pagos/hay_creditos/{doc}',[
    'middleware' => ['permission:crear_pagos'],
    'PagoController@hay_creditos'
]);


Route::get('start/anuladas/index',[ 'uses' => 'AnuladaController@index', 'as'   => 'start.anuladas.index']);
