<?php

Route::post("start/vehiculos", [
    'middleware' => ['permission:editar_vehiculo'],
    'uses'  => 'VehiculoController@update',
    'as'    => 'start.vehiculo.update'
]);