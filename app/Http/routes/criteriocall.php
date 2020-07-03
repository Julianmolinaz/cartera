<?php

Route::get('admin/listall/{page?}',[
    'middleware' => ['permission:ver_criteriocall'],
    'uses' => 'CriteriocallController@listall', 
    'as' => 'admin.listall'
]);

// VER criteriocall

Route::get('admin/criteriocall',[
    'middleware' => ['permission:ver_criteriocall'],
    'uses' => 'CriteriocallController@index',
    'as' => 'admin.criteriocall.index'
]);

// VISTA CREAR criteriocall

Route::get('admin/criteriocall/create',[
    'middleware' => ['permission:ver_criteriocall'],
    'uses' => 'CriteriocallController@create',
    'as' => 'admin.criteriocall.create'
]);

// ACTUALIZAR criteriocall

Route::post('admin/criteriocall',[
    'middleware' => ['permission:ver_criteriocall'],
    'uses' => 'CriteriocallController@store',
    'as' => 'admin.criteriocall.store'
]);

// VISTA EDITAR criteriocall

Route::get('admin/criteriocall/{id}/edit',[
    'middleware' => ['permission:editar_criteriocall'],
    'uses' => 'CriteriocallController@edit',
    'as' => 'admin.criteriocall.edit'
]);
   
// ACTUALIZAR criteriocall

Route::put('admin/criteriocall/{criteriocall_id}',[
    'middleware' => ['permission:editar_criteriocall'],
    'uses' => 'CriteriocallController@update',
    'as' => 'admin.criteriocall.update'
]);

// ELIMINAR CRITERIOCALL

Route::get('admin/criteriocall/{id}/destroy',[
    'middleware' => ['permission:eliminar_criteriocall'],
    'uses' => 'CriteriocallController@destroy',
    'as' => 'admin.criteriocall.destroy'
]);

