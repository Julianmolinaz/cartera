<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallBusqueda extends Model
{
    protected $table = 'call_busquedas';
    protected $fillable = [
    	'user_id' , 'busqueda' , 'rango_ini' ,'rango_fin'
    ];
}
