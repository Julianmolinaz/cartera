<?php

Route::get('admin/pagos_masivos/load_masivos',[
    'middleware' => ['permission:pagos_masivos'],
    'uses' => 'PagoMasivoController@cargarMasivos', 
    'as'   => 'admin.pagos_masivos.load'	
]);

Route::get('admin/pagos_masivos/list_masivos/{load_id}',[
    'middleware' => ['permission:pagos_masivos'],
    'uses' => 'PagoMasivoController@listMasivos', 
    'as'   => 'admin.pagos_masivos.list_masivos'	
]);


Route::get('admin/pagos_masivos',[
    'middleware' => ['permission:pagos_masivos'],
    'uses' => 'PagoMasivoController@index', 
    'as'   => 'admin.pagos_masivos.index'	
]);

Route::post('admin/pagos_masivos',[
    'middleware' => ['permission:pagos_masivos'],
    'uses' => 'PagoMasivoController@store', 
    'as'   => 'admin.pagos_masivos.store'	
]);

Route::get('admin/pagos_masivos/get_plantilla',[
    'middleware' => ['permission:pagos_masivos'],
    'uses' => 'PagoMasivoController@getPlantilla', 
    'as'   => 'admin.pagos_masivos.get_plantilla'	
]);

Route::get('admin/pagos_masivos/list',[ 
	'middleware' => ['permission:pagos_masivos'],
	'uses'  => 'PagoMasivoController@list',
	'as'    => 'admin.pagos_masivos.list'
]);