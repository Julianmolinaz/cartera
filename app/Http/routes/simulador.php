<?php


Route::get('start/simulador', [
	'middleware' => ['permission:simular'], 
	'uses' 	     => 'SimuladorController@index',
	'as'         => 'start.simulador.index'	
]);


Route::post('start/simulador',[
	'middleware' => ['permission:simular'], 
	'uses' 	=> 'SimuladorController@store',
	'as'	=> 'start.simulador.store'
]);