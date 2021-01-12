<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Criterio;
use DB;

class CriteriocallController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.criteriocall.index');
    }

    public function listall(){

        $criterios = Criterio::paginate(6);
        //dd($criterios);
        return view('admin.criteriocall.list_criterio')
            ->with('criterios',$criterios);
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
        $this->validate($request,['criterio' => 'required|unique:criterios']);

        if($request->ajax()){
            DB::beginTransaction();
            try{
                
                $criterio = new Criterio();
                $criterio->criterio = $request->input('criterio');
                $criterio->descripcion = $request->input('descripcion');
                $criterio->save();
                DB::commit();

                return response()->json(['res' => true, 'criterio' => $criterio->criterio ]);

            } catch(\Exception $e){
                DB::rollback();
                return response()->json(['res' => false]);
            }
            
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
        $criterio = Criterio::find($id);
        return response()->json($criterio);
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
            $this->validate($request,['criterio' => 'required|unique:criterios,criterio,'.$id]);   

            $criterio = Criterio::find($id);
            $criterio->fill($request->all());

            if ($criterio->criterio == 'ACUERDO DE PAGO') {
                return res(false, '', 'No se puede cambiar este criterio');
            }

            $criterio->save();
            return res(true, $criterio->criterio, 'Criterio editado exitosamente !!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $criterio = Criterio::find($id);
            $temp = $criterio->criterio;
            $criterio->delete();
            DB::commit();
            return response()->json('El criterio "'.$temp.'" se eliminó con éxito!!!');
        }catch(\Exception $e){
            DB::rollback();
            return response()->json('Ocurrió un error!!!');
        }
    }
}
