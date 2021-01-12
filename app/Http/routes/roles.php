<?php
// PANTALLA DE INICIO

Route::get('admin/roles',[
    // 'middleware' => ['permission:consultar_permisos'],
    'uses' => 'RolController@index',
    'as' => 'admin.roles.index'
]);
// CREAR

Route::get('admin/roles/create',[
    // 'middleware' => ['permission:modificar_permisos'],
    'uses' => 'RolController@create',
    'as' => 'admin.roles.create'
]);

// GUARDAR ROLF
Route::post('admin/roles',[
    // 'middleware' => ['permission:modificar_permisos'],
    'uses' => 'RolController@store',
    'as' => 'admin.roles.store'
]);

// VER ROLES
Route::get('admin/roles/show',[
    // 'middleware' => ['permission:consultar_permisos'],
    'uses' => 'RolController@show',
    'as' => 'admin.roles.show'
]);

//ACTUALIZAR ROL
Route::put('admin/roles/{role_id}',[
    // 'middleware' => ['permission:modificar_permisos'],
    'uses' => 'RolController@update',
    'as' => 'admin.roles.update'
]);

//ACTUALIZAR ROL
Route::post('admin/roles/destroy',[
    // 'middleware' => ['permission:modificar_permisos'],
    'uses' => 'RolController@destroy',
    'as' => 'admin.roles.destroy'
]);






// SHOW ROLE

Route::get('admin/roles/show/{rol_id}', 'RolController@show');

Route::get('admin/categorias_con_permisos','RolController@categorias_con_permisos');






