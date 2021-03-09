<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anotacion extends Model
{
    protected $table = 'anotaciones';

    protected $fillable = [
        'proceso_id',
        'fecha_anotacion',
        'asunto',
        'descripcion',
        'recordatorio',
        'notificado',
        'user_create_id',
        'user_update_id'
    ];

    public function proceso(){
        return $this->hasOne('App\Proceso','id','proceso_id');
    }

    public function user_create(){
        return $this->hasOne('App\User','id','user_create_id');
    }

    public function user_update(){
        return $this->hasOne('App\User','id','user_update_id');
    }

}
