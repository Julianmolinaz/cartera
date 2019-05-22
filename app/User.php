<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\UserResolver;
use Auth;

class User extends Authenticatable  implements Auditable, UserResolver
{

    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'estado' , 'rol' , 'email', 'password','punto_id', 'banco', 'num_cuenta'
    ];

    public function cliente_create(){
        return $this->hasOne('App\User');
    }

    public function cliente_update(){
        return $this->hasOne('App\User');
    }

    public function precredito(){
        return $this->belongsTo('App\Precredito');
    }

    public function precredito_create(){
        return $this->hasOne('App\Precredito');
    }

    public function precredito_update(){
        return $this->hasOne('App\Precredito');
    }

    public function estudio(){
        return $this->belongsTo('App\Estudio');
    }

    public function estudio_create(){
        return $this->belongsTo('App\Estudio');
    }

    public function estudio_update(){
        return $this->belongsTo('App\Estudio');
    }

    public function credito_create(){
        return $this->belongsTo('App\Credito');
    }

    public function credito_update(){
        return $this->belongsTo('App\Credito');
    }

    public function punto(){
        return $this->hasOne('App\Punto','id','punto_id');
    }

    public function llamadas(){
        return $this->hasMany('App\Llamada','user_create_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }

}
