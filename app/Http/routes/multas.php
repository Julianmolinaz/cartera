<?php


/**
 * MULTAS CRUD ADMINISTRATIVO 
 */


// VER MULTAS ADMIN

Route::get('admin/multas',[
    'middleware' => ['permission:consultar_multas'],
    'uses' => 'MultaController@index',
    'as'  => 'admin.multas.index'
    ]);

// VER MULTAS

Route::get('admin/multas/show',[
    'middleware' => ['permission:consultar_multas'],
    'uses' => 'MultaController@index',
    'as'  => 'admin.multas.show'
    ]);

// VER PREJURIDICOS

Route::get('admin/multas/show',[
    'middleware' => ['permission:consultar_multas'],
    'uses' => 'MultaController@index',
    'as'  => 'admin.multas.show'
    ]);

// VISTA CREAR CARTERA

Route::get('admin/multas/create', [
    'middleware' => ['permission:crear_PreJuridicos'],
    'uses' => 'MultaController@create',
    'as' => 'admin.multas.create'
]);

// CREAR CARTERA

Route::post('admin/multas', [
    'middleware' => ['permission:crear_PreJuridicos'],
    'uses' => 'MultaController@store',
    'as'   => 'admin.multas.store'    
]);

// VISTA EDITAR CARTERA

Route::get('admin/multas/edit/{cartera_id}',[
    'middleware' => ['permission:editar_PreJuridicos'],
    'uses' => 'MultaController@edit',
    'as' => 'admin.multas.edit'
]);

// ACTUALIZAR CARTERA

Route::put('admin/multas/{cartera_id}',[
    'middleware' => ['permission:editar_PreJuridicos'],
    'uses' => 'MultaController@update',
    'as' => 'admin.multas.update'
]);

// BORRAR CARTERA

Route::get('admin/multas/destroy/{cartera_id}',[
    'middleware' => ['permission:eliminar_multas'],
    'uses' => 'MultaController@destroy',
    'as' => 'admin.multas.destroy'
    ]);
// MULTAS CONCEPTO
Route::post('admin/multas/concepto',[
    'uses' =>'MultaController@concepto']);

    // Route::post('admin/multas/concepto','MultaController@concepto')->middleware(['auth', 'admin']);