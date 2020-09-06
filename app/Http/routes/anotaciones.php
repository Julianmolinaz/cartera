<?php

// ANOTACIONES

Route::get('admin/anotaciones/{credito_id}',['uses' => 'AnotacionController@index','as' => 'admin.anotaciones.index']);
Route::post('admin/anotaciones','AnotacionController@store');
Route::put('admin/anotaciones/{anotacion_id}','AnotacionController@update');
Route::get('admin/anotaciones/{proceso_id}/list','AnotacionController@list');
