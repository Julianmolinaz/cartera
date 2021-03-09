<?php

namespace App\ModelsContabilidad;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $fillable = [
        'id','nombre','codigo','naturaleza'
    ];
}
