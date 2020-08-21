<?php

// CONTABILIDAD

Route::get('contabilidad',function(){
	return view('contabilidad.index');
})->name('contabilidad.index');
