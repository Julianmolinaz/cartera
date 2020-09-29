<?php

//PAGOS
Route::get('start/pagos/inicio',[ 
    'middleware' => ['permission:hacer_pagos'],
    'uses' => 'PagoController@inicio', 
    'as'   => 'start.pagos.inicio'	
]);

//PAGOS LISTAR//
Route::get('start/pagos',[
    'middleware' => ['permission:ver_pagos_credito'],
    'uses' => 'FacturaController@pagos',
    'as'   => 'start.pagos'
]); //*

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
    'uses' => 'PagoController@hay_creditos'
]);


