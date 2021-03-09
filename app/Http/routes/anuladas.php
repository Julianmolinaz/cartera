<?php


// ANULADA FACTURAS//

Route::post('admin/anuladas',[
    'middleware' => ['permission:anular_pago_credito'],
    'uses' => 'AnuladaController@store',
    'as' => 'admin.anuladas.store'
]);

//FACTURAS ANULADAS
Route::get('start/anuladas/index',[ 
    'middleware' => ['permission:listar_pagos_anulados'],
    'uses' => 'AnuladaController@index', 
    'as'   => 'start.anuladas.index'
]);