<?php

//PRECREDITOS LISTAR
Route::get('start/precreditos',[
    'uses'  => 'PrecreditoController@index',
    'as'    => 'start.precreditos.index'
])->middleware('precreditos_listar');

//PRECREDITOS CREAR
Route::get('start/precreditos/{cliente}',[
    'uses'  => 'PrecreditoController@show',
    'as'    => 'start.precreditos.show'
]);

//PRECREDITOS EDITAR
Route::get('start/precreditos/{precredito_id}/edit',[
    'uses'  => 'PrecreditoController@edit',
    'as'    => 'start.precreditos.edit'
]);

//PRECREDITOS ACTUALIZAR
Route::put('start/precreditos/{precredito_id}',[
    'uses'  => 'PrecreditoController@update',
    'as'    => 'start.precreditos.update'
]);

//PRECREDITOS GUARDAR
Route::post('start/precreditos',[
    'uses'  => 'PrecreditoController@store',
    'as'    => 'start.precreditos.store'
]);

//PRECREDITOS VER
Route::get('start/precreditos/{id}/ver',[
    'uses'  	=> 'PrecreditoController@ver',
    'as'    => 'start.precreditos.ver'
]);
