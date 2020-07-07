<?php

// CREAR

Route::get('admin/roles/create','RolController@create')
    ->name('admin.roles.create');

Route::post('admin/roles','RolController@store');

// PANTALLA DE INICIO

Route::get('admin/roles','RolController@index');

// SHOW ROLE

Route::get('admin/roles/show/{rol_id}', 'RolController@show');

Route::get('admin/categorias_con_permisos','RolController@categorias_con_permisos');


// ACTUALIZAR PERMISOS 

Route::put('admin/roles/{rol_id}','RolController@update');