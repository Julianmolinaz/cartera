<?php

Route::get('admin/pagos_masivos',[
    'middleware' => ['permission:pagos_masivos'],
    'uses' => 'PagoMasivoController@index', 
    'as'   => 'admin.pagos_masivos.index'	
]);

Route::post('admin/pagos_masivos',[
    'middleware' => ['permission:pagos_masivos'],
    'uses' => 'PagoMasivoController@store', 
    'as'   => 'admin.pagos_masivos.store'	
]);