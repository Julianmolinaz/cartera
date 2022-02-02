<?php

Route::post("start/fecha_cobros/update-fecha-pago", [
    'middleware' => [],
    'uses'  => 'FechaCobroController@updateFechaPago',
    'as'    => 'start.fecha_cobros.update_fecha_pago'
]);