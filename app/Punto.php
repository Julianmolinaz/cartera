<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Punto extends Model
{
    protected $table = 'puntos';

    protected $fillable = ['nombre', 'estado', 'direccion', 'descripcion','municipio_id'];
    
    public function municipio(){
    	return $this->hasOne('App\Municipio','id','municipio_id');
    }

}
