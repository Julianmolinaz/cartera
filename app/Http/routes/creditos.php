<?php


/*
|--------------------------------------------------------------------------
| Creditos
|--------------------------------------------------------------------------
*/

Route::get('start/creditos',[
	'middleware' => ['permission:listar_creditos'],
    'uses'  => 'CreditoController@index',
    'as'    => 'start.creditos.index'
]);


// Route::get('start/creditos/create',
// 	['uses' 	=> 'CreditoController@create','as'=> 'start.creditos.create']);

Route::put('start/creditos/{credito}',[
	// Route::get('startUpdate',[
	'middleware' => ['permission:editar_creditos'],	
    'uses'  => 'CreditoController@update',
    'as'    => 'start.creditos.update'
]);

Route::get('start/creditos/{credito}/edit',[
	'middleware' => ['permission:editar_creditos'],
    'uses'  => 'CreditoController@edit',
    'as'    => 'start.creditos.edit'
]);

Route::get('start/creditos/create/{id}/{mes}/{anio}',[
	'middleware' => ['permission:crear_creditos'],
	'uses' => 'CreditoController@create',
	'as'   => 'start.creditos.create'
]);

Route::get('start/creditos/{id}/refinanciar',[
	'middleware' => ['permission:refiananciar_creditos'],
	'uses' => 'CreditoController@refinanciar',
	'as'   => 'start.creditos.refinanciar'
]);

Route::post('start/creditos/crear_refinanciacion',[
	'middleware' => ['permission:refiananciar_creditos'],
	'uses' => 'CreditoController@crear_refinanciacion',
	'as'   => 'start/creditos/crear_refinanciacion'
]);

Route::get('start/creditos/cancelados',[
	'middleware' => ['permission:listar_creditos'],
	'uses' => 'CreditoController@cancelados',
	'as'   => 'start.creditos.cancelados'	
]);

Route::get('start/creditos/exportar_todo',[
	'middleware' => ['permission:exportar_todo'],
	'uses'	=> 'CreditoController@ExportarTodo',
	'as'	=> 'start.creditos.exportar_todo'
]);

Route::get('start/creditos/{credito_id}/destroy',[
	'middleware' => ['permission:eliminar_creditos'],
	'uses'  => 'CreditoController@destroy',
	'as'    => 'start.creditos.destroy'
]);


