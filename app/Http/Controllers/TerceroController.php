<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tercero;
use Validator;
use Auth;
use DB;

class TerceroController extends Controller
{
    public function index()
    {
        return view('contabilidad.terceros.index');
    }

    public function list()
    {
        $terceros = Tercero::orderBy('updated_at','DESC')->get();
        
        return res(true,$terceros, '', 200);
    }

    public function create()
    {
        $tipos      = getEnumValues('terceros', 'tipo');
        $regimenes  = getEnumValues('terceros', 'regimen');
        $tipos_doc  = getEnumValues('terceros', 'tipo_doc');
        $municipios = DB::table('municipios')->where('id','<>',100)->get();

        return response()->json([
            'success' => true,
            'dat'     => [
                'tipos'     => $tipos,
                'regimenes' => $regimenes,
                'tipos_doc' => $tipos_doc,
                'municipios'=> $municipios
            ]
        ]);
    }

    public function store(Request $request)
    {
        $rq = $request->all();

        $validator = $this->validator($rq);

        if ( $validator->fails() ) {
            return res(false,$validator->errors()->toArray(),
                'Error de validación, corrija los siguientes errores',200);
        }

        $tercero = new Tercero($request->all());
        $tercero->created_by = Auth::user()->id;
        $tercero->save();

        return res(true,'','El tercero ha sido creado !!!',200);
    }
    

    public function validator($rq)
    {
        $rules          = [];
        $messages       = [];

        if (! $rq['razon_social'] ) {

            $regla = [ 'pnombre' => 'required', 'papellido' => 'required' ];

            $mensajes = [ 
                'pnombre.required' => 'El primer nombre es requerido',
                'papellido.required' => 'El primer apellido es requerido'
            ];

            $rules = array_merge($rules, $regla);
            $messages = array_merge($messages, $mensajes);
        }

        if ( (! $rq['pnombre'])  || (! $rq['papellido']) ) {
            
            $reglas= [ 'razon_social' => 'required' ];
            $mensajes = [ 'razon_social.required' => 'La razon social es requerida' ];

            $rules = array_merge($rules, $reglas);
            $messages = array_merge($messages, $mensajes);
        }

        $reglas = [
            'regimen'  => 'required',
            'tipo_doc' => 'required',
            'num_doc'  => 'required',
            'tipo'     => 'required',
            'mun_id' => 'required'
        ];

        $mensajes = [
            'regimen.required'  => 'El regimen es requerido',
            'tipo_doc.required' => 'El tipo de documento es requerido',
            'num_doc.required'  => 'El número de documento es requerido',
            'tipo.required'     =>  'El tipo de tercero es requerido',
            'mun_id.required' => 'El municipio es requerido'
        ];

        $rules = array_merge($rules, $reglas);
        $messages = array_merge($messages, $mensajes);

        $validator = Validator::make($rq,$rules,$messages);

        return $validator;
    }

}
