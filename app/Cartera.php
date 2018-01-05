<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Cartera extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'carteras';

    protected $fillable = [
    	'nombre', 'estado'
    ];

    public function precreditos(){
        return $this->belongsTo('App\Precredito');
    }


}
