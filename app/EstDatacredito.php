<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstDatacredito extends Model
{
    
	protected $table = 'est_datacreditos';

    protected $fillable = [ 'criterio', 'puntaje' ];

    public function estudio(){
        return $this->belongsTo('App\Estudio');
    }
}
