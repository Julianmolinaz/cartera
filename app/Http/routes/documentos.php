<?php

/*
|--------------------------------------------------------------------------
| Documentos
|--------------------------------------------------------------------------
*/

Route::put('start/documentos/{objeto_relacionado}',[
    'middleware' => ['permission:borrar_documentos'],
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
 