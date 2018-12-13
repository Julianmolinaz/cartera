<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Llamada extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'llamadas';
    protected $fillable = ['credito_id','criterio_id', 'agenda' , 
    'observaciones','user_create_id','user_update_id'];

    public function credito(){
        return $this->hasOne('App\Credito','id','credito_id');
    }

    function criterio(){
    	return $this->hasOne('App\Criterio','id','criterio_id');
    }
    function user_create(){
    	return $this->hasOne('App\User','id','user_create_id');
    }
    function user_update(){
    	return $this->hasOne('App\User','id','user_update_id');
    }

}
