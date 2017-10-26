<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codeudor extends Model
{
    protected $table = 'codeudores';

    protected $fillable = [
        'codeudor' ,
        'nombrec' ,
        'primer_nombrec',
        'segundo_nombrec', 
        'primer_apellidoc', 
        'segundo_apellidoc',
        'tipo_docc',
        'num_docc', 
        'direccionc',
        'barrioc',
        'municipioc_id',
        'movilc',
        'fijoc',
        'ocupacionc',
        'tipo_actividadc',
        'empresac',
        'placac',
        'emailc'
    ];

    public function cliente(){
    	return $this->belongsTo('App\Cliente');
    }

    public function municipio(){
    	return $this->hasOne('App\Municipio','id','municipioc_id');
    }

    public function estudio(){
        return $this->belongsTo('App\Estudio','id','codeudor_id');
    }



}
