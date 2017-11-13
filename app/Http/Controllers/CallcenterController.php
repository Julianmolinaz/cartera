<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Credito;
use App\Criterio;
use App\Llamada;
use App\FechaCobro;
use App\Pago;
use Auth;
use DB;
use Carbon\Carbon;
use App\CallBusqueda;

class CallcenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hoy        = Carbon::now();
        $now        = formatoFecha(ano($hoy),mes($hoy),dia($hoy));
        $ayer       = Carbon::now()->subDay();
        $ayer       = formatoFecha(ano($ayer),mes($ayer),dia($ayer));
        $criterios  = Criterio::all();
        $filtro     = CallBusqueda::where('user_id',Auth::user()->id)->get();



        if(count($filtro) == 0){
            $filtro = 0;
        } else{ 
            $filtro = $filtro[0]->busqueda;
        }

        switch ($filtro) {
            /*********************************************************************************/
            case '0':
                $creditos = DB::table('creditos')->whereIn('estado',['Al dia','Mora','Juridico','Prejuridico'])
                                ->orderBy('updated_at','desc')->get();

                $creditos       = Credito::find(array_ids($creditos))->sortBy('updated_at');
                
                $tipo_filtrado  = new CallBusqueda();
                $tipo_filtrado->busqueda = 'Todos';
                $tipo_filtrado->user_id  = Auth::user()->id;
                $tipo_filtrado->save();
                
                break;
            /*********************************************************************************/
            case 'Todos':
                $creditos = DB::table('creditos')->whereIn('estado',['Al dia','Mora','Juridico','Prejuridico','Cancelado'])
                                ->orderBy('updated_at','desc')->get();

                $creditos       = Credito::find(array_ids($creditos))->sortBy('updated_at');
                
                break;
            /*********************************************************************************/
            case 'Morosos':
                $creditos = DB::table('creditos')->whereIn('estado',['Mora','Juridico','Prejuridico'])
                                ->orderBy('updated_at','desc')->get();

                $creditos       = Credito::find(array_ids($creditos))->sortBy('updated_at');  
            
                break;
            /*********************************************************************************/  

            case 'Agenda':  
                $creditos = 
                DB::table('creditos')
                    ->join('llamadas', 'creditos.id','=','llamadas.credito_id')
                    ->where('llamadas.agenda','=',$ayer)
                    ->whereIn('creditos.estado',['Mora','Juridico','Prejuridico'])
                    ->select('creditos.id as id')
                    ->orderBy('creditos.updated_at','desc')
                    ->get();

                $creditos       = Credito::find(array_ids($creditos))->sortBy('updated_at'); 
                break;  
        }

        return view('start.callcenter.index')
            ->with('creditos',$creditos)
            ->with('criterios',$criterios)
            ->with('busqueda',CallBusqueda::where('user_id',Auth::user()->id)->get()[0]);
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
        //
    }

    /**
     * MUESTR TODA LA INFORMACIÓN DEL CLIENTE, EL CREDITO, LOS PAGOS ETC
     *
     * @param  RECIBE EL ID DE UN CREDITO
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $credito = Credito::find($id);

        $sum_sanciones = DB::table('sanciones')->where([['credito_id','=',$id],['estado','Debe']])->sum('valor');
        if($sum_sanciones == 'null'){ $sum_sanciones = 0; }

        $juridico = DB::table('extras')
                        ->where([['credito_id','=',$id],
                                 ['estado','=','Debe'],
                                 ['concepto','=','Juridico']])
                        ->get();

        $prejuridico = DB::table('extras')
                        ->where([['credito_id','=',$id],
                                 ['estado','=','Debe'],
                                 ['concepto','=','Prejuridico']])
                        ->get();

        $total_parciales = DB::table('pagos')
                            ->where([['credito_id','=',$id],
                                    ['concepto','=','Cuota Parcial'],
                                    ['estado','=','Debe']])
                            ->sum('Debe');

        $llamadas = Llamada::where('credito_id',$id)->orderBy('created_at')->get();
        $pagos    = Pago::where('credito_id',$id)->orderBy('created_at')->get();

        return view('start.callcenter.show')
            ->with('credito',$credito)
            ->with('sum_sanciones',$sum_sanciones)
            ->with('juridico',$juridico)
            ->with('prejuridico',$prejuridico)
            ->with('total_parciales',$total_parciales)
            ->with('llamadas',$llamadas)
            ->with('pagos',$pagos);
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

    public function consultar_credito($id){

        $credito = Credito::find($id);
        $credito->precredito->cliente;
        return response()->json(['credito' => $credito]);
    }

    public function call_create(Request $request){
        
       DB::beginTransaction();

       try{

            $llamada = new Llamada();
            $llamada->credito_id    = $request->credito_id;
            $llamada->criterio_id   = $request->criterio_id;
            
            if($request->agenda == null){
                $llamada->agenda = null;
            }
            else{
                $llamada->agenda = inv_fech($request->agenda);
            }
            
            $llamada->observaciones = $request->observaciones;
            $llamada->user_create_id = Auth::user()->id;
            $llamada->user_update_id = Auth::user()->id;
            $llamada->save();

            DB::commit();

            return response()->json(["mensaje" => "listo"]);

        } catch (\Exception $e){

            DB::rollback();

        }
    }

    /*
        FUNCION QUE BUSCA EL CRITERIO DE FILTRADO EN LA LISTA DE LLAMADAS DEL CALLCENTER
    */

    public function busqueda($opcion)
    {
        try{
            $call = CallBusqueda::where('user_id',Auth::user()->id)->update(['busqueda' => $opcion]);
            return response()->json(true);
        } catch(\Exception $e){ 
            return response()->json($opcion);
        }   

    } 

    public function index_unique($id){

        $credito  = Credito::find($id);
        $criterios = Criterio::all();


        
        return view('start.callcenter.index')
            ->with('credito',$credito)
            ->with('criterios',$criterios)
            ->with('busqueda',CallBusqueda::where('user_id',Auth::user()->id)->get()[0]);
    }


}
