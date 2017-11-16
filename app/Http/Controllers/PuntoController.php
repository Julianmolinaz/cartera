<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Punto;  
use App\Municipio;
use DB;

class PuntoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.puntos.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listall()
    {

        $puntos = Punto::where('id','>',0)->orderBy('updated_at','desc')->paginate(6);
        $estados = getEnumValues('puntos', 'estado');
        $municipios = Municipio::all();

        
        return view('admin.puntos.list_puntos')
            ->with('puntos',$puntos)
            ->with('estados',$estados)
            ->with('municipios',$municipios);
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
     * Crea un punto o sucursal de la organización
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            DB::beginTransaction();
            try{

                $this->validate($request,
                    ['nombre'       => 'required|unique:puntos',
                     'direccion'    => 'required',
                     'municipio_id' => 'required']);
                
                $punto = new Punto();
                $punto->nombre = strtoupper($request->input('nombre'));
                $punto->direccion = strtoupper($request->input('direccion'));
                $punto->descripcion = strtoupper($request->input('descripcion'));
                $punto->municipio_id = $request->input('municipio_id');
                $punto->save();
                DB::commit();

                return response()->json(['res' => true, 'nombre' => $punto->nombre ]);

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
        $punto      = Punto::find($id);
        $estados    = getEnumValues('puntos','estado');

        return response()->json(['punto' => $punto, 'estados' => $estados]);
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
        try{
            $this->validate($request,
            ['nombre' => 'required|unique:puntos,nombre,'.$id,'direccion' => 'required']);  
        

            $punto              = Punto::find($id);
            $punto->id          = $request->input('id');
            $punto->nombre      = strtoupper($request->input('nombre'));
            $punto->direccion   = strtoupper($request->input('direccion'));
            $punto->municipio_id=$request->input('municipio_id');
            $punto->descripcion = strtoupper($request->input('descripcion'));
            $punto->estado      = $request->input('estado'); 
            $punto->save();

            $respuesta= [
                'error' => FALSE,
                'mensaje' => 'El Punto "'.$punto->nombre.'" se editó con éxito!!!!' ];

            return response()->json($respuesta);
        }
        catch(\Exception $e){

            $respuesta= ['error' => FALSE,
                         'mensaje' => 'ERROR' ];
            return response()->json($respuesta);
        }

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
            $punto = Punto::find($id);
            $temp = $punto->nombre;
            $punto->delete();
            DB::commit();
            return response()->json('El Punto "'.$temp.'" se eliminó con éxito!!!');
        }catch(\Exception $e){
            DB::rollback();
            return response()->json('Ocurrió un error!!!');
        }
    }


    // cargar envia los municipios mediante un mensaje ajax

    public function cargar(){
        
        try{
            $municipios = Municipio::where('id','<>',100)->get();
            $respuesta = [
                'error' => FALSE,
                'data'  => $municipios
            ];
            return response()->json($respuesta);
        }
        catch(\Exceptio $e){
            return response()->json(['error' => TRUE]);
        }
        
        
    }
}
