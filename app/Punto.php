<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Punto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'puntos';

    protected $fillable = [
    	'nombre',
        'estado',
        'prefijo',
        'increment',
        'zona_id',
    	'direccion',
        'telefono',
        'descripcion',
        'municipio_id'
        ];
    
    public function setPrefijoAttribute($value){
    	$this->attributes['prefijo'] = strtoupper($value);
    }

    public function setNombreAttribute($value){
    	$this->attributes['nombre'] = strtoupper($value);
    }

    public function municipio(){
    	return $this->hasOne('App\Municipio','id','municipio_id');
    }

    public function zona(){
        return $this->hasOne('App\Zona','id','zona_id');
    }

}
