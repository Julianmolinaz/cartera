<?php

// La facturación hace referencia a los proceso contables 
// de registro y  manipulación de comprobantes de pago

Route::get('start/facturacion/{solicitudId}', [
    'middleware' => [],
    'uses'  => 'V3\FacturacionController@index',
    'as'    => 'start.facturacion.index'
]);

Route::get('start/facturacion/destroy/{facturaId}', [
    'middleware' => [],
    'uses'  => 'V3\FacturacionController@destroy',
    'as'    => 'start.facturacion.destroy'
]);