<?php

// LISTAR zonas

Route::get('admin/zonas_listall/{page?}',[
    'middleware' => ['permission:consultar_zonas'],
    'uses' => 'ZonaController@listall', 
    'as' => 'admin.zonas.listall']);

Route::get('admin/zonas', [
    'middleware' => ['permission:consultar_zonas'],
    'uses' => 'ZonaController@index',
    'as'  => 'admin.zonas'
]);

Route::post('admin/zonas', [
    'middleware' => ['permission:crear_zonas'],
    'uses' => 'ZonaController@store',
    'as'  => 'admin.zonas.store'
]);
    
