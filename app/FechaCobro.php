<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Carbon\Carbon;

class FechaCobro extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;

    protected $table = 'fecha_cobros';
    protected $fillable = ['credito_id' , 'fecha_pago'];

    public function getFechaAttribute () {
        $date = new Carbon($this->fecha_pago);

        return $date->format('d-m-Y');
    }
}
