<?php

/*
|--------------------------------------------------------------------------
| Documentos
|--------------------------------------------------------------------------
*/

Route::put('start/documentos/{objeto_relacionado}',[
    'middleware' => ['permission:subir_documentos'],
    'uses'  => 'DocumentoController@set_documento',
    'as'    => 'start.documentos.upload'
]);
	
Route::get('start/documentos/{documento_id}/get/{nombre}',[
    'middleware' => ['permission:subir_documentos'],
    'uses'  => 'DocumentoController@get_documento',
    'as'    => 'start.documentos.get_documento'
]);

Route::get('start/documentos/{documento_id}/destroy/{inicio?}',[
    'middleware' => ['permission:borrar_documentos'],
    'uses'  => 'DocumentoController@destroy',
    'as'    => 'start.documentos.destroy'
]);
 
