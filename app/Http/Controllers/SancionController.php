<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Sancion;
use App\Credito;
class SancionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
       $array = array_keys($request->all());

        for($i = 0; $i < count($array)-2; $i++){
            $sancion = Sancion::find($array[$i]); 
            if($sancion->estado == 'Debe'){
                $sancion->estado = 'Exonerada'; 
                $sancion->save();
                $credito = Credito::find($request->input('credito_id'));
                $credito->saldo = $credito->saldo - $sancion->valor;
                $credito->save();
            }  
            

            
        }
        return redirect()->route('admin.sanciones.show',$request->input('credito_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.sanciones.show')
            ->with('sanciones', Sancion::where('credito_id',$id)->orderBy('created_at','des')->get())
            ->with('credito',Credito::find($id));
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
        //
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
