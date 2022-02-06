<?php

Route::get('start/precreditosV3',[
    'middleware' => ['permission:exportar_solicitudes'],
    'uses'  => 'V3\PrecreditoController@create',
    'as'    => 'start.precreditosV3.create.index'
]);

Route::get('start/precreditosV3/mis-solicitudes', [
    'middleware' => [],
    'uses' => 'V3\PrecreditoController@misSolicitudes',
    'as' => 'start.precreditosV3.mis-solicitudes'
]);

// PRECREDITOS CREAR
Route::get('start/precreditosV3/{cliente}',[
    'middleware' => ['permission:consultar_solicitudes'],
    'uses'  => 'V3\PrecreditoController@create',
    'as'    => 'start.precreditosV3.create'
]);

// PRECREDITOS EDITAR
Route::get('start/precreditosV3/edit/{precredito_id}',[
    'middleware' => ['permission:editar_solicitudes|editar_producto_solicitudes'],
    'uses'  => 'V3\PrecreditoController@edit',
    'as'    => 'start.precreditosV3.edit'
]);

//PRECREDITOS SHOW
Route::get('start/precreditosV3/show/{precredito_id}',[
    'middleware' => ['permission:consultar_solicitudes'],
    'uses'  	=> 'V3\PrecreditoController@show',
    'as'    => 'start.precreditosV3.show'
]);

// Aprobar solicitud
Route::post('start/precreditosV3/aprobar', [
    'middleware' => ['permission:aprobar_solicitudes'],
    'uses' => 'V3\PrecreditoController@aprobar',
    'as' => 'start.precreditosV3.aprobar'
]);

Route::post('start/precreditosV3/observaciones', [
    'middleware' => ['permission:editar_observaciones'],
    'uses' => 'V3\PrecreditoController@updateObservaciones',
    'as' => 'start.precreditosV3.observaciones'
]);