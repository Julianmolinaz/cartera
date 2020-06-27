<?php

//ESTUDIOS

Route::get('start/estudios/cliente/{id_cliente}/codeudor/{id_codeudor}/create/{obj}',[
	'middleware' => ['permission:crear_estudios'],
	'uses'	=> 'EstudioController@create',
	'as'	=> 'start.estudios.create'
]);


Route::post('estudios-ref',[
	'middleware' => ['permission:crear_referencias'],
	'uses'	=> 'EstudioController@store_ref',
	'as'	=> 'start.estudios.create.ref'
]);

Route::put('estudios-ref',[
	'middleware' => ['permission:crear_referencias'],
	'uses'	=> 'EstudioController@update_ref',
	'as'	=> 'start.estudios.create.ref'
]);

Route::resource('estudios','EstudioController');

Route::post('start/estudios',[
	'middleware' => ['permission:listar_clientes'],
    'uses' => 'EstudioController@store',
    'as'=> 'start.estudios.store'	
]);


Route::put('start/estudios/{estudio}',[
	'middleware' => ['permission:crear_estudios'],
    'uses' => 'EstudioController@update',
    'as'=> 'start.estudios.update'
]);
