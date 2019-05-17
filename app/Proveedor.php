<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    public $timestamps = false;

    protected $table = 'proveedores';

    protected $fillable = ['nombre','estado'];

}
