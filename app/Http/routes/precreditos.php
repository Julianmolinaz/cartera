<?php

//PRECREDITOS exportar
Route::get('start/precreditos',[
    'middleware' => ['permission:exportar_solicitudes'],
    'uses'  => 'PrecreditoController@index',
    'as'    => 'start.precreditos.index'
]);

//PRECREDITOS LISTAR
Route::get('start/precreditos',[
    'middleware' => ['permission:consultar_solicitudes'],
    'uses'  => 'PrecreditoController@index',
    'as'    => 'start.precreditos.index'
]);

//PRECREDITOS CREAR
Route::get('start/precreditos/{cliente}',[
    'middleware' => ['permission:consultar_solicitudes'],
    'uses'  => 'PrecreditoController@create',
    'as'    => 'start.precreditos.create'
]);

//PRECREDITOS EDITAR
Route::get('start/precreditos/{precredito_id}/edit',[
    'middleware' => ['permission:editar_solicitudes'],
    'uses'  => 'PrecreditoController@edit',
    'as'    => 'start.precreditos.edit'
]);

//PRECREDITOS ACTUALIZAR
Route::put('start/precreditos/{precredito_id}',[
    'middleware' => ['permission:editar_solicitudes'],
    'uses'  => 'PrecreditoController@update',
    'as'    => 'start.precreditos.update'
]);

//PRECREDITOS ACTUALIZAR V2 
Route::post('start/precreditos/updateV2',[
    // 'middleware' => ['permission:crear_solicitudes'],
    'uses'  => 'PrecreditoController@updateV2',
    'as'    => 'start.precreditos.update'
]);


//PRECREDITOS GUARDAR
Route::post('start/precreditos',[
    // 'middleware' => ['permission:crear_solicitudes'],
    'uses'  => 'PrecreditoController@store',
    'as'    => 'start.precreditos.store'
]);


//PRECREDITOS VER
Route::get('start/precreditos/{id}/ver',[
    'middleware' => ['permission:consultar_solicitudes'],
    'uses'  	=> 'PrecreditoController@ver',
    'as'    => 'start.precreditos.ver'
]);


