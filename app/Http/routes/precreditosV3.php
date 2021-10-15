<?php

Route::get('start/precreditosV3',[
    'middleware' => ['permission:exportar_solicitudes'],
    'uses'  => 'PrecreditoController@create',
    'as'    => 'start.precreditosV3.create.index'
]);