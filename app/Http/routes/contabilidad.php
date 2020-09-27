<?php

// CONTABILIDAD

Route::group(['prefix' => 'contabilidad'], function () {

    Route::get('/', 'ContabilidadController@index')
        ->name('contabilidad.index');

    // Route::get('/puc/index','PucController@index')
    //     ->name('contabilidad.puc.index');

    // TERCEROS 

    Route::get('terceros','TerceroController@index')
        ->name('contabilidad.terceros.index');
    
    Route::get('terceros/list','TerceroController@list');
    
    Route::get('terceros/create','TerceroController@create');
    
    Route::post('terceros','TerceroController@store');
    
    // PAGO A PROVEEDORES

    Route::get('pago_proveedores','PagoProveedorController@index')
        ->name('contabilidad.pago_proveedores.index');

    Route::get('pago_proveedores/{proveedor_id}/{type}','PagoProveedorController@list');

});