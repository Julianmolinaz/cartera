<?php

//ESTUDIOS

Route::get('start/estudios/cliente/{id_cliente}/codeudor/{id_codeudor}/create/{obj}',[
	'uses'	=> 'EstudioController@create',
	'as'	=> 'start.estudios.create'
])->middleware('estudios_crear');


Route::post('estudios-ref',[
	'uses'	=> 'EstudioController@store_ref',
	'as'	=> 'start.estudios.create.ref'
])->middleware('estudios_crear');

Route::put('estudios-ref',[
	'uses'	=> 'EstudioController@update_ref',
	'as'	=> 'start.estudios.create.ref'
	])->middleware('estudios_crear');

Route::resource('estudios','EstudioController');

Route::post('start/estudios',[
    'uses' => 'EstudioController@store',
    'as'=> 'start.estudios.store'	
])->middleware('estudios_guardar');


Route::put('start/estudios/{estudio}',[
    'uses' => 'EstudioController@update',
    'as'=> 'start.estudios.update'
])->middleware('estudios_actualizar');
