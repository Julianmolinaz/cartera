<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nombre','estado'
    ];

    public function users()
    {
        return $this->hasMany('App\User','banco_id','id');
    }
}
