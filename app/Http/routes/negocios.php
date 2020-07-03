<?php

// Route::resource('negocios','NegocioController');

// VER NEGOCIOS

Route::get('admin/negocios',[
    'middleware' => ['permission:ver_negocios'],
    'uses' => 'NegocioController@index',
    'as' => 'admin.negocios.index'
]);

// VISTA CREAR NEGOCIOS

Route::get('admin/negocios/create',[
    'middleware' => ['permission:ver_negocios'],
    'uses' => 'NegocioController@create',
    'as' => 'admin.negocios.create'
]);

// ACTUALIZAR NEGOCIOS

Route::post('admin/negocios/store',[
    'middleware' => ['permission:ver_negocios'],
    'uses' => 'NegocioController@store',
    'as' => 'admin.negocios.store'
]);

// VISTA EDITAR NEGOCIOS

Route::get('admin/negocios/edit/{negocio_id}',[
    'middleware' => ['permission:editar_negocios'],
    'uses' => 'NegocioController@edit',
    'as' => 'admin.negocios.edit'
]);
   
// ACTUALIZAR NEGOCIOS

Route::put('admin/negocios/{negocio_id}',[
    'middleware' => ['permission:editar_negocios'],
    'uses' => 'NegocioController@update',
    'as' => 'admin.negocios.update'
]);

// ELIMINAR NEGOCIOS

Route::get('admin/negocios/destroy/{negocio_id}',[
    'middleware' => ['permission:eliminar_negocios'],
    'uses' => 'NegocioController@destroy',
    'as' => 'admin.negocios.destroy'
]);