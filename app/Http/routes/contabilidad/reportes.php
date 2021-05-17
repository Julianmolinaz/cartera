<?php

Route::get('contabilidad/reportes',[
    'uses' => 'Contabilidad\ReporteContableController@index', 
    'as' => 'contabilidad.reportes.index'
]);

Route::post('contabilidad/reportes', [
    'middleware' => ['permission:generar_reporte'],
    'uses' => 'Contabilidad\ReporteContableController@store',
    'as' => 'contabilidad.reportes.store'
]);

Route::get('contabilidad/reportes/test', 
    'Contabilidad\ReporteContableController@go');

Route::get('contabilidad/reportes/test',
    'TestController@some');

// Nueva ruta para Terceros
Route::get('contabilidad/reportes/terceros/index',[
        'uses' => 'Contabilidad\ReporteContableController@getTerceros',
        'as' => 'contabilidad.reportes.terceros.index'
]);

// Nueva ruta para Recibos de Caja
Route::get('contabilidad/reportes/recibos_caja/index',[
        'uses' => 'Contabilidad\ReporteContableController@getRecibosCaja',
        'as' => 'contabilidad.reportes.recibos_caja.index'
]);

// Nueva ruta para Facturas De Venta
Route::get('contabilidad/reportes/facturas_venta/index',[
        'uses' => 'Contabilidad\ReporteContableController@getFacturasVenta',
        'as' => 'contabilidad.reportes.facturas_venta.index'
]);

// Nueva ruta para Compras
Route::get('contabilidad/reportes/compras/index',[
        'uses' => 'Contabilidad\ReporteContableController@getCompras',
        'as' => 'contabilidad.reportes.compras.index'
]);

// Nueva ruta para Facturas Proveedor
Route::get('contabilidad/reportes/facturas_proveedor/index',[
        'uses' => 'Contabilidad\ReporteContableController@getFacturasProveedor',
        'as' => 'contabilidad.reportes.facturas_proveedor.index'
]);