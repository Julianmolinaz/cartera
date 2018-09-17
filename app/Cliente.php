<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Cliente extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre','primer_nombre','segundo_nombre','primer_apellido',
        'segundo_apellido','tipo_docc','num_doc','fecha_nacimiento',
        'direccion','barrio','municipio_id', 'movil','fijo','ocupacion',
        'tipo_actividad','empresa','placa','email','codeudor_id', 
        'user_create_id','user_update_id','calificacion', 
        'conyuge_id', 'tel_empresa', 'dir_empresa'

    ];

    public function setNombreAttribute($value){

        $_1 = ucwords(strtolower($this->primer_nombre));
        $_2 = ' '.ucwords(strtolower($this->segundo_nombre));
        $_3 = ' '.ucwords(strtolower($this->primer_apellido));
        $_4 = ' '.ucwords(strtolower($this->segundo_apellido));

        $this->attributes['nombre'] = trim($_1.$_2.$_3.$_4);

    }

    public function setPrimernombreAttribute($value){
        $this->attributes['primer_nombre'] = ucwords(strtolower($value));
        $this->setNombreAttribute($value);
    }

    public function setSegundonombreAttribute($value){
        $this->attributes['segundo_nombre'] = ucwords(strtolower($value));
        $this->setNombreAttribute($value);
    }

    public function setPrimerapellidoAttribute($value){
        $this->attributes['primer_apellido'] = ucwords(strtolower($value));
        $this->setNombreAttribute($value);
    }

    public function setSegundoapellidoAttribute($value){
        $this->attributes['segundo_apellido'] = ucwords(strtolower($value));
        $this->setNombreAttribute($value);
    }

    public function setDireccionAttribute($value){
        $this->attributes['direccion'] = trim(strtoupper($value));
    }

    // public function setOcupacionAttribute($value){
    //     $this->attributes['ocupacion'] = strtoupper($value);
    // }

    // public function setEmpresaAttribute($value){
    //     $this->attributes['empresa'] = strtoupper($value);
    // }

    public function setPlacaAttribute($value){
        $this->attributes['placa'] = strtoupper($value);
    }

    public function municipio(){
    	return $this->hasOne('App\Municipio','id','municipio_id');
    }

    public function codeudor(){
    	return $this->hasOne('App\Codeudor','id','codeudor_id');
    }

    public function user_create(){
        return $this->hasOne('App\User','id','user_create_id');
    }

    public function user_update(){
        return $this->hasOne('App\User','id','user_update_id');
    }

    public function precreditos(){
        return $this->hasMany('App\Precredito');
    }

    public function estudio(){
        return $this->belongsTo('App\Estudio','id','cliente_id');
    }
    
    public function soat(){
        return $this->hasOne('App\Soat', 'cliente_id', 'id');
    }

    public function conyuge(){
        return $this->hasOne('App\Conyuge','id','conyuge_id');
    }

    protected $auditExclude = [
        'published',
    ];

}
