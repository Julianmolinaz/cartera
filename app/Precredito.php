<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Precredito extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'precreditos';

    protected $fillable = [
        'num_fact',            // old
        'fecha',               // old
        'cartera_id',          // old
        'funcionario_id',      // old
        'cliente_id',          // old
        'producto_id',         // old
        'vlr_fin',             // old
        'periodo',             // old
        'meses',               // old
        'cuotas',              // old
        'vlr_cuota',           // old
        'p_fecha',             // old
        's_fecha',             // old
        'estudio',             // old
        'cuota_inicial',       // old
        'aprobado',            // old
        'observaciones',       // old
        'user_create_id',      // old
        'user_update_id',      // old
        'version'
    ];

    public function user(){
    	return $this->hasOne('App\User','id','funcionario_id');
    }
    public function cliente(){
    	return $this->hasOne('App\Cliente','id','cliente_id');
    }

    public function producto(){
    	return $this->hasOne('App\Producto','id','producto_id');
    }

    public function funcionario(){
        return $this->hasOne('App\User','id','funcionario_id');
    }

    public function user_create(){
        return $this->hasOne('App\User','id','user_create_id');
    }

    public function user_update(){
        return $this->hasOne('App\User','id','user_update_id');
    }

    public function cartera(){
        return $this->hasOne('App\Cartera','id','cartera_id');
    }

    public function credito(){
        return $this->belongsTo('App\Credito','id','precredito_id');
    }

    public function facturas(){
        return $this->belongsTo('App\Factura');
    }

    public function proceso(){
        return $this->hasMany('App\Proceso','id','proceso_id');
    }

    public function pagos() {
        return $this->hasMany('App\PrecreditoPago','precredito_id','id');
    }

    public function ref_productos() {
        return $this->hasMany('App\RefProducto','precredito_id','id');
    }
}
