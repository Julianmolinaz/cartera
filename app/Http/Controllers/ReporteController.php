<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pago;
use App\Credito;
use App\Variable;
use App\Egreso;
use App\Cartera;
use DB;
use Carbon\Carbon;
use App\Factura;
use App\OtrosPagos;
use Auth;
use App\Llamada;
use App\User;


class ReporteController extends Controller
{
    // Pagina que muestra un listado de los reportes, con un calendario para el rango.

    public function index()
    {
        $tipo_reportes = array(
              array('value' => 'general','vista' => 'General'),
              array('value' => 'general_por_carteras', 'vista' => 'General por Carteras'),
              array('value' => 'general_por_users', 'vista' => 'General por Funcionarios'), 
              array('value' => 'venta_creditos', 'vista' => 'Venta de Créditos'),
              array('value' => 'venta_creditos_por_asesor','vista' => 'Venta de Créditos por Asesor'),
              array('value' => 'castigada', 'vista' => 'Cartera Castigada'),
              array('value' => 'callcenter','vista' => 'Call Center'),
              array('value' => 'procredito','vista' => 'Reporte Procredito'),
              array('value' => 'datacredito','vista' => 'Reporte Datacredito'));

        $carteras = Cartera::all()->sortBy('nombre');   
        $now = Carbon::now();
        $ano = $now->year;

        return view('admin.reportes.index')
            ->with('tipo_reportes', $tipo_reportes)
            ->with('carteras',$carteras)
            ->with('ano',$ano);
    }

    public function create()
    {
        //
    }

    /*  generador de los reportes
        recibe el tipo de reporte, cartera y un rango de fecha daterange
    */

    public function store(Request $request)
    {
        //validación de los datos

        if($request->input('tipo_reporte') == 'general_por_carteras'){
            $this->validate($request,
                ['tipo_reporte' => 'required', 'cartera' => 'required'],
                ['tipo_reporte.required' => 'Se requiere el Tipo de Reporte', 
                'cartera.required' => 'Se requiere que seleccione una cartera']);
        }else{
            $this->validate($request,
                ['tipo_reporte' => 'required'],
                ['tipo_reporte.required' => 'Se requiere el Tipo de Reporte']);
        }

        $fecha_1 = substr($request->daterange,0,10);
        $fecha_2 = substr($request->daterange,13,22);
        $ini     = Carbon::create(ano($fecha_1),mes($fecha_1),dia($fecha_1),00,00,00);
        $fin     = Carbon::create(ano($fecha_2),mes($fecha_2),dia($fecha_2),23,59,59);
        $rango   = array('ini' => $ini->format('d-m-Y'), 'fin' => $fin->format('d-m-Y')); 

        //REPORTEGENERALREPORTEGENERALREPORTEGENERALREPORTEGENERALREPORTEGENERALREPORTEGENERALREPORTEGENERAL
        //REPORTEGENERALREPORTEGENERALREPORTEGENERALREPORTEGENERALREPORTEGENERALREPORTEGENERALREPORTEGENERAL

        if($request->input('tipo_reporte') == 'general'){

            // reporte_general( $fecha_1, $fecha_2 ) se encuentra en helpers

            $reporte = reporte_general( $fecha_1, $fecha_2 );

            return view('admin.reportes.general')
              ->with('cuotas',$reporte['cuotas'])
              ->with('sanciones',$reporte['sanciones'])
              ->with('juridicos',$reporte['juridicos'])
              ->with('prejuridicos',$reporte['prejuridicos'])
              ->with('saldos_favor',$reporte['saldos_favor'])
              ->with('estudios',$reporte['estudios'])
              ->with('iniciales',$reporte['iniciales'])
              ->with('gastos',$reporte['gastos'])
              ->with('compras',$reporte['compras'])
              ->with('prestamos',$reporte['prestamos'])
              ->with('pago_proveedores',$reporte['pago_proveedores'])
              ->with('total_cuotas',$reporte['total_cuotas'])
              ->with('total_sanciones',$reporte['total_sanciones'])
              ->with('total_juridicos',$reporte['total_juridicos'])
              ->with('total_prejuridicos',$reporte['total_prejuridicos'])
              ->with('total_saldos',$reporte['total_saldos'])
              ->with('total_estudios',$reporte['total_estudios'])
              ->with('total_iniciales',$reporte['total_iniciales'])
              ->with('total_gastos',$reporte['total_gastos'])
              ->with('total_compras',$reporte['total_compras'])
              ->with('total_prestamos',$reporte['total_prestamos'])
              ->with('total_pago_proveedores',$reporte['total_pago_proveedores'])
              ->with('carteras',$reporte['carteras'])
              ->with('total',$reporte['total'])
              ->with('otros_pagos',$reporte['otros_pagos'])
              ->with('total_otros_ingresos',$reporte['total_otros_ingresos'])
              ->with('rango',$reporte['rango']);  
        }

        /*
         * Reporte por venta de créditos utilizado para saber
         * cuantos creditos se otorgado y cuanta es la ganancia o rendimiento.
         */
        
        //VENTACREDITOSVENTACREDITOSVENTACREDITOSVENTACREDITOSVENTACREDITOSVENTACREDITOSVENTACREDITOSVENTACREDITOS
        //VENTACREDITOSVENTACREDITOSVENTACREDITOSVENTACREDITOSVENTACREDITOSVENTACREDITOSVENTACREDITOSVENTACREDITOS

        else if($request->input('tipo_reporte') == 'venta_creditos'){

            $reporte = reporte_venta_creditos( $fecha_1, $fecha_2 );

            return view('admin.reportes.venta_creditos')
                ->with('creditos',$reporte['creditos'])
                ->with('total_vlr_fin',$reporte['total_vlr_fin'])
                ->with('total_vlr_credito',$reporte['total_vlr_credito'])
                ->with('total_saldo',$reporte['total_saldo'])
                ->with('rango',$reporte['rango'])
                ->with('carteras',$reporte['carteras'])
                ->with('total',$reporte['total']);
        }

        //VENTACREDITOSASESORVENTACREDITOSASESORVENTACREDITOSASESORVENTACREDITOSASESORVENTACREDITOSASESOR
        //VENTACREDITOSASESORVENTACREDITOSASESORVENTACREDITOSASESORVENTACREDITOSASESORVENTACREDITOSASESOR

        else if( $request->input('tipo_reporte') == 'venta_creditos_por_asesor' ){
            $reporte = reporte_venta_creditos_por_asesor( $fecha_1, $fecha_2 );
            
                return view('admin.reportes.venta_creditos_por_asesor')
                    ->with('creditos',$reporte['creditos'])
                    ->with('total_vlr_fin',$reporte['total_vlr_fin'])
                    ->with('total_vlr_credito',$reporte['total_vlr_credito'])
                    ->with('total_saldo',$reporte['total_saldo'])
                    ->with('rango',$reporte['rango'])
                    ->with('funcionarios',$reporte['funcionarios'])
                    ->with('total',$reporte['total'])
                    ->with('puntos',$reporte['puntos'])
                    ->with('total_puntos',$reporte['total_puntos']);
        }

        //CASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADA
        //CASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADA

        else if($request->input('tipo_reporte') == 'castigada'){

          $reporte = reporte_castigada($fecha_1,$fecha_2);

          return view('admin.reportes.castigada')
            ->with('rango',$reporte['rango'])
            ->with('castigadas',$reporte['castigadas'])
            ->with('carteras',$reporte['carteras']);      
        }        

        /*
         * REPORTE CALLCENTER 
         * 
         */ 

        //CALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTER
        //CALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTER  
  
        else if($request->input('tipo_reporte') == 'callcenter'){
            $llamadas = Llamada::whereBetween('created_at',[$ini,$fin])->get();

            $sumatoria = 
            DB::table('llamadas')
                ->join('users','llamadas.user_create_id','=','users.id')
                ->select(DB::raw('count(*) as num_llamadas, users.name as nombre'))
                ->whereBetween('llamadas.created_at',[$ini,$fin])
                ->groupBy('user_create_id')
                ->get();

            $total = Llamada::whereBetween('created_at',[$ini,$fin])->count();            
            
            return view('admin.reportes.callcenter')
                ->with('llamadas',$llamadas)
                ->with('rango',$rango)
                ->with('sumatoria',$sumatoria)
                ->with('total',$total);
        }

        //GENERALPORCARTERASGENERALPORCARTERASGENERALPORCARTERASGENERALPORCARTERASGENERALPORCARTERAS
        //GENERALPORCARTERASGENERALPORCARTERASGENERALPORCARTERASGENERALPORCARTERASGENERALPORCARTERAS

        else if($request->input('tipo_reporte') == 'general_por_carteras'){

            //reporte_general_por_carteras() ver en helpers


           $reporte = reporte_general_por_carteras( $fecha_1, $fecha_2 , $request->input('cartera'));
           

           return view('admin.reportes.general_cartera')
                ->with('cuotas',$reporte['cuotas'])
                ->with('sanciones',$reporte['sanciones'])
                ->with('juridicos',$reporte['juridicos'])
                ->with('prejuridicos',$reporte['prejuridicos'])
                ->with('saldos_favor',$reporte['saldos_favor'])
                ->with('estudios',$reporte['estudios'])
                ->with('iniciales',$reporte['iniciales'])
                ->with('gastos',$reporte['gastos'])
                ->with('compras',$reporte['compras'])
                ->with('prestamos',$reporte['prestamos'])
                ->with('pago_proveedores',$reporte['pago_proveedores'])
                ->with('total_cuotas',$reporte['total_cuotas'])
                ->with('total_sanciones',$reporte['total_sanciones'])
                ->with('total_juridicos',$reporte['total_juridicos'])
                ->with('total_prejuridicos',$reporte['total_prejuridicos'])
                ->with('total_saldos',$reporte['total_saldos'])
                ->with('total_estudios',$reporte['total_estudios'])
                ->with('total_iniciales',$reporte['total_iniciales'])
                ->with('total_gastos',$reporte['total_gastos'])
                ->with('total_compras',$reporte['total_compras'])
                ->with('total_prestamos',$reporte['total_prestamos'])
                ->with('total_pago_proveedores',$reporte['total_pago_proveedores'])
                ->with('carteras',$reporte['carteras'])
                ->with('total',$reporte['total'])
                ->with('otros_pagos',$reporte['otros_pagos'])
                ->with('total_otros_ingresos',$reporte['total_otros_ingresos'])
                ->with('rango',$reporte['rango'])
                ->with('users',$reporte['users']);
        }
        else if($request->input('tipo_reporte') == 'general_por_users'){

            $respuesta = reporte_general_por_funcionarios( $fecha_1, $fecha_2);



            return view('admin.reportes.general_funcionarios')
                ->with('reporte',$respuesta['reporte'])
                ->with('totales',$respuesta['totales'])
                ->with('rango',$rango);
            
            }
        else if($request->input('tipo_reporte') == 'procredito'){
            reporte_procredito();
            $this->index();
        }  
        //DATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITO
        //DATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITO

        else if($request->input('tipo_reporte') == 'datacredito' ){
            try{
                $this->validate($request,
                        ['mes_corte' => 'required',
                         'ano_corte' => 'required'],
                        ['mes_corte.required' => 'El mes de corte es requerido',
                         'ano_corte.required' => 'El año de corte es requerido']);

               // creacion fecha de corte tomando con ultimo dia del mes de corte
                
               $fecha  = Carbon::create($request->input('ano_corte'), $request->input('mes_corte'),1 );
               $dias_mes = $fecha->daysInMonth;
               $fecha = Carbon::create($fecha->year,$fecha->month,$dias_mes,23,59,59);
               

                dd(reporte_datacredito( $fecha ));  
            }
            catch(\Exception $e){

                return redirect()->route('admin.reportes.index'); 
            }
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $users = User::where('id','<>',1)->get();

        $users = 

        DB::table('users')
        ->join('puntos','users.punto_id','=','puntos.id')
        ->leftJoin('facturas','users.id','=','facturas.user_create_id')
        ->select(DB::raw(
            'users.id as id,
             users.name as nombre,
             puntos.nombre as punto,
             SUM(facturas.total) as total'))
        ->where([['users.id','<>',1]])
        ->whereBetween('facturas.created_at',[$ini,$fin])
        ->groupBy('users.id')
        ->get();

        //dd($users);
            
        return view('admin.reportes.prueba');
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

    public function centrales(){
      
      dd(reporte_centrales());      

    }
}
