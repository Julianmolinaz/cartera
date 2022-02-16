<?php

Route::post(
    "refinanciacion/{creditoRefinanciadoId}",
    "V3\CreditoController@storeRefinanciacion"
);