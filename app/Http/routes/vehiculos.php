<?php

Route::post("start/vehiculos", [
    'middleware' => [],
    'uses'  => 'VehiculoController@update',
    'as'    => 'start.vehiculo.update'
]);