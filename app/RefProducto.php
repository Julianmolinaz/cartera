<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefProducto extends Model
{
    protected $table = "ref_productos";

    protected $fillable = [
        'nombre',
        'estado',
        'fecha_exp',
        'precredito_id',
        'costo',
        'iva',
        'num_fact',
        'proveedor_id',
        'producto_id',
        'extra',
        'observaciones',
        'created_by',
        'updated_by'
    ];

    public function solicitud() {
        return $this->hasOne('App\Precredito','id','precredito_id');
    }

    public function proveedor() {
        return $this->hasOne('App\Proveedor','id','proveedor_id');
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

}
