<?php

Route::get("start/refinanciacion/create/{creditoId}", [
    "middleware" => [],
    "uses" => "V3\CreditoController@refinanciar",
    "as" => "start.refinanciacionV3.create"
]);