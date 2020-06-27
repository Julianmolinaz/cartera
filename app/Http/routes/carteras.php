<?php


/**
 * CARTERAS CRUD ADMINISTRATIVO 
 */

// LISTAR CARTERAS

Route::get('admin/carteras', [
    'middleware' => ['permission:listar_carteras'],
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

/** 
 * GESTIONAR CARTERAS
 */

// Listar carteras

Route::get('admin/gestion_cartera/index',[
    'middleware' => ['permission:listar_carteras'],
	'uses'	=> 'GestionCarteraController@index',
	'as'    => 'admin.gestion_cartera.index'
]);

// Consultar cartera

Route::get('admin/gestion_cartera/getCartera/{carteraId}',[
    //middleware
    'uses' => 'GestionCarteraController@getCartera'
]);
  
Route::get('admin/gestion_cartera/getCarteras',[
    //middleware,
    'uses' => 'CarteraController@getCarteras'
]);

Route::get('admin/gestion_cartera/get_info_carteras',[
	'uses' => 'GestionCarteraController@getInfoCarteras',
    'as'   => 'admin.info_carteras' ]);

    
Route::get('admin/gestion_cartera/flujo_de_caja',[
	'uses' => 'FlujocajaController@index',
    'as'   => 'admin.info_cartera.flujo_de_caja']);	
    
    
Route::get('admin/gestion_cartera/data_flujo_de_caja',
    'FlujocajaController@getDataFlujo');
    
Route::post('admin/gestion_cartera/get_flujo_de_caja',
    'FlujocajaController@getFlujoDeCaja');


    Route::get('admin/gestion_cartera/get_info_puntos',[
        'uses' => 'GestionCarteraController@getPuntos',
        'as'   => 'admin.info_cartera_puntos']);