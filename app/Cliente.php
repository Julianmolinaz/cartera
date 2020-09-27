<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Cliente extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'clientes';

    protected $fillable = [
        
        // info personal

        'nombre',               //*
        'primer_nombre',        //*
        'segundo_nombre',       //*
        'primer_apellido',      //*
        'segundo_apellido',     //*
        'genero',               //new
        'tipo_doc',             //*
        'num_doc',              //*
        'estado_civil',         //new
        'fecha_exp',            //new
        'lugar_exp',            //new
        'fecha_nacimiento',     //*
        'lugar_nacimiento',     //new
        'nivel_estudios',       //new

        //info ubicacion

        'direccion',            //*
        'barrio',               //*
        'municipio_id',         //*
        'movil',                //*
        'antiguedad_movil',     //new
        'fijo',                 //*
        'email',                //*
        'anos_residencia',      //new
        'envio_correspondencia',//new
        'estrato',              //new
        'meses_residencia',     //new
        'tipo_vivienda',        //new
        'nombre_arrendador',    //new
        'telefono_arrendador',  //new

        //info laboral

        'tipo_actividad',       //*
        'ocupacion',            //*
        'empresa',              //*
        'nit',                  //
        'dir_empresa',          //new
        'tel_empresa',          //*
        'cargo',                //new
        'descripcion_actividad',//new
        'doc_empresa',          //new
        'fecha_vinculacion',    //new
        'tipo_contrato',        //new
        
        // info crediticia
        
        'reportado',            //new
        'numero_de_creditos',   //*
        'calificacion',         //*
        
        // referencias FK
        
        'codeudor_id',          //*
        'conyuge_id',           //new
        'user_create_id',       //*
        'user_update_id',       //*
        
        // general
        
        'placa',                //new
        'version',              //new
        'calificacion',         //*
        
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

        public function setBarrioAttribute($value){
        $this->attributes['barrio'] = trim(strtoupper($value));
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

    public function documentos(){
        return $this->hasMany('App\Documento','cliente_id','id');
    }

    public function cdeudor() {
        return $this->hasOne('App\Cliente','id','cdeudor_id');
    }

    public function deudor() {
        return $this->hasOne('App\Cliente','cdeudor_id','id');
    }

    protected $auditExclude = [
        'published',
    ];

}
