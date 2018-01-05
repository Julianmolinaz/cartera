<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Factura extends Model implements Auditable 
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'facturas';

    protected $fillable = [
    	'num_fact' , 'fecha' , 'credito_id' , 'total' , 'user_create_id' , 'user_update_id'
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

    public function pagos(){
        return $this->hasMany('App\Pago');
    }

    public function otro_pago(){
        return $this->hasMany('App\OtrosPagos');
    }
}
