<<<<<<< HEAD
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
    



=======
<?php

//CONYUGES

Route::resource('start/conyuges','ConyugeController');

Route::get('start/conyuges/create/{cliente_id}/{tipo}','ConyugeController@create')
		->name('start.conyuges.create');

Route::get('start/conyuges/{cliente_id}/{tipo}/edit','ConyugeController@edit')
		->name('start.conyuges.edit');

Route::get('start/conyuges/destroy/{cliente_id}/{tipo}','ConyugeController@destroy')
		->name('start.conyuges.destroy');
>>>>>>> 3f773aed3efbe1a041357650c41931c2d09ab172
