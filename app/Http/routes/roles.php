<?php

Route::get('admin/roles/create','RolController@create')
    ->name('admin.roles.create');

Route::post('admin/roles','RolController@store');

Route::get('admin/roles','RolController@index');

Route::get('admin/categorias_con_permisos','RolController@categorias_con_permisos');