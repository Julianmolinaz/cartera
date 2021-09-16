<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class OtrosPagos extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'otros_pagos';

    protected $fillable = [
    	'factura_id',
        'fecha_factura',
        'concepto',
        'valor_unitario',
        'cantidad',
        'subtotal',
        'cartera_id'
    ];

    public function factura(){
    	return $this->hasOne('App\Factura','id','factura_id');
    }

    public function cartera(){
    	return $this->hasOne('App\Cartera','id','cartera_id');
    }


}
