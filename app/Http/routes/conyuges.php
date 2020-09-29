<?php 


/*
|--------------------------------------------------------------------------
| Conyuges
|--------------------------------------------------------------------------
*/

Route::get('start/conyuges/{id}/{tipo}',[
    'uses' => 'ConyugeController@index',
    'as' => 'start.conyuges.index'
]);

Route::get('start/conyuges/create/{cliente_id}/{tipo}',[
 
    'uses' => 'ConyugeController@create',   
    'as' => 'start.conyuges.create']);

Route::post('start/conyuges',[
 
    'uses' => 'ConyugeController@store',   
    'as' => 'start.conyuges.store'
]);

Route::post('start/conyugesV2',[
 
    'uses' => 'ConyugeController@storeV2',   
    'as' => 'start.conyuges.storeV2'
]);

Route::put('start/conyuges/{conyuge_id}',[

    'uses' => 'ConyugeController@update',
    'as' => 'start.conyuges.update'
]);

Route::get('start/conyuges/{cliente_id}/{tipo}/edit',[ 
 
    'uses' =>'ConyugeController@edit',
    'as' => 'start.conyuges.edit'
]);

Route::get('start/conyuges/destroy/{cliente_id}/{tipo}',[ 
 
    'uses' => 'ConyugeController@destroy',
    'as' => 'start.conyuges.destroy'
]);


    



