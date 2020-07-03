<?php
use App\Cliente;
use App\Codeudor;

Route::get('/', function () {
    return view('welcome');
});

Route::get('set-sanciones','GeneradorController@set');

// Route::get('detallado_ventas/{nombre}','ReporteController@descargarDetalladoVentas')
// 	;

// Route::get('ventas_cartera/{nombre}','ReporteController@descargarVentasCartera')
// 	;









//WIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKIWIKI

Route::get('wiki',[
	'uses'	=> 'WikiController@index',
	'as'	=> 'wiki'
]);
Route::get('wiki/{opcion}',[
	'uses'	=> 'WikiController@escuchar',
	'as'	=> 'wiki.opciones'
]);


Route::group(['prefix' => 'admin'],function(){
	
	
	Route::resource('productos','ProductoController');
	Route::resource('sanciones','SancionController');
  	Route::resource('anuladas','AnuladaController');
	  
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



//ADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMINADMIN


//REPORTES

// // Route::get('admin/reporte_centrales','ReporteController@centrales');


// REPORTESHISTORIALVENTAS

// // Route::post('admin/descargar_reporte_detallado_ventas','ReporteController@descargar');




Route::get('admin/carteras/{id}/destroy',[
	'uses'	=> 'CarteraController@destroy',
	'as'	=> 'admin.carteras.destroy'
	]);

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
]);

Route::post('start/anular_precred_pagos',[
	'uses'   => 'PrecredPagosController@anular',
	'as' => 'start.precred_pagos.anular'
]);

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



