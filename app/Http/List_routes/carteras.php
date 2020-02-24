<?php

Route::get('admin/gestion_cartera/index',[
	'uses'	=> 'GestionCarteraController@index',
	'as'    => 'admin.gestion_cartera.index'
]);

Route::get('admin/gestion_cartera/getCartera/{carteraId}',
    'GestionCarteraController@getCartera');

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
    
Route::get('admin/gestion_cartera/data_flujo_de_caja',
    'FlujocajaController@getDataFlujo');
    
Route::post('admin/gestion_cartera/get_flujo_de_caja',
    'FlujocajaController@getFlujoDeCaja');
