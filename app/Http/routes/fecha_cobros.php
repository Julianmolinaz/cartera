<?php

Route::post("start/fecha_cobros/update-fecha-pago", [
    'middleware' => ['permission:editar_fecha_pago'],
    'uses'  => 'FechaCobroController@updateFechaPago',
    'as'    => 'start.fecha_cobros.update_fecha_pago'
]);