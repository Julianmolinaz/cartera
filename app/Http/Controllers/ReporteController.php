<?php

namespace App\Http\Controllers;

use App\Traits\ReporteTrait;
use Illuminate\Http\Request;

use App\Http\Controllers\VentaController;
use App\Http\Requests;
use App\OtrosPagos;
use App\Variable;
use App\Llamada;
use App\Factura;
use App\Credito;
use App\Cartera;
use App\Egreso;
use App\Pago;
use App\User;
use App\Traits\Financierotrait;
use Carbon\Carbon;
use Excel;
use Auth;
use DB;
use App\Punto;


class ReporteController extends Controller
{
    private $fecha_1;
    private $fecha_2;
    use ReporteTrait;
    use Financierotrait;

    public function setFecha1($fecha_1){
        $this->fecha_1 = $fecha_1;
    }
    public function setFecha2($fecha_2){
        $this->fecha_2 = $fecha_2;
    }
 

    // Pagina que muestra un listado de los reportes, con un calendario para el rango.

    public function index()
    {
        $tipo_reportes = $this->tipo_reportes();

        $carteras = Cartera::all()->sortBy('nombre');   
        $now = Carbon::now();
        $ano = $now->year;

        $ultimo_reporte_cancelados = DB::table('cancelados')->first();


        if($ultimo_reporte_cancelados){
            $ultimo_reporte_cancelados = $ultimo_reporte_cancelados->created_at;
        }
        else{ $ultimo_reporte_cancelados = null; }

        //dd($ultimo_reporte_cancelados);

        return view('admin.reportes.index')
            ->with('tipo_reportes', $tipo_reportes)
            ->with('carteras',$carteras)
            ->with('ano',$ano)
            ->with('ultimo_reporte_cancelados', $ultimo_reporte_cancelados);
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

        //HISTORIALVENTACREDITOSHISTORIALVENTACREDITOSHISTORIALVENTACREDITOSHISTORIALVENTACREDITOS
        //HISTORIALVENTACREDITOSHISTORIALVENTACREDITOSHISTORIALVENTACREDITOSHISTORIALVENTACREDITOS
        
        else if( $request->input('tipo_reporte') == 'historial_ventas'){

            if( Auth::user()->rol <> 'Administrador'){ return abort(403); }

            $detalleVentas = \File::allFiles(storage_path('0-detalleVentas'));
            $ventaCarteras = \File::allFiles(storage_path('1-ventasCarteras'));
            
            return view('admin.reportes.historial_ventas')
                ->with('detalleVentas',$detalleVentas)
                ->with('ventaCarteras',$ventaCarteras);
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

        //PROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITO
        //PROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITO
        
        else if($request->input('tipo_reporte') == 'procredito'){

            $report_procredito  =  reporte_procredito(); // array con el reporte    
            $nombre_archivo     = '294466092'.fecha_plana(Carbon::now()).'.txt';  // nombre del reporte
            $archivo            = fopen($nombre_archivo, "w"); // creacion del archivo
            
            //asignacion de datos al archivo
            foreach($report_procredito as $reporte){
                foreach($reporte as $key => $elemento){

                    if ($elemento === reset($reporte)) {
                        fwrite($archivo, $elemento);
                    }
                    else{
                        fwrite($archivo, '|'.$elemento);
                    }
                }
                fwrite($archivo, PHP_EOL);  
            }
            fclose($archivo); // cierre del archivo
    
            //echo  nl2br(file_get_contents($nombre_archivo));

            return response()->download($nombre_archivo);
        }  
        //DATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITO
        //DATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITO

        else if($request->input('tipo_reporte') == 'datacredito' ){
            $corte               = Carbon::now();
            $corte->subMonth()->modify('last day of this month');

            $report_datacredito  =  reporte_datacredito($corte); // array con el reporte    
            $nombre_archivo      = '116881.'.$corte->year.cast_number($corte->month,2,'right').cast_number($corte->day,2,'right').'.T.txt';  // nombre del reporte
            $archivo             = fopen($nombre_archivo, "w"); // creacion del archivo
            
            //asignacion de datos al archivo
            foreach($report_datacredito as $reporte){
                foreach($reporte as $key => $elemento){

                    if ($elemento === reset($reporte)) {
                        fwrite($archivo, $elemento);
                    }
                    else{
                        fwrite($archivo, $elemento);
                    }
                }
                fwrite($archivo, PHP_EOL);  
            }
            fclose($archivo); // cierre del archivo
    
            //echo  nl2br(file_get_contents($nombre_archivo));

            return response()->download($nombre_archivo); 
        }

    else if($request->input('tipo_reporte') == 'auditoria' )
    {
        $audits = 
        DB::table('audits')
            ->join('users','audits.user_id','=','users.id')
            ->select(
                'users.name as name',
                'audits.event as event',
                'audits.auditable_type as type',
                'audits.auditable_id as auditable',
                'audits.old_values as old_values',
                'audits.new_values as new_values',
                'audits.url as url',
                'audits.ip_address as ip_address',
                'audits.user_agent as user_agent',
                'audits.created_at as created_at')
            ->whereBetween('audits.created_at',[$ini,$fin])
            ->paginate(2000);

        return view('admin.reportes.auditoria')
                ->with('audits',$audits)
                ->with('rango',$rango);
    }

    else if($request->input('tipo_reporte') == 'financiero')
    {
        $ini     = Carbon::create(ano($fecha_1),mes($fecha_1),dia($fecha_1),00,00,00);
        $fin     = Carbon::create(ano($fecha_2),mes($fecha_2),dia($fecha_2),23,59,59);
        $info = $this->financiero($ini, $fin);

        return view('admin.reportes.financiero.financiero_operativo')
            ->with('rango',$rango)
            ->with('info', $info);
    }
}

  
    public function show($id){}

    public function edit($id){}

    public function update(Request $request, $id){}

    public function destroy($id){}


    /**
     * Genera xls del detallado de ventas de credito 
     * y el total por c/u de las carteras
     * @param  implicitamente utiliza $this->fecha_1 y $this->fecha_2 
     * @param  string string
     * @return dos archivos xls almacenados en el storage
     */

    public function ventas(){

        Excel::create('reporte_detallado_ventas-'.Carbon::now(),function($excel){

            $excel->sheet('Sheetname',function($sheet){
                
                $reporte = reporte_venta_creditos($this->fecha_1, $this->fecha_2);
                $creditos = $reporte['creditos'];   
                $array = array();

                for($i = 0; $i < count($creditos) ; $i++){
                    $array[$i] = (array)$creditos[$i];
                }
                $sheet->fromArray($array);
            });
        })->store('xls', storage_path('0-detalleVentas'));

        Excel::create('reporte_ventas_carteras-'.Carbon::now(),function($excel){

            $excel->sheet('Sheetname',function($sheet){
                $reporte = reporte_venta_creditos($this->fecha_1, $this->fecha_2);
                $carteras = $reporte['carteras'];
                $array = array();

                for($i = 0; $i < count($carteras) ; $i++){
                    $array[$i] = (array)$carteras[$i];
                }
                $sheet->fromArray($array);
            });
        })->store('xls', storage_path('1-ventasCarteras'));   
    }

    public function descargarDetalladoVentas($reporte){
            return response()->download(storage_path('0-detalleVentas/'.$reporte));
    }
    public function descargarVentasCartera($reporte){
        return response()->download(storage_path('1-ventasCarteras/'.$reporte));
    }

    public function getReportVentas($fecha_1, $fecha_2)
    {
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

    public function marcar_cancelados()
    {
        DB::beginTransaction();

        try{

            $cancelados = DB::table('cancelados')->get();

            if(count($cancelados) > 0){
                foreach($cancelados as $cancelado){
    
                    DB::table('creditos')
                        ->where('id',$cancelado->credito_id)
                        ->update(['end_procredito' => 1]);
                }

                DB::table('cancelados')->delete();
                DB::commit();
                flash()->success('Se marcaron los creditos cancelados correctamente');
                return redirect()->route('admin.reportes.index');
            } //.if

            else{
                flash()->error('No hay creditos que marcar');
                return redirect()->route('admin.reportes.index');
            }

        }//.try
        catch(\Exception $e)
        {
            flash()->info('Error al marcar los créditos cancelados');
            return redirect()->route('admin.reportes.index');
        }

        
    }//.marcar_cancelados


    public function financiero_sucursales($ini, $fin)
    {
        $sucursales = Punto::orderBy('nombre','asc')->get();
        $ini     = Carbon::create(ano($ini),mes($ini),dia($ini),00,00,00);
        $fin     = Carbon::create(ano($fin),mes($fin),dia($fin),23,59,59);

        $array = [];
        
        foreach ($sucursales as $sucursal) {
            $temp =  $this->financiero_por_sucursales($ini, $fin, $sucursal->id);
            array_push($array, $temp);
        }

        dd($array);
    }
    
}
