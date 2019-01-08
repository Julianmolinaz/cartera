<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Producto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = "productos";

    protected $fillable = [
    	'nombre' , 'descripcion',
    ];


    public function setNombreAttribute($value){
    	$this->attributes['nombre'] = strtoupper($value);
    }

    public function precredito(){
    	return $this->belongsTo('App\Precredito');
    }

}
