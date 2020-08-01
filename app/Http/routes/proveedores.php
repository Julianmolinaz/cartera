<?php


    //PROVEEDORES
    
    Route::get('admin/proveedores',[
        'middleware' => ['permission:ver_proveedores'],
        'uses' => 'ProveedorController@show',
        'as' => 'admin.proveedores.show'
    ]);

    Route::get('admin/proveedores/create',[
        'middleware' => ['permission:crear_proveedor'],
        'uses' => 'ProveedorController@create',
        'as' => 'admin.proveedores.create'
    ]);

    Route::get('admin/proveedores/update',[
        'middleware' => ['permission:editar_proveedor'],
        'uses' => 'ProveedorController@update',
        'as' => 'admin.proveedores.update'
    ]);
    


	// Route::resource('proveedores','ProveedorController');