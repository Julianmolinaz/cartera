<?php

Route::get('start/acuerdos/{credito_id}', [
    // 'middleware' => ['permission:anular_pago_credito'],
    'uses' => 'AcuerdoController@listAcuerdos',
    'as' => 'start.acuerdos.list'
]);


Route::post('start/acuerdos', [
    // 'middleware' => ['permission:anular_pago_credito'],
    'uses' => 'AcuerdoController@store',
    'as' => 'start.acuerdos.store'
]);

Route::put('start/acuerdos/{acuerdo_id}', [
    // 'middleware' => ['permission:anular_pago_credito'],
    'uses' => 'AcuerdoController@update',
    'as' => 'start.acuerdos.update'
]);