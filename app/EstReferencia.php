<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstReferencia extends Model
{
    protected $table = 'est_referencias';

    protected $fillable = [ 'criterio', 'puntaje' ];

    public function estudio(){
        return $this->belongsTo('App\Estudio');
    }
}
