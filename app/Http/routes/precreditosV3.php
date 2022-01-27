<?php

Route::get('start/precreditosV3',[
    'middleware' => ['permission:exportar_solicitudes'],
    'uses'  => 'V3\PrecreditoController@create',
    'as'    => 'start.precreditosV3.create.index'
]);

//PRECREDITOS LISTAR
// Route::get('start/precreditosV3',[
//     'middleware' => ['permission:consultar_solicitudes'],
//     'uses'  => 'PrecreditoV3Controller@index',
//     'as'    => 'start.precreditosV3.index'
// ]);

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

//PRECREDITOS ACTUALIZAR
// Route::put('start/precreditosV3/{precredito_id}',[
//     'middleware' => ['permission:editar_solicitudes'],
//     'uses'  => 'PrecreditoV3Controller@update',
//     'as'    => 'start.precreditosV3.update'
// ]);

//PRECREDITOS ACTUALIZAR V2 
// Route::post('start/precreditosV3/updateV2',[
//     'middleware' => ['permission:crear_solicitudes'],
//     'uses'  => 'PrecreditoV3Controller@updateV2',
//     'as'    => 'start.precreditosV3.update'
// ]);


//PRECREDITOS GUARDAR
// Route::post('start/precreditosV3',[
//     'middleware' => ['permission:crear_solicitudes'],
//     'uses'  => 'PrecreditoV3Controller@store',
//     'as'    => 'start.precreditosV3.store'
// ]);


//PRECREDITOS SHOW
Route::get('start/precreditosV3/show/{precredito_id}',[
    'middleware' => ['permission:consultar_solicitudes'],
    'uses'  	=> 'V3\PrecreditoController@show',
    'as'    => 'start.precreditosV3.show'
]);