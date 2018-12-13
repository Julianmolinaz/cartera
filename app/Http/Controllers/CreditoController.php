<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\CreditoRepository;

use App\Traits\MensajeTrait;
use App\Precredito;
use App\FechaCobro;
use App\Castigada;
use Carbon\Carbon;
use App\Producto;
use App\Variable;
use App\Cartera;
use App\Credito;
use App\Cliente;
use App\User;
use Excel;
use Auth;
use DB;

class CreditoController extends Controller
{
    protected $creditos;
    use MensajeTrait;

    public function __construct(CreditoRepository $creditos){
      $this->creditos = $creditos;
    }

    /*
    |--------------------------------------------------------------------------
    | index
    |--------------------------------------------------------------------------
    | 
    | Return: listado de creditos en estado:
    | Al dia, Mora, Prejuridico, Juridico
    | 
    */

    public function index()
    {        
      $creditos = 
      DB::table('creditos')
          ->join('precreditos','creditos.precredito_id',  '=',  'precreditos.id')
          ->join('carteras'   ,'precreditos.cartera_id',  '=',  'carteras.id')
          ->join('clientes'   ,'precreditos.cliente_id',  '=',  'clientes.id')
          ->join('users'      ,'creditos.user_create_id', '=',  'users.id')
          ->join('fecha_cobros','creditos.id',            '=',  'fecha_cobros.credito_id')
          ->whereIn('creditos.estado',['Al dia','Mora','Prejuridico','Juridico'])
          ->select(DB::raw('
              creditos.id         as id,
              creditos.created_at as created_at,
              creditos.updated_at as updated_at,
              creditos.estado     as estado,
              precreditos.fecha   as precredito_fecha,
              carteras.nombre     as cartera,
              clientes.id         as cliente_id,
              clientes.nombre     as cliente,
              clientes.num_doc    as doc,
              precreditos.periodo as periodo,
              creditos.saldo      as saldo,
              users.name          as user_create,
              precreditos.id      as precredito_id,
              precreditos.fecha   as fecha,
              fecha_cobros.fecha_pago as fecha_pago,
              null                as sanciones
          '))
          ->orderBy('creditos.updated_at','desc')
          ->paginate(100);
          
          $creditos_array = [];
          
          //asignación numero de sanciones diarias
          
          foreach($creditos as $credito){
            $sanciones = 
            DB::table('sanciones')
              ->where([['credito_id','=',$credito->id],['estado','=','Debe']])
              ->count();

            $credito->sanciones = $sanciones;

          }

        return view('start.creditos.index')
          ->with('creditos',$creditos);
    }

    /*
    |--------------------------------------------------------------------------
    | cancelados
    |--------------------------------------------------------------------------
    | 
    | Return: listado de creditos en estado "Cancelado" y "Cancelado por refinanciación"
    | 
    */


    public function cancelados()
    {        

        $creditos = 
        DB::table('creditos')
            ->join('precreditos','creditos.precredito_id',  '=',  'precreditos.id')
            ->join('carteras'   ,'precreditos.cartera_id',  '=',  'carteras.id')
            ->join('clientes'   ,'precreditos.cliente_id',  '=',  'clientes.id')
            ->join('users'      ,'creditos.user_create_id', '=',  'users.id')
            ->join('fecha_cobros','creditos.id',            '=',  'fecha_cobros.credito_id')
            ->whereIn('creditos.estado',['Cancelado','Cancelado por refinanciacion'])
            ->select(DB::raw('
                creditos.id                       as id,
                creditos.created_at               as created_at,
                creditos.refinanciacion           as refinanciado,
                creditos.credito_refinanciado_id  as padre,
                creditos.cuotas_faltantes         as cuotas_faltantes,
                precreditos.observaciones         as observaciones,
                precreditos.p_fecha               as p_fecha,
                precreditos.s_fecha               as s_fecha,
                creditos.updated_at               as updated_at,
                creditos.estado                   as estado,
                precreditos.cuotas                as cuotas,
                precreditos.vlr_cuota             as vlr_cuota,
                precreditos.fecha                 as precredito_fecha,
                carteras.nombre                   as cartera,
                clientes.id                       as cliente_id,
                clientes.nombre                   as cliente,
                clientes.num_doc                  as doc,
                precreditos.periodo               as periodo,
                creditos.saldo                    as saldo,
                users.name                        as user_create,
                precreditos.id                    as precredito_id,
                precreditos.fecha                 as fecha,
                fecha_cobros.fecha_pago           as fecha_pago,
                creditos.created_at               as created_at,
                null                              as sanciones
            '))
            ->orderBy('creditos.updated_at','desc')
            ->paginate(100);
            
            $creditos_array = [];
            
            //asignación numero de sanciones diarias
            
            foreach($creditos as $credito){
              $sanciones = 
              DB::table('sanciones')
                ->where([['credito_id','=',$credito->id],['estado','=','Debe']])
                ->count();
  
              $credito->sanciones = $sanciones;
  
            }
  
          return view('start.creditos.cancelados')
            ->with('creditos',$creditos);
    }

    /*
    |--------------------------------------------------------------------------
    | create
    |--------------------------------------------------------------------------
    | RECIBE EL ID DE UN PRECREDITO (SOLICITUD)
    | RETORNA UN NUEVO CREDITO ASOCIADO AL PRECREDTITO (SOLICITUD)
    | 
    */

    public function create($id)
    {
       $precredito = Precredito::find($id);

       //valida que no existan creditos vigentes o que la solicitud actual no este aprobada

       if($precredito->credito){
           flash()->error('Ya existe un credito asociado !');
           return redirect()->route('start.precreditos.ver',$precredito->id);
       }
       elseif ($precredito->aprobado != 'Si') {
            flash()->error('La solicitud aun no ha sido aprobada !');
           return redirect()->route('start.precreditos.ver',$precredito->id);
       }
       else{// si no existen obligaciones vigentes se crea el credito
          DB::beginTransaction();

          try{

             $credito = new Credito();
             $credito->precredito_id    = $precredito->id;
             $credito->cuotas_faltantes = $precredito->cuotas;

             $credito->estado         = 'Al dia';
             $credito->valor_credito  = $precredito->cuotas * $precredito->vlr_cuota;
             $credito->saldo          = $credito->valor_credito;
             $credito->rendimiento    = $credito->valor_credito - $precredito->vlr_fin;
             $credito->castigada      = 'No';
             $credito->end_datacredito  = 0;
             $credito->end_procredito   = 0;
             $credito->user_create_id = Auth::user()->id;
             $credito->user_update_id = Auth::user()->id;
             $credito->save();

             // SE INCREMENTA EN UNO EL NUMERO DE CREDITOS DEL CLIENTE

             $cliente = Cliente::find($precredito->cliente_id);
             $cliente->numero_de_creditos++;
             $cliente->user_update_id = Auth::user()->id;
             $cliente->save();

             // se genera la fecha limite del primer pago del crédito.

             $fecha_pago = calcularFecha($credito->precredito->fecha,$credito->precredito->periodo, 1, $credito->precredito->p_fecha, $credito->precredito->s_fecha, true);

             $obj = new FechaCobro();
             $obj->credito_id = $credito->id;
             $obj->fecha_pago = inv_fech($fecha_pago['fecha_ini']);
             $obj->save();

             DB::commit();

             flash()->success('Se creo el crédito con éxito!');
             return redirect()->route('start.precreditos.ver',$credito->precredito->id);

          } catch(\Exception $e){

            DB::rollback();

            flash()->error('Ocurrió un error');
            return redirect()->route('start.precreditos.ver',$precredito->id);
          }

        }

    }

    public function store(Request $request){}
    public function show($id){}

    /*
    |--------------------------------------------------------------------------
    | edit
    |--------------------------------------------------------------------------
    | 
    | recibe el id de un crédito
    | retorna toda la información relacionada a un crédito
    |
    */

    public function edit($id)
    {  
      
      $credito        = Credito::find($id);
      $productos      = Producto::all();
      $variables      = Variable::find(1);
      $users          = User::all();
      $carteras       = Cartera::all();
      $f              = FechaCobro::where('credito_id',$id)->get()[0]->fecha_pago;
      $fecha_de_pago  = formatoFecha(dia($f), mes($f), ano($f));
      $estados_credito= getEnumValues('creditos', 'estado');
      unset($estados_credito['Cancelado por refinanciacion']);
      $calificaciones = getEnumValues('clientes', 'calificacion'); 

      return view('start.creditos.edit')
        ->with('credito',$credito)
        ->with('productos',$productos)
        ->with('variables',$variables)
        ->with('users',$users)
        ->with('carteras',$carteras)
        ->with('estados_credito',$estados_credito)
        ->with('fecha_de_pago',$fecha_de_pago)
        ->with('calificaciones',$calificaciones);
    }

    /*
    |--------------------------------------------------------------------------
    | update
    |--------------------------------------------------------------------------
    | 
    | recibe el request del credito y el id del crédito
    | retorna un credito modificado 
    |
    */

    public function update(Request $request, $id)
    {
      // valida que p_fecha sea menor que s_fecha

      $ini = $request->input('p_fecha')+1;
      if($request->input('s_fecha')){
        $fin = $request->input('s_fecha')-1;
      }
      

      if($request->input('s_fecha') == "" || $request->input('periodo') == 'Mensual'){
        $fin = 30;
      }
      if($request->input('periodo') == 'Quincenal'){
        $rule_s_fecha_quincena = 'required|integer|between:'.$ini.',30';
      }
      else {
        $rule_s_fecha_quincena = 'between:0,30';
      }

      // reglas de validacion del formulario
        if($request->input('periodo') == 'Quincenal'){
            $this->validate($request, ['s_fecha' => 'required'],
                                      ['s_fecha.required' => 'La Fecha 2 es requerida.']);
        }  

        $rules_fijos = array(
            'num_fact'      => 'required|unique:precreditos,num_fact,'. Credito::find($id)->precredito->id,
            'fecha'         => 'required',
            'vlr_fin'       => 'required',
            'producto_id'   => 'required',
            'periodo'       => 'required',
            'meses'         => 'required',
            'vlr_cuota'     => 'required',
            'p_fecha'       => 'required|integer|between:1,'.$fin,
            's_fecha'       => $rule_s_fecha_quincena,
            'funcionario_id'=> 'required',
            'fecha_pago'    => 'required',
            );
        
        // mensajes de error del formulario
        $message_fijos = array(
            'num_fact.required'      => 'El Número de Factura es requerido',
            'num_fact.unique'        => 'EL Número de factura ya existe',
            'fecha.required'         => 'La Fecha de afiliación es requerida',
            'vlr_fin.required'       => 'El Centro de Costos es requerido',   
            'producto_id.required'   => 'El Producto es requerido',
            'periodo.required'       => 'El Periodo es requerido',
            'meses.required'         => 'El # de Meses es requerido',
            'vlr_cuota.required'     => 'El Valor de la Cuota es requerido',
            'p_fecha.required'       => 'La Fecha 1 es requerida',
            'p_fecha.between'        => 'La Fecha 1 debe ser menor que la Fecha 2',
            's_fecha.between'        => 'La Fecha 2 debe ser mayor que la Fecha 1', 
            'funcionario_id.required'=> 'El Funcionario es requerido',
            'fecha_pago.required' => 'La Fecha de Pago es requerida',
            );
        
        //validacion

        $this->validate($request,$rules_fijos,$message_fijos);

        //si el periodo es quincenal se validan las dos fechas de pago mensual

        DB::beginTransaction();

        try{

          if($request->input('periodo') == 'Mensual'){ $s_fecha = '';}
          else{ $s_fecha = $request->input('s_fecha');}

          $credito    = Credito::find($id);
          $estado_anterior_credito   = $credito->estado; // se guarda el estado anterior del credito
          $precredito = Precredito::find($credito->precredito->id);
          $cliente    = Cliente::find($credito->precredito->cliente_id);

          $precredito->num_fact       = $request->input('num_fact');
          $precredito->fecha          = $request->input('fecha');
          $precredito->cartera_id     = $request->input('cartera_id');
          $precredito->funcionario_id = $request->input('funcionario_id');
          $precredito->producto_id    = $request->input('producto_id');
          $precredito->vlr_fin        = $request->input('vlr_fin');
          $precredito->periodo        = $request->input('periodo');
          $precredito->meses          = $request->input('meses');
          $precredito->cuotas         = $request->input('cuotas');
          $precredito->vlr_cuota      = $request->input('vlr_cuota');
          $precredito->p_fecha        = $request->input('p_fecha');
          $precredito->s_fecha        = $s_fecha;         
          $precredito->estudio        = $request->input('estudio');
          $precredito->cuota_inicial  = $request->input('cuota_inicial');
          $precredito->aprobado       = $request->input('aprobado');
          $precredito->observaciones  = $request->input('observaciones');
          $precredito->user_update_id = Auth::user()->id;
          $precredito->save();

          // valida y crea registro si se castiga cartera
          $anterior  = $credito->castigada;

          $credito->cuotas_faltantes  = $request->input('cuotas_faltantes');
          $credito->saldo             = $request->input('saldo');
          $credito->saldo_favor       = $request->input('saldo_favor');
          $credito->estado            = $request->input('estado_credito');
          $credito->rendimiento       = $request->input('rendimiento');
          $credito->valor_credito     = $request->input('valor_credito');
          $credito->castigada         = $request->input('castigada');
          $credito->recordatorio      = $request->input('recordatorio');
          $credito->user_update_id    = Auth::user()->id;
          $credito->save();

          $fecha_pago                 = FechaCobro::where('credito_id',$credito->id)->get()[0];
          $fecha_pago->fecha_pago     = inv_fech($request->input('fecha_pago'));
          $fecha_pago->save();

          $this->castigar($credito,$request->input('castigada'),$anterior);

          // calificación del cliente 

          if($request->input('calificacion') != ""){
            $cliente->calificacion    = $request->input('calificacion');
            $cliente->user_update_id  = Auth::user()->id;
            $cliente->save();
          }

          DB::commit();

            $movil  = $precredito->cliente->movil;

            // si el objeto de edición es el crédito

            if( ($credito->estado != $estado_anterior_credito ) && $movil){

              if( $credito->estado == 'Prejuridico' ){
                  $this->send_message([$movil],'MSS444'); }

              elseif( $credito->estado == 'Juridico' ){
                  $this->send_message([$movil],'MSS555'); }
            }
            

          flash()->success('El crédito con Id: '.$precredito->credito->id.' del cliente '.$cliente->nombre.' se editó con éxito!');
          return redirect()->route('start.precreditos.ver',$precredito->id);

        } catch(\Exception $e){

          DB::rollback();

          flash()->error('Ocurrió un error' . $e->getMessage());
          return redirect()->route('start.creditos.index');         

        }


    }
    /*
    |--------------------------------------------------------------------------
    | destroy
    |--------------------------------------------------------------------------
    | 
    | castigar valida si se quiere castigar cartera para crear un registro en la 
    | tabla castigadas  con el saldo a la fecha y la referencia al respectivo credito, 
    | si no se va a castigar no sucede nada, recibe un objeto credito y el atributo 
    | castigada que puede ser si o no.
    |
    | recibe un objeto credito ($credito), un si o no para castigada ($castigada_in),
    |  como estaba la castigada anteriormente ($anterior)
    |
    */

    private function castigar($credito, $castigada_in, $anterior){ 

      if($anterior <> $castigada_in){

        if($castigada_in == 'Si'){

          $castigada                  = new Castigada();
          $castigada->credito_id      = $credito->id;
          $castigada->fecha_limite    = $credito->fecha_pago->fecha_pago;
          $castigada->saldo           = $credito->saldo;
          $castigada->user_create_id  = Auth::user()->id;
          $castigada->user_update_id  = Auth::user()->id;
          $castigada->save();
        }
        else{
          $castigada = Castigada::where('credito_id',$credito->id)->get();
          $castigada[0]->delete();
          
        }
      }
      else{ // cuando no hay cambio en castigada solo se actulizan los datos necesarios
        
        DB::table('castigadas')
                    ->where('credito_id',$credito->id)
                    ->update(['fecha_limite'  => $credito->fecha_pago->fecha_pago,
                              'saldo'         => $credito->saldo,
                              'user_update_id'=> Auth::user()->id,
                              ]);
      }

    }

    /*
    |--------------------------------------------------------------------------
    | ExportarTodo
    |--------------------------------------------------------------------------
    | 
    | retorna un excel con toda la información relacionada de un crédito en estado
    | Al dia, Mora. Juridico, Prejuridico, Cancelado
    |
    */

    // retorna un archivo excel con el listado de todos los creditos activos

    function ExportarTodo(){

      try{
        $fecha = Carbon::now();
        $fecha = fecha_plana($fecha->toDateTimeString());

        Excel::create('creditos'.$fecha,function($excel){
          $excel->sheet('Sheetname',function($sheet){

            $creditos = $this->creditos->creditosQuery();
            $array_creditos = [];

            $header = ['id','cartera','producto','fecha_aprobacion','estado',
                        'sanciones','tipo de mora','cuotas_faltantes','centro_costo',
                        'valor_credito','periodo','cuotas','p_fecha', 's_fecha','inicial',
                        'funcionario', 'observaciones','castigada','refinanciacion','credito_padre',
                        'pago_hasta','primer_nombre','segundo_nombre','primer_apellido','segundo_apellido',
                        'documento'    
                    ];
            array_push($array_creditos,$header);

            foreach($creditos as $credito){
              $sanciones = 
                DB::table('sanciones')
                  ->where([['credito_id','=',$credito->id],['estado','=','Debe']])
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

              $temp = [
                'id'                => $credito->id,
                'cartera'           => $credito->cartera,
                'producto'          => $credito->producto,
                'fecha_aprobacion'  => $credito->fecha_aprobacion,
                'estado'            => $credito->estado,
                'sanciones'         => $sanciones,
                'tipo de mora'      => $tipo_moroso,  
                'cuotas_faltantes'  => $credito->cuotas_faltantes,
                'centro_costo'      => $credito->centro_costo,
                'valor_credito'     => $credito->valor_credito,
                'periodo'           => $credito->periodo,
                'cuotas'            => $credito->cuotas,
                'p_fecha'           => $credito->p_fecha,
                's_fecha'           => $credito->s_fecha,
                'inicial'           => $credito->inicial,
                'funcionario'       => $credito->funcionario,
                'observaciones'     => $credito->observaciones,
                'castigada'         => $credito->castigada,
                'refinanciacion'    => $credito->refinanciacion,
                'credito_padre'     => $credito->credito_padre,
                'pago_hasta'        => $credito->pago_hasta,
                'primer_nombre'     => $credito->primer_nombre,
                'segundo_nombre'    => $credito->segundo_nombre,
                'primer_apellido'   => $credito->primer_apellido,
                'segundo_apellido'  => $credito->segundo_apellido,
                'documento'         => $credito->documento
              ];


              array_push($array_creditos, $temp);
          }  


            $sheet->fromArray($array_creditos,null,'A1',false,false);
          });
      })->download('xls');

    }//end try
    catch(\Exception $e){
      dd('Error <br>*<br>*<br>'.$e);
    }
          
    }




    function refinanciar($id){

      $credito    = Credito::find($id);
      $users      = User::all()->sortBy('name');
      $productos  = Producto::all()->sortBy('nombre');
      $carteras   = Cartera::where('estado','Activo')->get();
      $variables  = Variable::find(1);

      return view('start.creditos.refinanciacion')
                ->with('users',$users)
                ->with('credito',$credito)
                ->with('productos',$productos)
                ->with('variables',$variables)
                ->with('carteras',$carteras)
                ->with('credito_id',$id); 
    }

    function crear_refinanciacion(Request $request){
      {
        $ini = $request->input('p_fecha')+1;
        $fin = $request->input('s_fecha')-1;
        if($request->input('s_fecha') == ""){
          $fin = 30;
        }
        if($request->input('periodo') == 'Quincenal'){
          $s_fecha_quincena = 'required|integer|between:'.$ini.',30';
        }else {$s_fecha_quincena = 'between:0,30'; }
  
          $rules_fijos = array(
              'num_fact'    => 'required|unique:precreditos',
              'fecha'       => 'required',
              'cartera_id'  => 'required',
              'vlr_fin'     => 'required',
              'producto_id' => 'required',
              'periodo'     => 'required',
              'meses'       => 'required',
              'estudio'     => 'required',
              'vlr_cuota'   => 'required',
              'p_fecha'     => 'required|integer|between:1,'.$fin,
              's_fecha'     => $s_fecha_quincena,
              'funcionario_id' => 'required',
              );
          $message_fijos = array(
              'num_fact.required'      => 'El Número de Factura es requerido',
              'num_fact.unique'        => 'EL Número de factura ya existe',
              'fecha.required'         => 'La Fecha de afiliación es requerida',
              'cartera_id.required'    => 'La Cartera es requerida',
              'vlr_fin.required'       => 'El Centro de Costos es requerido',
              'producto_id.required'   => 'El Producto es requerido',
              'periodo.required'       => 'El Periodo es requerido',
              'meses.required'         => 'El # de Meses es requerido',
              'estudio.required'       => 'El tipo de estudio es requerido',
              'vlr_cuota.required'     => 'El Valor de la Cuota es requerido',
              'p_fecha.required'       => 'La Fecha 1 es requerida',
              'p_fecha.between'        => 'La Fecha 1 debe ser menor que la Fecha 2',
              's_fecha.between'        => 'La Fecha 2 debe ser mayor que la Fecha 1',
              'funcionario_id.required'=> 'El Funcionario es requerido',
              );
  
          $this->validate($request,$rules_fijos,$message_fijos);

  
          //si el periodo es quincenal se validan las dos fechas de pago mensual
          if($request->input('periodo') == 'Quincenal'){
              $this->validate($request,
                              ['s_fecha' => 'required'],
                              ['s_fecha.required' => 'La Fecha 2 es requerida.']);
          }
  
          DB::beginTransaction();
  
          try{
              //validar que un cliente no tenga mas precréditos o créditos en proceso
              $credito_antiguo = Credito::find($request->input('credito_id'));
              $credito_antiguo->estado = 'Cancelado por refinanciacion';
              $credito_antiguo->save();

              $cliente = Cliente::find($credito_antiguo->precredito->cliente->id);

              $cant_precred =
              DB::table('precreditos')
                  ->join('clientes','precreditos.cliente_id','=','clientes.id')
                  ->where([
                      ['clientes.id','=',$cliente->id],
                      ['precreditos.aprobado','=','En estudio']])
                  ->count();

              if($cant_precred == 0){
  
                  $precredito = new Precredito($request->all());
  
                  if($request->input('cuota_inicial') == ""){
                      $precredito->cuota_inicial = 0;
                  }
                  $precredito->cliente_id     = $cliente->id;
                  $precredito->user_create_id = Auth::user()->id;
                  $precredito->user_update_id = Auth::user()->id;
                  $precredito->aprobado = 'Si';
                  $precredito->save();

                  // CREACION DEL CREDITO

                  $credito = new Credito();
                  $credito->precredito_id    = $precredito->id;
                  $credito->cuotas_faltantes = $precredito->cuotas;
                  $credito->end_datacredito  = 0;
                  $credito->end_procredito   = 0;
                  $credito->refinanciacion   = 'Si';
                  $credito->credito_refinanciado_id = $request->input('credito_id');
                  $credito->estado         = 'Al dia';
                  $credito->valor_credito  = $precredito->cuotas * $precredito->vlr_cuota;
                  $credito->saldo          = $credito->valor_credito;
                  $credito->rendimiento    = $credito->valor_credito - $precredito->vlr_fin;
                  $credito->castigada      = 'No';
                  $credito->user_create_id = Auth::user()->id;
                  $credito->user_update_id = Auth::user()->id;
                  $credito->save();
     
     
                  // se genera la fecha limite del primer pago del crédito.(más en helpers)
     
                  $fecha_pago = calcularFecha($credito->precredito->fecha,
                                              $credito->precredito->periodo, 
                                              1, 
                                              $credito->precredito->p_fecha, 
                                              $credito->precredito->s_fecha, 
                                              true);
     
                  $obj = new FechaCobro();
                  $obj->credito_id = $credito->id;
                  $obj->fecha_pago = inv_fech($fecha_pago['fecha_ini']);
                  $obj->save();
     
                  DB::commit();
     
                  flash()->success('Se creo el crédito con éxito!');
                  return redirect()->route('start.precreditos.ver',$precredito->id);
              }
              else{
                DB::commit();
  
                flash()->error('@ No se puede crear la solicitud, existen solicitudes en trámite!');
                      return redirect()->route('start.clientes.show');
              }
          } catch(\Exception $e){
              DB::rollback();
              echo 'hola';
              flash()->error('Ocurrió un error');
              return redirect()->route('start.precreditos.ver',$precredito->id);
          }
  
    }
}
}
