<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Anulada extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'anuladas';

    protected $fillable = [
        'cliente_id', 'factura_id', 'credito_id', 'precredito_id', 'num_fact', 
        'fecha', 'total','pagos', 'motivo_anulacion',
        'user_anula', 'user_create_id'
    ];

    public function cliente(){
        return $this->hasOne('App\Cliente','id','cliente_id');
    }
    
    public function user_create(){
        return $this->hasOne('App\User','id','user_create_id');
    }    

    public function anula(){
    	return $this->hasOne('App\User','id','user_anula');
    }

    public function credito(){
        return $this->hasOne('App\Credito','id','credito_id');
    }

    public function precredito(){
        return $this->hasOne('App\Preredito','id','precredito_id');
    }
}
