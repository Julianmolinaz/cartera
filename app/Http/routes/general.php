<?php
use App\Cliente;
use App\Codeudor;

Route::get('/', function () {
    return view('welcome');
});

Route::get('set-sanciones','GeneradorController@set');

Route::get('detallado_ventas/{nombre}','ReporteController@descargarDetalladoVentas')
	->middleware('admin');

Route::get('ventas_cartera/{nombre}','ReporteController@descargarVentasCartera')
	->middleware('admin');



//FACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECRED

Route::get('start/fact_precreditos/create/{precredito_id}',[
	'uses' => 'FactPrecreditoController@create', 'as' => 'start.fact_precreditos.create'
]);
Route::get('start/precredito-invoice-print/{factura_id}',[
	'uses' => 'FactPrecreditoController@invoice_to_print',
	'as'   => 'start.precredito_factura.print']);

Route::post('start/fact_precreditos','FactPrecreditoController@store');




//OTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOS

Route::get('start/pagos/index_otros_ingresos',
	['uses' => 'PagoController@index_otros_ingresos', 'as' => 'start.pagos.index_otros_ingresos'])->middleware('otros_ingresos_listar');

Route::get('start/pagos/inicio',[ 'uses' => 'PagoController@inicio', 'as'   => 'start.pagos.inicio'	]);

Route::get('start/pagos/create',
	[ 'uses' => 'PagoController@create', 'as'   => 'start.pagos.create'	])->middleware('otros_ingresos_crear');

Route::get('start/pagos/hay_creditos/{doc}','PagoController@hay_creditos');





// Route::get('start/clientes/{clientes}/edit',
// 	['uses' => 'ClienteController@edit', 'as' => 'start.clientes.edit'])->middleware(['auth', 'admin',]);


Route::get('start/anuladas/index',[ 'uses' => 'AnuladaController@index', 'as'   => 'start.anuladas.index']);

//WIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKI

Route::get('wiki',[
	'uses'	=> 'WikiController@index',
	'as'	=> 'wiki'
]);
Route::get('wiki/{opcion}',[
	'uses'	=> 'WikiController@escuchar',
	'as'	=> 'wiki.opciones'
]);


Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']],function(){

	// USERS
	Route::get('users/get_users','UserController@getUsers');
	Route::resource('users','UserController');

	Route::resource('variables','VariableController',['only' =>['index','update']]);
	
	Route::resource('negocios','NegocioController');
	Route::get('negocios/{id}/destroy','NegocioController@destroy')->name('admin.negocios.destroy');
	Route::resource('productos','ProductoController');
	Route::resource('sanciones','SancionController');
	Route::resource('multas','MultaController');
	Route::resource('criteriocall','CriteriocallController');
  	Route::resource('anuladas','AnuladaController');
  	Route::resource('puntos','PuntoController');	

    Route::get('get-mensajes','VariableController@get_mensajes');
	  
	Route::post('data-asis',['uses' =>'DataAsisController@upload_excel','as' => 'data.data_asis']);

	//PROVEEDORES

	Route::get('proveedores/list','ProveedorController@list');
	Route::resource('proveedores','ProveedorController');

});

/*
|--------------------------------------------------------------------------
| Estado Cuenta
|--------------------------------------------------------------------------
*/

Route::get('admin/estado_cuenta/PDF/{credito_id}',[
	'uses' => 'EstadoCuentaController@getPDF',
	'as'   => 'admin.estado_cuenta.PDF'
]);

Route::get('admin/estado_cuenta/{credito_id}',[
	'uses' => 'EstadoCuentaController@getEstadoCuenta',
	'as'   => 'admin.get_estado_cuenta'	
]);


//GESTION DE CARTERA

Route::get('admin/gestion_cartera/index',[
	'uses'	=> 'GestionCarteraController@index',
	'as'    => 'admin.gestion_cartera.index'
]);

Route::get('admin/gestion_cartera/getCartera/{carteraId}','GestionCarteraController@getCartera');
Route::get('admin/gestion_cartera/get_info_puntos',[
	'uses' => 'GestionCarteraController@getPuntos',
    'as'   => 'admin.info_cartera_puntos']);
Route::get('admin/gestion_cartera/getCarteras','CarteraController@getCarteras');
Route::get('admin/gestion_cartera/get_info_carteras',[
	'uses' => 'GestionCarteraController@getInfoCarteras',
	'as'   => 'admin.info_carteras' ]);
Route::get('admin/gestion_cartera/flujo_de_caja',[
	'uses' => 'FlujocajaController@index',
	'as'   => 'admin.info_cartera.flujo_de_caja']);	
Route::get('admin/gestion_cartera/data_flujo_de_caja','FlujocajaController@getDataFlujo');
Route::post('admin/gestion_cartera/get_flujo_de_caja','FlujocajaController@getFlujoDeCaja');

Route::get('admin/reportes',['uses' => 'ReporteController@index', 'as' => 'admin.reportes.index'])
	->middleware('reporte_listar');

Route::post('admin/reportes',['uses' => 'ReporteController@store', 'as' => 'admin.reportes.store'])
	->middleware('reporte_generate');

//Route::resource('admin/reportes','ReporteController');

//ADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMIN


//REPORTES

Route::get('admin/reporte_centrales','ReporteController@centrales');


//REPORTESHISTORIALVENTAS

Route::post('admin/descargar_reporte_detallado_ventas','ReporteController@descargar');

Route::get('admin/marcar-cancelados/{tipo_reporte}', 
	[ 'uses' => 'ReporteController@marcar_cancelados', 'as' => 'admin.marcar_cancelados'])
	->middleware('admin');


//EGRESOS
Route::get('start/egresos_report','EgresoController@report');
Route::get('start/egresos/get_info','EgresoController@get_info');
Route::get('start/egresos/solicitudes','EgresoController@get_solicitudes');
Route::get('start/egresos/search/{string?}','EgresoController@search');
Route::get('start/egresos/get_data','EgresoController@get_data');
Route::get('start/egresos/get_egresos','EgresoController@get_egresos');
Route::resource('start/egresos','EgresoController');

Route::get('start/egresos/{id}/destroy','EgresoController@destroy')->middleware('admin');

//ELIMINAR
Route::get('start/egresos/{id}/destroy',
	['uses'	=> 'EgresoController@destroy','as'	=> 'start.egresos.destroy']);



Route::get('admin/criteriocall/{id}/destroy',
	['uses'	=> 'CriteriocallController@destroy','as'=> 'admin.criteriocall.destroy'])->middleware('admin');

Route::get('admin/puntos/{id}/destroy',
	['uses'	=> 'PuntoController@destroy','as'	=> 'admin.puntos.destroy'])->middleware('admin');


Route::get('admin/listall/{page?}',
	['uses' => 'CriteriocallController@listall', 'as' => 'admin.listall']);

Route::get('admin/puntos_listall/{page?}',
	['uses' => 'PuntoController@listall', 'as' => 'admin.puntos.listall']);

Route::get('admin/users/{id}/destroy',[
	'uses'	=> 'UserController@destroy',
	'as'	=> 'admin.users.destroy'
	])->middleware(['auth', 'admin']);

Route::get('admin/carteras/{id}/destroy',[
	'uses'	=> 'CarteraController@destroy',
	'as'	=> 'admin.carteras.destroy'
	])->middleware(['auth', 'admin']);

Route::resource('log','LogController');

Route::get('logout',[
	'uses'	=> 'LogController@logout',
	'as'	=> 'logout'
	]);

//ZONAS

Route::get('admin/zonas',['uses'  => 'ZonaController@index','as'=> 'admin.zonas']);
Route::post('admin/zonas','ZonaController@store');
Route::put('admin/zonas/{zona_id}','ZonaController@update');
Route::get('admin/getZonas','ZonaController@getZonas');


//INICIOINICIOINICIOINICIOINICIOINICIOINICIOINICIOINICIOINICIOINICIOINICIOINICIOINICIOINICIO

Route::get('start/inicio/index',[
	'uses'	=> 'InicioController@index',
	'as' 	=> 'start.inicio.index'
]);
Route::get('start/inicio/buscar/{string}',[
	'uses' 	=> 'InicioController@buscar',
	'as'	=> 'start.inicio.buscar'
]);

Route::post('admin/multas/concepto','MultaController@concepto')->middleware(['auth', 'admin']);
Route::post('start/pagos/insert_pago','PagoController@insertar_pago');
Route::post('start/pagos','PagoController@store');

//consultar listado de municipios
Route::get('admin/municipios/cargar','PuntoController@cargar');

//CREAR SANCIONES

Route::post('admin/sanciones/crear_sanciones','SancionController@crearSanciones');


//API

Route::get('api/cuenta/{cedula}','ConsultaController@cuenta');

Route::get('api/solicitud/{precredito_id}','ConsultaController@solicitud');

$GLOBALS['a'] = array();

Route::get('prueba', function(){
	array_push($GLOBALS['a'],'hola_mundo');
	return $GLOBALS['a'];
});

Route::group(['prefix' => 'data'],function(){
	Route::get('egresos','DatatableController@egresos');
});

/*
|--------------------------------------------------------------------------
| Caja
|--------------------------------------------------------------------------
*/

Route::get('start/cajas',[
	'uses' => 'CajaController@index',
	'as'   => 'start.cajas.index'
]);

Route::get('start/cajas/report/{date}','CajaController@get_cash_report');
Route::get('start/all_cajas/report/{date}','CajaController@get_cashes_report');
Route::get('start/ventas_mes/report/{date}','CajaController@ventas_mes');
/*
|--------------------------------------------------------------------------
| PrecredPagos
|--------------------------------------------------------------------------
*/

Route::get('start/precred_pagos/{fact_precredito_id}',[
	'uses'   => 'PrecredPagosController@show',
	'as' => 'start.precred_pagos.show'
])->middleware(['auth']);

Route::post('start/anular_precred_pagos',[
	'uses'   => 'PrecredPagosController@anular',
	'as' => 'start.precred_pagos.anular'
])->middleware(['auth', 'admin']);

// ANOTACIONES

Route::get('admin/anotaciones/{credito_id}',['uses' => 'AnotacionController@index','as' => 'admin.anotaciones.index']);
Route::post('admin/anotaciones','AnotacionController@store');
Route::put('admin/anotaciones/{anotacion_id}','AnotacionController@update');
Route::get('admin/anotaciones/{proceso_id}/list','AnotacionController@list');

// MUNICIPIOS

Route::get('municipios/index','MunicipioController@index');


// PROCESOS

Route::post('admin/procesos','ProcesoController@store');
Route::put('admin/procesos/{proceso_id}','ProcesoController@update');

Route::get('123', function(){
	$m  = DB::table('municipios')->get();
	$m2 = DB::table('municipios2')
			->join('departamentos','municipios2.departamento_id','=','departamentos.id')
			->select('municipios2.id as id',
					 'municipios2.nombre as nombre',
					 'departamentos.nombre as departamento',
					 'departamentos.id as departamento_id')
			->get();
	$count = 0;

	DB::beginTransaction();

	try{

		foreach($m as $mas){ 
			$count++;
			foreach($m2 as $m2as){ 
				if($mas->nombre === $m2as->nombre && $mas->departamento == $m2as->departamento){ 
					echo $mas->nombre.'/'.$mas->departamento.' = '.$m2as->nombre.'/'.$m2as->departamento.'<br>'; 
					DB::table('municipios2')
						->where('id',$m2as->id)
						->update(['codigo' => $mas->codigo_municipio]);
	
					DB::table('departamentos')
						->where('id',$m2as->departamento_id)
						->update(['codigo' => $mas->codigo_departamento]);
				} 
			}
			DB::commit(); 
		}
		echo $count;
	} catch(\Exception $e){
		DB::rollback();
		dd($e);
	}

});



