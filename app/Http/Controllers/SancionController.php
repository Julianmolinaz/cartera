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
        dd('hola');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credito = Credito::find( $request->input('credito_id') );
        $array = array_keys($request->all());

        $sanciones = $credito->sanciones;
        $count_debe = 0;
        $count_exoneradas = 0;

        foreach( $sanciones as $sancion ){
            $bandera = 0;
            for($i = 0; $i < count($array)-2; $i++){
                if( $sancion->id == $array[$i] ){
                    if( $sancion->estado == 'Debe' ){
                        $sancion->estado = 'Exonerada';
                        $sancion->save();
                        $credito->saldo = $credito->saldo - $sancion->valor;
                        $credito->save();
                        $bandera = 1;
                        $count_exoneradas++;
                    }
                    else{
                        $bandera = 2;
                    }
                }
            }
            if( $bandera == 0 ){
                if($sancion->estado == 'Exonerada'){
                    $sancion->estado = 'Debe';
                    $sancion->save();
                    $credito->saldo = $credito->saldo + $sancion->valor;
                    $credito->save();
                    $count_debe++;                    
                }
            }
        }

        flash()->success('Exonerados: '.$count_exoneradas.', Se colocaron en debe: '.$count_debe);
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
