<?php 

/*
|--------------------------------------------------------------------------
| Clientes
|--------------------------------------------------------------------------
*/

Route::get('start/clientes',[
    'uses'  => 'ClienteController@index',
    'as'    => 'start.clientes.index'
]);

Route::get('start/clientes/list',[
    'uses'  => 'ClienteController@list',
    'as'    => 'start.clientes.list' 
]);

Route::post('start/clientes',[
    'uses'  => 'ClienteController@store',
    'as'    => 'start.clientes.store'	
]);     

Route::get('start/clientes/create',[
    'uses' 	=> 'ClienteController@create',
    'as'    => 'start.clientes.create'
]);     

Route::get('start/clientes/{cliente}',[
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