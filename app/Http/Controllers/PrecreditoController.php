<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Traits\Solicitudes\SolicitudCreateTrait;
use App\Traits\Solicitudes\SolicitudUpdateTrait;
use Carbon\Carbon, App\Variable, App\Producto;
use App\Traits\Creditos\CreditoUpdateTraitV2;
use App\Cliente, App\Cartera, App\Credito;
use App\Traits\Solicitudes\SolicitudTrait;
use App\Traits\Creditos\RefProductoTrait;
use App\Traits\Creditos\VehiculoTrait;
use App\Http\Requests, App\Precredito;
use App\http\Controllers as Ctrl;
use App\Traits\MensajeTrait;
use App\Extra, Validator;
use App\User;
use App as _;
use Auth;
use DB;

class PrecreditoController extends Controller
{
    use MensajeTrait, SolicitudTrait,SolicitudCreateTrait, SolicitudUpdateTrait;
    use VehiculoTrait, RefProductoTrait, CreditoUpdateTraitV2;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {     
        $precreditos = Precredito::where('id','>',0)
            ->orderBy('updated_at','desc')
            ->paginate(100);

        return view('start.precreditos.index')
            ->with('precreditos',$precreditos);
    }

    /**
     * Permite crear solicitudes
     */
    public function create($cliente_id)
    {
        //validar que un cliente no tenga mas precréditos o créditos en proceso

        if ( $this->existen_solicitudes_pendientes_tr( $cliente_id ) ) {

            flash()->error('@ No se puede crear la solicitud, existen trámites vigentes!');
            return redirect()->route('start.clientes.show',$cliente_id);
        }

        $insumosInvoice = $this->insumosInvoice();
        $insumosVehiculo = $this->insumosVehiculo();

        // Obtiene los productos
        $catalogo = DB::table('productos') 
            ->where('estado',1)
            ->orderBy('nombre')
            ->get();

        $cliente = Cliente::find($cliente_id); 
        $data    = $this->obtener_data_para_crear($cliente_id);
        $data['status'] = 'create';
        
        return view('start.precreditosV3.create.index')
            ->with('catalogo', $catalogo)
            ->with('insumosInvoice', $insumosInvoice)
            ->with('insumosVehiculo', $insumosVehiculo);
    }

    public function insumosInvoice()
    {
        $list_expedido_a = Ctrl\getEnumValues('ref_productos','expedido_a');
        $list_estados_ref_productos = Ctrl\getEnumValues('ref_productos','estado');
        $proveedores = _\MyService\Proveedor::getProveedores();

        return [
           'list_expedido_a' => $list_expedido_a, 
           'list_estados_ref_productos'=> $list_estados_ref_productos, 
           'proveedores'=> $proveedores, 
        ];
    }

    public function insumosVehiculo()
    {
        $list_tipo_vehiculo = DB::table('tipo_vehiculos')
            ->orderBy('nombre')
            ->get();
        $list_placa = DB::table('vehiculos')
            ->get();

        return [
           'list_tipo_vehiculo' => $list_tipo_vehiculo,
           'list_placa' => $list_placa
        ];
    }

    public function store(Request $request)
    {   
        $validator = $this->validateSolicitudCreateTr($request->solicitud);

        if ($validator->fails()) return res(false,'validation',$validator->errors());

        DB::beginTransaction();

        try {
            
            if ($this->procesosPendientes($request->cliente_id)) {
                return res(false, '','No se puede crear la solicitud, ya existen solicitudes en trámite!!!');
            }

            $solicitud = $this->saveSolicitudCreateTr($request->solicitud); // SolicitudCreateTrait.php

            log(Auth::user()->id ,'creacion' ,'Creación solicitud de crédito' ,1 ,'App\\Precredito' ,$solicitud->id); 
            
            if ($request->producto['min_vehiculos'] && $request->ref_productos) {

                foreach ($request->ref_productos as $producto) {
                    $vehiculo = $this->saveVehiculoFromProductoTr($producto); // Creditos/VehiculoTr
                    $ref_producto = $this->saveRefProductoFromProductoTr($producto, $vehiculo, $solicitud); // Creditos/RefProductoTrait
                }
            }

            DB::commit();

            return res(true, $solicitud, 'Se creó la solicitud con éxito !!!');

        } catch(\Exception $e){
            DB::rollback();
            return res(false, '', 'Ocurrió un error: '.$e->getMessage());
        }

    }


    public function edit($precredito_id)
    {
        $precredito = Precredito::find($precredito_id);
        $precredito->fecha = inv_fech2($precredito->fecha);
        $proveedores = _\MyService\Proveedor::getProveedores();
        $users = _\User::where('estado','activo')->orderBy('name')->get();
        
        $ref_productos = (isset($precredito->ref_productos)) ? $precredito->ref_productos: '';
        
        if (isset($precredito->credito )) {
            $estado = 'edicion_credito';
        } else {
            $estado = 'edicion_solicitud';
        }
        if ($precredito->version == 1) {
            return view('start.precreditos.edit')
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
                ->with('users', $users)
                ->with('estados_credito','')
                ->with('now',Carbon::now())
                ->with('estado',$estado)
                ->with('fecha_pago','')
                ->with('credito','');
        } else {

            $cliente = $precredito->cliente;  
            $data    = $this->obtener_data_para_crear($cliente->id);
    
            $data['status'] = 'edit';
            $ref_productos = (isset($precredito->ref_productos)) ? $precredito->ref_productos : '';
        
            $ref_productos = $ref_productos->map( function ($ref_producto) {
                return [
                    'ref_producto_id' => $ref_producto->id,
                    'producto_id' => $ref_producto->producto_id,
                    'nombre' =>  $ref_producto->nombre,
                    'precredito_id' => $ref_producto->precredito_id,
                    'proveedor_id' => $ref_producto->proveedor_id,
                    'num_fact' =>  $ref_producto->num_fact,
                    'fecha_exp' => $ref_producto->fecha_exp,
                    'costo' => $ref_producto->costo,
                    'estado' => $ref_producto->estado,
                    'otros' => $ref_producto->otros,
                    'expedido_a' => $ref_producto->expedido_a,
                    'iva' => $ref_producto->iva,
                    'observaciones' => $ref_producto->observaciones,
                    '_vehiculo_id' => $ref_producto->vehiculo->id,
                    '_tipo_vehiculo_id' => $ref_producto->vehiculo->tipo_vehiculo_id,
                    '_placa' => $ref_producto->vehiculo->placa,
                    '_vencimiento_soat' => $ref_producto->vehiculo->vencimiento_soat,
                    '_vencimiento_rtm' => $ref_producto->vehiculo->vencimiento_rtm
                ];
            });
    
            return view('start.precreditos.create')
                ->with('data', $data)
                ->with('producto_id',$precredito->producto_id)
                ->with('solicitud',$precredito)
                ->with('producto',$precredito->producto)
                ->with('ref_productos',$ref_productos)
                ->with('data_credito','')
                ->with('fecha_pago','')
                ->with('credito','');
        }

    }

    /*
    VER MUESTRA LA INFORMACIÒN DE LA SOLICITUD QUE INTERNAMENTE LA LLAMAMOS PRECREDITO
    */

    public function ver($precredito_id)
    {
        $precredito = Precredito::find($precredito_id);

        $credito    = Credito::where('precredito_id',$precredito_id)->get();

        ($precredito->credito) ?  $total_pagos = sum_pagos($credito[0]) : $total_pagos = 0;

        ($precredito->credito) ?  $total_descuentos = sum_descuentos($credito[0]) : $total_descuentos = 0;

        //calcular años para formulario de referncia al crear crédito

        $anio = Carbon::now()->year;

        $anios = [$anio - 1, $anio];

        /******************** JURIDICO **************************/
        /* se valida la existencia de sanciones Juridicas en la tabla extras, si existen se valida que haya abonos en
        la tabla pagos en los casos de que no existan se generan los respectivos valores */


        if (count($credito) > 0) {

            $juridico = Extra::where('credito_id',$credito[0]->id)
                ->where('concepto','Juridico')
                ->where('estado','Debe')
                ->get();

            if (count($juridico) > 0) {

                $pago_juridico =
                    DB::table('pagos')
                        ->where([['credito_id','=',$credito[0]->id],['concepto','=','Juridico'],['estado','=','Debe']])
                        ->get();

                if ( count($pago_juridico) > 0 ) {
                    $pago_juridico = array('juridico' => $pago_juridico[0]->debe, 'valor' => $juridico[0]->valor);
                } else {
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

            if (count($prejuridico) > 0) {

                $pago_prejuridico = DB::table('pagos')
                        ->where([['credito_id','=',$credito[0]->id],
                            ['concepto','=','Prejuridico'],
                            ['estado','=','Debe']])
                        ->get();

                if (count($pago_prejuridico) > 0) {
                    $pago_prejuridico = array('prejuridico' => (int)$pago_prejuridico[0]->debe, 'valor' => ' de '.$prejuridico[0]->valor);
                } else{
                    $pago_prejuridico = array('prejuridico' => 0, 'valor' => $prejuridico[0]->valor);
                }
            }
            else{
                $pago_prejuridico = array('prejuridico' => null, 'valor' => 0);
            }

            /******************** PAGOS PARCIALES **************************/
            $total_parciales = DB::table('pagos')
                ->where([['credito_id','=',$credito[0]->id],['concepto','=','Cuota Parcial'],['estado','=','Debe']])
                ->sum('Debe');

            /*******************SANCIONES*********************************/
            $sum_sanciones = DB::table('sanciones')
                ->where([['credito_id','=',$credito[0]->id],['estado','Debe']])
                ->sum('valor');

            if(!$sum_sanciones){ $sum_sanciones = 0;}

            /******************FECHA LIMITE DE PAGO***********************/

        }//end if credito
        else {
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

        if (isset($precredito->credito->hijo)) {
            $hijo = $precredito->credito->hijo;
        } else{
            $hijo = null;
        }

        return view('start.precreditos.show')
            ->with('precredito',$precredito)
            ->with('juridico',$pago_juridico)
            ->with('prejuridico',$pago_prejuridico)
            ->with('parciales',$total_parciales)
            ->with('sanciones',$sum_sanciones)
            ->with('total_pagos',$total_pagos)
            ->with('total_descuentos',$total_descuentos)
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

        $rules_fijos = array(
            'num_fact' => 'required|unique:precreditos,num_fact,'.$request->id,
            'fecha'    => 'required',
            'vlr_fin'  => 'required',
            'producto_id' => 'required',
            'periodo'  => 'required',
            'meses'    => 'required',
            'estudio'  => 'required', 
            'vlr_cuota'=> 'required',
            'p_fecha'  => 'required|integer|between:1,'.$fin,
            's_fecha'  => $rule_s_fecha_quincena,
            'funcionario_id' => 'required',
            );
        $message_fijos = array(
            'num_fact.required'      => 'El Número de Factura es requerido',
            'num_fact.unique'        => 'El Número de factura ya existe',
            'fecha.required'         => 'La Fecha de afiliación es requerida',
            'vlr_fin.required'       => 'El Costo del crédito es requerido',
            'producto_id.required'   => 'El Producto es requerido',
            'periodo.required'       => 'El Periodo es requerido',
            'meses.required'         => 'El # de Meses es requerido',
            'estudio.required'       => 'El tipo de estudio es requerido',
            'vlr_cuota.required'     => 'El Valor de la Cuota es requerido',
            'p_fecha.required'       => 'La Fecha 1 es requerida',
            'p_fecha.between'        => 'La Fecha 1 debe ser menor que la Fecha 2',
            's_fecha.between'        => 'La Fecha 2 debe ser mayor que la Fecha 1',
            's_fecha.required'       => 'La Fecha 2 es requerida',
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

            if($request->input('periodo') == 'Mensual'){ $s_fecha = '';}
            else{ $s_fecha = $request->input('s_fecha');}

            $precredito = Precredito::find($request->id);

            $estado_anterior_solicitud = $precredito->aprobado; //toma el estado (aprobado) antes de editar

            $cliente = Cliente::find($precredito->cliente_id);
            $precredito->fill($request->all());
            $precredito->s_fecha = $s_fecha;
            $precredito->user_update_id = Auth::user()->id;
            $precredito->save();

            //actualizacion del crédito relacionado

            if($precredito->credito != NULL){


                $credito = Credito::find($precredito->credito->id);

                $estado_anterior_credito   = $credito->estado; // se guarda el estado anterior del credito

                $credito->cuotas_faltantes = $precredito->cuotas;
                $credito->saldo            = $precredito->vlr_fin - $precredito->cuota_inicial;
                $credito->valor_credito    = $precredito->cuotas * $precredito->vlr_cuota;
                $credito->rendimiento      = $credito->valor_credito - ($precredito->vlr_fin -$precredito->cuota_inicial);
                $credito->user_update_id   = Auth::user()->id;
                $credito->save();

            }

            DB::commit();

            //envío de mensjae de texto 'MSS111' 'su solicitud de credito ha sido aprobada'

            $movil  = $precredito->cliente->movil;

            // si el objeto de edición es el crédito

            if(isset($precredito->credito)){
                if( ($credito->estado != $estado_anterior_credito ) && $movil){
                if( $credito->estado == 'Prejuridico' ){
                    $this->send_message([$movil],'MSS444'); 
                }
                elseif( $credito->estado == 'Juridico' ){
                    $this->send_message([$movil],'MSS555'); 
                }
                }
            } 
            // si el objeto de edición es el precredito (solicitud)
            else{

                if( ($precredito->aprobado != $estado_anterior_solicitud ) && $movil){
                    if( $precredito->aprobado == 'Si' ){
                        $this->send_message([$movil],'MSS111'); 
                    }
                }
            }

            flash()->success('La solicitud con Id: '.$precredito->id.' del cliente '.$cliente->nombre.' se editó con éxito!');
            return redirect()->route('start.precreditos.ver',$precredito->id);

        } catch(\Exception $e){
            DB::rollback();
            flash()->error('Ocurrió un error!!!'.$e->getMessage());
            return redirect()->route('start.precreditos.index');
        }
    }

    public function updateV2(Request $request) 
    {  
        $validator = $this->validateSolicitudUpdateTr($request->solicitud);

        if ( $validator->fails() ) return res(false,$validator->errors(),'Error en la validación');

        DB::beginTransaction();

        try {
            // Update producto

            $solicitud = Precredito::find($request->solicitud['id']);
            $old_producto_id = $solicitud->producto_id;
            $solicitud->fill($request->solicitud);

            if ($solicitud->isDirty()) {
                $solicitud->user_update_id = Auth::user()->id;
                $solicitud->save(); 
            }

            // Edit ref productos
            $this->saveRefProductosTrV2($request, $old_producto_id);

            DB::commit();

            return res(true, $solicitud , 'Se editó la solicitud con éxito !!!');

        } catch(\Exception $e){

            DB::rollback();

            return res(false, '', 'Ocurrio un error: '.$e->getMessage());
        }

    }

    public function destroy($id)
    {
        //
    }
}
