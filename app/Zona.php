<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $fillable = [
        'nombre', 'descripcion', 'user_create_id', 'user_update_id'
    ];
}
