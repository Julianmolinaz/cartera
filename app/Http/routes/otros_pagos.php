<?php

// LISTAR OTROS INGRESOS

Route::get('start/pagos/index_otros_ingresos',[
    'middleware' => ['permission:hacer_otro_ingreso'],
    'uses' => 'PagoController@index_otros_ingresos', 
    'as' => 'start.pagos.index_otros_ingresos'
]);

// MUESTRA LA VISTA DE OTROS INGRESOS

Route::get('start/pagos/inicio',[ 
    'middleware' => ['permission:registrar_otros_ingresos'],
    'uses' => 'PagoController@inicio', 
    'as'   => 'start.pagos.inicio'	
]);

// AGREGAR OTRO INGRESO

Route::get('start/pagos/create',[ 
    'middleware' => ['permission:registrar_otros_ingresos'],
    'uses' => 'PagoController@create', 
    'as'   => 'start.pagos.create'	
]);

Route::get('start/pagos/hay_creditos/{doc}',[
    'uses' => 'PagoController@hay_creditos'
]);
