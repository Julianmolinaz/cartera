<?php
// LISTAR zonas

Route::get('admin/zonas_listall/{page?}',[
    'middleware' => ['permission:ver_zonas'],
    'uses' => 'ZonaController@listall', 
    'as' => 'admin.zonas.listall']);

Route::get('admin/zonas', [
    'middleware' => ['permission:ver_zonas'],
    'uses' => 'ZonaController@index',
    'as'  => 'admin.zonas'
    ]);

