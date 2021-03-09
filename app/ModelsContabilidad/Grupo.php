<?php

namespace App\ModelsContabilidad;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $fillable = [
        'id','nombre','codigo','clase_id'
    ];
}
