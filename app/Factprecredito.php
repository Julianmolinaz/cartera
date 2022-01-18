<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Factprecredito extends Model implements Auditable 
{
	use \OwenIt\Auditing\Auditable;

    protected $table = 'fact_precreditos';

    protected $fillable = [
    	'id',
        'precredito_id',
        'num_fact',
        'fecha',
        'total',
        'tipo',
        'banco',
        'num_consignacion',        
        'user_create_id',
        'user_update_id',
        'ref'
    ];

    public function precredito(){
    	return $this->hasOne('App\Precredito','id','precredito_id');
    }

    public function user_create(){
    	return $this->hasOne('App\User','id','user_create_id');
    }

    public function user_update(){
    	return $this->hasOne('App\User','id','user_update_id');
    }

    public function pagos(){
        return $this->hasMany('App\PrecreditoPago','fact_precredito_id','id');
    }

}
