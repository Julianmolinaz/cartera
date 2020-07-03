<?php 

/*
|--------------------------------------------------------------------------
| Clientes
|--------------------------------------------------------------------------
*/
// LIST

// Listar clientes

Route::get('start/clientes',[
<<<<<<< HEAD
	'middleware' => ['permission:ver_clientes'],
	'uses' => 'ClienteController@index',
	'as'=> 'start.clientes.index'
=======
    'middleware' => ['permission:cliente_show'],
    'uses'  => 'ClienteController@index',
    'as'    => 'start.clientes.index'
>>>>>>> 3f773aed3efbe1a041357650c41931c2d09ab172
]);

// LIST

Route::get('start/clientes/list',[
<<<<<<< HEAD
    'middleware' => ['permission:listar_clientes'],
    'uses'  => 'ClienteController@list',
    'as'    => 'start.clientes.list' 
=======
    'uses'       => 'ClienteController@list',
    'as'         => 'start.clientes.list' 
]);

// VALIDATE DOCUMENT TO CREATE

Route::post('start/clientes/validar/documento',[
    'uses'  => 'ClienteController@validate_document',
    'as'    => 'start.clientes.validate_document'
>>>>>>> 3f773aed3efbe1a041357650c41931c2d09ab172
]);

// Crear clientes

Route::post('start/clientes',[
    'middleware' => ['permission:crear_cliente'],
    'uses'  => 'ClienteController@store',
    'as'    => 'start.clientes.store'	
<<<<<<< HEAD
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
=======
]);     

Route::get('start/clientes_create/{tipo}/{cliente_id?}','ClienteController@create')
    ->name('start.clientes_create');

// SHOW

Route::get('start/clientes/{cliente}',[
    'middleware' => ['permission:cliente_show'],
    'uses'  => 'ClienteController@show',
    'as'    => 'start.clientes.show'
]);     
>>>>>>> 3f773aed3efbe1a041357650c41931c2d09ab172

Route::get('start/clientes/{cliente}/edit',[
    'middleware' => ['permission:editar_clientes'],
    'uses'  => 'ClienteController@edit',
    'as'    => 'start.clientes.edit'
<<<<<<< HEAD
]);
=======
]);     
>>>>>>> 3f773aed3efbe1a041357650c41931c2d09ab172

Route::put('start/clientes/{cliente}',[
    'middleware' => ['permission:editar_clientes'],
    'uses'  => 'ClienteController@update',
    'as'    => 'start.clientes.update'
<<<<<<< HEAD
]);
=======
]); 

Route::post('start/clientes/updateV2','ClienteController@updateV2'); 
>>>>>>> 3f773aed3efbe1a041357650c41931c2d09ab172

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

<<<<<<< HEAD

=======
Route::get('start/clientes/{id}/destroy',[
    'uses'	=> 'ClienteController@destroy',
    'as'	=> 'start.clientes.destroy'
]);     
>>>>>>> 3f773aed3efbe1a041357650c41931c2d09ab172



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
 




