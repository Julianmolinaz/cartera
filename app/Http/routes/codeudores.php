<?php

Route::get('start/clientes/{id}/consultar_codeudor',[
	'uses'	=> 'ClienteController@consultar_codeudor',
	'as'	=> 'start.clientes.consulta_codeudor'
]);
