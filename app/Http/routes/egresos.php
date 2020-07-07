<?php 

// LISTAR CARTERAS

Route::get('start/egresos', [
    'middleware' => ['permission:ver_egresos'],
    'uses' => 'EgresoController@index',
    'as'  => 'start.egresos.index'
    ]);

// VISTA CREAR CARTERA

Route::get('start/egresos/create', [
    'middleware' => ['permission:crear_egresos'],
    'uses' => 'EgresoController@create',
    'as' => 'start.egresos.create'
]);

// CREAR CARTERA

Route::post('start/egresos', [
    'middleware' => ['permission:crear_egresos'],
    'uses' => 'EgresoController@store',
    'as'   => 'start.egresos.store'    
]);

// VISTA EDITAR CARTERA

Route::get('start/egresos/edit/{cartera_id}',[
    'middleware' => ['permission:editar_egresos'],
    'uses' => 'EgresoController@edit',
    'as' => 'start.egresos.edit'
]);

// ACTUALIZAR CARTERA

Route::put('start/egresos/{cartera_id}',[
    'middleware' => ['permission:editar_egresos'],
    'uses' => 'EgresoController@update',
    'as' => 'start.egresos.update'
]);

// BORRAR CARTERA

Route::get('start/egresos/destroy/{cartera_id}',[
    'middleware' => ['permission:eliminar_egresos'],
    'uses' => 'EgresoController@destroy',
    'as' => 'start.egresos.destroy'
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

Route::get('start/egresos/get_info','EgresoController@get_info');

Route::get('start/egresos/solicitudes','EgresoController@get_solicitudes');

Route::get('start/egresos/search/{string?}','EgresoController@search');

Route::get('start/egresos/get_data','EgresoController@get_data');

Route::get('start/egresos/get_egresos','EgresoController@get_egresos');









