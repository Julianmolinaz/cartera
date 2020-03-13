<?php


/*
|--------------------------------------------------------------------------
| Creditos
|--------------------------------------------------------------------------
*/


Route::get('start/creditos',[
    'uses'  => 'CreditoController@index',
    'as'    => 'start.creditos.index'
])->middleware('creditos_listar');


// Route::get('start/creditos/create',
// 	['uses' 	=> 'CreditoController@create','as'=> 'start.creditos.create'])->middleware('creditos_crear');

Route::put('start/creditos/{credito}',[
	// Route::get('startUpdate',[	
    'uses'  => 'CreditoController@update',
    'as'    => 'start.creditos.update'
]);

Route::get('start/creditos/{credito}/edit',[
    'uses'  => 'CreditoController@edit',
    'as'    => 'start.creditos.edit'
]);

Route::get('start/creditos/create/{id}/{mes}/{anio}',[
	'uses' => 'CreditoController@create',
	'as'   => 'start.creditos.create'
])->middleware('creditos_crear');

Route::get('start/creditos/{id}/refinanciar',[
	'uses' => 'CreditoController@refinanciar',
	'as'   => 'start.creditos.refinanciar'
])->middleware('refinanciacion');;

Route::post('start/creditos/crear_refinanciacion',[
	'uses' => 'CreditoController@crear_refinanciacion',
	'as'   => 'start/creditos/crear_refinanciacion'
])->middleware('refinanciacion');;

Route::get('start/creditos/cancelados',[
	'uses' => 'CreditoController@cancelados',
	'as'   => 'start.creditos.cancelados'	
])->middleware('refinanciacion');;

Route::get('start/creditos/exportar_todo',[
	'uses'	=> 'CreditoController@ExportarTodo',
	'as'	=> 'start.creditos.exportar_todo'
])->middleware('refinanciacion');


