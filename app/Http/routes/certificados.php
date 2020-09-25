<?php

Route::get('start/certificados/paz_y_salvo/{cliente_id}/{tipo}','CertificadoController@paz_y_salvo')
    ->name('certificados.paz_y_salvo');

