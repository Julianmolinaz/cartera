<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Credito extends Model
{
    protected $table = 'creditos';

    protected $fillable = [
        'precredito_id' , 'cuotas_faltantes' , 'saldo' , 'estado' , 'rendimiento'  , 'valor_credito' ,  'castigada',
        'refinanciacion', 'credito_refinanciado_id', 'end_procredito', 'end_credito','funcionario_id'
    ];  

    public function precredito(){
    	return $this->hasOne('App\Precredito','id','precredito_id');
    }

    public function user_create(){
    	return $this->hasOne('App\User','id','user_create_id');
    }

    public function user_update(){
    	return $this->hasOne('App\User','id','user_update_id');
    }

    public function facturas(){
        return $this->hasMany('App\Factura');
    }
    
    public function pagos(){
        return $this->hasMany('App\Pago');
    }

    public function llamadas(){
        return $this->hasMany('App\Llamada');
    }

    public function fecha_pago(){
        return $this->hasOne('App\FechaCobro');    
    }

    public function multas(){
        return $this->hasMany('App\Extra');
    }

    public function refinanciado(){
        return $this->hasOne('App\Credito','id','credito_refinanciado_id');
    }

    public function sanciones(){
        return $this->hasMany('App\Sancion');
    }
}
