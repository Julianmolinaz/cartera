<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Estudio extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'estudios';

    protected $fillable = [
    	'cliente_id' , 'codeudor_id' , 'funcionario_id' , 'estDatacredito_id' , 'estLaboral_id' , 'estVivienda_id' , 'estReferencia_id' , 'cal_asesor' , 'observaciones' , 'user_create_id' , 'user_update_id'
    ];

    public function cliente(){
    	return $this->hasOne('App\Cliente','id','cliente_id');
    }

    public function codeudor(){
    	return $this->hasOne('App\Codeudor','id','codeudor_id');
    }

    public function funcionario(){
    	return $this->hasOne('App\User','id','funcionario_id');
    }

    public function user_create(){
    	return $this->hasOne('App\User','id','user_create_id');
    }

    public function user_update(){
    	return $this->hasOne('App\User','id','user_update_id');
    }

    public function datacredito(){
        return $this->hasOne('App\EstDatacredito','id','estDatacredito_id');
    }

    public function laboral(){
        return $this->hasOne('App\EstLaboral','id','estLaboral_id');
    }

    public function vivienda(){
        return $this->hasOne('App\EstVivienda','id','estVivienda_id');
    }

    public function referencia(){
        return $this->hasOne('App\EstReferencia','id','estReferencia_id');
    }



}

