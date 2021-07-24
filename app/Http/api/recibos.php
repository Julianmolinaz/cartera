<?php

// Evalue si existen pagos recientes por el mismo valor de pago

Route::post('recibos/recibos-recientes', 'FacturaController@recibosRecientes');