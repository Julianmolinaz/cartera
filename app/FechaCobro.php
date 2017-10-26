<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FechaCobro extends Model
{
    protected $table = 'fecha_cobros';
    protected $fillable = ['credito_id' , 'fecha_pago'];

    
}
