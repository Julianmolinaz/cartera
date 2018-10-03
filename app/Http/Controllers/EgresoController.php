<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use App\Egreso;
use DB;
use Auth;
use App\User;
use App\Cartera;


class EgresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now     = Carbon::today();
        $now     = inv_fech(formatoFecha($now->day,$now->month,$now->year));

        $egresos = DB::table('egresos')->where('created_at','like',$now.'%')->get();

        $array = array();
        foreach($egresos as $egreso){   array_push($array,$egreso->id);  }   
        $egresos = Egreso::find($array);

        return view('admin.egresos.index')
            ->with('egresos',$egresos);
    }

    public function listar_egresos(){
        return view('admin.egresos.listar_egresos');
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
        return view('admin.egresos.create')
            ->with('conceptos',$conceptos)
            ->with('carteras',$carteras);
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
            );
        $rules_message = array(
            'fecha.required'                => 'La Fecha es requerida',
            'comprobante_egreso.required'   => 'El # Comprobande de Egreso es requerido',
            'cartera_id.required'           => 'La Cartera es requerida',  
            'comprobante_egreso.unique'     => 'El # Comprobante de Egreso ya existe',    
            'concepto.required'             => 'El Concepto es requerido',
            'valor.required'                => 'El Valor es requerido',
            'valor.numeric'                 => 'El Valor debe ser un numero',
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
        $egreso = Egreso::find($id);
        $conceptos = getEnumValues('egresos','concepto');
        $carteras = Cartera::all();
        return view('admin.egresos.edit')
            ->with('egreso',$egreso)
            ->with('conceptos',$conceptos)
            ->with('carteras',$carteras);
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
            'comprobante_egreso'    => 'required|unique:egresos,'.'id',
            'cartera_id'               => 'required',
            'concepto'              => 'required',
            'valor'                 => 'required|numeric',
            );
        $rules_message = array(
            'fecha.required'                => 'La Fecha es requerida',
            'comprobante_egreso.required'   => 'El # Comprobande de Egreso es requerido',
            'comprobante_egreso.unique'     => 'El # Comprobante de Egreso ya existe',
            'cartera_id.required'              => 'La Cartera es requerida',
            'concepto.required'             => 'El Concepto es requerido',
            'valor.required'                => 'El Valor es requerido',
            'valor.numeric'                 => 'El Valor debe ser un numero',
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
