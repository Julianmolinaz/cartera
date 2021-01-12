<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    protected $fillable = [
        'filename','created_by'
    ];

    public function masivos() {
        return $this->hasMany('App\Masivo','load_id','id');
    }

    public function creator() {
        return $this->hasOne('App\User','id','created_by');
    }
}
