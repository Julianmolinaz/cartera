<?php

/**
 * SALVAR SOLICITUD
 */

Route::post('precreditosV3', 'V3\precreditoController@store');

/**
 * ACTUALIZAR SOLICITUD
 */

Route::post('precreditosV3/update', 'V3\precreditoController@update');