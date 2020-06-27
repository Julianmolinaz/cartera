<?php


//CALLCENTER LISTAR TODOS LOS CREDITOS
Route::get('call',[
    'middleware' => ['permission:listar'],
    'uses'  => 'CallcenterController@index',
    'as'    => 'call.index'
]);

//CALLCENTER LISTAR TODOS LOS MOROSOS
Route::get('call/morosos',[
    'middleware' => ['permission:listar_morosos'],
    'uses'  => 'CallcenterController@list_morosos',
    'as'    => 'call.morosos'
]);

//CALLCENTER LISTAR TODOS LOS AGENDADOS
Route::get('call/agendados',[
    'middleware' => ['permission:listar_agendados'],
    'uses'  => 'CallcenterController@list_agendados',
    'as'=> 'call.agendados'
]);

Route::get('call/miscall',[
    'middleware' => ['permission:miscall'],
	'uses'	=> 'CallcenterController@misCall',
	'as'	=> 'call.miscall'
]);

//CALLCENTER VER
Route::get('call/{call}',[
    'middleware' => ['permission:listar'],
    'uses'  => 'CallcenterController@show',
    'as'    => 'call.show'
]);

//CALLCENTER CREAR

Route::post('call/call_create',[
    'middleware' => ['permission:listar'],
    'uses'  =>'CallcenterController@call_create'
]);


Route::get('call/{tipo}/busqueda',[ 
    'uses' =>'CallcenterController@busqueda'
]);

Route::get('call/{id}/consultar',[
    'uses' => 'CallcenterController@consultar_credito'
]);

Route::get('call/{id}/index_unique',[
	'uses' 	=> 'CallcenterController@index_unique',
	'as'	=> 'call.index_unique'
]);

//EXPORTAR TODOS LOS CREDITOS CALLCENTER
Route::get('call/exportar/todo/{todos?}',[
    'middleware' => ['permission:exportar_todo'],
	'uses'	=> 'CallcenterController@ExportarTodo',
	'as'	=> 'call.exportar.todo'
]);

Route::get('call/exportar/soat',[
    'middleware' => ['permission:exportar_soat'],
	'uses'	=> 'CallcenterController@soat',
	'as'	=> 'call.exportar.soat'
]);

