<?php

Route::get('start/acuerdos/{credito_id}', [
    'middleware' => ['permission:consultar_acuerdo_de_pago'],
    'uses' => 'AcuerdoController@listAcuerdos',
    'as' => 'start.acuerdos.list'
]);

Route::post('start/acuerdos', [
    'middleware' => ['permission:crear_acuerdo'],
    'uses' => 'AcuerdoController@store',
    'as' => 'start.acuerdos.store'
]);

Route::put('start/acuerdos/{acuerdo_id}', [
    'middleware' => ['permission:editar_acuerdo'],
    'uses' => 'AcuerdoController@update',
    'as' => 'start.acuerdos.update'
]);

Route::get('start/acuerdos/{acuerdo_id}/delete', [
    'middleware' => ['permission:eliminar_acuerdo'],
    'uses' => 'AcuerdoController@delete',
    'as' => 'start.acuerdos.delete'
]);