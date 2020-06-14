<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehiculo extends Model
{
    protected $fillable= [
        'tipo','placa','vencimiento_soat','vencimiento_rtm','observaciones',
    ];
}
