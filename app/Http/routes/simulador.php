<?php

Route::get('start/simulador',[
	'uses' 	=> 'SimuladorController@index',
	'as'	=> 'start.simulador.index'
])->middleware('simulador');

Route::post('start/simulador',[
	'uses' 	=> 'SimuladorController@store',
	'as'	=> 'start.simulador.store'
])->middleware('simulador');