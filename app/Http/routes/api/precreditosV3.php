<?php

/**
 * SALVAR SOLICITUD
 */

Route::post('precreditosV3', 'V3\PrecreditoController@store');

/**
 * ACTUALIZAR SOLICITUD
 */

Route::post('precreditosV3/update', 'V3\PrecreditoController@update');