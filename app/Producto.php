<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Producto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = "productos";

    protected $fillable = [
    	'nombre',
        'estado',
        'num_vehiculos',
        'descripcion', 
        'con_invoice', 
        'con_vehiculo',
        'valores' // valores por defecto
    ];

    public function setNombreAttribute($value){
    	$this->attributes['nombre'] = strtoupper($value);
    }

    public function precredito(){
    	return $this->belongsTo('App\Precredito');
    }

}
