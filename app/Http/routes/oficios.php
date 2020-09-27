<?php

Route::post('start/oficios','OficioController@store');

Route::get('start/oficios','OficioController@getOficios');

Route::post('start/oficios/update','OficioController@update');

Route::get('start/oficios/delete/{oficio_id}','OficioController@destroy');