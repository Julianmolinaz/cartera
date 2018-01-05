<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Criterio extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;

    protected $table = 'criterios';
    protected $fillable = ['criterio','descripcion'];
}
