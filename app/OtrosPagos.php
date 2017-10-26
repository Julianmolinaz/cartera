<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtrosPagos extends Model
{
    protected $table = 'otros_pagos';

    protected $fillable = [
    	'factura_id', 'fecha_factura',  'concepto', 'valor_unitario', 'cantidad', 'subtotal','cartera_id'
    ];

    public function factura(){
    	return $this->hasOne('App\Factura','id','factura_id');
    }

    public function cartera(){
    	return $this->hasOne('App\Cartera','id','cartera_id');
    }


}
