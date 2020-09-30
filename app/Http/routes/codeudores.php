<?php

/*
|--------------------------------------------------------------------------
| Codeudores
|--------------------------------------------------------------------------
*/

// Crear

Route::get('start/codeudores/{cliente_id}/create',[
	// 'middleware' => ['permission:crear_codeudor'],
	'uses' => 'CodeudorController@create',
	'as' => 'start.codeudores.create'
]);

Route::post('start/codeudores',[
    // 'middleware' => ['permission:crear_codeudor'],
	'uses' => 'CodeudorController@store',
	'as' => 'start.codeudores.store'
]);

// Editar

Route::put('start/codeudores/updateV2/{cliente_id}',[
	// 'middleware' => ['permission:editar_codeudor'],
	'uses' => 'CodeudorController@updateV2',
	'as' => 'start.codeudores.updateV2'
]);

Route::get('start/codeudores/{cliente_id}/edit',[
	// 'middleware' => ['permission:editar_codeudor'],
	'uses' => 'CodeudorController@edit',
	'as' => 'start.codeudores.edit'
]);

// Editar

Route::put('start/codeudores/{cliente_id}/update',[
	//'middleware' => ['permission:editar_codeudor'],
	'uses' => 'CodeudorController@update',
	'as' => 'start.codeudores.update'
]);

// Eliminar

Route::get('start/codeudores/destroy/{cliente_id}',[
	//'middleware' => ['permission:eliminar_codeudor'],
	'uses' => 'CodeudorController@destroy',
	'as' => 'start.codeudores.destroy'
]);
