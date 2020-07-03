<?php 

/*
|--------------------------------------------------------------------------
| Clientes
|--------------------------------------------------------------------------
*/
// LIST

// Listar clientes

Route::get('start/clientes',[
	'middleware' => ['permission:ver_clientes'],
	'uses' => 'ClienteController@index',
	'as'=> 'start.clientes.index'
]);

// LIST

Route::get('start/clientes/list',[
    'middleware' => ['permission:listar_clientes'],
    'uses'  => 'ClienteController@list',
    'as'    => 'start.clientes.list' 
]);

// Crear clientes

Route::post('start/clientes',[
    'middleware' => ['permission:crear_cliente'],
    'uses'  => 'ClienteController@store',
    'as'    => 'start.clientes.store'	
]);

Route::get('start/clientes/create',[
    'middleware' => ['permission:crear_cliente'],
    'uses' 	=> 'ClienteController@create',
    'as'    => 'start.clientes.create'
]);

// Ver clientes

Route::get('start/clientes/{cliente_id}',[
    'middleware' => ['permission:ver_clientes'],
    'uses'  => 'ClienteController@show',
    'as'    => 'start.clientes.show'
]);

// Editar clientes

Route::get('start/clientes/{cliente}/edit',[
    'middleware' => ['permission:editar_clientes'],
    'uses'  => 'ClienteController@edit',
    'as'    => 'start.clientes.edit'
]);

Route::put('start/clientes/{cliente}',[
    'middleware' => ['permission:editar_clientes'],
    'uses'  => 'ClienteController@update',
    'as'    => 'start.clientes.update'
]);

// Eliminar cliente

Route::get('start/clientes/{id}/destroy',[
    'middleware' => ['permission:borrar_clientes'],
    'uses'	=> 'ClienteController@destroy',
    'as'	=> 'start.clientes.destroy'
]);


Route::get('start/clientes/{cliente_id}/upload',[
    'middleware' => ['permission:subir_documentos'],
	'uses'  => 'ClienteController@uploadDocument',
	'as'    => 'start.clientes.upload_document'
]);




/*
|--------------------------------------------------------------------------
| Documentos
|--------------------------------------------------------------------------
*/

Route::put('start/documentos/{objeto_relacionado}',[
    'uses'  => 'DocumentoController@set_documento',
    'as'    => 'start.documentos.upload'
]);
	
Route::get('start/documentos/{documento_id}/get/{nombre}',[
    'uses'  => 'DocumentoController@get_documento',
    'as'    => 'start.documentos.get_documento'
]);

Route::get('start/documentos/{documento_id}/destroy/{inicio?}',[
    'uses'  => 'DocumentoController@destroy',
    'as'    => 'start.documentos.destroy'
]);
 




