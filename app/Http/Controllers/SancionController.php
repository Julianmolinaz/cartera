<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Sancion;
use App\Credito;
use Carbon\Carbon;
use App\Variable;
use Auth;

class SancionController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sanciones.create');
    }

    public function crearSanciones(Request $request){
    
       $credito = Credito::find($request->input('credito_id'));//CREDITO
       $rango   = $request->input('rango');// FECHA INICIAL A FECHA FINAL PUEDEN SER IGUALES
       $sanciones = Sancion::where('credito_id',$credito->id);//TRAER TODAS LAS SANCIONES DEL CREDITO
       $fecha_ini = substr($rango,0,10);
       $fecha_fin = substr($rango,-10);
       $ya_existe = 0;  // CUANDO ES UN SOLO DIA DE SANCION SE PONE EN 1 SI YA EXISTE UNA MISMA FECHA
       $creadas = array();
       $existentes = array();


       //CUANDO ES UN SOLO DIA ****************************************

       if( $fecha_ini == $fecha_fin){
           $fecha = Carbon::createFromFormat('d/m/Y',substr($rango,0,10));
           //return response()->json($fecha);
            foreach($credito->sanciones as $sancion){ 
               if( substr($sancion->created_at,0,10 ) == $fecha->toDateString() ){
                 array_push($existentes,$fecha->toDateString());
                 $ya_existe = 1;
                 break; 
               }
            }
            //SI NO EXISTE UNA SANCION CON LA MISMA FECHASE CREA LA SANCION, UPDATED_AT QUEDA CON LA FECHA EN QUE SE HACE ESTA TRANSACCION

            if( !$ya_existe ){
                $nueva_sancion = new Sancion();
                $nueva_sancion->credito_id = $credito->id;
                $nueva_sancion->valor = Variable::find(1)->vlr_dia_sancion;
                $nueva_sancion->estado = 'Debe';
                $nueva_sancion->created_at = $fecha->toDateString();
                $nueva_sancion->save();

                $credito->saldo = $credito->saldo + Variable::find(1)->vlr_dia_sancion;
                $credito->sanciones_debe ++;
                $credito->user_update_id = Auth::user()->id;
                $credito->save();


                array_push($creadas,$fecha->toDateString());
                $mensaje = [
                   'error' => false,
                   'creadas' => $creadas,
                   'existentes' => $existentes];
            }
            else{
               $mensaje = [
                   'error' => FALSE,
                   'existentes' => $existentes,
                   'creadas'    => $creadas ];
            }
       }

       //CUANDO ES UN RANGO DE DIAS
       else{
           $fecha_ini = Carbon::create(ano($fecha_ini),mes($fecha_ini),dia($fecha_ini),00,00,00);
           $fecha_fin = Carbon::create(ano($fecha_fin),mes($fecha_fin),dia($fecha_fin),00,00,00);
           $fechas_existentes = '<br>';
           $fechas_agregadas = '<br>';

           while($fecha_ini->lte($fecha_fin)){
               $ya_existe = 0;
               foreach( $credito->sanciones as $sancion ){

                   $sancion->created_at->hour = 0;
                   $sancion->created_at->minute = 0;
                   $sancion->created_at->second = 0;

                   if( $sancion->created_at->eq($fecha_ini) ){
                       array_push($existentes, $fecha_ini->toDateString());
                       $ya_existe = 1;
                       break;
                   }
               }
               if(!$ya_existe){

                   $nueva_sancion = new Sancion();
                   $nueva_sancion->credito_id = $credito->id;
                   $nueva_sancion->valor = Variable::find(1)->vlr_dia_sancion;
                   $nueva_sancion->estado = 'Debe';
                   $nueva_sancion->created_at = $fecha_ini->toDateString();
                   $nueva_sancion->save();

                   $credito->saldo = $credito->saldo + Variable::find(1)->vlr_dia_sancion;
                   $credito->sanciones_debe ++;
                   $credito->user_update_id = Auth::user()->id;
                   $credito->save();

                   array_push($creadas,$fecha_ini->toDateString());

                }                
               $fecha_ini->addDay();

           }//end while

           $mensaje = [
               'error' => FALSE,
               'creadas' => $creadas,
               'existentes' => $existentes  ];

       } //end else

       return response()->json($mensaje);
       
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
                        $credito->sanciones_exoneradas ++;
                        $credito->sanciones_debe --;
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
                    $credito->sanciones_exoneradas --;
                    $credito->sanciones_debe ++;
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
