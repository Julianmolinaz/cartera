<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Codeudor extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'codeudores';

    protected $fillable = [

        // información personal

        'codeudor',             //*
        'nombrec',              //*
        'primer_nombrec',       //*
        'segundo_nombrec',      //*
        'primer_apellidoc',     //*
        'segundo_apellidoc',    //*
        'tipo_docc',            //*
        'num_docc',             //*
        'fecha_nacimientoc',    //*
        'direccionc',           //*
        'barrioc',              //*
        'municipioc_id',        //*
        'movilc',               //*
        'fijoc',                //*
        'ocupacionc',           //*
        'tipo_actividadc',      //*
        'empresac',             //*
        'placac',               //*
        'emailc',               //*
        'conyuge_id',           // ambos
        'tel_empresac',         //*
        'dir_empresac',         //*


        // info personal

        'nombre',               // new
        'primer_nombre',        // new
        'segundo_nombre',       // new
        'primer_apellido',      // new
        'segundo_apellido',     // new
        'genero',               // new
        'tipo_doc',             // new
        'num_doc',              // new
        'estado_civil',         // new
        'fecha_exp',            // new
        'lugar_exp',            // new
        'fecha_nacimiento',     // new
        'lugar_nacimiento',     // new
        'nivel_estudios',       // new

        //info ubicacion

        'direccion',            // new
        'barrio',               // new
        'municipio_id',         // new
        'movil',                // new
        'antiguedad_movil',     // new
        'fijo',                 // new
        'email',                // new
        'anos_residencia',      // new
        'envio_correspondencia',// new
        'estrato',              // new
        'meses_residencia',     // new
        'tipo_vivienda',        // new
        'nombre_arrendador',    // new
        'telefono_arrendador',  // new

        //info laboral

        'tipo_actividad',       // new
        'ocupacion',            // new
        'empresa',              // new
        'nit',                  // new
        'dir_empresa',          // new
        'tel_empresa',          // new
        'cargo',                // new
        'descripcion_actividad',// new
        'doc_empresa',          // new
        'fecha_vinculacion',    // new
        'tipo_contrato',        // new
        
        // info crediticia
        
        'reportado',            // new
        'calificacion',         // new
        
        // referencias FK

        'codeudor_id',          // new
        'user_create_id',       // new
        'user_update_id',       // new
        
        // general

        'placa',                // new
        'version'               // new

    ];
        

    // mutators

    public function setNombrecAttribute($value){

        $_1 = ucwords(strtolower($this->primer_nombrec));
        $_2 = ' '.ucwords(strtolower($this->segundo_nombrec));
        $_3 = ' '.ucwords(strtolower($this->primer_apellidoc));
        $_4 = ' '.ucwords(strtolower($this->segundo_apellidoc));

        $this->attributes['nombrec'] = trim($_1.$_2.$_3.$_4);

    }

    public function setPrimernombrecAttribute($value){
        $this->attributes['primer_nombrec'] = ucwords(strtolower($value));
        $this->setNombrecAttribute($value);
    }

    public function setSegundonombrecAttribute($value){
        $this->attributes['segundo_nombrec'] = ucwords(strtolower($value));
        $this->setNombrecAttribute($value);
    }

    public function setPrimerapellidocAttribute($value){
        $this->attributes['primer_apellidoc'] = ucwords(strtolower($value));
        $this->setNombrecAttribute($value);
    }

    public function setSegundoapellidocAttribute($value){
        $this->attributes['segundo_apellidoc'] = ucwords(strtolower($value));
        $this->setNombrecAttribute($value);
    }

    public function setDireccioncAttribute($value){
        $this->attributes['direccionc'] = trim(strtoupper($value));
    }

    public function setOcupacioncAttribute($value){
        $this->attributes['ocupacionc'] = strtoupper($value);
    }

    public function setEmpresacAttribute($value){
        $this->attributes['empresac'] = strtoupper($value);
    }

    public function setPlacacAttribute($value){
        $this->attributes['placac'] = strtoupper($value);
    }

    // relaciones

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

    public function conyuge(){
        return $this->hasOne('App\Conyuge','id','conyuge_id');
    }

    public function clientes(){
        return $this->hasMany('App\Cliente');
    }



}
