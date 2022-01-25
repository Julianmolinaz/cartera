<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $timestamps = false;

    protected $fillable= [
        'estado',
        'fecha_exp',
        'costo',
        'iva',
        'num_fact',
        'otros',
        'expedido_a',
        'observaciones',
        'venta_id',
        'proveedor_id',
        'precredito_id',
        'created_by',
        'updated_by'    
    ];

    public function solicitud() {
        return $this->hasOne('App\Precredito','id','precredito_id');
    }

    public function venta(){
    	return $this->hasOne('App\Venta','id','venta_id');
    }

    public function producto() {
        return $this->hasOne('App\Producto','id','producto_id');
    }

    public function creator() {
        return $this->hasOne('App\User','id','created_by');
    }

    public function updator() {
        return $this->hasOne('App\User','id','updated_by');
    }

    public function proveedor() {
        return $this->hasOne('App\Tercero','id','proveedor_id');
    }
}
