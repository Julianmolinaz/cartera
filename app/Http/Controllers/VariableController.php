<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Variable;
use App\Mensaje;


class VariableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variables = Variable::find(1);
       
        return view('admin.variables.index')
            ->with('variables',$variables);
            
    }

    public function create(){}

    public function store(Request $request){}

    public function show($id){}

    public function edit($id){}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'meses_min'             => 'required',
            'meses_max'             => 'required',
            'vlr_dia_sancion'       => 'required',
            'vlr_estudio_tipico'    => 'required',
            'vlr_estudio_domicilio' => 'required',
            'razon_social'          => 'required'
            ],
            [
            'meses_min.required'        => 'El Rango de Meses Mínimo es requerido',
            'meses_max.required'        => 'El Rango de Meses Máximo es requerido',
            'vlr_dia_sancion.required'  => 'El Valor día de mora es requerido',
            'vlr_estudio_tipico.required'=>'El Valor estudio típico es requerido',
            'vlr_estudio_domicilio.required'=>'El Valor estudio domicilio es requerido',
            'razon_social.required'     => 'La razon social de la empresa es requerida'
            ]
            );

        $variables = Variable::find(1);
        $variables->fill($request->all());
        $variables->vlr_dia_sancion = $request->vlr_dia_sancion;
        $variables->save();

        flash()->success('Edición de Variables Realizada!');
        return redirect()->route('admin.variables.index');

    }

    public function destroy($id){}

    /*
    |--------------------------------------------------------------------------
    | get_mensajes
    |--------------------------------------------------------------------------
    |
    | retorna los listado de los mensajes que se envian automaticamente por
    | el sistema.
    |
    */    

    public function get_mensajes()
    {
        try
        {
            $mensajes = Mensaje::all();

            $res = ['error' => false, 'res' => $mensajes];

            return response()->json($res);
        }
        catch(\Exception $e)
        {
            $res = ['error' => true, 'res' => $e->getMessage()];

            return response()->json($res);
        }
    }
}
