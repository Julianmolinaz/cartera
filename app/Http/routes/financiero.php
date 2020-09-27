<?php


//FINANCIERO

//carga la vista principal de los reportes financieros

Route::get('financiero',[
	'middleware' => ['permission:financiero_operativo'],
	'uses' =>'FinancieroController@index',
	'as'=>'admin.reporte.financiero'
]);

Route::get('repor-financiero',[
	'middleware' => ['permission:financiero'],
	'uses' => 'FinancieroController@index',
	'as'   => 'reporte.financiero'
]);

Route::get('repor-financiero/general/{rango}',[
	'middleware' => ['permission:general'],
	'uses' => 'FinancieroController@general',
	'as'   => 'reporte.financiero.general'
]);

Route::get('repor-financiero/sucursales/{rango}/{sucursal_id}',
	'FinancieroController@financiero_sucursales')
;

Route::get('repor-financiero/comparativo-anual/{year}',[
'uses' 	=> 'FinancieroController@financiero_comparativo',
'as'	=> 'reporte.financiero.comparativo'
]);

Route::post('repor-financiero/detalle',[
'uses'  => 'FinancieroController@detalle',
'as'    => 'reporte.financiero.detalle'
]);

