<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrecreditoPago extends Model
{
    protected $table = 'precred_pagos';

    protected $fillable = [
    	'fact_precredito_id','concepto_id','precredito_id','valor','user_create_id','user_update_id'
    ];

    public function factura(){
    	return $this->hasOne('App\Factprecredito','id','fact_precredito_id');
    }

    public function concepto(){
    	return $this->hasOne('App\ConceptoFactPrecredito','id','concepto_id');
    }

    public function precredito(){
    	return $this->hasOne('App\Precredito','id','precredito_id');
    }

    public function user_create(){
    	return $this->hasOne('App\User','id','user_create_id');
    }

    public function user_update(){
    	return $this->hasOne('App\User','id','user_update_id');
    }


}
