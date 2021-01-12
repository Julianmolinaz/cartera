<?php

Route::get('contabilidad/reportes',[
    // 'middleware' => ['permission:generar_reporte'],
    'uses' => 'Contabilidad\ReporteContableController@go', 
    'as' => 'contabilidad.reportes.index'
]);

Route::get('contabilidad/reportes/test', 
    'Contabilidad\ReporteContableController@go');