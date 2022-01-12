<?php




// LISTAR productos

Route::get('admin/productos_listall/{page?}',[
    'middleware' => ['permission:consultar_productos'],
    'uses' => 'ProductoController@listall', 
    'as' => 'admin.productos.listall']);

Route::get('admin/productos', [
    'middleware' => ['permission:consultar_productos'],
    'uses' => 'ProductoController@index',
    'as'  => 'admin.productos.index'
    ]);

// VISTA CREAR productos

Route::get('admin/productos/create', [
    'middleware' => ['permission:crear_producto'],
    'uses' => 'ProductoController@create',
    'as' => 'admin.productos.create'
]);

// CREAR productos

Route::post('admin/productos', [
    'middleware' => ['permission:crear_producto'],
    'uses' => 'ProductoController@store',
    'as'   => 'admin.productos.store'    
]);

// VISTA EDITAR productos

Route::get('admin/productos/edit/{Producto_id}',[
    'middleware' => ['permission:editar_productos'],
    'uses' => 'ProductoController@edit',
    'as' => 'admin.productos.edit'
]);

// ACTUALIZAR productos

Route::put('admin/productos/{producto_id}',[
    'middleware' => ['permission:editar_productos'],
    'uses' => 'ProductoController@update',
    'as' => 'admin.productos.update'
]);

Route::get('admin/productos/destroy/{producto_id}', [
    'uses' => 'ProductoController@destroy',
    'as' => 'admin.productos.destroy'
]);
