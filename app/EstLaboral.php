<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstLaboral extends Model
{
    protected $table = 'est_laborales';

    protected $fillable = [ 'criterio', 'puntaje' ];

    public function estudio(){
        return $this->belongsTo('App\Estudio');
    }
}
