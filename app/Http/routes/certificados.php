<?php

Route::get('start/certificados/paz_y_salvo/{credito_id}/{tipo}',[
	'middleware' => ['permission:expedir_pazysalvo'],
	'uses'  => 'CertificadoController@paz_y_salvo',
	'as' => 'certificados.paz_y_salvo'
]);

