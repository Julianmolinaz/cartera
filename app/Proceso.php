<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $fillable = [
        'juzgado',
        'radicado',
        'fecha_radicado',
        'credito_id',
        'cliente_id',
        'user_create_id',
        'user_update_id'
    ];

    public function anotaciones(){
        return $this->hasMany('App\Anotacion','proceso_id','id');
    }

    public function cliente(){
        return $this->hasOne('App\Cliente','id','cliente_id');
    }

    public function credito(){
        return $this->hasOne('App\Credito','id','credito_id');
    }

}
