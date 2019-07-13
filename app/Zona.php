<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $fillable = [
        'nombre', 'descrpcion', 'user_create_id', 'user_update_id'
    ];
}
