<?php 


/*
|--------------------------------------------------------------------------
| Conyuges
|--------------------------------------------------------------------------
*/

Route::get('start/conyuges/{id}/{tipo}',[
    'middleware' => ['permission:ver_conyuges'],
    'uses' => 'ConyugeController@index',
    'as' => 'start.conyuges.index'
    ]);

Route::get('start/conyuges/create/{cliente_id}/{tipo}',[
    'middleware' => ['permission:crear_conyuges'],
    'uses' => 'ConyugeController@create',   
    'as' => 'start.conyuges.create']);

Route::post('start/conyuges',[
    'middleware' => ['permission:crear_conyuges'],
    'uses' => 'ConyugeController@store',   
    'as' => 'start.conyuges.store']);

Route::get('start/conyuges/{cliente_id}/{tipo}/edit',[ 
    'middleware' => ['permission:editar_conyuges'],
        'uses' =>'ConyugeController@edit',
		'as' => 'start.conyuges.edit']);

Route::get('start/conyuges/destroy/{cliente_id}/{tipo}',[ 
    'middleware' => ['permission:eliminar_conyuges'],
    'uses' => 'ConyugeController@destroy',
	'as' => 'start.conyuges.destroy']);
    



