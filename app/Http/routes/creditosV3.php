<?php

Route::post("start/v3/creditos", [
    'middleware' => [],
    'uses'  => 'V3\CreditoController@store',
    'as'    => 'start.v3.creditos.store'
]);