<?php

namespace App\Http\Controllers;

use App\Traits\ReporteTrait;
use Illuminate\Http\Request;

use App\Http\Controllers\VentaController;
use App\Repositories\EgresosRepository;
use App\Traits\InformeCarteraTrait;
use App\Traits\IngresoEsperadoTrait;
use App\Traits\Financierotrait;
use App\Traits\MorososTrait;
use App\Traits\EgresoTrait;
use App\Http\Requests;
use App\OtrosPagos;
use Carbon\Carbon;
use App\Variable;
use App\Llamada;
use App\Factura;
use App\Credito;
use App\Cartera;
use App\Egreso;
use App\Punto;
use App\Pago;
use App\User;
use Excel;
use Auth;
use DB;


class ReporteController extends Controller
{
    private $fecha_1;
    private $fecha_2;
    public $egresos_repo;
    public $egresos;
    use ReporteTrait, Financierotrait;
    use EgresoTrait, MorososTrait, InformeCarteraTrait, IngresoEsperadoTrait;

    public function __construct(EgresosRepository $egresos_repo)
    {
        $this->middleware('auth');
        $this->egresos_repo = $egresos_repo;
    }

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
        if ($request->daterange) {
            $fecha_1 = substr($request->daterange,0,10);
            $fecha_2 = substr($request->daterange,13,22);
            $ini     = Carbon::create(ano($fecha_1),mes($fecha_1),dia($fecha_1),00,00,00);
            $fin     = Carbon::create(ano($fecha_2),mes($fecha_2),dia($fecha_2),23,59,59);
            $rango   = array('ini' => $ini->format('d-m-Y'), 'fin' => $fin->format('d-m-Y')); 
        }

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
        
        //VENTACREDITOSVENTACREDITOSVENTACREDITOSVENTACREDITOSVENTACREDITOS
        //VENTACREDITOSVENTACREDITOSVENTACREDITOSVENTACREDITOSVENTACREDITOS

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

        //VENTACREDITOSASESORVENTACREDITOSASESORVENTACREDITOSASESORVENTACREDITOS
        //VENTACREDITOSASESORVENTACREDITOSASESORVENTACREDITOSASESORVENTACREDITOS

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



        //CASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADA
        //CASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADACASTIGADA

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

        //CALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTER
        //CALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTERCALLCENTER
  
        else if($request->input('tipo_reporte') == 'callcenter'){

            $llamadas = Llamada::whereBetween('created_at',[$ini,$fin])->get();

            $calls = 
            DB::table('llamadas')
                ->join('users','llamadas.user_create_id','=','users.id')
                ->select('llamadas.*','users.name as user')
                ->whereBetween('llamadas.created_at',[$ini,$fin])
                ->get();


            $collection = collect($calls);
            $grouped = $collection->groupBy('user');
            $array_calls = [];
            $totales = [
                'num_llamadas' => 0,
                'efectivas' => 0,
                'no_efectivas' => 0,
                'efectivas_null' => 0 
            ];
 
            foreach ($grouped as $key => $element) {
                $temp = [
                    'user' => $key,
                    'num_llamadas' => 0,
                    'efectivas' => 0,
                    'no_efectivas' => 0,
                    'efectivas_null' => 0
                ];

                foreach ($element as $e) {
                    $totales['num_llamadas'] ++;
                    $temp['num_llamadas'] ++;

                    if($e->efectiva == '1'){

                        $temp['efectivas'] ++;
                        $totales['efectivas'] ++;

                    } else if($e->efectiva == '0') {

                        $temp['no_efectivas'] ++;
                        $totales['no_efectivas'] ++;

                    } else {

                        $temp['efectivas_null'] ++;
                        $totales['efectivas_null'] ++;
                    }
                }

                array_push($array_calls, $temp);
            }          

            return view('admin.reportes.callcenter')
                ->with('array_calls',$array_calls)
                ->with('llamadas',$llamadas)
                ->with('rango',$rango)
                ->with('totales',$totales);
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

        //PROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITO
        //PROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITOPROCREDITO
        
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
        //DATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITO
        //DATACREDITODATACREDITODATACREDITODATACREDITODATACREDITODATACREDITO

        else if($request->input('tipo_reporte') == 'datacredito' ){
            $corte = Carbon::now();
            $corte->subMonth()->modify('last day of this month');

            $report_datacredito  =  reporte_datacredito($corte); // array con el reporte    
            $nombre_archivo      = '116881.'.$corte->year.cast_number($corte->month,2,'right').cast_number($corte->day,2,'right').'.T.txt';  // nombre del reporte
            $archivo             = fopen($nombre_archivo, "w"); // creacion del archivo
            
            //asignacion de datos al archivo
            foreach($report_datacredito as $reporte){
                foreach($reporte as $key => $elemento){

                    if ($elemento === reset($reporte)) {
                        fwrite($archivo, $elemento); }
                    else{
                        fwrite($archivo, $elemento); }
                }
                fwrite($archivo, PHP_EOL);  
            }
            fclose($archivo); // cierre del archivo

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

    //FINANCIEROFINANCIEROFINANCIEROFINANCIEROFINANCIEROFINANCIEROFINANCIERO
    //FINANCIEROFINANCIEROFINANCIEROFINANCIEROFINANCIEROFINANCIEROFINANCIERO

    else if($request->input('tipo_reporte') == 'financiero')
    {
        $sucursales = Punto::orderBy('nombre')->get();
        $anios = array();
        $now = Carbon::now();

        for ($i=2017; $i <= $now->year ; $i++) { 
            array_push($anios, $i);
        }

        return view('admin.reportes.financiero.index')
            ->with('sucursales',$sucursales)
            ->with('anios',$anios);

    }

    //EGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOS
    //EGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOS

    else if($request->input('tipo_reporte') == 'egresos' )
    {
        return $this->getEgresosEt($ini, $fin);
    }

    /**
     * Reporte Caja
     */

     else if($request->input('tipo_reporte') == 'caja')
     {
         return view('admin.reportes.caja.index');
     }

     else if( $request->input('tipo_reporte') == 'morosos')
     {
        $now            = Carbon::now();
        $fecha          = $now->toDateTimeString();

        Excel::create('morosos'.$fecha,function($excel){
            $excel->sheet('Sheetname',function($sheet){
                $morosos =  $this->get_morosos();
                $sheet->fromArray($morosos,null,'A1',false,false);
            });
        })->download('xls');
     }

     /**
      * Reporte datacredito asistimotos
      */
      else if($request->input('tipo_reporte') == 'data-asis')
      {
          return view('admin.reportes.data_asis.index');
      }

      /**
       *  Informe cartera
       */
      else if ($request->input('tipo_reporte') == 'informe_cartera') {
        $this->informeCarteraTr(); //ver InformeCarteraTrait
      }

    /**
     *  Informe Ingreso Esperado
     */

    else if ($request->input('tipo_reporte') == 'ingreso_esperado') {
        return $this->ingresoNominalTr($ini, $fin);
    }
      
}

    public function get_cashes_report($date)
    {
        $cajas = cajas($date);
        $res   = ['error' => false, 'dat' => $cajas];
        return responser()->json($res);
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

    public function marcar_cancelados($tipo_reporte)
    {
        DB::beginTransaction();

        try{

            $cancelados = DB::table('cancelados')->where('reporte',$tipo_reporte)->get();

            if($tipo_reporte == 'procredito'){
                $end = 'end_procredito';
            }
            elseif($tipo_reporte == 'datacredito')
            {
                $end = 'end_datacredito';
            }

            if(count($cancelados) > 0){

                foreach($cancelados as $cancelado){
                    DB::table('creditos')
                        ->where('id',$cancelado->credito_id)
                        ->update([$end => 1]);
                }

                DB::table('cancelados')->where('reporte',$tipo_reporte)->delete();
                DB::commit();
                flash()->success('Se marcaron los creditos cancelados correctamente');
                return redirect()->route('admin.reportes.index');
            } //.if

            else{
                flash()->error('No hay creditos en el rango');
                return redirect()->route('admin.reportes.index');
            }

        }//.try
        catch(\Exception $e)
        {
            flash()->info('Error al marcar los créditos cancelados');
            return redirect()->route('admin.reportes.index');
        }

        
    }//.marcar_cancelados

    
}
