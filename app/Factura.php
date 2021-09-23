<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Collection;

class Factura extends Model implements Auditable 
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'facturas';

    protected $fillable = [
        'num_fact',
        'fecha',
        'banco',
        'credito_id',
        'total',
        'descuento',
        'user_create_id',
        'user_update_id'
    ];

    /**
     * Relaciones
     */

    public function credito(){
    	return $this->hasOne('App\Credito','id','credito_id');
    }

    public function user_create(){
    	return $this->hasOne('App\User','id','user_create_id');
    }

    public function user_update(){
    	return $this->hasOne('App\User','id','user_update_id');
    }

    public function pagos(){
        return $this->hasMany('App\Pago');
    }

    /**
     * **PAGOS**
     */

    public function pagosSinDescuento() {
        return collect(
            \DB::table('pagos')
                ->join('facturas','pagos.factura_id', '=', 'facturas.id')
                ->select('pagos.*')
                ->where('facturas.id', $this->id)
                ->where('facturas.descuento', false)
                ->get()
            );
    }

    public function otro_pago(){
        return $this->hasMany('App\OtrosPagos');
    }

    //MUTATORS

    public function setNumfactAttribute($value){
        $this->attributes['num_fact'] = strtoupper($value);
    }

}
