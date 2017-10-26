<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    protected $table = "variables";

    protected $fillable = [
    	'meses_min' , 'meses_max', 'vlr_dia_sancion', 'vlr_estudio_tipico','vlr_estudio_domicilio'
    ];

}
