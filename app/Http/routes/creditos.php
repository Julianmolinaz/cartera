<?php


/*
|--------------------------------------------------------------------------
| Creditos
|--------------------------------------------------------------------------
*/

Route::get('start/creditos',[
	'middleware' => ['permission:consultar_creditos'],
    'uses'  => 'CreditoController@index',
    'as'    => 'start.creditos.index'
]);

Route::get('start/creditos/list',[ 
	'middleware' => ['permission:consultar_creditos'],   
	'uses'  => 'CreditoController@list',
	'as'    => 'start.creditos.list'
]);

Route::get('start/creditos/show',[ 
	'middleware' => ['permission:consultar_creditos'],   
	'uses'  => 'CreditoController@show',
	'as'    => 'start.creditos.show'
]);

// Route::get('start/creditos/create',
// 	['uses' 	=> 'CreditoController@create','as'=> 'start.creditos.create']);

Route::put('start/creditos/{credito}',[
	'middleware' => ['permission:editar_creditos'],	
    'uses'  => 'CreditoController@update',
    'as'    => 'start.creditos.update'
]);

Route::post('start/creditos/updateV2',[
	'middleware' => ['permission:editar_creditos'],	
    'uses'  => 'CreditoController@updateV2',
    'as'    => 'start.creditos.updateV2'
]);

Route::get('start/creditos/{credito_id}/edit',[
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
	'middleware' => ['permission:refinanciar_creditos'],
	'uses' => 'CreditoController@refinanciar',
	'as'   => 'start.creditos.refinanciar'
]);

Route::post('start/creditos/crear_refinanciacion',[
	'middleware' => ['permission:refinanciar_creditos'],
	'uses' => 'CreditoController@crear_refinanciacion',
	'as'   => 'start/creditos/crear_refinanciacion'
]);

Route::get('start/creditos/cancelados',[
	'middleware' => ['permission:consultar_cancelados'],
	'uses' => 'CreditoController@cancelados',
	'as'   => 'start.creditos.cancelados'	
]);

Route::get('start/creditos/exportar_todo',[
	'middleware' => ['permission:exportar_creditos'],
	'uses'	=> 'CreditoController@ExportarTodo',
	'as'	=> 'start.creditos.exportar_todo'
]);

Route::get('start/creditos/{credito_id}/destroy',[
	'middleware' => ['permission:eliminar_creditos'],
	'uses'  => 'CreditoController@destroy',
	'as'    => 'start.creditos.destroy'
]);



