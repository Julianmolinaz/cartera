<?php

Route::get('start/cajas',[
	'uses' => 'CajaController@index',
	'as'   => 'start.cajas.index'
]);

Route::get('start/cajas/report/{date}','CajaController@get_cash_report');
Route::get('start/all_cajas/report/{date}','CajaController@get_cashes_report');
Route::get('start/ventas_mes/report/{date}','CajaController@ventas_mes');