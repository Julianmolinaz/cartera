<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'id',
        'user_create_id',
        'action',
        'descrption',
        'created_at',
        'visible',
        'ref_type',
        'ref_id',
    ];
}
