<?php

Route::get("start/refinanciacion/create/{creditoPadreId}", [
    "middleware" => ['permission:refinanciar_creditos'],
    "uses" => "V3\RefinanciacionController@create",
    "as" => "start.refinanciacion.create"
]);

Route::post("start/refinanciacion", [
    "middleware" => ['permission:refinanciar_creditos'],
    "uses" => "V3\RefinanciacionController@store",
    "as" => "start.refinanciacion.store"
]);