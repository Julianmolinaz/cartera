<?php
use App\Cliente;
use App\Codeudor;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('set-sanciones','GeneradorController@set');

Route::get('detallado_ventas/{nombre}','ReporteController@descargarDetalladoVentas')
	->middleware('admin');

Route::get('ventas_cartera/{nombre}','ReporteController@descargarVentasCartera')
	->middleware('admin');

//FINANCIERO

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

// SIMULADORSIMULADORSIMULADORSIMULADORSIMULADORSIMULADOR

Route::get('start/simulador',[
	'uses' 	=> 'SimuladorController@index',
	'as'	=> 'start.simulador.index'
	])->middleware('simulador');

Route::post('start/simulador',[
	'uses' 	=> 'SimuladorController@store',
	'as'	=> 'start.simulador.store'
	])->middleware('simulador');

//FINANCIERO

//carga la vista principal de los reportes financieros

Route::get('financiero',
	['uses' =>'FinancieroController@index','as'=>'admin.reporte.financiero'])
	->middleware('admin');

// CLIENTESCLIENTESCLIENTESCLIENTESCLIENTESCLIENTESCLIENTES

//CLIENTES LISTAR
Route::get('start/clientes',
	['uses' => 'ClienteController@index','as'=> 'start.clientes.index'])->middleware('clientes_listar');

//CLIENTE GUARDAR
Route::post('start/clientes',
	['uses' => 'ClienteController@store','as'=> 'start.clientes.store'	])->middleware('clientes_guardar');

//CLIENTE CREAR
Route::get('start/clientes/create',
	['uses' 	=> 'ClienteController@create','as'=> 'start.clientes.create'])->middleware('clientes_crear');

//CLIENTE VER
Route::get('start/clientes/{cliente}',
	['uses' => 'ClienteController@show','as'=> 'start.clientes.show'])->middleware('clientes_ver');

//CLIENTE EDITAR
Route::get('start/clientes/{cliente}/edit',
	['uses' => 'ClienteController@edit','as'=> 'start.clientes.edit'])->middleware('clientes_editar');

//CLIENTE ACTUALIZAR
Route::put('start/clientes/{cliente}',
	['uses' => 'ClienteController@update','as'=> 'start.clientes.update'])->middleware('clientes_actualizar');

Route::get('start/clientes/{id}/consultar_codeudor',[
	'uses'	=> 'ClienteController@consultar_codeudor',
	'as'	=> 'start.clientes.consulta_codeudor'
	]);

//CLIENTE BORRAR

Route::get('start/clientes/{id}/destroy',
	['uses'	=> 'ClienteController@destroy','as'	=> 'start.clientes.destroy'])->middleware('clientes_borrar');

//ESTUDIOS


Route::get('start/estudios/cliente/{id_cliente}/codeudor/{id_codeudor}/create/{obj}',[
	'uses'	=> 'EstudioController@create',
	'as'	=> 'start.estudios.create'
	])->middleware('estudios_crear');


Route::post('estudios-ref',[
	'uses'	=> 'EstudioController@store_ref',
	'as'	=> 'start.estudios.create.ref'
	])->middleware('estudios_crear');

Route::put('estudios-ref',[
	'uses'	=> 'EstudioController@update_ref',
	'as'	=> 'start.estudios.create.ref'
	])->middleware('estudios_crear');

Route::resource('estudios','EstudioController');

//ESTUDIO GUARDAR
Route::post('start/estudios',
	['uses' => 'EstudioController@store','as'=> 'start.estudios.store'	])->middleware('estudios_guardar');


//ESTUDIOS ACTUALIZAR
Route::put('start/estudios/{estudio}',
	['uses' => 'EstudioController@update','as'=> 'start.estudios.update'])->middleware('estudios_actualizar');





//CREDITOSCREDITOSCREDITOSCREDITOSCREDITOSCREDITOSCREDITOSCREDITOSCREDITOSCREDITOS

//CREDITOS LISTAR
Route::get('start/creditos',
	['uses' => 'CreditoController@index','as'=> 'start.creditos.index'])->middleware('creditos_listar');

// //CREDITOS CREAR
// Route::get('start/creditos/create',
// 	['uses' 	=> 'CreditoController@create','as'=> 'start.creditos.create'])->middleware('creditos_crear');

//CREDITOS ACTUALIZAR
Route::put('start/creditos/{credito}',
	['uses' => 'CreditoController@update','as'=> 'start.creditos.update'])->middleware('creditos_actualizar');

//CREDITOS EDITAR
Route::get('start/creditos/{credito}/edit',
	['uses' => 'CreditoController@edit','as'=> 'start.creditos.edit'])->middleware('creditos_editar');


//CREDITOS CREAR
Route::get('start/creditos/create/{id}',[
	'uses' => 'CreditoController@create',
	'as'   => 'start.creditos.create'
	])->middleware('creditos_crear');

//CREDITOS  REFINANCIAR
Route::get('start/creditos/{id}/refinanciar',[
	'uses' => 'CreditoController@refinanciar',
	'as'   => 'start.creditos.refinanciar'
])->middleware('refinanciacion');;

//CREAR REFINANCIACION
Route::post('start/creditos/crear_refinanciacion',[
	'uses' => 'CreditoController@crear_refinanciacion',
	'as'   => 'start/creditos/crear_refinanciacion'
	])->middleware('refinanciacion');;
//LISTAR CREDITOS CANCELADOS
Route::get('start/creditos/cancelados',[
	'uses' => 'CreditoController@cancelados',
	'as'   => 'start.creditos.cancelados'	
])->middleware('refinanciacion');;
//EXPORTAR TODOS LOS CREDITOS
Route::get('start/creditos/exportar_todo',[
	'uses'	=> 'CreditoController@ExportarTodo',
	'as'	=> 'start.creditos.exportar_todo'
	])->middleware('refinanciacion');;

//CONYUGES

Route::resource('start/conyuges','ConyugeController');

Route::get('start/conyuges/create/{cliente_id}/{tipo}','ConyugeController@create')
		->name('start.conyuges.create');

Route::get('start/conyuges/{cliente_id}/{tipo}/edit','ConyugeController@edit')
		->name('start.conyuges.edit');

Route::get('start/conyuges/destroy/{cliente_id}/{tipo}','ConyugeController@destroy')
		->name('start.conyuges.destroy');


//CODEUDORES

Route::resource('start/codeudores','CodeudorController');

Route::get('start/codeudores/create/{cliente_id}','CodeudorController@create')
		->name('start.codeudores.create');

Route::get('start/codeudores/destroy/{cliente_id}','CodeudorController@destroy')
		->name('start.codeudores.destroy');

//CALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTER

//CALLCENTER LISTAR TODOS LOS CREDITOS
Route::get('call',
	['uses' => 'CallcenterController@index','as'=> 'call.index']);

//CALLCENTER LISTAR TODOS LOS MOROSOS
Route::get('call/morosos',
	['uses' => 'CallcenterController@list_morosos','as'=> 'call.morosos']);

//CALLCENTER LISTAR TODOS LOS AGENDADOS
Route::get('call/agendados',
	['uses' => 'CallcenterController@list_agendados','as'=> 'call.agendados']);

Route::get('call/miscall',[
	'uses'	=> 'CallcenterController@misCall',
	'as'	=> 'call.miscall'
	]);

//CALLCENTER VER
Route::get('call/{call}',
	['uses' => 'CallcenterController@show','as'=> 'call.show']);

//CALLCENTER CREAR

Route::post('call/call_create','CallcenterController@call_create');


Route::get('call/{tipo}/busqueda', 'CallcenterController@busqueda');

Route::get('call/{id}/consultar','CallcenterController@consultar_credito');

Route::get('call/{id}/index_unique',[
	'uses' 	=> 'CallcenterController@index_unique',
	'as'	=> 'call.index_unique'
]);

//EXPORTAR TODOS LOS CREDITOS CALLCENTER
Route::get('call/exportar/todo/{todos?}',[
	'uses'	=> 'CallcenterController@ExportarTodo',
	'as'	=> 'call.exportar.todo'
	]);

Route::get('call/exportar/soat',[
	'uses'	=> 'CallcenterController@soat',
	'as'	=> 'call.exportar.soat'
	]);

//FACTURASFACTURASFACTURASFACTURASFACTURASFACTURASFACTURASFACTURASFACTURASFACTURASFACTURAS

//FACTURAS LISTAR
Route::get('start/facturas',
	['uses' => 'FacturaController@index','as'=> 'start.facturas.index'])->middleware('facturas_listar');

//FACTURAS GUARDAR
Route::post('start/facturas',
	['uses' => 'FacturaController@store','as'=> 'start.facturas.store'])->middleware('facturas_guardar');

//FACTURAS CREAR
Route::get('start/facturas/create/{id}',
	['uses' => 'FacturaController@create','as' => 'start.facturas.create'])->middleware('facturas_crear');

//FACTURAS VER
Route::get('start/facturas/{factura}',
	['uses' => 'FacturaController@show','as'=> 'start.facturas.show'])->middleware('facturas_ver');

//FACTURAS EDITAR
Route::get('start/facturas/{factura}/edit',
	['uses' => 'FacturaController@edit','as'=> 'start.facturas.edit']);

//FACTURAS ACTUALIZAR
Route::put('start/facturas/{factura}',
	['uses' => 'FacturaController@update','as'=> 'start.facturas.update']);

Route::get('start/factura_pdf/{factura_id}',
	['uses' => 'FacturaController@get_pdf','as' => 'start.facturas.pdf']);

Route::get('start/facturas/{id}/consultar_factura','FacturaController@consultar_factura');
Route::post('start/facturas/fecha_pago','FacturaController@fecha_pago');
Route::post('start/facturas/abonos','FacturaController@abonos');


//FACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECREDFACTPRECRED

Route::get('start/fact_precreditos/create/{precredito_id}',[
	'uses' => 'FactPrecreditoController@create', 'as' => 'start.fact_precreditos.create'
]);
Route::get('start/precredito-invoice-print/{factura_id}',[
	'uses' => 'FactPrecreditoController@invoice_to_print',
	'as'   => 'start.precredito_factura.print']);

Route::post('start/fact_precreditos','FactPrecreditoController@store');



//PAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOS

//PAGOS LISTAR

Route::get('start/pagos',['uses' => 'FacturaController@pagos','as'   => 'start.pagos'])->middleware('pagos_listar');

Route::get('start/invoice-print/{factura_id}',[
	'uses' => 'FacturaController@invoice_to_print',
	'as'   => 'start.factura.print'])
->middleware('facturas_listar');

//OTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOS

Route::get('start/pagos/index_otros_ingresos',
	['uses' => 'PagoController@index_otros_ingresos', 'as' => 'start.pagos.index_otros_ingresos'])->middleware('otros_ingresos_listar');

Route::get('start/pagos/inicio',[ 'uses' => 'PagoController@inicio', 'as'   => 'start.pagos.inicio'	]);

Route::get('start/pagos/create',
	[ 'uses' => 'PagoController@create', 'as'   => 'start.pagos.create'	])->middleware('otros_ingresos_crear');

Route::get('start/pagos/hay_creditos/{doc}','PagoController@hay_creditos');


//DOCUMENTOS
Route::put('start/documentos/{objeto_relacionado}',
	['uses' => 'DocumentoController@set_documento',
	 'as' => 'start.documentos.upload']);
	
Route::get('start/documentos/{documento_id}/get/{nombre}',
	['uses' => 'DocumentoController@get_documento',
	 'as' => 'start.documentos.get_documento']);

Route::get('start/documentos/{documento_id}/destroy',
	 ['uses' => 'DocumentoController@destroy',
	  'as' => 'start.documentos.destroy']);
 

//PRECREDITOSPRECREDITOSPRECREDITOSPRECREDITOSPRECREDITOSPRECREDITOSPRECREDITOSPRECREDITOS


//PRECREDITOS LISTAR
Route::get('start/precreditos',
	['uses' => 'PrecreditoController@index','as'=> 'start.precreditos.index'])->middleware('precreditos_listar');

//PRECREDITOS CREAR
Route::get('start/precreditos/{cliente}',
	['uses' => 'PrecreditoController@show','as'=> 'start.precreditos.show'])->middleware('precreditos_crear');

//PRECREDITOS EDITAR
Route::get('start/precreditos/{cliente}/edit',
	['uses' => 'PrecreditoController@edit','as'=> 'start.precreditos.edit'])->middleware('precreditos_editar');

//PRECREDITOS ACTUALIZAR
Route::put('start/precreditos/{cliente}',
	['uses' => 'PrecreditoController@update','as'=> 'start.precreditos.update']);

//PRECREDITOS GUARDAR
Route::post('start/precreditos',
	['uses' => 'PrecreditoController@store','as'=> 'start.precreditos.store']);

//PRECREDITOS VER
Route::get('start/precreditos/{id}/ver',['uses'	=> 'PrecreditoController@ver','as'=> 'start.precreditos.ver'
	])->middleware('precreditos_ver');



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

	Route::resource('users','UserController');
	Route::resource('variables','VariableController',['only' =>['index','update']]);
	Route::resource('carteras','CarteraController');
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

//GESTION DE CARTERA

Route::get('admin/gestion_cartera/index',[
	'uses'	=> 'GestionCarteraController@index',
	'as'    => 'admin.gestion_cartera.index'
]);

Route::get('admin/gestion_cartera/getCartera/{carteraId}','GestionCarteraController@getCartera');
Route::get('admin/gestion_cartera/getCarteras','CarteraController@getCarteras');

Route::get('admin/reportes',['uses' => 'ReporteController@index', 'as' => 'admin.reportes.index'])
	->middleware('reporte_listar');

Route::post('admin/reportes',['uses' => 'ReporteController@store', 'as' => 'admin.reportes.store'])
	->middleware('reporte_generate');

//Route::resource('admin/reportes','ReporteController');

//ADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMIN


//REPORTESREPORTESREPORTESREPORTESREPORTESREPORTESREPORTESREPORTESREPORTESREPORTESREPORTESREPORTES

Route::get('admin/reporte_centrales','ReporteController@centrales');

//REPORTESHISTORIALVENTAS

Route::post('admin/descargar_reporte_detallado_ventas','ReporteController@descargar');

Route::get('admin/marcar-cancelados/{tipo_reporte}', 
	[ 'uses' => 'ReporteController@marcar_cancelados', 'as' => 'admin.marcar_cancelados'])
	->middleware('admin');


//EGRESOS

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