<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Venta extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $timestamps = false;

    protected $fillable= [
        'cantidad',
        'producto_id',
        'precredito_id',
        'valor',
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
