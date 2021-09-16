<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    public $timestamps = false;

    protected $table = 'proveedores';

    protected $fillable = [
        'nombre',
        'tipo_doc',
        'num_doc',
        'telefono',
        'direccion',
        'estado',
        'created_at',
        'updated_at'
    ];
}
