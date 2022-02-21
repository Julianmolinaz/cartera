<?php

Route::post("start/ventas/update-valor", [
    'middleware' => ['permission:editar_valor_producto'],
    'uses'  => 'V3\VentaController@updateValor',
    'as'    => 'start.venta.update-valor'
]);