<?php


/**
 * GESTION CARTERAS CRUD ADMINISTRATIVO 
 */

// VER INFORMES CARTERA

Route::get('admin/gestion_carteras/index',[
    'middleware' => ['permission:informe_carteras'],
	'uses'	=> 'GestionCarteraController@index',
	'as'    => 'admin.gestion_carteras.index'
]);

// Consultar cartera

Route::get('admin/gestion_cartera/getCarteras/{carteraId}',[
    'middleware' => ['permission:informe_carteras'],
    'uses' => 'GestionCarteraController@getCarteras',
]);
  
Route::get('admin/gestion_carteras/getCarteras',[
    //middleware,
    'uses' => 'CarteraController@getCarteras'
]);

Route::get('admin/gestion_cartera/get_info_carteras',[
    'middleware' => ['permission:generar_informes'],
	'uses' => 'GestionCarteraController@getInfoCarteras',
    'as'   => 'admin.info_cartera.get_info_carteras' 
]);

    
Route::get('admin/gestion_carteras/flujo_de_caja',[
    'middleware' => ['permission:flujo_cajas'],
	'uses' => 'FlujocajaController@index',
    'as'   => 'admin.info_cartera.flujo_de_caja']);	
    
    
Route::get('admin/gestion_carteras/data_flujo_de_caja',
    'FlujocajaController@getDataFlujo');
    
Route::post('admin/gestion_carteras/get_flujo_de_caja',
    'FlujocajaController@getFlujoDeCaja');


    Route::get('admin/gestion_carteras/get_info_puntos',[
        'middleware' => ['ver_informe_total_puntos'],
        'uses' => 'GestionCarteraController@getPuntos',
        'as'   => 'admin.info_cartera_puntos']);


        // VIENE DE GENERAL

// GESTION DE CARTERA

Route::get('admin/gestion_cartera/index',[
	'uses'	=> 'GestionCarteraController@index',
	'as'    => 'admin.gestion_cartera.index'
]);

Route::get('admin/gestion_cartera/getCartera/{carteraId}','GestionCarteraController@getCartera');
Route::get('admin/gestion_cartera/get_info_puntos',[
	'uses' => 'GestionCarteraController@getPuntos',
    'as'   => 'admin.info_cartera_puntos']);
Route::get('admin/gestion_cartera/getCarteras','CarteraController@getCarteras');
Route::get('admin/gestion_cartera/get_info_carteras',[
	'uses' => 'GestionCarteraController@getInfoCarteras',
	'as'   => 'admin.info_carteras' ]);
Route::get('admin/gestion_cartera/flujo_de_caja',[
	'uses' => 'FlujocajaController@index',
	'as'   => 'admin.info_cartera.flujo_de_caja']);	
Route::get('admin/gestion_cartera/data_flujo_de_caja','FlujocajaController@getDataFlujo');
Route::post('admin/gestion_cartera/get_flujo_de_caja','FlujocajaController@getFlujoDeCaja');

Route::get('admin/reportes',['uses' => 'ReporteController@index', 'as' => 'admin.reportes.index']);

Route::post('admin/reportes',['uses' => 'ReporteController@store', 'as' => 'admin.reportes.store']);

Route::resource('admin/reportes','ReporteController');

