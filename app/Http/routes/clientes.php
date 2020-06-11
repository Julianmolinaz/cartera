<?php 

/*
|--------------------------------------------------------------------------
| Clientes
|--------------------------------------------------------------------------
*/
// LIST

Route::get('start/clientes',[
    'middleware' => ['permission:cliente_show'],
    'uses'  => 'ClienteController@index',
    'as'    => 'start.clientes.index'
]);

// LIST

Route::get('start/clientes/list',[
    'uses'       => 'ClienteController@list',
    'as'         => 'start.clientes.list' 
]);

// VALIDATE DOCUMENT TO CREATE

Route::post('start/clientes/validar/documento',[
    'uses'  => 'ClienteController@validate_document',
    'as'    => 'start.clientes.validate_document'
]);

Route::post('start/clientes',[
    'uses'  => 'ClienteController@store',
    'as'    => 'start.clientes.store'	
]);     

Route::get('start/clientes_create/{tipo}/{cliente_id?}','ClienteController@create')
    ->name('start.clientes_create');

// SHOW

Route::get('start/clientes/{cliente}',[
    'middleware' => ['permission:cliente_show'],
    'uses'  => 'ClienteController@show',
    'as'    => 'start.clientes.show'
]);     

Route::get('start/clientes/{cliente}/edit',[
    'uses'  => 'ClienteController@edit',
    'as'    => 'start.clientes.edit'
]);     

Route::put('start/clientes/{cliente}',[
    'uses'  => 'ClienteController@update',
    'as'    => 'start.clientes.update'
]); 

Route::post('start/clientes/updateV2','ClienteController@updateV2'); 

Route::get('start/clientes/{id}/consultar_codeudor',[
	'uses'	=> 'ClienteController@consultar_codeudor',
	'as'	=> 'start.clientes.consulta_codeudor'
]);

Route::get('start/clientes/{cliente_id}/upload',[
	'uses'  => 'ClienteController@uploadDocument',
	'as'    => 'start.clientes.upload_document'
]);

Route::get('start/clientes/{id}/destroy',[
    'uses'	=> 'ClienteController@destroy',
    'as'	=> 'start.clientes.destroy'
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
 


/*
|--------------------------------------------------------------------------
| Conyuges
|--------------------------------------------------------------------------
*/

Route::resource('start/conyuges','ConyugeController');

Route::get('start/conyuges/create/{cliente_id}/{tipo}','ConyugeController@create')
		->name('start.conyuges.create');

Route::get('start/conyuges/{cliente_id}/{tipo}/edit','ConyugeController@edit')
		->name('start.conyuges.edit');

Route::get('start/conyuges/destroy/{cliente_id}/{tipo}','ConyugeController@destroy')
		->name('start.conyuges.destroy');


/*
|--------------------------------------------------------------------------
| Codeudores
|--------------------------------------------------------------------------
*/


Route::resource('start/codeudores','CodeudorController');

Route::get('start/codeudores/create/{cliente_id}','CodeudorController@create')
		->name('start.codeudores.create');

Route::get('start/codeudores/destroy/{cliente_id}','CodeudorController@destroy')
		->name('start.codeudores.destroy');