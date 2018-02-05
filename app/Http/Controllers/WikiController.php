<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class WikiController extends Controller
{
    public function index(){

        $opciones = array(
            'Roles'
        );

        return view('start.wiki.index')
            ->with('opciones',$opciones);
    }

    public function escuchar($opcion){
        if($opcion == "Roles"){
            return view('start.wiki.roles');
        }
    }
}
