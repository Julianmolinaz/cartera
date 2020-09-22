<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masivo extends Model
{
    protected $fillable = [
        'id',
        'fecha',
        'documento',
        'referencia',
        'monto',
        'entidad',
        'efectivo',
        'ref_type',
        'ref_id',
        'created_by',
        'created_at'
    ];
}
