<?php




// LISTAR PUNTOS

Route::get('admin/puntos_listall/{page?}',[
    'middleware' => ['permission:ver_puntos'],
    'uses' => 'PuntoController@listall', 
    'as' => 'admin.puntos.listall']);

Route::get('admin/puntos', [
    'middleware' => ['permission:ver_puntos'],
    'uses' => 'PuntoController@index',
    'as'  => 'admin.puntos.index'
    ]);

// VISTA CREAR PUNTOS

Route::get('admin/puntos/create', [
    'middleware' => ['permission:crear_puntos'],
    'uses' => 'PuntoController@create',
    'as' => 'admin.puntos.create'
]);

// CREAR PUNTOS

Route::post('admin/puntos', [
    'middleware' => ['permission:crear_puntos'],
    'uses' => 'PuntoController@store',
    'as'   => 'admin.puntos.store'    
]);

// VISTA EDITAR PUNTOS

Route::get('admin/puntos/{punto_id}/edit',[
    'middleware' => ['permission:editar_puntos'],
    'uses' => 'PuntoController@edit',
    'as' => 'admin.puntos.edit'
]);

// ACTUALIZAR PUNTOS

Route::put('admin/puntos/{punto_id}',[
    'middleware' => ['permission:editar_puntos'],
    'uses' => 'PuntoController@update',
    'as' => 'admin.puntos.update'
]);

// BORRAR PUNTOS

Route::get('admin/puntos/{punto_id}/destroy',[
    'middleware' => ['permission:eliminar_puntos'],
    'uses' => 'PuntoController@destroy',
    'as' => 'admin.puntos.destroy'
    ]);