<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use DB;
use Auth;
use App\Estudio;
use App\EstDatacredito;
use App\EstLaboral;
use App\EstReferencias;
use App\EstVivienda;
use App\EstReferencia;


class EstudioController extends Controller
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
     * El $id hace referencia al individuo que solicita el estudio
     * EL $objeto hace referencia al objeto de estudio qu puede ser cliente o codeudor
     */
    public function create($id_cliente, $id_codeudor, $objeto)
    {
        /*
        * recordar que el codeudor con id 100 es un registro vacio que se utiliza
        * ṕara los clientes que no tienen codeudor ya que si no se crea se pueden generar 
        * errores en la vista start.clientes.show
        */
        //dd($id_cliente.' ' . $id_codeudor.' '. $objeto);
        //dd($id_cliente.' '.$id_codeudor.' '.$objeto);

        if ($objeto == 'codeudor' && $id_codeudor == 100){
            flash()->error('El Codeudor no existe');
            return redirect()->route('start.clientes.show',$id_cliente);
        }


        if($objeto == 'codeudor'){
            $existe = DB::table('estudios')
                    ->where('codeudor_id',$id_codeudor)
                    ->count();
                  
             if($existe){
              $estudio = Estudio::where('codeudor_id','=',$id_codeudor)->get();  
              $ir = 'editar';
            }
            else{
             $ir = 'crear';

            }

        }
        else{
            $existe = DB::table('estudios')
                    ->where('cliente_id',$id_cliente)
                    ->count();
                  
             if($existe){
              $estudio = Estudio::where('cliente_id','=',$id_cliente)->get();  

              $ir = 'editar';
            }
            else{
              $ir = 'crear';
            }
        }


        /**************************** Editar ****************************/
        if($ir == 'editar'){

            return view('start.estudios.edit')
                ->with('objeto',$objeto)
                ->with('id_cliente',$id_cliente)
                ->with('id_codeudor',$id_codeudor)
                ->with('estudio',$estudio[0])
                ->with('users',User::all()->sortBy('name'))
                ->with('datacreditos',EstDatacredito::all())
                ->with('laborales',EstLaboral::all())
                ->with('referencias',EstReferencia::all())
                ->with('viviendas',EstVivienda::all());          
        }

        /*****************************************************************/
        if($ir == 'crear'){

            $users = User::all()->sortBy('name');
            
            return view('start.estudios.create')
                ->with('objeto',$objeto)
                ->with('id_cliente',$id_cliente)
                ->with('id_codeudor',$id_codeudor)
                ->with('users',$users)
                ->with('datacreditos',EstDatacredito::all())
                ->with('laborales',EstLaboral::all())
                ->with('referencias',EstReferencia::all())
                ->with('viviendas',EstVivienda::all());
        }
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * est_lab = Valoración del estudio laboral
     */
    public function store(Request $request)
    {
        $rules = array(
                  "funcionario_id" => "required",  
                  "estLaboral_id" => "required",
                  "estVivienda_id" => "required",
                  "estReferencia_id" => "required",
                  "estDatacredito_id" => "required",
                  "cal_asesor" => "required",                  
            );
        $message = array(
                  "funcionario_id.required" => "El Asesor es requerido",  
                  "estLaboral_id.required" => "La Valoración Laboral es requerida",
                  "estVivienda_id.required" => "El Tiempo en Vivienda es requerido",
                  "estReferencia_id.required" => "Las Referencias son requeridas",
                  "estDatacredito_id.required" => "El Datacredito es requerido",
                  "cal_asesor.required" => "La Calificación del Asesor es requerido",    
            );
        $this->validate($request,$rules,$message);

        $estudio = new Estudio($request->all());
        
        //si el objeto de estudio es cliente
        
        if($request->input('objeto') == 'cliente'){
         
            $estudio->cliente_id = $request->input('id_cliente');            

        }//si el objeto de estudio es el codeudor

        else{
            $estudio->codeudor_id = $request->input('id_codeudor');
        }

   
        // Cálculo del puntaje del estudio

        $datacredito  = EstDatacredito::find($request->input('estDatacredito_id'))->puntaje * 0.4;
        $laboral      = EstLaboral::find($request->input('estLaboral_id'))->puntaje * 0.15;
        $vivienda     = EstVivienda::find($request->input('estVivienda_id'))->puntaje * 0.1;
        $referencia   = EstReferencia::find($request->input('estReferencia_id'))->puntaje * 0.2;
        $cal_asesor   = $request->input('cal_asesor') * 0.15;

        $cal_estudio  = $datacredito + $laboral + $vivienda + $referencia + $cal_asesor;


        $estudio->cal_estudio = $cal_estudio;

        $estudio->user_create_id = Auth::user()->id;
        $estudio->user_update_id = Auth::user()->id;

        $estudio->save();

        flash()->success('El Estudio tiene una calificación de: '.$estudio->cal_estudio);
        return redirect()->route('start.clientes.show',$request->input('id_cliente'));

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
                $rules = array(
                  "funcionario_id" => "required",  
                  "estLaboral_id" => "required",
                  "estVivienda_id" => "required",
                  "estReferencia_id" => "required",
                  "estDatacredito_id" => "required",
                  "cal_asesor" => "required",                  
            );
        $message = array(
                  "funcionario_id.required" => "El Asesor es requerido",  
                  "estLaboral_id.required" => "La Valoración Laboral es requerida",
                  "estVivienda_id.required" => "El Tiempo en Vivienda es requerido",
                  "estReferencia_id.required" => "Las Referencias son requeridas",
                  "estDatacredito_id.required" => "El Datacredito es requerido",
                  "cal_asesor.required" => "La Calificación del Asesor es requerido",    
            );
        $this->validate($request,$rules,$message);

        
        //si el objeto de estudio es cliente
        
        if($request->input('objeto') == 'cliente'){
         
            $estudio = Estudio::where('cliente_id','=',$request->input('id_cliente'))->get()[0];
          
        }//si el objeto de estudio es el codeudor

        else{
            $estudio = Estudio::where('codeudor_id','=',$request->input('id_codeudor'))->get()[0];
         
        }

        $estudio->fill($request->all());
        // Cálculo del punta del estudio

        $datacredito = EstDatacredito::find($request->input('estDatacredito_id'))->puntaje * 0.4;
        $laboral     = EstLaboral::find($request->input('estLaboral_id'))->puntaje * 0.15;
        $vivienda     = EstVivienda::find($request->input('estVivienda_id'))->puntaje * 0.1;
        $referencia  = EstReferencia::find($request->input('estReferencia_id'))->puntaje * 0.2;
        $cal_asesor  = $request->input('cal_asesor') * 0.15;


        $cal_estudio = $datacredito + $laboral + $vivienda + $referencia + $cal_asesor;


        $estudio->cal_estudio = $cal_estudio;

        $estudio->user_update_id = Auth::user()->id;

        $estudio->save();

        flash()->success('El Estudio tiene una calificación de: '.$estudio->cal_estudio);
        return redirect()->route('start.clientes.show',$request->input('id_cliente'));

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
