<?php

Route::get('start/certificados/paz_y_salvo/{credito_id}/{tipo}','CertificadoController@paz_y_salvo')
    ->name('certificados.paz_y_salvo');

