<?php

Route::get('contabilidad/reportes',[
    // 'middleware' => ['permission:generar_reporte'],
    'uses' => 'Contabilidad\ReporteContableController@index', 
    'as' => 'contabilidad.reportes.index'
]);

Route::post('contabilidad/reportes', [
    'uses' => 'Contabilidad\ReporteContableController@store',
    'as' => 'contabilidad.reportes.store'
]);

Route::get('contabilidad/reportes/test', 
    'Contabilidad\ReporteContableController@go');

Route::get('contabilidad/reportes/test',
    'TestController@some');