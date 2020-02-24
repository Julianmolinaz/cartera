<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Cartera extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'carteras';

    protected $fillable = [
    	'nombre', 'estado', 'porcentaje_pago_parcial'
    ];

    public function setNombreAttribute($value){
    	$this->attributes['nombre'] = strtoupper($value);
    }

    public function precreditos(){
        return $this->belongsTo('App\Precredito');
    }

    public function negocios(){
        return $this->belongsToMany('App\Negocio');
    }

}
