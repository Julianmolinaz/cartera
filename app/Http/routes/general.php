<?php
use App\Cliente;
use App\Codeudor;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test','TestController@make');

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

// MUNICIPIOS

Route::get('municipios/index','MunicipioController@index');


// PROCESOS

Route::post('admin/procesos','ProcesoController@store');
Route::put('admin/procesos/{proceso_id}','ProcesoController@update');



