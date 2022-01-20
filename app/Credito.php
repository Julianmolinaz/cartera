<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Collection;

class Credito extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'creditos';

    protected $fillable = [
        'precredito_id' ,
        'cuotas_faltantes', //*
        'saldo',//*
        'saldo_favor',//*
        'estado' ,//*
        'rendimiento'  ,//*
        'valor_credito' ,//*
        'castigada', //*        
        'refinanciacion',
        'credito_refinanciado_id',
        'end_procredito',
        'end_credito',
        'calificacion',
        'funcionario_id',
        'last_llamada_id',       
        'sanciones_debe', 
        'sanciones_ok',
        'sanciones_exoneradas',
        'mes', //*
        'anio', //*
        'cancelado_data', //*
        'recordatorio'
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

    public function facturasSinDescuento() {
        return collect(
            \DB::table('facturas')
                ->where('credito_id', $this->id)
                ->where('descuento', false)
                ->get()
        );
    }

    public function pagosSinDescuento() {
        return collect(\DB::table('pagos')
            ->join('facturas','pagos.factura_id', '=', 'facturas.id')
            ->select('pagos.*')
            ->where('facturas.credito_id', $this->id)
            ->where('facturas.descuento', false)
            ->get());
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

    //referencia al credito origen cuando se hace refinanciación

    public function refinanciado(){
        return $this->hasOne('App\Credito','id','credito_refinanciado_id');
    }

    public function sanciones(){
        return $this->hasMany('App\Sancion');
    }

    public function credito_nuevo_refinanciado(){
        return $this->hasOne('App\Credito','credito_refinanciado_id','id');
    }

    public function last_llamada(){
        return $this->hasOne('App\Llamada','id','last_llamada_id');
    }

    public function hijo(){
        return $this->hasOne('App\Credito','credito_refinanciado_id','id');
    }

    public function proceso(){
        return $this->hasOne('App\Proceso','credito_id','id');
    }
    
    public function acuerdos(){
        return $this->hasMany('App\Acuerdo','credito_id','id');
    }

    public function lastAcuerdo(){
        $acuerdo = DB::table('acuerdos')
            ->where('credito_id', $this->id)
            ->last();

        return $acuerdo;
    }
}
