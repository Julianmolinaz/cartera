<?php

/**
 * Pantalla inicial de reportes
 */

Route::get('contabilidad/reportes',[
    'uses' => 'Contabilidad\ReporteContableController@index', 
    'as' => 'contabilidad.reportes.index'
]);


/**
 * Terceros
 */

Route::get('contabilidad/reportes/terceros/index',[
   'uses' => 'Contabilidad\ReporteContableController@getTerceros',
   'as' => 'contabilidad.reportes.terceros.index'
]);

Route::post('contabilidad/reportes/terceros/list', [
    'uses' => 'Contabilidad\ReporteContableController@listTerceros',
    'as' => 'contabilidad.reportes.terceros.list'
]);

Route::post('contabilidad/reportes/terceros/exp', [
    'uses' => 'Contabilidad\ReporteContableController@expTerceros',
    'as' => 'contabilidad.reportes.terceros.exp'
]);

/**
 * Facturas proveedor
 */

Route::get('contabilidad/reportes/facturas_proveedor/index',[
   'uses' => 'Contabilidad\ReporteContableController@getFacturasProveedor',
   'as' => 'contabilidad.reportes.facturas_proveedor.index'
]);

Route::post('contabilidad/reportes/facturas_proveedor/list', [
    'uses' => 'Contabilidad\ReporteContableController@listFacturasProveedor',
    'as' => 'contabilidad.reportes.facturas_proveedor.list'
]);

Route::post('contabilidad/reportes/facturas_proveedor/exp', [
    'uses' => 'Contabilidad\ReporteContableController@expFacturasProveedor',
    'as' => 'contabilidad.reportes.facturas_proveedor.exp'
]);

/**
 * Ventas
 */

Route::get('contabilidad/reportes/facturas_venta/index',[
        'uses' => 'Contabilidad\ReporteContableController@getFacturasVenta',
        'as' => 'contabilidad.reportes.facturas_venta.index'
]);

Route::post('contabilidad/reportes/facturas_venta/list', [
    'uses' => 'Contabilidad\ReporteContableController@listFacturasVenta',
    'as' => 'contabilidad.reportes.facturas_venta.list'
]);

Route::post('contabilidad/reportes/facturas_venta/exp', [
    'uses' => 'Contabilidad\ReporteContableController@expFacturasVenta',
    'as' => 'contabilidad.reportes.facturas_venta.exp'
]);


/**
 * Compras
 */

Route::get('contabilidad/reportes/compras/index',[
        'uses' => 'Contabilidad\ReporteContableController@getCompras',
        'as' => 'contabilidad.reportes.compras.index'
]);

Route::post('contabilidad/reportes/compras/list', [
    'uses' => 'Contabilidad\ReporteContableController@listCompras',
    'as' => 'contabilidad.reportes.compras.list'
]);

Route::post('contabilidad/reportes/compras/exp', [
    'uses' => 'Contabilidad\ReporteContableController@expCompras',
    'as' => 'contabilidad.reportes.compras.exp'
]);

/**
 * Recibos de Caja
 */

Route::get('contabilidad/reportes/recibos_caja/index',[
        'uses' => 'Contabilidad\ReporteContableController@getRecibosCaja',
        'as' => 'contabilidad.reportes.recibos_caja.index'
]);

Route::post('contabilidad/reportes/recibos_caja/list', [
    'uses' => 'Contabilidad\ReporteContableController@listRecibosCaja',
    'as' => 'contabilidad.reportes.recibos_caja.list'
]);

Route::post('contabilidad/reportes/recibos_caja/exp', [
    'uses' => 'Contabilidad\ReporteContableController@expRecibosCaja',
    'as' => 'contabilidad.reportes.recibos_caja.exp'
]);

/**
 * Reportes
 */


Route::post('contabilidad/reportes', [
    'middleware' => ['permission:generar_reporte'],
    'uses' => 'Contabilidad\ReporteContableController@store',
    'as' => 'contabilidad.reportes.store'
]);

Route::get('contabilidad/reportes/test', 
    'Contabilidad\ReporteContableController@go');

Route::get('contabilidad/reportes/test',
    'TestController@some');

