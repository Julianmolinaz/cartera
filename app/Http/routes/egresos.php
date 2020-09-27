<?php 

// CONSULTAR CARTERAS

Route::get('start/egresos', [
    'middleware' => ['permission:consultar_egresos'],
    'uses' => 'EgresoController@index',
    'as'  => 'start.egresos.index'
    ]);

// VISTA CREAR CARTERA

Route::get('start/egresos/create', [
    'middleware' => ['permission:crear_egresos'],
    'uses' => 'EgresoController@create',
    'as' => 'start.egresos.create'
]);

// Actualizar CARTERA

Route::post('start/egresos', [
    'middleware' => ['permission:crear_egresos'],
    'uses' => 'EgresoController@store',
    'as'   => 'start.egresos.store'    
]);

// ELIMINAR

Route::get('start/egresos/{id}/destroy',[
    'middleware' => ['permission:eliminar_egresos'],
    'uses'	=> 'EgresoController@destroy',
    'as'	=> 'start.egresos.destroy'
]);


//** */
//EGRESOS

Route::get('start/egresos_report',[
    'uses' => 'EgresoController@report'

]);

//Egresos solicitudes
Route::get('start/egresos/get_info','EgresoController@get_info');

Route::get('start/egresos/solicitudes','EgresoController@get_solicitudes');

//search (Buscar)
Route::get('start/egresos/search/{string?}','EgresoController@search');

Route::get('start/egresos/get_data','EgresoController@get_data');

Route::get('start/egresos/get_egresos','EgresoController@get_egresos');









