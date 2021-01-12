<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    protected $fillable = [
        'nombre',
        'direccion',
        'parentezco',
        'telefono',
        'celular',
        'observaciones',
        'cliente_id',
        'user_create_id',
        'user_update_id'
    ];

    function cliente() {
        return $this->hasOne('App\Cliente','id','cliente_id');
    }

    public function created_by() {
    	return $this->hasOne('App\User','id','user_create_id');
    }

    public function updated_by() {
    	return $this->hasOne('App\User','id','user_update_id');
    }
}
