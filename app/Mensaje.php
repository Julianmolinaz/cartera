<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $fillable = [
    	'nombre','estado','mensaje','user_create_id','user_update_id'
    ];

    function user_create(){
    	return $this->hasOne('App\User','id','user_create_id');
    }
    function user_update(){
    	return $this->hasOne('App\User','id','user_update_id');
    }
}
