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

    public function setNombreAttribute($value){
        
        $_1 = ucwords(strtolower( trim($this->primer_nombre)) );
        $_2 = $this->segundo_nombre ? ' '.ucwords(strtolower( trim($this->segundo_nombre) )) : '';
        $_3 = ' '.ucwords(strtolower( trim($this->primer_apellido) ));
        $_4 = $this->segundo_apellido ? ' '.ucwords(strtolower( trim($this->segundo_apellido) )) : '';

        $this->attributes['nombre'] = trim($_1.$_2.$_3.$_4);

    }


    // Mutators

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

    // Accesors

    public function getNombreAttribute() {
        if ($this->attributes['nombrec']) return trim($this->attributes['nombrec']);
        else return trim($this->attributes['nombre']);
    }

    public function getNombrecAttribute() {
        if ($this->attributes['nombrec']) return trim($this->attributes['nombrec']);
        else return trim($this->attributes['nombre']);
    }
    
    public function getPrimerNombrecAttribute() {
        if ($this->attributes['primer_nombrec']) return trim($this->attributes['primer_nombrec']);
        else return trim($this->attributes['primer_nombre']);
    }

    public function getPrimerNombreAttribute() {
        if ($this->attributes['primer_nombre']) return trim($this->attributes['primer_nombre']);
        else return trim($this->attributes['primer_nombrec']);
    }

    public function getSegundoNombrecAttribute() {
        if (isset($this->attributes['segundo_nombrec'])) return trim($this->attributes['segundo_nombrec']);
        else if (isset($this->attributes['segundo_nombre'])) return trim($this->attributes['segundo_nombre']);
    }

    public function getSegundoNombreAttribute() {
        if (isset($this->attributes['segundo_nombre'])) return trim($this->attributes['segundo_nombre']);
        else if(isset($this->attributes['segundo_nombrec'])) return trim($this->attributes['segundo_nombrec']);

    }

    public function getPrimerApellidocAttribute() {
        if (isset($this->attributes['primer_apellidoc'])) return trim($this->attributes['primer_apellidoc']);
        else if(isset($this->attributes['primer_apellido'])) return trim($this->attributes['primer_apellido']);
    }

    public function getPrimerApellidoAttribute() {
        if (isset($this->attributes['primer_apellido'])) return trim($this->attributes['primer_apellido']);
        else if(isset($this->attributes['primer_apellidoc'])) return trim($this->attributes['primer_apellidoc']);
    }

    public function getSegundoApellidocAttribute() {
        if (isset($this->attributes['segundo_apellidoc'])) return trim($this->attributes['segundo_apellidoc']);
        else if(isset($this->attributes['segundo_apellido'])) return trim($this->attributes['segundo_apellido']);
    }

    public function getSegundoApellidoAttribute() {
        if (isset($this->attributes['segundo_apellido'])) return trim($this->attributes['segundo_apellido']);
        else if (isset($this->attributes['segundo_apellidoc'])) return trim($this->attributes['segundo_apellidoc']);
    }
    
    public function getTipoDoccAttribute() {
        if ($this->attributes['tipo_docc']) return trim($this->attributes['tipo_docc']);
        else return trim($this->attributes['tipo_doc']);
    }

    public function getTipoDocAttribute() {
        if ($this->attributes['tipo_doc']) return trim($this->attributes['tipo_doc']);
        else return trim($this->attributes['tipo_docc']);
    }

    public function getNumDoccAttribute() {
        if ($this->attributes['num_docc']) return trim($this->attributes['num_docc']);
        else return trim($this->attributes['num_doc']);
    }

    public function getNumDocAttribute() {
        if ($this->attributes['num_doc']) return trim($this->attributes['num_doc']);
        else return trim($this->attributes['num_docc']);
    }

    public function getFechaNacimientocAttribute() {
        if ($this->attributes['fecha_nacimientoc']) return trim($this->attributes['fecha_nacimientoc']);
        else return trim($this->attributes['fecha_nacimiento']);
    }

    public function getFechaNacimientoAttribute() {
        if ($this->attributes['fecha_nacimiento']) return trim($this->attributes['fecha_nacimiento']);
        else return trim($this->attributes['fecha_nacimientoc']);
    }

    public function getDireccioncAttribute() {
        if ($this->attributes['direccionc']) return trim($this->attributes['direccionc']);
        else return trim($this->attributes['direccion']);
    }

    public function getDireccionAttribute() {
        if ($this->attributes['direccion']) return trim($this->attributes['direccion']);
        else return trim($this->attributes['direccionc']);
    }

    public function getBarriocAttribute() {
        if ($this->attributes['barrioc']) return trim($this->attributes['barrioc']);
        else return trim($this->attributes['barrio']);
    }

    public function getBarrioAttribute() {
        if ($this->attributes['barrio']) return trim($this->attributes['barrio']);
        else return trim($this->attributes['barrioc']);
    }

    public function getMunicipioIdAttribute() {
        if ($this->attributes['municipio_id']) return trim($this->attributes['municipio_id']);
        else return trim($this->attributes['municipioc_id']);
    }

    public function getMunicipiocIdAttribute() {
        if ($this->attributes['municipioc_id']) return trim($this->attributes['municipioc_id']);
        else return trim($this->attributes['municipio_id']);
    }

    public function getMovilcAttribute() {
        if ($this->attributes['movilc']) return trim($this->attributes['movilc']);
        else return trim($this->attributes['movil']);
    }

    public function getMovilAttribute() {
        if ($this->attributes['movil']) return trim($this->attributes['movil']);
        else return trim($this->attributes['movilc']);
    }

    public function getFijocAttribute() {
        if ($this->attributes['fijoc']) return trim($this->attributes['fijoc']);
        else return trim($this->attributes['fijo']);
    }

    public function getFijoAttribute() {
        if ($this->attributes['fijo']) return trim($this->attributes['fijo']);
        else return trim($this->attributes['fijoc']);
    }

    public function getOcupacioncAttribute() {
        if ($this->attributes['ocupacionc']) return trim($this->attributes['ocupacionc']);
        else return trim($this->attributes['ocupacion']);
    }

    public function getOcupacionAttribute() {
        if ($this->attributes['ocupacion']) return trim($this->attributes['ocupacion']);
        else return trim($this->attributes['ocupacionc']);
    }

    public function getTipoActividadcAttribute() {
        if ($this->attributes['tipo_actividadc']) return trim($this->attributes['tipo_actividadc']);
        else return trim($this->attributes['tipo_actividad']);
    }

    public function getTipoActividadAttribute() {
        if ($this->attributes['tipo_actividad']) return trim($this->attributes['tipo_actividad']);
        else return trim($this->attributes['tipo_actividadc']);
    }

    public function getEmpresacAttribute() {
        if ($this->attributes['empresac']) return trim($this->attributes['empresac']);
        else return trim($this->attributes['empresa']);
    }

    public function getEmpresaAttribute() {
        if ($this->attributes['empresa']) return trim($this->attributes['empresa']);
        else return trim($this->attributes['empresac']);
    }

    public function getPlacacAttribute() {
        if (isset($this->attributes['placac'])) return trim($this->attributes['placac']);
        else if(isset($this->attributes['placa'])) return trim($this->attributes['placa']);
    }
    
    public function getPlacaAttribute() {
        if (isset($this->attributes['placa'])) return trim($this->attributes['placa']);
        else if(isset($this->attributes['placac'])) return trim($this->attributes['placac']);
    }

    public function getEmailcAttribute() {
        if ($this->attributes['emailc']) return trim($this->attributes['emailc']);
        else return trim($this->attributes['email']);
    }

    public function getEmailAttribute() {
        if ($this->attributes['email']) return trim($this->attributes['email']);
        else return trim($this->attributes['emailc']);
    }

    public function getConyugueIdcAttribute() {
        if ($this->attributes['conyugue_idc']) return trim($this->attributes['conyugue_idc']);
        else return trim($this->attributes['conyugue_id']);
    }

    public function getConyugueIdAttribute() {
        if ($this->attributes['conyugue_id']) return trim($this->attributes['conyugue_id']);
        else return trim($this->attributes['conyugue_idc']);
    }

    public function getTelEmpresacAttribute() {
        if ($this->attributes['tel_empresac']) return trim($this->attributes['tel_empresac']);
        else return trim($this->attributes['tel_empresa']);
    }

    public function getTelEmpresaAttribute() {
        if ($this->attributes['tel_empresa']) return trim($this->attributes['tel_empresa']);
        else return trim($this->attributes['tel_empresac']);
    }

    public function getDirEmpresacAttribute() {
        if ($this->attributes['dir_empresac']) return trim($this->attributes['dir_empresac']);
        else return trim($this->attributes['dir_empresa']);
    }

    public function getDirEmpresaAttribute() {
        if ($this->attributes['dir_empresa']) return trim($this->attributes['dir_empresa']);
        else return trim($this->attributes['dir_empresac']);
    }

    // Relations

    public function cliente(){
    	return $this->belongsTo('App\Cliente');
    }

    public function soat(){
        return $this->hasOne('App\Soat','codeudor_id', 'id');
    }

    public function municipio(){
        if ($this->attributes['municipioc_id']) $municipio_key = 'municipioc_id';
        else $municipio_key = 'municipio_id';

        return $this->hasOne('App\Municipio','id',$municipio_key);
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


    // NOT C
    
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

    // RELATIONS

    public function client(){
        return $this->hasOne('App\Cliente','codeudor_id','id');
    }

    public function mun(){
        return $this->hasOne('App\Municipio','id','municipio_id');
    }

    public function study(){
        return $this->belongsTo('App\Estudio','id','codeudor_id');
    }

    public function spouse(){
        return $this->hasOne('App\Conyuge','id','conyuge_id');
    }

}
