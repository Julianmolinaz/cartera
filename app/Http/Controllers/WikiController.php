<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class WikiController extends Controller
{
    public function index(){

        $opciones = array(
            'Roles', 'Atajos'
        );

        return view('start.wiki.index')
            ->with('opciones',$opciones);
    }

    public function escuchar($opcion){
        if($opcion == "Roles"){
            return view('start.wiki.roles');
        }
        if($opcion == 'Atajos'){
            $atajos = [
                ['atajo' => 'alt n' , 'accion' => 'Abre buscador Gofin'],
                ['atajo' => 'alt s' , 'accion' => 'Abre simulador Gofin'],
                ['atajo' => 'alt c' , 'accion' => 'Abre listado de clientes Gofin'],
                ['atajo' => 'alt o' , 'accion' => 'Abre listado de creditos Gofin'],
                ['atajo' => 'alt p' , 'accion' => 'Abre panel de pagos Gofin'],
            ];
            return view('start.wiki.atajos')
                ->with('atajos', $atajos);
        }
    }
}
