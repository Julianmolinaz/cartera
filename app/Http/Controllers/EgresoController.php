<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use App\Cartera;
use App\Egreso;
use App\Punto;
use App\User;
use Auth;
use DB;


class EgresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.egresos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $conceptos = getEnumValues('egresos','concepto');
        $carteras  = Cartera::where('estado','Activo')->get();
        $puntos    = Punto::where('estado','Activo')->orderBy('nombre','asc')->get();

        return view('admin.egresos.create')
            ->with('conceptos',$conceptos)
            ->with('carteras',$carteras)
            ->with('puntos',$puntos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  
        $rules_egreso = array(
            'fecha'                 => 'required',
            'comprobante_egreso'    => 'required|unique:egresos',
            'cartera_id'               => 'required',
            'concepto'              => 'required',
            'valor'                 => 'required|numeric',
            'punto_id'              => 'required'
            );
        $rules_message = array(
            'fecha.required'                => 'La Fecha es requerida',
            'comprobante_egreso.required'   => 'El # Comprobande de Egreso es requerido',
            'cartera_id.required'           => 'La Cartera es requerida',  
            'comprobante_egreso.unique'     => 'El # Comprobante de Egreso ya existe',    
            'concepto.required'             => 'El Concepto es requerido',
            'valor.required'                => 'El Valor es requerido',
            'valor.numeric'                 => 'El Valor debe ser un numero',
            'punto_id.required'             => 'El punto es requerido'
            );

        $this->validate($request,$rules_egreso,$rules_message); 

        DB::beginTransaction();

        try{

            $egreso = new Egreso($request->all());
            $egreso->user_create_id = Auth::user()->id;
            $egreso->user_update_id = Auth::user()->id;
            $egreso->save();

            DB::commit();

            flash()->success($egreso->comprobante_egreso.' -El egreso se creo con éxito!');
            return redirect()->route('admin.egresos.index');

        }catch(\Exception $e){
            
            DB::rollback();
            
            flash()->error('Ocurrió un error!');
            return redirect()->route('admin.egresos.index');

        }
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
        $egreso     = Egreso::find($id);
        $conceptos  = getEnumValues('egresos','concepto');
        $carteras   = Cartera::all();
        $puntos     = Punto::where('estado','Activo')->orderBy('nombre','asc')->get();

        return view('admin.egresos.edit')
            ->with('egreso',$egreso)
            ->with('conceptos',$conceptos)
            ->with('carteras',$carteras)
            ->with('puntos',$puntos);
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
        $rules_egreso = array(
            'fecha'                 => 'required',
            'comprobante_egreso'    => "required|unique:egresos,comprobante_egreso,$id,id",
            'cartera_id'               => 'required',
            'concepto'              => 'required',
            'valor'                 => 'required|numeric',
            'punto_id'              => 'required'
            );
        $rules_message = array(
            'fecha.required'                => 'La Fecha es requerida',
            'comprobante_egreso.required'   => 'El # Comprobande de Egreso es requerido',
            'comprobante_egreso.unique'     => 'El # Comprobante de Egreso ya existe',
            'cartera_id.required'              => 'La Cartera es requerida',
            'concepto.required'             => 'El Concepto es requerido',
            'valor.required'                => 'El Valor es requerido',
            'valor.numeric'                 => 'El Valor debe ser un numero',
            'punto_id.required'             => 'El punto es requerido'
            );

        $this->validate($request,$rules_egreso,$rules_message); 


        $egreso = Egreso::find($id);
        $egreso->fill($request->all());
        $egreso->user_update_id = Auth::user()->id;
        $egreso->save();

         flash()->success($egreso->comprobante_egreso.' -El egreso se edito con éxito!');
        return redirect()->route('admin.egresos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $egreso = Egreso::find($id);
        $egreso->delete();
        flash()->error('El Egreso con comprobante '.$egreso->comprobante_egreso. ' se eliminó éxitosamente!');
        return redirect()->route('admin.egresos.index');
    }
}
