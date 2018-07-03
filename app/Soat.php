<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soat extends Model
{
    protected $table = 'soat';

    protected $fillable = [
        'cliente_id',
        'codeudor_id',
        'placa',
        'tipo',
        'vencimiento',
        'user_create_id',
        'user_update_id',
    ];

    public function setPlacaAttribute($value){
        $this->attributes['placa'] = strtoupper($value);
    }

    public function cliente(){
        return $this->hasOne('App\Cliente', 'id', 'cliente_id');
    }

    public function codeudor(){
        return $this->hasOne('App\Codeudor', 'id', 'codeudor_id');
    }

    public function user_create(){
        return $this->hasOne('App\User','id','user_create_id');
    }

    public function user_update(){
        return $this->hasOne('App\User','id','user_update_id');
    }
}
