<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Precredito extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'precreditos';

    protected $fillable = [
        'num_fact' , 'fecha' , 'cartera_id' , 'funcionario_id' , 'cliente_id' , 
        'producto_id' , 'vlr_fin' , 'periodo' , 'meses' , 'cuotas' , 'vlr_cuota' , 
        'p_fecha' , 's_fecha' ,  'estudio' , 'cuota_inicial' , 
        'aprobado' , 'observaciones' , 'user_create_id' , 'user_update_id',
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
