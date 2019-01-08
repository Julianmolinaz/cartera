<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Sancion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'sanciones';

    protected $fillable = [
    	'credito_id','valor', 'estado','pago_id'
    ];

    public function credito(){
    	return $this->hasOne('Appp\Credito','id','credito_id');
    }

    //Nota: el pago_id no es una llave foranea que apunta a pagos porque se necesita borrar ese valor al anular una factura.
}
