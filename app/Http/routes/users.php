<?php


// VER USERS

Route::get('admin/users',[
    'middleware' => ['permission:consultar_users'],
    'uses'	=> 'UserController@index',
    'as'	=> 'admin.users.index'
]);

// VISTA CREAR NEGOCIOS

Route::get('admin/users/create',[
    'middleware' => ['permission:crear_users'],
     'uses'	=> 'UserController@create',
     'as'	=> 'admin.users.create'
]);


// get users json (ruta utilizada para egresos)

Route::get('admin/users/get_users',[
    'middleware' => ['permission:crear_egresos'],
     'uses'	=> 'UserController@getUsers'
]);

// ACTUALIZAR NEGOCIOS

Route::post('admin/users/store',[
    'middleware' => ['permission:crear_users'],
     'uses'	=> 'UserController@store',
     'as'	=> 'admin.users.store'
]);

// VISTA EDITAR NEGOCIOS

Route::get('admin/users/edit/{user_id}',[
    'middleware' => ['permission:editar_users'],
     'uses'	=> 'UserController@edit',
     'as'	=> 'admin.users.edit'
]);
   
// ACTUALIZAR NEGOCIOS

Route::put('admin/users/{user_id}',[
    'middleware' => ['permission:editar_users'],
     'uses'	=> 'UserController@update',
     'as'	=> 'admin.users.update'
]);

// ELIMINAR NEGOCIOS

Route::get('admin/users/destroy/{user_id}',[
    'middleware' => ['permission:eliminar_users'],
    'uses'	=> 'UserController@destroy',
    'as'	=> 'admin.users.destroy'
]);