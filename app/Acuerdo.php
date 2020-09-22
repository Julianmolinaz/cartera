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
}
