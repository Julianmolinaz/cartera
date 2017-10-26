<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    protected $table = 'criterios';
    protected $fillable = ['criterio','descripcion'];
}
