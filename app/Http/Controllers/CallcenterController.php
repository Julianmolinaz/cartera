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
use App\Repositories\CreditoRepository;
use Excel;

class CallcenterController extends Controller
{
    protected $creditos ;

    public function __construct(CreditoRepository $creditos){
        $this->creditos = $creditos;
    }
    /**
     * Recibe un array con los estados de los creditos a consultar
     * Retorna un array con el listado de creditos filtrado por estado
     * @return \Illuminate\Http\Response
     */

    protected function query($array){

         //primer query
         $creditos = 
         DB::table('creditos')
             ->join('precreditos','precreditos.id','=','creditos.precredito_id')
             ->join('carteras','precreditos.cartera_id','=','carteras.id')
             ->join('clientes','precreditos.cliente_id','=','clientes.id')
             ->join('municipios','clientes.municipio_id','=','municipios.id')
             ->join('fecha_cobros','creditos.id','=','fecha_cobros.credito_id')
             ->select(DB::raw('
                 carteras.nombre             as cartera,
                 creditos.id                 as credito_id,
                 creditos.saldo              as saldo,
                 municipios.nombre           as municipio,
                 municipios.departamento     as departamento,
                 creditos.estado             as estado,
                 clientes.nombre             as cliente,
                 clientes.num_doc            as doc,
                 fecha_cobros.fecha_pago     as fecha_pago'))
             ->whereIn('creditos.estado',$array)
             ->orderBy('creditos.updated_at','desc')
             ->paginate(500);
 
         // segundo query para contabilizar el numero de sanciones diarias en debe
         // extracción ultima llamada realizada en el callcenter
 
         foreach($creditos as $credito){
             
             $sanciones = 
             DB::table('sanciones')
                 ->where([['credito_id','=',$credito->credito_id],['estado','=','Debe']])
                 ->count();
             
             $credito->sanciones = $sanciones;
 
 
             $ultima_llamada = 
             DB::table('llamadas')
                 ->join('users','llamadas.user_create_id','=','users.id')
                 ->where('llamadas.credito_id',$credito->credito_id)
                 ->orderBy('llamadas.created_at','desc')
                 ->first();
 
             // si el credito tiene llamadas
 
             if($ultima_llamada){
                 $credito->agenda        = $ultima_llamada->agenda;
                 $credito->observaciones = $ultima_llamada->observaciones;
                 $credito->funcionario   = $ultima_llamada->name;
                 $credito->fecha_llamada = "[ ".$ultima_llamada->created_at." ]";
             }
             // si el credito no tiene llamadas
             else{
                 $credito->agenda        = '';
                 $credito->observaciones = '';
                 $credito->funcionario   = '';
                 $credito->fecha_llamada = '';
             }
            }
            return $creditos;        
    } 



     /**
     * Retorna listado de creditos activos (Al dia, Mora, Juridico, Prejuridico)
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $criterios  = Criterio::all();
        $creditos   = $this->query(['Al dia','Mora','Prejuridico','Juridico']); 
       
        return view('start.callcenter.list_todos')
            ->with('creditos',$creditos)
            ->with('criterios',$criterios);
    }

    public function list_morosos(){

        $criterios  = Criterio::all();
        $creditos   = $this->query(['Mora','Prejuridico','Juridico']);

        return view('start.callcenter.list_morosos')
            ->with('creditos',$creditos)
            ->with('criterios',$criterios);        
    }


    

    public function list_agendados(){
       
        $ayer       = Carbon::now()->subDay();
        $ayer       = formatoFecha(ano($ayer),mes($ayer),dia($ayer));
        $criterios  = Criterio::all();

        $creditos = 
        DB::table('creditos')
            ->join('precreditos','precreditos.id','=','creditos.precredito_id')
            ->join('carteras','precreditos.cartera_id','=','carteras.id')
            ->join('clientes','precreditos.cliente_id','=','clientes.id')
            ->join('municipios','clientes.municipio_id','=','municipios.id')
            ->join('fecha_cobros','creditos.id','=','fecha_cobros.credito_id')
            ->join('llamadas','creditos.id','=','llamadas.credito_id')
            ->join('users','llamadas.user_create_id','=','users.id')
            ->select(DB::raw('
                carteras.nombre             as cartera,
                creditos.id                 as credito_id,
                creditos.saldo              as saldo,
                municipios.nombre           as municipio,
                municipios.departamento     as departamento,
                creditos.estado             as estado,
                clientes.nombre             as cliente,
                clientes.num_doc            as doc,
                fecha_cobros.fecha_pago     as fecha_pago,
                llamadas.agenda             as agenda,
                llamadas.observaciones      as observaciones,
                llamadas.created_at         as fecha_llamada,
                users.name                  as funcionario'))
            ->where('llamadas.agenda','=',$ayer)
            ->whereIn('creditos.estado',['Mora','Juridico','Prejuridico'])
            ->orderBy('creditos.updated_at','desc')
            ->paginate(500);


        foreach($creditos as $credito){
            $sanciones = 
            DB::table('sanciones')
                ->where([['credito_id','=',$credito->credito_id],['estado','=','Debe']])
                ->count();

            $credito->sanciones = $sanciones;
        }
        
        return view('start.callcenter.list_agendados')
            ->with('creditos',$creditos)
            ->with('criterios',$criterios);  
    }


    public function index_unique($id){

        $credito    = Credito::find($id);
        $criterios  = Criterio::all();

        return view('start.callcenter.filter_credit_call')
            ->with('credito',$credito)
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


    public function ExportarTodo(){

        try{

            $now            = Carbon::now();
            $fecha          = $now->toDateTimeString();

            Excel::create('CreditosCallCenter'.$fecha,function($excel){
                $excel->sheet('Sheetname',function($sheet){

                    $temp           = array();
                    $array_creditos = array();
                    $tipo_moroso;

                    $creditos = $this->creditos->creditosTipoCall();

                    $header = [
                        'cartera','credito_id','municipio','departamento',
                        'estado','sanciones','tipo moroso','cliente','doc',
                        'fecha_pago','agenda','observaciones','funcionario','fecha_llamada'];
        
                    array_push($array_creditos,$header);

        
                    foreach($creditos as $credito){
            
                        $sanciones = 
                        DB::table('sanciones')
                            ->where([['credito_id','=',$credito->credito_id],['estado','=','Debe']])
                            ->count();
            
                        if($sanciones > 0 && $sanciones <= 30){
                            $tipo_moroso = 'Morosos ideales';
                        }
                        elseif($sanciones > 30 && $sanciones <= 90){
                            $tipo_moroso = 'Morosos alerta';
                        }
                        elseif($sanciones > 90){
                            $tipo_moroso = 'Morosos crìticos';
                        }
                        else{
                            $tipo_moroso = 'No moroso';
                        }

                        $ultima_llamada = 
                        DB::table('llamadas')
                            ->join('users','llamadas.user_create_id','=','users.id')
                            ->where('llamadas.credito_id',$credito->credito_id)
                            ->select(
                                'llamadas.agenda as agenda',
                                'llamadas.observaciones as observaciones',
                                'llamadas.created_at as created_at',
                                'users.name'
                            )
                            ->orderBy('llamadas.created_at','desc')
                            ->first();
  
                        // si el credito tiene llamadas

                        if($ultima_llamada){
                            $agenda        = $ultima_llamada->agenda;
                            $observaciones = $ultima_llamada->observaciones;
                            $funcionario   = $ultima_llamada->name;
                            $fecha_llamada = $ultima_llamada->created_at;
                        }
                        // si el credito no tiene llamadas
                        else{
                            $agenda        = '';
                            $observaciones = '';
                            $funcionario   = '';
                            $fecha_llamada = '';
                        }

        
                        $temp = [
                            'cartera'       => $credito->cartera,
                            'credito_id'    => $credito->credito_id,
                            'municipio'     => $credito->municipio,
                            'departamento'  => $credito->departamento,
                            'estado'        => $credito->estado,
                            'sanciones'     => $sanciones,
                            'tipo_moroso'   => $tipo_moroso,
                            'cliente'       => $credito->cliente,
                            'doc'           => $credito->doc,
                            'fecha_pago'    => $credito->fecha_pago,
                            'agenda'        => $agenda,
                            'observaciones' => $observaciones,
                            'funcionario'   => $funcionario,
                            'fecha_llamada' => $fecha_llamada         
                            ];
            
                    array_push($array_creditos,$temp);
                    }

                    // $response = [
                    //     'error' => false,
                    //     'data'  => 'Reporte generado exitosamente'
                    // ];
        
                    // return response()->json($response);
                $sheet->fromArray($array_creditos,null,'A1',false,false);
                });
            })->download('xls');

            return redirect()->route('call.index'); 
        }//end try
        catch(\Exception $e){
            echo 'Error<br>*<br>*<br>*<br>*<br>';
            dd($e);
        }    
    }


}
