<?php

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




// SIMULADORSIMULADORSIMULADORSIMULADORSIMULADORSIMULADOR

Route::get('start/simulador',[
	'uses' 	=> 'SimuladorController@index',
	'as'	=> 'start.simulador.index'
	])->middleware('simulador');

Route::post('start/simulador',[
	'uses' 	=> 'SimuladorController@store',
	'as'	=> 'start.simulador.store'
	])->middleware('simulador');






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







//ESTUDIOSESTUDIOSESTUDIOSESTUDIOSESTUDIOSESTUDIOSESTUDIOSESTUDIOSESTUDIOSESTUDIOSESTUDIOS


Route::get('start/estudios/cliente/{id_cliente}/codeudor/{id_codeudor}/create/{obj}',[
	'uses'	=> 'EstudioController@create',
	'as'	=> 'start.estudios.create'
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
]);

//CREAR REFINANCIACION
Route::post('start/creditos/crear_refinanciacion',[
	'uses' => 'CreditoController@crear_refinanciacion',
	'as'   => 'start/creditos/crear_refinanciacion'
	]);

Route::get('start/creditos/cancelados',[
	'uses' => 'CreditoController@cancelados',
	'as'   => 'start.creditos.cancelados'	
]);


//CALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTER

//CALLCENTER LISTAR
Route::get('call',
	['uses' => 'CallcenterController@index','as'=> 'call.index']);

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

Route::get('start/facturas/{id}/consultar_factura','FacturaController@consultar_factura');
Route::post('start/facturas/fecha_pago','FacturaController@fecha_pago');
Route::post('start/facturas/abonos','FacturaController@abonos');






//PAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOSPAGOS

//PAGOS LISTAR

Route::get('start/pagos',['uses' => 'FacturaController@pagos','as'   => 'start.pagos'])->middleware('pagos_listar');







//OTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOSOTROSPAGOS

Route::get('start/pagos/index_otros_ingresos',
	['uses' => 'PagoController@index_otros_ingresos', 'as' => 'start.pagos.index_otros_ingresos'])->middleware('otros_ingresos_listar');

Route::get('start/pagos/inicio',[ 'uses' => 'PagoController@inicio', 'as'   => 'start.pagos.inicio'	]);

Route::get('start/pagos/create',
	[ 'uses' => 'PagoController@create', 'as'   => 'start.pagos.create'	])->middleware('otros_ingresos_crear');

Route::get('start/pagos/hay_creditos/{doc}','PagoController@hay_creditos');







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





Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']],function(){

	Route::resource('users','UserController');
	Route::resource('variables','VariableController');
	Route::resource('carteras','CarteraController');
	Route::resource('productos','ProductoController');
	Route::resource('sanciones','SancionController');
	Route::resource('multas','MultaController');
	Route::resource('reportes','ReporteController');
	Route::resource('criteriocall','CriteriocallController');
  	Route::resource('anuladas','AnuladaController');
  	Route::resource('puntos','PuntoController');	
});


//ADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMIN


//REPORTESREPORTESREPORTESREPORTESREPORTESREPORTESREPORTESREPORTESREPORTESREPORTESREPORTESREPORTES

Route::get('admin/reporte_centrales','ReporteController@centrales');


//EGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOS

//LISTAR
Route::get('admin/egresos',
	['uses' => 'EgresoController@index', 'as' => 'admin.egresos.index'])->middleware('egresos_listar');


Route::get('admin/egresos/listar/egresos',
	['uses' => 'EgresoController@listar_egresos', 'as' => 'admin.egresos.listar.egresos'])->middleware('egresos_listar');

//CREAR
Route::get('admin/egresos/create',
	['uses' => 'EgresoController@create','as' => 'admin.egresos.create'])->middleware('egresos_crear');

Route::post('admin/egresos',
	['uses' => 'EgresoController@store', 'as' => 'admin.egresos.store'])->middleware('egresos_crear');

//EDITAR
Route::get('admin/egresos/{egreso}/edit',
	['uses' => 'EgresoController@edit','as' => 'admin.egresos.edit'])->middleware('egresos_editar');

Route::put('admin/egresos/{egreso}',
	['uses' => 'EgresoController@update','as' => 'admin.egresos.update'])->middleware('egresos_editar');

//ELIMINAR
Route::get('admin/egresos/{id}/destroy',
	['uses'	=> 'EgresoController@destroy','as'	=> 'admin.egresos.destroy'])->middleware('egresos_eliminar');



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


