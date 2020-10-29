<?php


Route::post('start/acuerdos', [
    // 'middleware' => ['permission:anular_pago_credito'],
    'uses' => 'AcuerdoController@store',
    'as' => 'start.acuerdos.store'
]);