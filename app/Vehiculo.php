<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    public $timestamps = false;

    protected $fillable= [
        'placa',
        'modelo',
        'cilindraje',
        'vencimiento_rtm',
        'vencimiento_soat',
        'tipo_vehiculo_id',
        'created_at',
        'updated_by'
    ];

    public function tipo() {
        return $this->hasOne('App\TipoVehiculo','id','tipo_vehiculo_id');
    }

    public function setPlacaAttribute($value) {
        $this->attributes['placa'] = strtoupper($value);
    }

    public function ref_producto()
    {
        return $this->hasOne('App\RefProducto','vehiculo_id','id');
    }

    public function creator() {
        return $this->hasOne('App\User','id','created_by');
    }

    public function updator() {
        return $this->hasOne('App\User','id','updated_by');
    }
}
