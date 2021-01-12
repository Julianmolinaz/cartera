<?php

namespace App\MyService;
use Auth;

class Access
{
    public static function in($roles)
    {
        $bandera = 1;

        foreach ($roles as $rol) {
            if (Auth::user()->rol == $rol) {
                $bandera = 0;
            }
        }

        return $bandera;
    }

    public static function out()
    {
        flash()->error('No puede acceder');
        return view('errors.403');
    }

    public static function outJson()
    {
        return response()->json([
            'error'     => true,
            'data'      => '',
            'message'   => 'No tiene permisos',
            'status'    => 400
        ]);
    } 
}
