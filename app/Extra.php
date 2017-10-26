<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    protected $table = 'extras';

    protected $fillable = [
    'fecha' , 'concepto' , 'estado' , 'valor' , 'descripcion' , 'credito_id' , 'user_create_id' , 'user_update_id'
    ];

    public function credito(){
    	return $this->hasOne('App\Credito','id','credito_id');
    }

    
    public function user_create(){
    	return $this->hasOne('App\User','id','user_create_id');
    }

    public function user_update(){
    	return $this->hasOne('App\User','id','user_update_id');
    }
    
}
