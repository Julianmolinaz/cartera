<?php

Route::get('start/pagos/inicio',[ 
    'middleware' => ['permission:hacer_pagos'],
    'uses' => 'PagoController@inicio', 
    'as'   => 'start.pagos.inicio'	
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


