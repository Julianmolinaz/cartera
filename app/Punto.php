<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Punto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'puntos';

    protected $fillable = [
    	'nombre', 'estado', 'prefijo','increment',
    	'direccion', 'telefono', 'descripcion','municipio_id'];
    
    public function municipio(){
    	return $this->hasOne('App\Municipio','id','municipio_id');
    }

}
