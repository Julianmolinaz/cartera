<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acuerdo extends Model
{
    protected $fillable = [
        'id',
        'fecha',
        'descripcion',
        'estado',
        'credito_id',
        'created_by',
        'updated_by'
    ];

    public function creator() {
        return $this->hasOne('App\User','id','created_by');
    }

    public function updator() {
        return $this->hasOne('App\User','id','updated_by');
    }
}
