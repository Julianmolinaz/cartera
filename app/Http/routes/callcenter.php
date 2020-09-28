<?php


// CALLCENTER LISTAR TODOS LOS CREDITOS
Route::get('call',[
    'middleware' => ['permission:consultar'],
    'uses'  => 'CallcenterController@index',
    'as'    => 'call.index'
]); //*

//CALLCENTER consultar TODOS LOS MOROSOS
Route::get('call/morosos',[
    'middleware' => ['permission:consultar'],
    'uses'  => 'CallcenterController@list_morosos',
    'as'    => 'call.morosos'
]); //*

//CALLCENTER consultar TODOS LOS AGENDADOS
Route::get('call/agendados',[
    'middleware' => ['permission:consultar'],
    'uses'  => 'CallcenterController@list_agendados',
    'as'=> 'call.agendados'
]); //*

Route::get('call/miscall',[
    'middleware' => ['permission:consultar'],
	'uses'	=> 'CallcenterController@misCall',
	'as'	=> 'call.miscall'
]); //*

//CALLCENTER VER
Route::get('call/{call}',[
    'middleware' => ['permission:consultar'],
    'uses'  => 'CallcenterController@show',
    'as'    => 'call.show'
]); //*

//CALLCENTER CREAR

Route::post('call/call_create',[
    'middleware' => ['permission:registro_llamada'],
    'uses'  =>'CallcenterController@call_create'
]); //*


Route::get('call/{tipo}/busqueda',[ 
    'middleware' => ['permission:consultar'],
    'uses' =>'CallcenterController@busqueda'
]); //*

Route::get('call/{id}/consultar',[
    'middleware' => ['permission:consultar'],
    'uses' => 'CallcenterController@consultar_credito'
]); //*

// LLAMAR CALL DESDE LA VISTA CLIENTE

Route::get('call/{id}/index_unique',[
    'middleware' => ['permission:registro_llamada'],
	'uses' 	=> 'CallcenterController@index_unique',
	'as'	=> 'call.index_unique'
]); //*


Route::get('call/{id}/index_unique',[
        'middleware' => ['permission:llamar_creditos'],
	'uses' 	=> 'CallcenterController@index_unique',
	'as'	=> 'call.index_unique'
]); //*


//EXPORTAR TODOS LOS CREDITOS CALLCENTER
Route::get('call/exportar/todo/{todos?}',[
    'middleware' => ['permission:exportar_todo'],
	'uses'	=> 'CallcenterController@ExportarTodo',
	'as'	=> 'call.exportar.todo'
]);

Route::get('call/exportar/sucursal',[
    'middleware' => ['permission:exportar_sucursal'],
	'uses'	=> 'CallcenterController@ExportarTodo',
	'as'	=> 'call.exportar.sucursal'
]);

Route::get('call/exportar/soat',[
    'middleware' => ['permission:exportar_todo'],
	'uses'	=> 'CallcenterController@soat',
	'as'	=> 'call.exportar.soat'
]);



