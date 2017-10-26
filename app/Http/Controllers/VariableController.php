<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Variable;


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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

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
            'vlr_estudio_domicilio' => 'required'
            ],
            [
            'meses_min.required'        => 'El Rango de Meses Mínimo es requerido',
            'meses_max.required'        => 'El Rango de Meses Máximo es requerido',
            'vlr_dia_sancion.required'  => 'El Valor día de mora es requerido',
            'vlr_estudio_tipico.required'=>'El Valor estudio típico es requerido',
            'vlr_estudio_domicilio.required'=>'El Valor estudio domicilio es requerido'
            ]
            );

        $variables = Variable::find(1);
        $variables->fill($request->all());
        $variables->vlr_dia_sancion = $request->vlr_dia_sancion;
        $variables->save();

        flash()->success('Edición de Variables Realizada!');
        return redirect()->route('admin.variables.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
