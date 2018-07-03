<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Codeudor extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
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

    public function soat(){
        return $this->hasOne('App\Soat','codeudor_id', 'id');
    }

    public function municipio(){
    	return $this->hasOne('App\Municipio','id','municipioc_id');
    }

    public function estudio(){
        return $this->belongsTo('App\Estudio','id','codeudor_id');
    }



}
