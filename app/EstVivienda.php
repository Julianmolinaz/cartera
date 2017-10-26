<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstVivienda extends Model
{
    protected $table = 'est_viviendas';

    protected $fillable = [ 'criterio', 'puntaje' ];

    public function estudio(){
        return $this->belongsTo('App\Estudio');
    }
}
