<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Egreso extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'egresos';
    protected $fillable = [
        'fecha','comprobante_egreso','concepto','tipo','banco','num_consignacion',
        'valor','user_create_id','user_update_id','observaciones', 'cartera_id', 
        'punto_id','proveedor_id'
    ];


    public function user_create(){
    	return $this->hasOne('App\User','id','user_create_id');
    }

    public function user_update(){
    	return $this->hasOne('App\User','id','user_update_id');
    }

    public function cartera(){
    	return $this->hasOne('App\Cartera','id','cartera_id');
    }

    public function punto(){
        return $this->hasOne('App\Punto','id','punto_id');
    }

    public function proveedor(){
        return $this->hasOne('App\Proveedor','id','proveedor_id');
    }
}
