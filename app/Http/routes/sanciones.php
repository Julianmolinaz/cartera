<?php


// Agregar sanciones

// Route::get('set-sanciones','GeneradorController@set');


//CREAR SANCIONES

// Route::post('admin/sanciones/crear_sanciones','SancionController@crearSanciones');

// Actualizar sancniones

Route::post('admin/sanciones',[
    'middleware' => ['permission:gestionar_sanciones'],
    'uses'  => 'SancionController@store',
    'as'    => 'admin.sanciones.store'  
]); 


// Mostrar sanciones

Route::get('admin/sanciones/{credito_id}',[
'middleware' => ['permission:consultar_sanciones'],
'uses'  => 'SancionController@show',
'as'    => 'admin.sanciones.show'      
]);