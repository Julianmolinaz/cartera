<?php

namespace App\ModelsContabilidad;

use Illuminate\Database\Eloquent\Model;

class Subcuenta extends Model
{
    protected $fillable = [
        'id','nombre','codigo','cuenta_id','tercero','tipo'
    ];
}
