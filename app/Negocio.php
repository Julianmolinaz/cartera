<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    protected $fillable = [
        'nombre', 'descripcion'
    ];

    public function carteras(){
        return $this->belongsToMany('App\Cartera');
    }

}
