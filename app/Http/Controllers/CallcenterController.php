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
        $this->middleware('auth');
    }


    /*
    |--------------------------------------------------------------------------
    | query
    |--------------------------------------------------------------------------
    | 
    | Recibe un array con los estados de los creditos a consultar
    | Retorna un objeto con el listado de creditos filtrado por estado
    |
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
             ->leftJoin('llamadas','creditos.last_llamada_id','=','llamadas.id')
             ->leftjoin('users','llamadas.user_create_id','=','users.id')
             ->select(DB::raw('
                 carteras.nombre             as cartera,
                 creditos.id                 as credito_id,
                 creditos.saldo              as saldo,
                 creditos.castigada          as castigada,
                 creditos.refinanciacion     as refinanciado,
                 creditos.credito_refinanciado_id as credito_refinanciado_id,
                 precreditos.vlr_fin         as valor_financiar,
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
             ->whereIn('creditos.estado',$array)
             ->orderBy('llamadas.created_at','desc')
             ->paginate(100);


 
         // segundo query para contabilizar el numero de sanciones diarias en debe
         // extracción ultima llamada realizada en el callcenter
 
         foreach($creditos as $credito){
             
             $sanciones = 
             DB::table('sanciones')
                 ->where([['credito_id','=',$credito->credito_id],['estado','=','Debe']])
                 ->count();
             
             $credito->sanciones = $sanciones;
             

            
         }
            return $creditos;        
    } 
    

    
    /*
    |--------------------------------------------------------------------------
    | index
    |--------------------------------------------------------------------------
    | 
    | Retorna listado de creditos activos (Al dia, Mora, Juridico, Prejuridico)
    | 
    |
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


    /*
    |--------------------------------------------------------------------------
    | list_agendados
    |--------------------------------------------------------------------------
    | 
    | Retorna listado de creditos activos (Mora, Juridico, Prejuridico) que estan 
    | ajendados justo para el dia de ayer
    | 
    |
    */ 

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
                creditos.refinanciacion     as refinanciado,
                creditos.credito_refinanciado_id as credito_refinanciado_id,
                precreditos.vlr_fin         as valor_financiar,
                municipios.nombre           as municipio,
                municipios.departamento     as departamento,
                creditos.estado             as estado,
                clientes.nombre             as cliente,
                clientes.num_doc            as doc,
                fecha_cobros.fecha_pago     as fecha_pago,
                users.name                  as funcionario,
                llamadas.agenda             as agenda'))
            ->where('llamadas.agenda','=',$ayer)
            ->whereIn('creditos.estado',['Mora','Juridico','Prejuridico'])
            ->orderBy('creditos.last_llamada_id','desc')
            ->paginate(500);


        foreach($creditos as $credito){
            $sanciones = 
            DB::table('sanciones')
                ->where([['credito_id','=',$credito->credito_id],['estado','=','Debe']])
                ->count();

            $credito->sanciones = $sanciones;

            $ultima_llamada = 
            DB::table('llamadas')
                ->join('users','llamadas.user_create_id','=','users.id')
                ->select('llamadas.observaciones', 'users.name', 'llamadas.created_at')
                ->where('llamadas.credito_id',$credito->credito_id)
                ->orderBy('llamadas.created_at','desc')
                ->first();

            // si el credito tiene llamadas

            if($ultima_llamada){
                $credito->observaciones = $ultima_llamada->observaciones;
                $credito->funcionario   = $ultima_llamada->name;
                $credito->fecha_llamada = "[ ".$ultima_llamada->created_at." ]";
            }
            // si el credito no tiene llamadas
            else{
                $credito->observaciones = '';
                $credito->funcionario   = '';
                $credito->fecha_llamada = '';
            }
        }
        
        
        return view('start.callcenter.list_agendados')
            ->with('creditos',$creditos)
            ->with('criterios',$criterios);  
    }

    /*
    |--------------------------------------------------------------------------
    | index_unique
    |--------------------------------------------------------------------------
    | 
    | Recibe el id de un credito
    | Retorna el credito y los criterios de llamada 
    | 
    |
    */

    public function index_unique($id){

        $credito    = Credito::find($id);
        $criterios  = Criterio::all();

        return view('start.callcenter.filter_credit_call')
            ->with('credito',$credito)
            ->with('criterios',$criterios);
    }


    public function create(){}
    public function store(Request $request){}

    /*
    |--------------------------------------------------------------------------
    | show
    |--------------------------------------------------------------------------
    | 
    | Recibe el id de un credito
    | Retorna toda la información del cliente, el credito y los pagos
    | 
    |
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


    public function edit($id){}

    public function update(Request $request, $id){}

    public function destroy($id){}

    /*
    |--------------------------------------------------------------------------
    | consultar_credito
    |--------------------------------------------------------------------------
    | 
    | Recibe el id de un credito
    | Retorna toda la información del credito y sus relaciones
    | 
    |
    */    

    public function consultar_credito($id){

        $credito = Credito::find($id);
        $credito->precredito->cliente;
        return response()->json(['credito' => $credito]);
    }

    /*
    |--------------------------------------------------------------------------
    | consultar_credito
    |--------------------------------------------------------------------------
    | 
    | Recibe el request de la llamada realizada por el callcenter
    | Crea un registro de la llamada realizada por el callcenter
    | 
    |
    */  

    public function call_create(Request $request){
        
       DB::beginTransaction();

       try{

            $credito = Credito::find($request->credito_id);

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

            $credito->last_llamada_id = $llamada->id;
            $credito->save();

            DB::commit();

            return response()->json(["mensaje" => "listo"]);

        } catch (\Exception $e){

            DB::rollback();

        }
    }

    /*
    |--------------------------------------------------------------------------
    | busqueda
    |--------------------------------------------------------------------------
    | 
    | metodo que busca el criterio de filtrado en la lista de llamadas del callcenter
    | 
    |
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

    /*
    |--------------------------------------------------------------------------
    | ExportarTodo
    |--------------------------------------------------------------------------
    | 
    | Metodo quepermite exportar toda la información concerniente a los creditos
    | con estado Al dia, Mora, Prejuridico, Juridico y Cancelado.
    |
    */  

    public function ExportarTodo()
    {
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
                        'cartera',
                        'credito_id',
                        'producto',
                        'vence SOAT',
                        'municipio',
                        'departamento',
                        'estado',
                        'centro de costos',
                        'saldo',
                        'cuotas pactadas',
                        'cuotas faltantes',
                        'cuotas pagadas (pactadas - faltantes)',
                        'sanciones',
                        'tipo moroso',
                        'castigada',
                        'refinanciado',
                        'credito_padre',
                        'cliente',
                        'documento',
                        'fecha_pago',
                        'fecha de agenda',
                        'observaciones',
                        'funcionario ultima llamada',
                        'fecha ultima llamada',
                        'funcionario que gestionó',
                        'fecha solicitud credito',
                        'fecha de apertura',
                        'pagos totales'
                    ];

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
                            'producto'      => $credito->producto,
                            'vence soat'    => $credito->soat,
                            'municipio'     => $credito->municipio,
                            'departamento'  => $credito->departamento,
                            'estado'        => $credito->estado,
                            'valor_financiar'=> $credito->valor_financiar,
                            'saldo'             => $credito->saldo,
                            'cuotas pactadas'   => $credito->cuotas_pactadas,
                            'cuotas faltantes'  => $credito->cuotas_faltantes,
                            'cuotas pagadas (pactadas - faltantes)'  => $credito->cuotas_pactadas - $credito->cuotas_faltantes,
                            'sanciones'         => $sanciones,
                            'tipo_moroso'       => $tipo_moroso,
                            'castigada'         => $credito->castigada,
                            'refinanciado'      => $credito->refinanciado,
                            'padre'             => $credito->credito_refinanciado_id,
                            'cliente'           => $credito->cliente,
                            'doc'               => $credito->doc,
                            'fecha_pago'        => $credito->fecha_pago,
                            'agenda'            => $agenda,
                            'observaciones'     => $observaciones,
                            'funcionario'       => $funcionario,
                            'fecha_llamada'     => $fecha_llamada,        
                            'funcionario_gestion'=> $credito->funcionario,
                            'fecha_solicitud'   => $credito->fecha_solicitud,
                            'fecha_aprobacion'  => $credito->aprobacion_credito,
                            'pagos totales'     => sum_pagos_por_id($credito->credito_id),
                            'pagos sanciones'   => sanciones_pagadas($credito->credito_id)
                            ];

    
                    array_push($array_creditos,$temp);
                    }
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

    public function misCall(){
        $calls = 
        Llamada::where('user_create_id',Auth()->user()->id)
            ->orderBy('id','desc')
            ->paginate(100);

        $dt = Carbon::now();
        $total = Llamada::where('created_at','like','%'.$dt->toDateString().'%')
                            ->where('user_create_id',Auth::user()->id)
                            ->count();
        
        return view('start.callcenter.miscall')
            ->with('calls', $calls)
            ->with('total',$total);
    }

    public function soat()
    {
        try
        {
            $now            = Carbon::now();
            $fecha          = $now->toDateTimeString();

            Excel::create('SoatCallCenter'.$fecha,function($excel){
                $excel->sheet('Sheetname',function($sheet){
                    
                    $soat_clientes = 
                    DB::table('soat')
                    ->join('clientes','soat.cliente_id','=','clientes.id')
                    ->join('municipios','clientes.municipio_id','=','municipios.id')
                    ->where('tipo','cliente')
                    ->select('soat.id as id',
                             'soat.tipo as tipo',
                             'clientes.id as cliente_id',
                             'soat.placa as placa',
                             'soat.vencimiento as vence',
                             'clientes.nombre as cliente',
                             'clientes.num_doc as documento',
                             'clientes.movil as movil',
                             'clientes.fijo as telefono',
                             'clientes.direccion as direccion',
                             'clientes.barrio as barrio',
                             'municipios.nombre as municipio',
                             'clientes.fecha_nacimiento as f_nacimiento',
                             'clientes.email as email',
                             'clientes.calificacion as calificacion'            
                    )
                    ->orderBy('soat.vencimiento','desc')
                    ->get();

                    $soat_codeudores = 
                    DB::table('soat')
                    ->join('codeudores','soat.codeudor_id','=','codeudores.id')
                    ->join('municipios','codeudores.municipioc_id','=','municipios.id')
                    ->where('tipo','codeudor')
                    ->select('soat.id as id',
                            'soat.tipo as tipo',
                            'soat.placa as placa',
                            'soat.vencimiento as vence',
                            'codeudores.nombrec as cliente',
                            'codeudores.num_docc as documento',
                            'codeudores.movilc as movil',
                            'codeudores.fijoc as telefono',
                            'codeudores.direccionc as direccion',
                            'codeudores.barrioc as barrio',
                            'municipios.nombre as municipio',
                            'codeudores.fecha_nacimientoc as f_nacimiento',
                            'codeudores.emailc as email')
                    ->orderBy('soat.vencimiento','desc')
                    ->get();                    

                    $temp  = array();
                    $array_soat  = array();


                    $header = [
                        'id',
                        'tipo',
                        'cliente',
                        'documento',
                        'placa',
                        'vencimiento',
                        'movil',
                        'telefono',
                        'direccion',
                        'barrio',
                        'municipio',
                        'fecha_nacimiento',
                        'email',
                        'calificacion'
                    ];
        
                    array_push($array_soat,$header);

        
                    foreach($soat_clientes as $soat){
        
                        $temp = [
                            'id'            => $soat->id,
                            'tipo'          => $soat->tipo,
                            'cliente'       => $soat->cliente,
                            'num_doc'       => $soat->documento,
                            'placa'         => $soat->placa,
                            'vencimiento'   => $soat->vence,
                            'movil'         => $soat->movil,
                            'telefono'      => $soat->telefono,
                            'direccion'     => $soat->direccion,
                            'barrio'        => $soat->barrio,
                            'municipio'     => $soat->municipio,
                            'fecha_nacimiento'=> $soat->f_nacimiento,
                            'email'         => $soat->email,
                            'calificacion'  => $soat->calificacion      
                            ];
            
                    array_push($array_soat,$temp);
                    }

                    foreach($soat_codeudores as $soat){
        
                        $temp = [
                            'id'            => $soat->id,
                            'tipo'          => $soat->tipo,
                            'cliente'       => $soat->cliente,
                            'num_doc'       => $soat->documento,
                            'placa'         => $soat->placa,
                            'vencimiento'   => $soat->vence,
                            'movil'         => $soat->movil,
                            'telefono'      => $soat->telefono,
                            'direccion'     => $soat->direccion,
                            'barrio'        => $soat->barrio,
                            'municipio'     => $soat->municipio,
                            'fecha_nacimiento'=> $soat->f_nacimiento,
                            'email'         => $soat->email,
                            'calificacion'  => ''     
                            ];
            
                    array_push($array_soat,$temp);
                    }

                $sheet->fromArray($array_soat,null,'A1',false,false);
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
