<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Variable extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = "variables";

    protected $fillable = [
    	'meses_min' , 'meses_max', 'vlr_dia_sancion', 'vlr_estudio_tipico','vlr_estudio_domicilio'
    ];

}
