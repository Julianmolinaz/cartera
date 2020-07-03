<?php

/*
|--------------------------------------------------------------------------
| Codeudores
|--------------------------------------------------------------------------
*/

Route::get('start/codeudores/{cliente_id}/create',[
	'middleware' => ['permission:crear_codeudor'],
	'uses' => 'CodeudorController@create',
	'as' => 'start.codeudores.create'
]);

Route::get('start/codeudores/{cliente_id}/edit',[
	'middleware' => ['permission:editar_codeudor'],
	'uses' => 'CodeudorController@edit',
	'as' => 'start.codeudores.edit'
]);

Route::put('start/codeudores/{cliente_id}/update',[
	'middleware' => ['permission:editar_codeudor'],
	'uses' => 'CodeudorController@update',
	'as' => 'start.codeudores.update'
]);

Route::get('start/codeudores/destroy/{cliente_id}',[
	'middleware' => ['permission:eliminar_codeudor'],
	'uses' => 'CodeudorController@destroy',
	'as' => 'start.codeudores.destroy'
]);