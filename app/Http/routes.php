<?php

require __DIR__ . '/routes/variables.php';

require __DIR__ . '/routes/carteras.php';

require __DIR__ . '/routes/general.php';

require __DIR__ . '/routes/simulador.php';

require __DIR__ . '/routes/financiero.php';

require __DIR__ . '/routes/clientes.php';

require __DIR__ . '/routes/callcenter.php';

require __DIR__ . '/routes/contabilidad.php';

require __DIR__ . '/routes/creditos.php';

require __DIR__ . '/routes/precreditos.php';

require __DIR__ . '/routes/estudios.php';

require __DIR__ . '/routes/pago_creditos.php';

require __DIR__ . '/routes/ref_productos.php';

require __DIR__ . '/routes/permisos.php';

require __DIR__ . '/routes/roles.php';

require __DIR__ . '/routes/codeudores.php';

require __DIR__ . '/routes/otros_pagos.php';

require __DIR__ . '/routes/pago_solicitudes.php';

require __DIR__ . '/routes/egresos.php';

require __DIR__ . '/routes/multas.php';

require __DIR__ . '/routes/gestion_carteras.php';

require __DIR__ . '/routes/negocios.php';

require __DIR__ . '/routes/users.php';

require __DIR__ . '/routes/puntos.php';

require __DIR__ . '/routes/zonas.php';

require __DIR__ . '/routes/productos.php';

require __DIR__ . '/routes/criteriocall.php';

require __DIR__ . '/routes/reportes.php';

require __DIR__ . '/routes/conyuges.php';





// //CODEUDORES

// Route::resource('start/codeudores','CodeudorController');

// Route::get('start/codeudores/create/{cliente_id}','CodeudorController@create')
// 		->name('start.codeudores.create');

// Route::get('start/codeudores/destroy/{cliente_id}','CodeudorController@destroy')
// 		->name('start.codeudores.destroy');

// //CALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTER

// // //CALLCENTER LISTAR TODOS LOS CREDITOS
// // Route::get('call',
// // 	['uses' => 'CallcenterController@index','as'=> 'call.index']);

// // //CALLCENTER LISTAR TODOS LOS MOROSOS
// // Route::get('call/morosos',
// // 	['uses' => 'CallcenterController@list_morosos','as'=> 'call.morosos']);

// // //CALLCENTER LISTAR TODOS LOS AGENDADOS
// // Route::get('call/agendados',
// // 	['uses' => 'CallcenterController@list_agendados','as'=> 'call.agendados']);

// // Route::get('call/miscall',[
// // 	'uses'	=> 'CallcenterController@misCall',
// // 	'as'	=> 'call.miscall'
// // 	]);

// // //CALLCENTER VER
// // Route::get('call/{call}',
// // 	['uses' => 'CallcenterController@show','as'=> 'call.show']);

// // //CALLCENTER CREAR

// // Route::post('call/call_create','CallcenterController@call_create');


// Route::get('call/{tipo}/busqueda', 'CallcenterController@busqueda');

// Route::get('call/{id}/consultar','CallcenterController@consultar_credito');

// Route::get('call/{id}/index_unique',[
// 	'uses' 	=> 'CallcenterController@index_unique',
// 	'as'	=> 'call.index_unique'
// ]);

// //EXPORTAR TODOS LOS CREDITOS CALLCENTER
// Route::get('call/exportar/todo/{todos?}',[
// 	'uses'	=> 'CallcenterController@ExportarTodo',
// 	'as'	=> 'call.exportar.todo'
// 	]);

// Route::get('call/exportar/soat',[
// 	'uses'	=> 'CallcenterController@soat',
// 	'as'	=> 'call.exportar.soat'
// 	]);



// //FACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECRED

// Route::get('start/fact_precreditos/create/{precredito_id}',[
// 	'uses' => 'FactPrecreditoController@create', 
// 	'as' => 'start.fact_precreditos.create'
// ]);
// Route::get('start/precredito-invoice-print/{factura_id}',[
// 	'uses' => 'FactPrecreditoController@invoice_to_print',
// 	'as'   => 'start.precredito_factura.print']);

// Route::post('start/fact_precreditos','FactPrecreditoController@store');




// //WIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKI

// Route::get('wiki',[
// 	'uses'	=> 'WikiController@index',
// 	'as'	=> 'wiki'
// ]);
// Route::get('wiki/{opcion}',[
// 	'uses'	=> 'WikiController@escuchar',
// 	'as'	=> 'wiki.opciones'
// ]);


// Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']],function(){

// 	// USERS
// 	Route::get('users/get_users','UserController@getUsers');
// 	Route::resource('users','UserController');
	
// 	// Route::resource('carteras','CarteraController');
// 	Route::resource('negocios','NegocioController');
// 	Route::get('negocios/{id}/destroy','NegocioController@destroy')->name('admin.negocios.destroy');
// 	Route::resource('productos','ProductoController');
// 	Route::resource('sanciones','SancionController');
// 	Route::resource('multas','MultaController');
// 	Route::resource('criteriocall','CriteriocallController');
//   	Route::resource('anuladas','AnuladaController');
//   	Route::resource('puntos','PuntoController');	
	  
// 	Route::post('data-asis',['uses' =>'DataAsisController@upload_excel','as' => 'data.data_asis']);

// 	//PROVEEDORES

// 	Route::get('proveedores/list','ProveedorController@list');
// 	Route::resource('proveedores','ProveedorController');

// });

// /*
// |--------------------------------------------------------------------------
// | Estado Cuenta
// |--------------------------------------------------------------------------
// */

// Route::get('admin/estado_cuenta/PDF/{credito_id}',[
// 	'uses' => 'EstadoCuentaController@getPDF',
// 	'as'   => 'admin.estado_cuenta.PDF'
// ]);

// Route::get('admin/estado_cuenta/{credito_id}',[
// 	'uses' => 'EstadoCuentaController@getEstadoCuenta',
// 	'as'   => 'admin.get_estado_cuenta'	
// ]);


// //GESTION DE CARTERA


// Route::get('admin/reportes',['uses' => 'ReporteController@index', 'as' => 'admin.reportes.index']);

// Route::post('admin/reportes',['uses' => 'ReporteController@store', 'as' => 'admin.reportes.store']);

// //Route::resource('admin/reportes','ReporteController');

// //ADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMIN


// //REPORTES

// Route::get('admin/reporte_centrales','ReporteController@centrales');


// //REPORTESHISTORIALVENTAS

// Route::post('admin/descargar_reporte_detallado_ventas','ReporteController@descargar');

// Route::get('admin/marcar-cancelados/{tipo_reporte}', 
// 	[ 'uses' => 'ReporteController@marcar_cancelados', 'as' => 'admin.marcar_cancelados'])
// 	;






// Route::get('admin/criteriocall/{id}/destroy',
// 	['uses'	=> 'CriteriocallController@destroy','as'=> 'admin.criteriocall.destroy']);

// Route::get('admin/puntos/{id}/destroy',
// 	['uses'	=> 'PuntoController@destroy','as'	=> 'admin.puntos.destroy']);


// Route::get('admin/listall/{page?}',
// 	['uses' => 'CriteriocallController@listall', 'as' => 'admin.listall']);

// Route::get('admin/puntos_listall/{page?}',
// 	['uses' => 'PuntoController@listall', 'as' => 'admin.puntos.listall']);

// Route::get('admin/users/{id}/destroy',[
// 	'uses'	=> 'UserController@destroy',
// 	'as'	=> 'admin.users.destroy'
// 	]);

// Route::get('admin/carteras/{id}/destroy',[
// 	'uses'	=> 'CarteraController@destroy',
// 	'as'	=> 'admin.carteras.destroy'
// 	]);

Route::resource('log','LogController');

// Route::get('logout',[
// 	'uses'	=> 'LogController@logout',
// 	'as'	=> 'logout'
// 	]);

// //ZONAS

// Route::get('admin/zonas',['uses'  => 'ZonaController@index','as'=> 'admin.zonas']);
// Route::post('admin/zonas','ZonaController@store');
// Route::put('admin/zonas/{zona_id}','ZonaController@update');
// Route::get('admin/getZonas','ZonaController@getZonas');


// //INICIOINICIOINICIOINICIOINICIOINICIOINICIOINICIOINICIOINICIOINICIOINICIOINICIOINICIOINICIO

// Route::get('start/inicio/index',[
// 	'uses'	=> 'InicioController@index',
// 	'as' 	=> 'start.inicio.index'
// ]);
// Route::get('start/inicio/buscar/{string}',[
// 	'uses' 	=> 'InicioController@buscar',
// 	'as'	=> 'start.inicio.buscar'
// ]);


// Route::post('start/pagos/insert_pago','PagoController@insertar_pago');
// Route::post('start/pagos','PagoController@store');

// //consultar listado de municipios
// Route::get('admin/municipios/cargar','PuntoController@cargar');

// //CREAR SANCIONES

// Route::post('admin/sanciones/crear_sanciones','SancionController@crearSanciones');


// //API

// Route::get('api/cuenta/{cedula}','ConsultaController@cuenta');

// Route::get('api/solicitud/{precredito_id}','ConsultaController@solicitud');

// $GLOBALS['a'] = array();

// Route::get('prueba', function(){
// 	array_push($GLOBALS['a'],'hola_mundo');
// 	return $GLOBALS['a'];
// });

// Route::group(['prefix' => 'data'],function(){
// 	Route::get('egresos','DatatableController@egresos');
// });

// /*
// |--------------------------------------------------------------------------
// | Caja
// |--------------------------------------------------------------------------
// */

// Route::get('start/cajas',[
// 	'uses' => 'CajaController@index',
// 	'as'   => 'start.cajas.index'
// ]);

// Route::get('start/cajas/report/{date}','CajaController@get_cash_report');
// Route::get('start/all_cajas/report/{date}','CajaController@get_cashes_report');


// /*
// |--------------------------------------------------------------------------
// | PrecredPagos
// |--------------------------------------------------------------------------
// */

// Route::get('start/precred_pagos/{fact_precredito_id}',[
// 	'uses'   => 'PrecredPagosController@show',
// 	'as' => 'start.precred_pagos.show'
// ]);

// Route::post('start/anular_precred_pagos',[
// 	'uses'   => 'PrecredPagosController@anular',
// 	'as' => 'start.precred_pagos.anular'
// ]);

// // ANOTACIONES

// Route::get('admin/anotaciones/{credito_id}',['uses' => 'AnotacionController@index','as' => 'admin.anotaciones.index']);
// Route::post('admin/anotaciones','AnotacionController@store');
// Route::put('admin/anotaciones/{anotacion_id}','AnotacionController@update');
// Route::get('admin/anotaciones/{proceso_id}/list','AnotacionController@list');

// // MUNICIPIOS

// Route::get('municipios/index','MunicipioController@index');


// // PROCESOS

// Route::post('admin/procesos','ProcesoController@store');
// Route::put('admin/procesos/{proceso_id}','ProcesoController@update');

// Route::get('123', function(){

//    request()->session()->has('flash');
// });

