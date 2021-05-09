<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tercero extends Model
{
    protected $fillable = [
        'tipo',
        'regimen',
        'razon_social',
        'nombre_comercial',
        'pnombre',
        'snombre',
        'papellido',
        'sapellido',
        'tipo_doc',
        'num_doc',
        'digito',
        'tel1',
        'tel2',
        'dir',
        'mun_id',
        'email',
        'estado'
    ];

    public function municipio() {
        return $this->hasOne('App\Municipio','id','mun_id');
    }

    public function getNombreAttribute($value) {
        $nombre = '';

        if ( $this->attributes['razon_social']) {
            return $this->attributes['razon_social'];
        } else {
            $nombre .= $this->attributes['pnombre'];
            $nombre .= '';
            $nombre .= $this->attributes['snombre'];
            $nombre .= '';
            $nombre .= $this->attributes['papellido'];
            $nombre .= ($this->attributes['sapellido'] ? ''.$this->attributes['sapellido'] : '');
        }
    }

    public function ref_productos() {
        return $this->hasMany('App\RefProducto','proveedor_id','id');
    }
}
