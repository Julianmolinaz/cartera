<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oficio extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['nombre'];
}
