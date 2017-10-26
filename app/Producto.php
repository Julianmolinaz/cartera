<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";

    protected $fillable = [
    	'nombre' , 'descripcion',
    ];

    public function precredito(){
    	return $this->belongsTo('App\Precredito');
    }

}
