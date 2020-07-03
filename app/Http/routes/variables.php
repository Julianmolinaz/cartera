<?php



// LISTAR zonas

Route::get('admin/variables', [
    'middleware' => ['permission:ver_variables'],
    'uses' => 'VariableController@index',
    'as'  => 'admin.variables.index'
]);

Route::get('admin/variables_listall/{page?}',[
    'middleware' => ['permission:editar_variables'],
    'uses' => 'VariableController@listall', 
    'as' => 'admin.variables.listall'
]);

