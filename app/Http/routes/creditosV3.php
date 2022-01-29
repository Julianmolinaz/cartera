
<?php

Route::post("start/v3/creditos", [
    'middleware' => [],
    'uses'  => 'V3\CreditoController@store',
    'as'    => 'start.v3.creditos.store'
]);

Route::get("start/v3/creditos/show/{creditoId}", [
    'middleware' => [],
    'uses'  => 'V3\CreditoController@show',
    'as'    => 'start.v3.creditos.show'
]);

Route::get("start/v3/creditos/destroy/{creditoId}", [
    'middleware' => [],
    'uses'  => 'V3\CreditoController@destroy',
    'as'    => 'start.v3.creditos.destroy'
]);