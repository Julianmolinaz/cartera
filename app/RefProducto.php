<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefProducto extends Model
{
    protected $table = "ref_productos";

    protected $fillable = [

        'nombre',
        'expedido_a',
        'estado',
        'fecha_exp',
        'costo',
        'iva',
        'num_fact',
        'otros',
        'observaciones',
  
        // Referenciass

        'vehiculo_id',
        'producto_id',       
        'proveedor_id', // ver terceros
        'precredito_id',
        'created_by',
        'updated_by',    
    ];

    public function vehiculo() {
        return $this->hasOne('App\Vehiculo','id','vehiculo_id');
    }

    public function solicitud() {
        return $this->hasOne('App\Precredito','id','precredito_id');
    }

    public function proveedor() {
        return $this->hasOne('App\Tercero','id','proveedor_id');
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
