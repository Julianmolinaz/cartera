<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Traits\Solicitudes\SolicitudCreateTrait;
use App\Traits\Solicitudes\SolicitudUpdateTrait;
use App\Traits\Solicitudes\SolicitudTrait;
use App\Traits\MensajeTrait;
use App\Http\Requests;
use App\Precredito;
use Carbon\Carbon;
use App\Variable;
use App\Producto;
use App\Cliente;
use App\Cartera;
use App\Credito;
use App\Extra;
use Validator;
use App\User;
use Auth;
use DB;

class PrecreditoController extends Controller
{
    use MensajeTrait;
    use SolicitudTrait;
    use SolicitudCreateTrait;
    use SolicitudUpdateTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {     
        $precreditos = 
            Precredito::where('id','>',0)
            ->orderBy('updated_at','desc')
            ->paginate(100);

        return view('start.precreditos.index')
            ->with('precreditos',$precreditos);
    }

    /**
     * para crear precreditos o solicitudes
     * vaya a la funcion show de esta clase
     *
     */
    public function create($cliente_id)
    {
      //validar que un cliente no tenga mas precréditos o créditos en proceso

      if ($this->existen_solicitudes_pendientes_tr($cliente_id)) {
          flash()->error('@ No se puede crear la solicitud, existen trámites vigentes!');
          return redirect()->route('start.clientes.show',$cliente->id);
      }

      $cliente = Cliente::find($cliente_id);  
      $data    = $this->obtener_data_para_crear($cliente_id);
      
      $data['status'] = 'create';

      return view('start.precreditos.create')
        ->with('data', $data);

    }


    public function store(Request $request)
    {
      $rq = $request->all();

      $validator = $this->validateSolicitudCreateTr($rq);

      if ($validator->fails()) {
        return response()->json([
          'error' => true,
          'message' => 'Error en la validación',
          'dat' => $validator->errors()
        ]);
      }

      DB::beginTransaction();

      try{
          
        if ($this->procesosPendientes($rq)) {
          
          DB::commit();

          return response()>json([
            'error'   => true,
            'message' => '@ No se puede crear la solicitud, ya existen solicitudes en trámite!'
          ]);

        }

        $solicitud = $this->saveSolicitudCreateTr($rq); // SolicitudCreateTrait.php
        
        $this->saveProductosCreateTr($rq['productos'], $solicitud); // SolicitudCreateTrait.php
  
        \DB::commit();

        return response()->json([
          'error'   => false,
          'message' => 'La solicitud con Id: '.$solicitud->id.' del cliente '.$solicitud->cliente->nombre.' se creo con éxito!',
          'dat'     => $solicitud
        ]);

      } catch(\Exception $e){
          DB::rollback();
          return response()->json([
            'error'   => true,
            'message' => 'Ocurrió un error, intentelo nuevamente.',
            'dat'     => $e->getMessage()
          ]);
      }

    }


    public function edit($id)
    {
      $precredito = Precredito::find($id);
      $precredito->fecha = inv_fech2($precredito->fecha);
      $proveedores       = \App\MyService\Proveedor::getProveedores();

      $ref_productos = (isset($precredito->ref_productos)) ? $precredito->ref_productos: '';

      if (isset($precredito->credito )) {
        $estado = 'edicion_credito';
      } else {
        $estado = 'edicion_solicitud';
      }

      return view('start.precreditos.create')
      ->with('carteras',Cartera::where('estado','Activo')->orderBy('nombre')->get())
      ->with('estados_aprobacion',getEnumValues('precreditos', 'aprobado'))
      ->with('productos',Producto::orderBy('nombre','DESC')->get())
      ->with('arr_periodos',getEnumValues('precreditos','periodo'))
      ->with('arr_estudios',getEnumValues('precreditos','estudio'))
      ->with('arr_productos', $ref_productos)
      ->with('cliente',$precredito->cliente)
      ->with('variables',Variable::find(1))
      ->with('proveedores',$proveedores)
      ->with('precredito',$precredito)
      ->with('user',\Auth::user())
      ->with('estados_credito','')
      ->with('now',Carbon::now())
      ->with('estado',$estado)
      ->with('fecha_pago','')
      ->with('credito','');

    }

    /*
      VER MUESTRA LA INFORMACIÒN DE LA SOLICITUD QUE INTERNAMENTE LA LLAMAMOS PRECREDITO
    */


    public function ver($id)
    {
        $precredito = Precredito::find($id);

        $credito    = Credito::where('precredito_id',$id)->get();

        ($precredito->credito) ?  $total_pagos = sum_pagos($credito[0]) : $total_pagos = 0;

        //calcular años para formulario de referncia al crear crédito

        $anio = Carbon::now()->year;

        $anios = [$anio - 1, $anio];

        /******************** JURIDICO **************************/
        /* se valida la existencia de sanciones Juridicas en la tabla extras, si existen se valida que haya abonos en
        la tabla pagos en los casos de que no existan se generan los respectivos valores */


        if(count($credito) > 0){

          $juridico = Extra::where('credito_id',$credito[0]->id)->where('concepto','Juridico')->where('estado','Debe')->get();

          if(count($juridico) > 0){

            $pago_juridico =
            DB::table('pagos')
                ->where([['credito_id','=',$credito[0]->id],['concepto','=','Juridico'],['estado','=','Debe']])
                ->get();

            if( count($pago_juridico) > 0 ){
              $pago_juridico = array('juridico' => $pago_juridico[0]->debe, 'valor' => $juridico[0]->valor);
            } else{
              $pago_juridico = array('juridico' => 0, 'valor' => $juridico[0]->valor);
            }
          }
          else {
            $pago_juridico = array('juridico' => null, 'valor' => 0);
          }

          /******************** PREJURIDICO  **************************/
          /* se valida la existencia de sanciones Prejuridicas en la tabla extras, si existen se valida que haya abonos en
          la tabla pagos en los casos de que no existan se generan los respectivos valores */

          $prejuridico = Extra::where('credito_id',$credito[0]->id)->where('concepto','Prejuridico')->where('estado','Debe')->get();

          if(count($prejuridico) > 0){

            $pago_prejuridico = DB::table('pagos')
					->where([['credito_id','=',$credito[0]->id],
						 ['concepto','=','Prejuridico'],
						 ['estado','=','Debe']])
					->get();

            if(count($pago_prejuridico) > 0){
              $pago_prejuridico = array('prejuridico' => (int)$pago_prejuridico[0]->debe, 'valor' => ' de '.$prejuridico[0]->valor);
            } else{
              $pago_prejuridico = array('prejuridico' => 0, 'valor' => $prejuridico[0]->valor);
            }
          }
          else{
            $pago_prejuridico = array('prejuridico' => null, 'valor' => 0);
          }

          /******************** PAGOS PARCIALES **************************/
          $total_parciales =
          DB::table('pagos')
              ->where([['credito_id','=',$credito[0]->id],['concepto','=','Cuota Parcial'],['estado','=','Debe']])
              ->sum('Debe');


          /*******************SANCIONES*********************************/
          $sum_sanciones = DB::table('sanciones')
              ->where([['credito_id','=',$credito[0]->id],['estado','Debe']])
              ->sum('valor');

              if(!$sum_sanciones){ $sum_sanciones = 0;}

          /******************FECHA LIMITE DE PAGO***********************/


        }//end if credito
        else{
            $pago_juridico = array('juridico' => 0, 'valor' => 0);
            $pago_prejuridico = array('prejuridico' => 0, 'valor' => 0);
            $sum_sanciones = 0;
            $total_parciales = 0;
        }

        /****************** PADRE? ***********************/
        /**
         * SE TRAE LA REFERENCIA DE UN CREDITO HIJO, ES DECIR,
         * UN CREDITO QUE FUE REFINANCIADO, EL ORIGEN ES EL PADRE
         * EL NUEVO CREDITO ES EL HIJO
         * PABLO GONZALEZ 02-08-2018
         */

        if(isset($precredito->credito->hijo)){
            $hijo = $precredito->credito->hijo;
        }
        else{
            $hijo = null;
        }

        return view('start.precreditos.show')
            ->with('precredito',$precredito)
            ->with('juridico',$pago_juridico)
            ->with('prejuridico',$pago_prejuridico)
            ->with('parciales',$total_parciales)
            ->with('sanciones',$sum_sanciones)
            ->with('total_pagos',$total_pagos)
            ->with('hijo',$hijo)
            ->with('anios',$anios);


    }


    //la funcion show se utilizo para abrir el formulario de creacion del precredito o solicitud
    // la variable $id es el id del cliente
    public function show($cliente_id)
    {
      //validar que un cliente no tenga mas precréditos o créditos en proceso

        $solicitudes_pendientes =
        DB::table('precreditos')
        ->join('clientes','precreditos.cliente_id','=','clientes.id')
        ->where([
            ['clientes.id','=',$cliente_id],
            ['precreditos.aprobado','=','En estudio']])
        ->count();


        $creditos_vigentes =
        DB::table('creditos')
         ->join('precreditos','creditos.precredito_id','=','precreditos.id')
         ->join('clientes','precreditos.cliente_id','=','clientes.id')
         ->where([['clientes.id','=',$cliente_id]])
         ->whereIn('Estado',['Al dia','Mora','Prejuridico','Juridico'])
         ->count();


        $cliente = Cliente::find($cliente_id);

        if($creditos_vigentes == 0 && $solicitudes_pendientes == 0){

            $productos        = Producto::orderBy('nombre','DESC')->get();
            $carteras         = Cartera::where('estado','Activo')->orderBy('nombre')->get();
            $proveedores      = \App\MyService\Proveedor::getProveedores();
            $variables        = Variable::find(1);
            $now              = Carbon::now();
            $estados_aprobacion = getEnumValues('precreditos', 'aprobado');
            $arr_periodos     = getEnumValues('precreditos','periodo');
            $arr_estudios     = getEnumValues('precreditos','estudio');
            $tipo_vehiculos   = getEnumValues('vehiculos','tipo');

            
            return view('start.precreditos.create')
              ->with('estados_aprobacion',$estados_aprobacion)
              ->with('arr_periodos',$arr_periodos)
              ->with('arr_estudios',$arr_estudios)
              ->with('proveedores',$proveedores)
              ->with('user',Auth::user()->id)
              ->with('productos',$productos)
              ->with('variables',$variables)
              ->with('carteras',$carteras)
              ->with('estados_credito','')
              ->with('estado','creacion')
              ->with('cliente',$cliente)
              ->with('arr_productos','')
              ->with('precredito','')
              ->with('fecha_pago','')
              ->with('credito','')
              ->with('tipo_vehiculos',$tipo_vehiculos);
        }
        else{
            flash()->error('@ No se puede crear la solicitud, existen trámites vigentes!');
            return redirect()->route('start.clientes.show',$cliente->id);
        }

    }



    public function update(Request $request, $id)
    {
      $changes = 0;

      $rq = $request->all();
      
      $validator = $this->validateSolicitudUpdateTr($rq);
      
      if ($validator->fails()) {
        return response()->json([
          'error' => true,
          'message' => 'Error en la validación.',
          'dat' => $validator->errors()
          ]);
      }
      DB::beginTransaction();
      
      try {
          
        $data = $this->saveSolicitudUpdate($rq); // SolicitudUpdateTrait.php

        $solicitud = $data->solicitud;
        $changes   = $data->changes;

        $changes += $this->saveProductosUpdateTr($rq['productos']); // SolicitudUpdateTrait.php
        
        if ($changes) {

          DB::commit();

          return response()->json([
            'error' => false,
            'message' => 'Solicitud modificada exitosamente !!!',
            'dat' => $solicitud
          ]);
        } 
        else {
          return response()->json([
            'error' => true,
            'message' => 'No se realizaron cambios a la solicitud'
          ]);
        }

      } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
          'error'   => true,
          'message' => 'Ocurrió un error, intentelo nuevamente.',
          'dat'     => $e->getMessage()
        ]);
      }

}

    public function destroy($id)
    {
        //
    }
}
