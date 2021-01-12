<?php 

/*
|--------------------------------------------------------------------------
| Clientes
|--------------------------------------------------------------------------
*/
// LIST

// Listar clientes

Route::get('start/clientes',[
	'middleware' => ['permission:consultar_clientes'],
	'uses' => 'ClienteController@index',
	'as'=> 'start.clientes.index'
]);

// LIST

Route::get('start/clientes/list',[
    'middleware' => ['permission:consultar_clientes'],
    'uses'  => 'ClienteController@list',
    'as'    => 'start.clientes.list' 
]);

// Crear clientes

Route::post('start/clientes',[
    // 'middleware' => ['permission:crear_clientes'],
    'uses'  => 'ClienteController@store',
    'as'    => 'start.clientes.store'	
]);

Route::get('start/clientes_create/{cliente_id?}',[
    'middleware' => ['permission:crear_clientes'],
    'uses' 	=> 'ClienteController@create',
    'as'    => 'start.clientes.create'
]);

// Ver clientes

Route::post('start/clientes/validar/documento', 'ClienteController@validate_document');

Route::get('start/clientes/{cliente_id}',[
    'middleware' => ['permission:consultar_clientes'],
    'uses'  => 'ClienteController@show',
    'as'    => 'start.clientes.show'
]);

// Editar clientes

Route::get('start/clientes/{cliente}/edit',[
    'middleware' => ['permission:editar_clientes'],
    'uses'  => 'ClienteController@edit',
    'as'    => 'start.clientes.edit'
]);

Route::put('start/clientes/{cliente}/edit',[
    'middleware' => ['permission:editar_clientes'],
    'uses'  => 'ClienteController@update',
    'as'    => 'start.clientes.update'
]);


Route::post('start/clientes/updateV2','ClienteController@updateV2'); 

// Eliminar cliente

Route::get('start/clientes/{id}/destroy',[
    'middleware' => ['permission:eliminar_clientes'],
    'uses'	=> 'ClienteController@destroy',
    'as'	=> 'start.clientes.destroy'
]);


Route::get('start/clientes/{cliente_id}/upload',[
    // 'middleware' => ['permission:subir_documentos'],
	'uses'  => 'ClienteController@uploadDocument',
	'as'    => 'start.clientes.upload_document'
]);







