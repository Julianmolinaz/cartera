<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public $timestamps = false;

    protected $fillable= [
        'cantidad',
        'producto_id',
        'precredito_id',
        'vehiculo_id',
        'created_by',
        'updated_by'
    ];

    public function vehiculo() {
        return $this->hasOne('App\Vehiculo','id','vehiculo_id');
    }

    public function solicitud() {
        return $this->hasOne('App\Precredito','id','precredito_id');
    }

    public function creator() {
        return $this->hasOne('App\User','id','created_by');
    }

    public function updator() {
        return $this->hasOne('App\User','id','updated_by');
    }
}
