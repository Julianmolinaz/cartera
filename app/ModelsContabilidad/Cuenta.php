<?php

namespace App\ModelsContabilidad;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $fillable = [
        'id','nombre','codigo','grupo_id'
    ];
}
