<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seccional extends Model
{
    protected $table = 'seccionales';

    protected $fillable = ['descripcion','created_at','updated_at'];
}
