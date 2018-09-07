<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
 
class Pago extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'pagos';

    protected $fillable = [
    	'factura_id' , 'credito_id' , 'precredito_id' 'concepto' , 'tipo' , 'abono' , 'debe' , 'descripcion' , 'estado' , 'pago_desde' , 'pago_hasta' , 'abono_pago_id'
    ];

    public function factura(){
    	return $this->hasOne('App\Factura','id','factura_id');
    }
    public function credito(){

    	return $this->hasOne('App\Credito','id','credito_id');
    }

    public function precredito(){

        return $this->hasOne('App\Precredito','id','precredito_id');
    }
}
