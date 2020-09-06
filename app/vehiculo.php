<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    public $timestamps = false;

    protected $fillable= [
        'tipo_vehiculo_id','placa','vencimiento_soat','vencimiento_rtm','observaciones',
    ];

    public function tipo() {
        return $this->hasOne('App\TipoVehiculo','id','tipo_vehiculo_id');
    }

    public function setPlacaAttribute($value) {
        $this->attributes['placa'] = strtoupper($value);
    }
}
