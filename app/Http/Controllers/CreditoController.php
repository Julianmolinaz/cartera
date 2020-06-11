<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\CreditoRepository;
use App\Traits\Creditos\CreditoUpdateTrait;
use App\Traits\Solicitudes\SolicitudUpdateTrait;
use App\Traits\Creditos\DatatableCreditoTrait;
use App\Traits\MensajeTrait;
use App\Http\Requests;
use App\Precredito;
use App\FechaCobro;
use App\Castigada;
use Carbon\Carbon;
use App\Producto;
use App\Variable;
use App\Cartera;
use App\Credito;
use App\Cliente;
use Datatables;
use App\User;
use Excel;
use Auth;
use DB;

class CreditoController extends Controller
{
    protected $creditos;
    use MensajeTrait;
    use CreditoUpdateTrait;
    use SolicitudUpdateTrait;
    use DatatableCreditoTrait;

    public function __construct(CreditoRepository $creditos){
      $this->creditos = $creditos;
      $this->middleware('auth');
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
        return view('start.creditos.index');
    }//.index

   

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
                creditos.id                       as id,               creditos.created_at               as created_at,
                creditos.refinanciacion           as refinanciado,     creditos.credito_refinanciado_id  as padre,
                creditos.cuotas_faltantes         as cuotas_faltantes, precreditos.observaciones         as observaciones,
                precreditos.p_fecha               as p_fecha,          precreditos.s_fecha               as s_fecha,
                creditos.updated_at               as updated_at,       creditos.estado                   as estado,
                precreditos.cuotas                as cuotas,           precreditos.vlr_cuota             as vlr_cuota,
                precreditos.fecha                 as precredito_fecha, carteras.nombre                   as cartera,
                clientes.id                       as cliente_id,       clientes.nombre                   as cliente,
                clientes.num_doc                  as doc,              precreditos.periodo               as periodo,
                creditos.saldo                    as saldo,            users.name                        as user_create,
                precreditos.id                    as precredito_id,    precreditos.fecha                 as fecha,
                fecha_cobros.fecha_pago           as fecha_pago,       creditos.created_at               as created_at,
                null                              as sanciones'))
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
    }//.cancelados

    /*
    |--------------------------------------------------------------------------
    | create
    |--------------------------------------------------------------------------
    | RECIBE EL ID DE UN PRECREDITO (SOLICITUD)
    | RETORNA UN NUEVO CREDITO ASOCIADO AL PRECREDTITO (SOLICITUD)
    | 
    */

    public function create($id, $mes, $anio)
    {

       $precredito = Precredito::find($id);

       //validacion del pago de estudio de crédito

       if (! $this->validar_pagos_por_estudio($precredito)) {
          flash()->error('Se requiere el pago del estudio de crédito !');
          return redirect()->route('start.precreditos.ver',$precredito->id);
       }

       // validacion del pago por cuota inicial

       if (! $this->validar_pago_por_inicial($precredito)) {
          flash()->error('Se requiere el pago completo de la cuota inicial !');
          return redirect()->route('start.precreditos.ver',$precredito->id);
       }


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
             $credito->mes  = $mes;
             $credito->anio = $anio;
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

             $fecha_pago = calcularFecha($credito->precredito->fecha,$credito->precredito->periodo, 
                                         1, 
                                         $credito->precredito->p_fecha, 
                                         $credito->precredito->s_fecha, 
                                         true);

	     $ini = new Carbon($fecha_pago['fecha_ini']);
             $hoy = Carbon::now();

             if($ini->diffInDays($hoy) > 7) {
               $fecha = $ini->format('Y-m-d');
             } else {
               $fecha = inv_fech($fecha_pago['fecha_fin']);
             }
 
             $obj = new FechaCobro();
             $obj->credito_id = $credito->id;
             $obj->fecha_pago = $fecha;
             $obj->save();

             DB::commit();

             flash()->success('Se creo el crédito con éxito!');
             return redirect()->route('start.precreditos.ver',$credito->precredito->id);

          } catch(\Exception $e){

            DB::rollback();

            flash()->error($e->getMessage());
            return redirect()->route('start.precreditos.ver',$precredito->id);
          }
        }
    }//.create

    protected function validar_pagos_por_estudio($precredito)
    {
      $estudio = $precredito->estudio;

      if($estudio === 'Sin estudio') {
        return true;
      } 
      elseif ($estudio === 'Domicilio') {
        return $this->validar_existencia_de_pago($precredito, 'Estudio domicilio');
      }
      elseif ($estudio === 'Tipico') {
        return $this->validar_existencia_de_pago($precredito, 'Estudio tipico');
      }

    }//validar_pagos_por_estudio

    public function validar_existencia_de_pago($precredito,$estudio)
    {
      $respuesta = false;

      foreach($precredito->pagos as $pago) {
        if ($pago->concepto->nombre === $estudio) {
          $respuesta = true;
        }
      }

      return $respuesta;
    }//.validar_existencia_de_pago

    protected function validar_pago_por_inicial($precredito)
    {
      $respuesta = false; 
      $sum_inicial= 0;
      if( $precredito->cuota_inicial > 0 ) {
        foreach($precredito->pagos as $pago) {
          if ( ($pago->concepto->nombre === 'Cuota inicial') ) { 
              
            $sum_inicial += $pago->subtotal;

            if ($sum_inicial == $precredito->cuota_inicial) {
              $respuesta = true;
            }
          }
        }
      } 
      else {
        $respuesta = true;
      }
      return $respuesta;
      
    }//.if

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

      $precredito     = $credito->precredito;

      $fecha_pago     = inv_fech2(FechaCobro::where('credito_id',$id)->get()[0]->fecha_pago);
 
      $estados_credito = getEnumValues('creditos', 'estado');
      unset($estados_credito['Cancelado por refinanciacion']);

      $precredito->fecha = inv_fech2($precredito->fecha);

      $ref_productos     = (isset($precredito->ref_productos)) ? $precredito->ref_productos: '';

      $estado            = 'edicion_credito';

      $proveedores       = \App\MyService\Proveedor::getProveedores();

      return view('start.precreditos.create')
      ->with('carteras',Cartera::where('estado','Activo')->orderBy('nombre')->get())
      ->with('estados_aprobacion',getEnumValues('precreditos', 'aprobado'))
      ->with('calificaciones',getEnumValues('clientes', 'calificacion'))
      ->with('productos',Producto::orderBy('nombre','DESC')->get())
      ->with('arr_periodos',getEnumValues('precreditos','periodo'))
      ->with('arr_estudios',getEnumValues('precreditos','estudio'))
      ->with('estados_credito',$estados_credito)
      ->with('arr_productos', $ref_productos)
      ->with('cliente',$precredito->cliente)
      ->with('variables',Variable::find(1))
      ->with('estado','edicion_credito')
      ->with('proveedores',$proveedores)
      ->with('fecha_pago',$fecha_pago)
      ->with('precredito',$precredito)
      ->with('user',\Auth::user())
      ->with('credito', $credito)
      ->with('now',Carbon::now());
    }//.edit

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
    // public function update()
    {
      $changes = 0;
      $rq = $request->all();

      // $validator = $this->validateCreditoUpdateTr($rq); // UpdateCreditoTrait.php

      DB::beginTransaction();

      try {

        $dat         = $this->saveSolicitudUpdate($rq['solicitud']); // SolicitudUpdateTrait.php
        $changes    += $dat->changes;
        $solicitud   = $dat->solicitud;
        $cliente     = $solicitud->cliente;
        
        $changes    += $this->saveProductosUpdateTr($rq['solicitud']['productos']); // SolicitudUpdateTrait.php

        $dat_credito = $this->saveCreditoUpdateTr($rq['credito'], $changes);

        $dat_fecha_pago  = $this->saveFechaPagoUpdateTr($rq['fecha_pago'], $dat_credito['credito'], $dat_credito['changes']);
        
        $credito = Credito::find($dat_credito['credito']['id']);

        $this->castigar($credito,$rq['credito']['castigada'],$dat_credito['anterior']);

        if ($dat_fecha_pago['changes'] == 0) {
          return response()->json([
            'error' => true,
            'message' => 'Ningun cambio en registro'
          ]);
        }

        DB::commit();

        return response()->json([
          'error' => false,
          'message' => 'Se guardaron los cambios exitosamente',
          'dat' => $solicitud['id']
        ]);


      } catch (\Exception $e) {

        DB::rollback();

        return response()->json([
          'error'   => true,
          'message' => 'Ocurrió un error, intentelo nuevamente: '+$e->getMessage(),
          'dat'     => $e
        ]);
      } 

      //   DB::beginTransaction();

      //   try{



      //     // calificación del cliente 

      //     if($request->input('calificacion') != ""){
      //       $cliente->calificacion    = $request->input('calificacion');
      //       $cliente->user_update_id  = Auth::user()->id;
      //       $cliente->save();
      //     }

      //     DB::commit();

      //       $movil  = $precredito->cliente->movil;

      //       // si el objeto de edición es el crédito

      //       if( ($credito->estado != $estado_anterior_credito ) && $movil){

      //         if( $credito->estado == 'Prejuridico' ){
      //             $this->send_message([$movil],'MSS444'); }

      //         elseif( $credito->estado == 'Juridico' ){
      //             $this->send_message([$movil],'MSS555'); }
      //       }
            

      //     flash()->success('El crédito con Id: '.$precredito->credito->id.' del cliente '.$cliente->nombre.' se editó con éxito!');
      //     return redirect()->route('start.precreditos.ver',$precredito->id);

      //   } catch(\Exception $e){

      //     DB::rollback();

      //     flash()->error('Ocurrió un error' . $e->getMessage());
      //     return redirect()->route('start.creditos.index');         

      //   }


    }//.update
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

    private function castigar($credito, $castigada_in, $anterior)
    { 
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
    } //.castigar

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

    function ExportarTodo()
    {

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
                        'documento'];

            array_push($array_creditos,$header);

            foreach($creditos as $credito){
              $sanciones = DB::table('sanciones')
                  ->where([['credito_id','=',$credito->id],['estado','=','Debe']])
                  ->count();

              if ($sanciones > 0 && $sanciones <= 30) {
                $tipo_moroso = 'Morosos ideales';
              }
              elseif ($sanciones > 30 && $sanciones <= 90) {
                  $tipo_moroso = 'Morosos alerta';
              }
              elseif ($sanciones > 90) {
                  $tipo_moroso = 'Morosos crìticos';
              }
              else {
                  $tipo_moroso = 'No moroso';
              }

              $temp = [
                'id'                => $credito->id,                'cartera'           => $credito->cartera,
                'producto'          => $credito->producto,          'fecha_aprobacion'  => $credito->fecha_aprobacion,
                'estado'            => $credito->estado,            'sanciones'         => $sanciones,
                'tipo de mora'      => $tipo_moroso,                'cuotas_faltantes'  => $credito->cuotas_faltantes,
                'centro_costo'      => $credito->centro_costo,      'valor_credito'     => $credito->valor_credito,
                'periodo'           => $credito->periodo,           'cuotas'            => $credito->cuotas,
                'p_fecha'           => $credito->p_fecha,           's_fecha'           => $credito->s_fecha,
                'inicial'           => $credito->inicial,           'funcionario'       => $credito->funcionario,
                'observaciones'     => $credito->observaciones,     'castigada'         => $credito->castigada,
                'refinanciacion'    => $credito->refinanciacion,    'credito_padre'     => $credito->credito_padre,
                'pago_hasta'        => $credito->pago_hasta,        'primer_nombre'     => $credito->primer_nombre,
                'segundo_nombre'    => $credito->segundo_nombre,    'primer_apellido'   => $credito->primer_apellido,
                'segundo_apellido'  => $credito->segundo_apellido,  'documento'         => $credito->documento
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
          
    }//.exportar_todo


    function refinanciar($id)
    {
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
    }//.refinanciar

    function crear_refinanciacion(Request $request)
    {
        $ini = $request->input('p_fecha')+1;
        $fin = $request->input('s_fecha')-1;
        if($request->input('s_fecha') == ""){
          $fin = 30;
        }
        if ($request->input('periodo') == 'Quincenal') {
          $s_fecha_quincena = 'required|integer|between:'.$ini.',30';
        }
        else {
          $s_fecha_quincena = 'between:0,30'; 
        }
  
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
  
    } // .crear_refinanciacion


    public function destroy($credito_id)
    {
      $credito = Credito::find($credito_id);

      if (Auth::user()->id != 2) {
        flash()->error('Lo sentimos, pero no tiene permisos para borrar este crédito.');
        return redirect()->route('start.precreditos.ver',$credito->precredito_id);
      }

      DB::beginTransaction();

      try {
        $solicitud_id = $credito->precredito_id;

        $credito->last_llamada_id = null;
        $credito->save();

        deletePagosCreditoHp($credito->id);
        deleteSancionesCreditoHp($credito->id);
        deleteLlamadasCreditoHp($credito->id);
        deleteFechaCobrosCreditoHp($credito->id);
        $credito->delete();

        DB::commit();

        flash()->success("El crédito {$credito_id} fue eliminado exitosamente !!!");

      } catch (\Exception $e) {

        flash()->error('Se rpesento un problema: '.$e->getMessage());
        
      } finally {
        
        return redirect()->route('start.precreditos.ver',$solicitud_id);
      }

    }

}

