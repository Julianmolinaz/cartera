<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';

    protected $fillable = [
        'nombre',
        'ruta',
        'cliente_id',
        'precredito_id',
        'credito_id',
        'user_create_id'
    ];

    public function cliente() {
        return $this->hasOne('App\Cliente','id','cliente_id');
    }

    public function precredito() {
        return $this->hasOne('App\Precredito','id','precredito_id');
    }

    public function credito() {
        return $this->hasOne('App\Credito','id','credito_id');
    }
    public function user_create() {
        return $this->hasOne('App\User','id','user_id');
    }

}
