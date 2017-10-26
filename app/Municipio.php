<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';

    protected $fillable = [
    	'nombre','departamento'
    ];
    public function cliente(){
    	return $this->belongsTo('App\Cliente');
    }
    public function codeudor(){
    	return $this->belongsTo('App\Codeudor');
    }
}
