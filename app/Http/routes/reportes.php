<?php

Route::get('admin/reportes',[
    'middleware' => ['permission:generar_reporte'],
    'uses' => 'ReporteController@index', 
    'as' => 'admin.reportes.index'
]);

Route::get('admin/marcar-cancelados/{tipo_reporte}', [
    'middleware' => ['permission:marcar-cancelados'],
     'uses' => 'ReporteController@marcar_cancelados', 
     'as' => 'admin.marcar_cancelados'
     ]);


Route::post('admin/reportes',['uses' => 'ReporteController@store', 'as' => 'admin.reportes.store']);

// Route::resource('admin/reportes','ReporteController');
