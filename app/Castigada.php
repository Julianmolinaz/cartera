<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Castigada extends Model
{
    protected $table = 'castigadas';

    protected $fillable = ['credito_id', 'fecha_limite','saldo', 'user_create_id', 'user_update_id'];

    public function user_create(){
    	return $this->hasOne('App\User','id','user_create_id');
    }

    public function user_update(){
    	return $this->hasOne('App\User','id','user_update_id');
    }

    public function credito(){
    	return $this->hasOne('App\Credito','id','credito_id');
    }
}
