<?php

Route::get('start/certificados/paz_y_salvo/{cliente_id}','CertificadoController@paz_y_salvo')
    ->name('certificados.paz_y_salvo');