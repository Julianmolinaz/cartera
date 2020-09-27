<?php

namespace App\Traits;

trait ConyugeTrait 
{
    public static function rulesConyugeTr ($type)
    {
        return [
            'p_nombrey'     => 'required',
            'p_apellidoy'   => 'required',
            'tipo_docy'     => '',
            'num_docy'      => '',
            'movily'        => 'required',
            'diry'          => ''
        ];
    }

    public static function messagesConyugeTr () 
    {
        return [
            'p_nombrey.required'     => 'El primer nombre del conyuge es requerido',
            'p_apellidoy.required'   => 'El primer apellido del conyuge es requerido',
            'movily.required'        => 'El celular del conyuge es requerido'
        ];
    }
}