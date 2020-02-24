<?php


Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']],function(){

    Route::resource('variables','VariableController',['only' =>['index','update']]);
    
    Route::get('get-mensajes','VariableController@get_mensajes');

    Route::post('variables/pagos/set_porcentaje_pago_parcial',
        'VariableController@setPorcentajePagoParcial');

});