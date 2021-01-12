<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FechaCobro extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;

    protected $table = 'fecha_cobros';
    protected $fillable = ['credito_id' , 'fecha_pago'];

    
}
