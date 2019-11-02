<?php


//FINANCIERO

//carga la vista principal de los reportes financieros

Route::get('financiero',[
        'uses' =>'FinancieroController@index',
        'as'=>'admin.reporte.financiero'
])->middleware('admin');

Route::get('repor-financiero',[
	'uses' => 'FinancieroController@index',
	'as'   => 'reporte.financiero'
])->middleware('admin');

Route::get('repor-financiero/general/{rango}',[
	'uses' => 'FinancieroController@general',
	'as'   => 'reporte.financiero.general'
])->middleware('admin');

Route::get('repor-financiero/sucursales/{rango}/{sucursal_id}',
		'FinancieroController@financiero_sucursales')
->middleware('admin');

Route::get('repor-financiero/comparativo-anual/{year}',[
	'uses' 	=> 'FinancieroController@financiero_comparativo',
	'as'	=> 'reporte.financiero.comparativo'
])->middleware('admin');

Route::post('repor-financiero/detalle',[
	'uses'  => 'FinancieroController@detalle',
	'as'    => 'reporte.financiero.detalle'
]);