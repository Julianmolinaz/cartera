
<?php

Route::post("start/v3/creditos", [
    'middleware' => ['permission:crear_creditos'],
    'uses'  => 'V3\CreditoController@store',
    'as'    => 'start.v3.creditos.store'
]);

Route::get("start/v3/creditos/show/{creditoId}", [
    'middleware' => ['permission:consultar_creditos'],
    'uses'  => 'V3\CreditoController@show',
    'as'    => 'start.v3.creditos.show'
]);

Route::get("start/v3/creditos/destroy/{creditoId}", [
    'middleware' => ['permission:eliminar_credito'],
    'uses'  => 'V3\CreditoController@destroy',
    'as'    => 'start.v3.creditos.destroy'
]);

Route::post("start/v3/creditos/update-recordatorio", [
    'middleware' => ['permission:editar_recordatorio'],
    'uses'  => 'V3\CreditoController@updateRecordatorio',
    'as'    => 'start.v3.creditos.update_recordatorio'
]);