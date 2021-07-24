<?php


/**
 * CARTERAS CRUD ADMINISTRATIVO 
 */

// LISTAR CARTERAS

Route::get('admin/carteras', [
    'middleware' => ['permission:consultar_carteras'],
    'uses' => 'CarteraController@index',
    'as'  => 'admin.carteras.index'
    ]);

// VISTA CREAR CARTERA

Route::get('admin/carteras/create', [
    'middleware' => ['permission:crear_carteras'],
    'uses' => 'CarteraController@create',
    'as' => 'admin.carteras.create'
]);

// CREAR CARTERA

Route::post('admin/carteras', [
    'middleware' => ['permission:crear_carteras'],
    'uses' => 'CarteraController@store',
    'as'   => 'admin.carteras.store'    
]);

// VISTA EDITAR CARTERA

Route::get('admin/carteras/edit/{cartera_id}',[
    'middleware' => ['permission:editar_carteras'],
    'uses' => 'CarteraController@edit',
    'as' => 'admin.carteras.edit'
]);

// ACTUALIZAR CARTERA

Route::put('admin/carteras/{cartera_id}',[
    'middleware' => ['permission:editar_carteras'],
    'uses' => 'CarteraController@update',
    'as' => 'admin.carteras.update'
]);

// BORRAR CARTERA

Route::get('admin/carteras/destroy/{cartera_id}',[
    'middleware' => ['permission:eliminar_carteras'],
    'uses' => 'CarteraController@destroy',
    'as' => 'admin.carteras.destroy'
    ]);

  