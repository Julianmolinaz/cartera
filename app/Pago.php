<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Carbon\Carbon;
 
class Pago extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'pagos';

    protected $fillable = [
        'factura_id',
        'credito_id',
        'precredito_id',
        'concepto',
        'tipo',
        'abono',
        'debe',
        'descripcion',
        'estado',
        'pago_desde',
        'pago_hasta',
        'abono_pago_id'
    ];

    public function factura () {
    	return $this->hasOne('App\Factura','id','factura_id');
    }
    public function credito () {
    	return $this->hasOne('App\Credito','id','credito_id');
    }

    public function precredito () {

        return $this->hasOne('App\Precredito','id','precredito_id');
    }

    /**
     * Return date en format dd-mm-yyyy del pago_hasta
     */

    public function getDesdeAttribute () {
        if ($this->pago_desde) {
            $date = new Carbon($this->pago_desde);
            return $date->format('d-m-Y');
        } else {
            return '';
        }
    }

    /**
     * Return date en format dd-mm-yyyy del pago_desde
     */

    public function getHastaAttribute () {
        if ($this->pago_hasta) {
            $date = new Carbon($this->pago_hasta);
            return $date->format('d-m-Y');
        } else {
            return '';
        }
    }
}
