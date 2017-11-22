<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cliente;
use App\User;
use App\Producto;
use App\Precredito;
use App\Variable;
use App\Cartera;
use App\Credito;
use DB;
use Auth;
use App\Extra;

class PrecreditoController extends Controller
{

    public function index()
    {
        $precreditos = Precredito::where('id','>',0)->orderBy('updated_at','desc')->get();

        return view('start.precreditos.index')
            ->with('precreditos',$precreditos);
    }

    /**
     * para crear precreditos o solicitudes
     * vaya a la funcion show de esta clase
     *
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            'num_fact' => 'required|unique:precreditos',
            'fecha'    => 'required',
            'cartera_id' => 'required',
            'vlr_fin'  => 'required',
            'producto_id' => 'required',
            'periodo'  => 'required',
            'meses'    => 'required',
            'estudio'  => 'required',
            'vlr_cuota'=> 'required',
            'p_fecha'  => 'required|integer|between:1,'.$fin,
            's_fecha'  => $s_fecha_quincena,
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

            $cant_precred =
            DB::table('precreditos')
                ->join('clientes','precreditos.cliente_id','=','clientes.id')
                ->where([
                    ['clientes.id','=',$request->input('cliente_id')],
                    ['precreditos.aprobado','=','En estudio']])
                ->count();

                $cliente = Cliente::find($request->input('cliente_id'));

            if($cant_precred == 0){

                $precredito = new Precredito($request->all());

                if($request->input('cuota_inicial') == ""){
                    $precredito->cuota_inicial = 0;
                }
                $precredito->user_create_id = Auth::user()->id;
                $precredito->user_update_id = Auth::user()->id;
                $precredito->aprobado = 'En estudio';
                $precredito->save();

                DB::commit();

                flash()->success('La solicitud con Id: '.$precredito->id.' del cliente '.$cliente->nombre.' se creo con éxito!');
                    return redirect()->route('start.clientes.show',$cliente->id);
            }
            else{

                DB::commit();

                flash()->error('@ No se puede crear la solicitud, ya existen solicitudes en trámite!');
                    return redirect()->route('start.clientes.show');
            }
        } catch(\Exception $e){
            DB::rollback();

            flash()->error('Ocurrió un error, intentelo nuevamente. Gracias!!');
            return redirect()->route('start.clientes.show');
        }


    }

    /*
      VER MUESTRA LA INFORMACIÒN DE LA SOLICITUD QUE INTERNAMENTE LA LLAMAMOS PRECREDITO
    */


    public function ver($id)
    {
        $precredito = Precredito::find($id);

        $credito    = Credito::where('precredito_id',$id)->get();

        ($precredito->credito) ?  $total_pagos = sum_pagos($credito[0]) : $total_pagos = 0;

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

            $pago_prejuridico = DB::table('pagos')->where([['credito_id','=',$credito[0]->id],['concepto','=','Prejuridico']])->get();

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

        return view('start.precreditos.show')
            ->with('precredito',$precredito)
            ->with('juridico',$pago_juridico)
            ->with('prejuridico',$pago_prejuridico)
            ->with('parciales',$total_parciales)
            ->with('sanciones',$sum_sanciones)
            ->with('total_pagos',$total_pagos);


    }


    //la funcion show se utilizo para abrir el formulario de creacion del precredito o solicitud
    // la variable $id es el id del cliente
    public function show($id)
    {


//validar que un cliente no tenga mas precréditos o créditos en proceso

        $solicitudes_pendientes =
        DB::table('precreditos')
        ->join('clientes','precreditos.cliente_id','=','clientes.id')
        ->where([
            ['clientes.id','=',$id],
            ['precreditos.aprobado','=','En estudio']])
        ->count();


        $creditos_vigentes =
        DB::table('creditos')
         ->join('precreditos','creditos.precredito_id','=','precreditos.id')
         ->join('clientes','precreditos.cliente_id','=','clientes.id')
         ->where([['clientes.id','=',$id]])
         ->whereIn('Estado',['Al dia','Mora','Prejuridico','Juridico'])
         ->count();


        $cliente = Cliente::find($id);

        if($creditos_vigentes == 0 && $solicitudes_pendientes == 0){

            $users = User::all()->sortBy('name');
            $productos = Producto::all()->sortBy('nombre');
            $carteras = Cartera::where('estado','Activo')->get();
            $variables = Variable::find(1);

            return view('start.precreditos.create')
            ->with('users',$users)
            ->with('cliente',$cliente)
            ->with('productos',$productos)
            ->with('variables',$variables)
            ->with('carteras',$carteras);
        }
        else{
            flash()->error('@ No se puede crear la solicitud, existen trámites vigentes!');
            return redirect()->route('start.clientes.show',$cliente->id);
        }

    }


    public function edit($id)
    {
        $productos = Producto::all();
        $variables = Variable::find(1);
        $precredito = Precredito::find($id);
        $carteras   = Cartera::all();
        $users = User::all();

        return view('start.precreditos.edit')
            ->with('productos',$productos)
            ->with('variables',$variables)
            ->with('users',$users)
            ->with('precredito',$precredito)
            ->with('carteras',$carteras);
    }


    public function update(Request $request, $id)
    {
     
      $ini = $request->input('p_fecha')+1;
      $fin = $request->input('s_fecha')-1;

      if($request->input('s_fecha') == ""){
        $fin = 30;
      }
     
      if($request->input('periodo') == 'Quincenal'){
        $s_fecha_quincena = 'required|integer|between:'.$ini.',30';
      }
      else {
        $s_fecha_quincena = 'between:0,30'; 
      }

        $rules_fijos = array(
            'num_fact' => 'required|unique:precreditos,num_fact,'.$id,
            'fecha'    => 'required',
            'vlr_fin'  => 'required',
            'producto_id' => 'required',
            'periodo'  => 'required',
            'meses'    => 'required',
            'estudio'  => 'required', 
            'vlr_cuota'=> 'required',
            'p_fecha'  => 'required|integer|between:1,'.$fin,
            's_fecha'  => $s_fecha_quincena,
            'funcionario_id' => 'required',
            );
        $message_fijos = array(
            'num_fact.required'      => 'El Número de Factura es requerido',
            'num_fact.unique'        => 'El Número de factura ya existe',
            'fecha.required'         => 'La Fecha de afiliación es requerida',
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

            $precredito = Precredito::find($id);
            $cliente = Cliente::find($precredito->cliente_id);
            $precredito->fill($request->all());
            $precredito->user_update_id = Auth::user()->id;
            $precredito->save();

            if($precredito->credito != NULL){

               $credito = Credito::find($precredito->credito->id);
               $credito->cuotas_faltantes = $precredito->cuotas;
               $credito->saldo = $precredito->vlr_fin - $precredito->cuota_inicial;
               $credito->valor_credito = $precredito->cuotas * $precredito->vlr_cuota;
               $credito->rendimiento = $credito->valor_credito - ($precredito->vlr_fin -$precredito->cuota_inicial);
               $credito->user_update_id = Auth::user()->id;
               $credito->save();

            }

            DB::commit();

            flash()->success('La solicitud con Id: '.$precredito->id.' del cliente '.$cliente->nombre.' se editó con éxito!');
            return redirect()->route('start.precreditos.ver',$precredito->id);

        } catch(\Exception $e){
            DB::rollback();
            flash()->error('Ocurrió un error!!!');
            return redirect()->route('start.precreditos.index');
        }
}

    public function destroy($id)
    {
        //
    }
}
