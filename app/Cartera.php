<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{
    protected $table = 'carteras';

    protected $fillable = [
    	'nombre', 'estado'
    ];

    public function precreditos(){
        return $this->belongsTo('App\Precredito');
    }


}
