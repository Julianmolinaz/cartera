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
        'user_create_id','user_update_id','calificacion'

    ];

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

    protected $auditExclude = [
        'published',
    ];

}
