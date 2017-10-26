<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    protected $table = 'egresos';
    protected $fillable = ['fecha','comprobante_egreso','concepto','valor','user_create_id','user_update_id','observaciones', 'cartera_id'];


    public function user_create(){
    	return $this->hasOne('App\User','id','user_create_id');
    }

    public function user_update(){
    	return $this->hasOne('App\User','id','user_update_id');
    }

    public function cartera(){
    	return $this->hasOne('App\Cartera','id','cartera_id');
    }
}
