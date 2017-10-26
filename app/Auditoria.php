<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
     protected $table = 'auditorias';

    protected $fillable = [
    	'concepto' , 'clave_ini' , 'clave_fin'
    ]; 
}
