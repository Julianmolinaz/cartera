<?php

namespace App\ModelsContabilidad;

use Illuminate\Database\Eloquent\Model;

class Auxiliar extends Model
{
    protected $table = 'auxiliares';

    protected $fillable = [
        'id','nombre','codigo','clase_id'
    ];
}
