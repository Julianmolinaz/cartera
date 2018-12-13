<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\FechaCobro;
use App\Traits\FacturaTrait;
use Carbon\Carbon;
use App\Variable;
use App\Factura;
use App\Credito;
use App\Sancion;
use App\Extra;
use App\Pago;
use App\Punto;
use Auth;
use DB;

class FacturaController extends Controller
{
    use FacturaTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $facturas   = Factura::orderBy('created_at','desc')->paginate(100);
      $variables  = Variable::find(1);

      return view('start.facturas.index')
      ->with('facturas',$facturas)
      ->with('variables',$variables);
    }

    //retorna la vista de todos pagos en el sistema
    public function pagos(){

      $pagos = Pago::cursor();
      
      return view('start.pagos.index')
            ->with('pagos',$pagos);
    }

    public function invoice_to_print($factura_id)
    {
      return $this->generate_content_to_print($factura_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $hoy      = Carbon::today();
      $credito  = Credito::find($id);

      $sum_sanciones = DB::table('sanciones')
                          ->where([['credito_id','=',$id],['estado','Debe']])
                          ->sum('valor');
      if($sum_sanciones == 'null'){ $sum_sanciones = 0; }

      $ultimo_pago = DB::table('pagos')
                          ->where([['credito_id','=',$credito->id],['concepto','=','Cuota']])
                          ->orWhere([['credito_id','=',$credito->id],['concepto','=','Cuota Parcial']])
                          ->orderBy('pago_hasta','desc')
                          ->first();

      //dd($ultimo_pago);

      $cuota_parcial = DB::table('pagos') 
                          ->where([['credito_id','=',$id],
                            ['concepto','=','Cuota Parcial']])
                          ->orderBy('pago_hasta','desc')
                          ->get();

      /******************** JURIDICO **************************/      
      /* se valida la existencia de sanciones Juridicas en la tabla extras, si existen se valida que haya abonos en 
      la tabla pagos en los casos de que no existan se generan los respectivos valores */


      $juridico = 
        Extra::where('credito_id',$id)
          ->where('concepto','Juridico')
          ->where('estado','Debe')->get();   

      if(count($juridico) > 0){

        $pago_juridico = DB::table('pagos')
                          ->where([['credito_id','=',$id],
                                   ['concepto','=','Juridico'],
                                   ['estado','=','Debe']])
                          ->get();

        if(count($pago_juridico) > 0){                    
          $pago_juridico = array(
                  'juridico' => $pago_juridico[0]->debe, 
                  'valor'    => $juridico[0]->valor);               
        }
        else{
          $pago_juridico = array('juridico' => null, 'valor' => $juridico[0]->valor);
        }                        
      }
      else{
        $pago_juridico = array('juridico' => 0, 'valor' => null);
      }

      /******************** END JURIDICO **************************/  

      /******************** PREJURIDICO  **************************/      
      /* se valida la existencia de sanciones Prejuridicas en la tabla extras, si existen se valida que haya abonos en 
      la tabla pagos en los casos de que no existan se generan los respectivos valores */


      $prejuridico = 
        Extra::where('credito_id',$id)
          ->where('concepto','Prejuridico')
          ->where('estado','Debe')->get();   

      if(count($prejuridico) > 0){

        $pago_prejuridico = DB::table('pagos')
          ->where([['credito_id','=',$id],['concepto','=','Prejuridico'],['estado','=','Debe']])
          ->get();
        
        if(count($pago_prejuridico) > 0){                    
          $pago_prejuridico = array('prejuridico' => $pago_prejuridico[0]->debe, 'valor' => $prejuridico[0]->valor);               
        }
        else{
          $pago_prejuridico = array('prejuridico' => null, 'valor' => $prejuridico[0]->valor);
        }                        
      }
      else{
        $pago_prejuridico = array('prejuridico' => 0, 'valor' => null);
      }

      /******************** END PREJURIDICO **************************/  

      /******************** PAGOS PARCIALES **************************/  
      $total_parciales = DB::table('pagos')->where([['credito_id','=',$id],[
        'concepto','=','Cuota Parcial'],['estado','=','Debe']])->sum('Debe');
      /******************** PAGOS PARCIALES **************************/  

      $pagos = Pago::where('credito_id',$id)->orderBy('id','desc')->get();
      $variables = Variable::all();
      $tipo_pago  = getEnumValues('facturas','tipo');
      $total_pagos = sum_pagos($credito);

//      dd($credito);

      return view('start.facturas.create')
        ->with('credito',$credito)
        ->with('sum_sanciones',$sum_sanciones)
        ->with('ultimo_pago',$ultimo_pago)
        ->with('pagos',$pagos)
        ->with('variables',$variables[0])
        ->with('pago_juridico',$pago_juridico)
        ->with('pago_prejuridico',$pago_prejuridico)
        ->with('total_parciales',$total_parciales)
        ->with('tipo_pago',$tipo_pago)
        ->with('total_pagos',$total_pagos);
    }


    public function generate_auto()
    {
      $punto        = Punto::find(Auth::user()->punto_id); 
      $prefijo      = $punto->prefijo;
      $consecutivo  = $punto->increment + 1;

      return $prefijo .''. $consecutivo;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    DB::beginTransaction();

    try{

      $cadena     = $request->info;
      $id         = $request->credito_id;
      $len_cadena = strlen($cadena);
      $vector     = array();
      $contenedor = "";
      $now        = Carbon::today();
      $bandera    = 0;

      if($request->auto){
        $date_time = Carbon::now();
        $num_fact  = $this->generate_auto();
      } else{
        $date_time = new Carbon($request->fecha_factura);
        $num_fact  = $request->num_factura;
      }

      // convierte el string cadena en un array llamado vector

      for( $i = 0; $i < $len_cadena ; $i++ ){
        if( $cadena[$i] == ','){ array_push($vector,$contenedor);  $contenedor = "";  }
        else{  $contenedor = $contenedor.$cadena[$i];  }        
      }
      array_push($vector,$contenedor);

      //variables creacion factura
      $factura = new Factura();
      $factura->num_fact        = $num_fact;
      $factura->fecha           = $date_time = $date_time->format('d-m-Y');
      $factura->credito_id      = $request->credito_id;
      $factura->total           = 0 ;
      $factura->tipo            = $request->tipo_pago;
      $factura->user_create_id  = Auth::user()->id;
      $factura->user_update_id  = Auth::user()->id;
      $factura->save();

      
      for ($k=0; $k < count($vector); $k++) { 
        $credito = Credito::find($id);

      /******************** JURIDICO *****************/  

        if($vector[$k] == "Juridico"){

          // Consulta el cobro jurìdico que este en Debe

          $juridico = Extra::where('credito_id',$credito->id)
                        ->where('concepto','Juridico')  
                        ->where('estado','Debe')
                        ->get();

          // Consulta si existen pagos de ese cobro jurídico              

          $pago_juridico = Pago::where('credito_id',$credito->id)
                              ->where('concepto','Juridico')
                              ->where('estado','Debe')
                              ->get(); 

          $pago = new Pago();
          $pago->factura_id = $factura->id;
          $pago->credito_id = $credito->id;
          $pago->concepto   = 'Juridico';  
          $pago->abono      = $vector[$k+3];  



          if(count($pago_juridico) > 0){
            $pago->debe         = $pago_juridico[0]->debe - $vector[$k+3];
            $pago->abono_pago_id= 'p'.$pago_juridico[0]->id.'.m'.$juridico[0]->id; 

            $pago_juridico          = Pago::find($pago_juridico[0]->id);
            $pago_juridico->estado  = 'Ok'; 
            $pago_juridico->save();
          }
          else{
            $pago->debe         = $juridico[0]->valor - $vector[$k+3];  

  // utilizo pago abono_id de la tabla pagos para referenciar a la multa que se le esta abonando (ver tabla extras) 
            $pago->abono_pago_id = 'p(--)'.'.m'.$juridico[0]->id; 
                       
          } 

          if($pago->debe == 0){ 
            $pago->estado = 'Ok'; 
            $juridico = Extra::find($juridico[0]->id);
            $juridico->estado = 'Ok';
            $juridico->save();
          } 
          else { 
            $pago->estado = 'Debe'; 
          }
          $pago->pago_desde = null;
          $pago->pago_hasta = null;
          $pago->save();  
          
          $credito->saldo = $credito->saldo - $pago->abono;
          $credito->save();
          $bandera = 1;                                              

        }

        /******************** PREJURIDICO *****************/ 

        if($vector[$k] == "Prejuridico"){

          $prejuridico = Extra::where('credito_id',$credito->id)
                        ->where('concepto','Prejuridico')  
                        ->where('estado','Debe')
                        ->get();

          $pago_prejuridico = Pago::where('credito_id',$credito->id)
                              ->where('concepto','Prejuridico')
                              ->where('estado','Debe')
                              ->get(); 

          $pago = new Pago();

          $pago->factura_id = $factura->id;
          $pago->credito_id = $credito->id;
          $pago->concepto   = 'Prejuridico';  
          $pago->abono      = $vector[$k+3];   

          if(count($pago_prejuridico) > 0){

            $pago->debe       = $pago_prejuridico[0]->debe - $vector[$k+3];
            $pago->abono_pago_id = 'p'.$pago_prejuridico[0]->id.'.m'.$prejuridico[0]->id; 
            $pago_prejuridico    = Pago::find($pago_prejuridico[0]->id);
            $pago_prejuridico->estado = 'Ok'; 
            $pago_prejuridico->save();   
          }
          else{
            $pago->debe       = $prejuridico[0]->valor - $vector[$k+3];        
            
            // utilizo pago abono_id de la tabla pagos para referenciar a la multa que se le esta abonando (ver tabla extras) 
            $pago->abono_pago_id = 'p(--)'.'.m'.$prejuridico[0]->id;     
            //$pago->abono_pago_id = null;            
          } 

          if($pago->debe == 0){ 
            $pago->estado = 'Ok'; 
            $prejuridico = Extra::find($prejuridico[0]->id);
            $prejuridico->estado = 'Ok';
            $prejuridico->save();
          } 
          else { 
            $pago->estado = 'Debe'; 
          }
          $pago->pago_desde = null;
          $pago->pago_hasta = null;
          $pago->save();  

          $credito->saldo = $credito->saldo - $pago->abono;
          $credito->save();
          $bandera = 1;
        }

        /******************** MORA  *****************/

        if($vector[$k] == "Mora"){
          $pago = new Pago();
          $pago->factura_id = $factura->id;
          $pago->credito_id = $id;
          $pago->concepto   = 'Mora';
          $pago->abono      = $vector[$k+3];
          $pago->debe       = 0;
          $pago->estado     = 'Ok';
          $pago->pago_desde = null;
          $pago->pago_hasta = null;
          $pago->abono_pago_id = null;
          $pago->save();

          $num_dias_sancion = $vector[$k-1];
          $debe_sancion = 
          DB::table('sanciones')
            ->where([['credito_id','=',$credito->id],['estado','=','Debe']])
            ->orderBy('created_at','asc')
            ->get();

          for ($i=0; $i < $num_dias_sancion; $i++) { 
              $sancion = Sancion::find($debe_sancion[$i]->id);
              $sancion->pago_id = $pago->id;
              $sancion->estado = 'Ok';
              $sancion->save();
            }  

          $credito->saldo = $credito->saldo - $pago->abono;
          $credito->save();
          $bandera = 1;

        } 

        /******************** CUOTA PARCIAL *****************/

        if($vector[$k] == "Cuota Parcial") {

          $cuota_parcial = Pago::where('credito_id',$credito->id)
                               ->where('concepto','Cuota Parcial')
                               ->where('estado','Debe')
                               ->where('pago_desde',$vector[$k+1])
                               ->where('pago_hasta',$vector[$k+2])
                               ->get();
                     
          $pago = new Pago();
          $pago->factura_id = $factura->id;
          $pago->credito_id = $credito->id;
          $pago->concepto   = 'Cuota Parcial';
          $pago->abono      = $vector[$k+3];


          if(count($cuota_parcial) > 0){  
            $pago->debe       = $cuota_parcial[0]->debe - $vector[$k+3];
            if($pago->debe == 0){
              $pago->estado = 'Ok';
              $credito->cuotas_faltantes = $credito->cuotas_faltantes - $vector[$k-1];
            }
            else{
              $pago->estado = 'Debe';
            }
            $pago->pago_desde     = $vector[$k+1];
            $pago->pago_hasta     = $vector[$k+2];
            $pago->abono_pago_id  = $cuota_parcial[0]->id;
            $pago->save();

            $cuota_parcial        = Pago::find($cuota_parcial[0]->id);
            $cuota_parcial->estado= 'Ok';
            $cuota_parcial->save();

            $credito->saldo       = $credito->saldo - $pago->abono;
            $credito->save();
          }
          else{
            $pago->debe           = $credito->precredito->vlr_cuota - $vector[$k+3];
            $pago->estado         = 'Debe';
            $pago->pago_desde     = inv_fech($vector[$k+1]);
            $pago->pago_hasta     = inv_fech($vector[$k+2]);
            $pago->abono_pago_id  = null;
            $pago->save();
            $credito->saldo       = $credito->saldo - $pago->abono;
            $credito->save();
          }
          $bandera = 1;
        }

        /******************** CUOTA *****************/

        if ($vector[$k] == "Cuota") {

          $pago = new Pago();
          $pago->factura_id = $factura->id;
          $pago->credito_id = $request->credito_id;
          $pago->concepto   = 'Cuota';
          $pago->abono      = $vector[$k+3];
          $pago->debe       = 0;
          $pago->estado     = 'Ok';
          $pago->pago_desde = inv_fech($vector[$k+1]);
          $pago->pago_hasta = inv_fech($vector[$k+2]);
          $pago->save();

          $credito->saldo            = $credito->saldo - $pago->abono;
          $credito->cuotas_faltantes = $credito->cuotas_faltantes - $vector[$k-1];
          $credito->save();

        }
        if ($vector[$k] == "Saldo a Favor") {

          $pago = new Pago();
          $pago->factura_id = $factura->id;
          $pago->credito_id = $request->credito_id;
          $pago->concepto   = 'Saldo a Favor';
          $pago->abono      = $vector[$k+1];
          $pago->debe       = 0;
          $pago->estado     = 'Ok';
          $pago->pago_desde = null;
          $pago->pago_hasta = null;
          $pago->save();

          $credito->saldo_favor      = $credito->saldo_favor + $pago->abono;
          $credito->save();
        }
        if ($vector[$k] == "Total:"){
          $factura->total  = $vector[$k+1];
          $factura->save();
        } 

      }//////////////////////////////////////////
       //definir fecha proxima de pago

        $ultima_cuota = 
            DB::table('pagos')
              ->where([['credito_id','=',$credito->id],['concepto','=','Cuota']])
              ->orWhere([['credito_id','=',$credito->id],['concepto','=','Cuota Parcial']])
              ->orderBy('pago_hasta','desc')
              ->first();

        if($ultima_cuota){
            $d = $ultima_cuota->pago_hasta; 
            $ultima_cuota = Carbon::create(ano($d),mes($d),dia($d),00,00,00);

            if($bandera == 1){
                $fecha_cercana = fecha_cercana($now->toDateString(),$credito->precredito->periodo,
                                              $credito->precredito->p_fecha,$credito->precredito->s_fecha);

                $fecha_cercana = Carbon::create(ano($fecha_cercana),mes($fecha_cercana),dia($fecha_cercana),00,00,00);

                if($fecha_cercana->gt($ultima_cuota)){                     
                  $n = $fecha_cercana; 
                  $n = inv_fech(formatoFecha(dia($n), mes($n), ano($n)));
                }
                else{ 
                  $n = $ultima_cuota; 
                  $n = inv_fech(formatoFecha(dia($n), mes($n), ano($n)));                  
                }
            }
            else{
                $n = $ultima_cuota;
                $n = inv_fech(formatoFecha(dia($n), mes($n), ano($n)));                
            }
        }
        else{
            if($bandera == 1){
                $fecha_cercana = fecha_cercana($now->toDateString(),$credito->precredito->periodo,
                                              $credito->precredito->p_fecha,$credito->precredito->s_fecha);
                $n = Carbon::create(ano($fecha_cercana),mes($fecha_cercana),dia($fecha_cercana),00,00,00);
                $n = inv_fech(formatoFecha(dia($n), mes($n), ano($n)));  
            }
        }

        $fecha_cobro = FechaCobro::where('credito_id',$credito->id)->get();
        if(count($fecha_cobro) > 0){
          $fecha_cobro = FechaCobro::find($fecha_cobro[0]->id);
          $fecha_cobro->credito_id = $credito->id;
          $fecha_cobro->fecha_pago = $n;
          $fecha_cobro->save();
          $factura->fecha_proximo_pago = $fecha_cobro->fecha_pago;
          $factura->save();
        }
        else{
          $fecha_cobro = new FechaCobro();
          $fecha_cobro->credito_id = $credito->id;
          $fecha_cobro->fecha_pago = $n;
          $fecha_cobro->save();
          $factura->fecha_proximo_pago = $fecha_cobro->fecha_pago;
          $factura->save();
        }  

        if($credito->cuotas_faltantes == 0 && $credito->saldo == 0){
          $credito->estado = 'Cancelado';
          $credito->save();
        }

        DB::commit();

      return response()->json([
        "error"   => false,
        "mensaje" => "Se generaron los pagos Éxitosamente !!!"
      ]); 
    } catch(\Exception $e){
        DB::rollback();
        return response()->json([
          "error"   => true,
          "mensaje" => $e->getMessage()
        ]);
    }

    }

    public function show($id)
    {
      $factura = Factura::find($id);
      return view('start.facturas.show')
      ->with('factura',$factura);
    } 


    public function edit($id){}
    public function update(Request $request, $id){}
    public function destroy($id){}

    public function fecha_pago(Request $request)
    {
      $fecha_inicial = $request->fecha;

      $periodo = calcularFecha($request->date,$request->periodo, $request->num_cuotas, $request->p_fecha, 
        $request->s_fecha, $request->primera_cuota);

      $fecha_ini = $periodo["fecha_ini"];
      $fecha_fin = $periodo["fecha_fin"];

      if ($request->ajax()){  return response()->json($periodo);  } 
    }

    //Consulta si el numero de factura existe

    public function consultar_factura($id){

      $n = 
      DB::table('facturas')
        ->where([['num_fact','=',$id]])
        ->count();

      if ($n > 0) { $hay_factura = true;  }
      else        { $hay_factura = false; }

      return response()->json($hay_factura);


    }

    public function abonos(Request $request)
    {

      $monto      = $request->monto;
      $credito    = Credito::find($request->credito_id);
      $sanciones  = Sancion::where('credito_id',$request->credito_id)
        ->where('estado','Debe')
        ->get();
      $hay_sanciones  = count($sanciones) > 0;
      $dia_sancion = Variable::find(1)->vlr_dia_sancion;
      $monto_por_sancion = 0;
      $contador   = 0;
      $fila       = "";
      $fila_monto = "";
      $fila_saldo = "";
      $fila_juridico          = "";
      $fila_prejuridico       = "";
      $fila_cuotas_completas  = "";
      $fila_cuotas_incompletas= "";
      $fila_pagos_parciales   = "";


      /****************************** JURIDICO **************************************/
      if($monto > 0){
        $sancion_juridico = DB::table('extras')
        ->where([['credito_id','=',$request->credito_id],
          ['concepto','=','Juridico'],
          ['estado','=','Debe']])
        ->get();

        if(count($sancion_juridico) > 0){
          $juridico = DB::table('pagos')
          ->where([['credito_id','=',$request->credito_id],
           ['concepto','=','Juridico'],
           ['estado','=','Debe']])
          ->get();

          if(count($juridico) > 0 ){                               
            if($monto > $juridico[0]->debe){ 
              $abono = $juridico[0]->debe;
              $monto = $monto - $abono;
            }
            else{
              $abono = $monto;
              $monto = 0;
            }
          }  
          else{
            if($monto > $sancion_juridico[0]->valor){
              $abono = $sancion_juridico[0]->valor;
              $monto = $monto - $abono;
            }
            else{
              $abono = $monto;
              $monto = 0;
            }           
          }
          $fila_juridico = 
          "<tr class='otras_filas'>
          <td>1</td>
          <td><a href='#' onclick='Eliminar(this.parentNode.parentNode.rowIndex)'>Juridico</a></td>
          <td></td>
          <td></td>
          <td class='vlr'>".$abono."</td>
        </tr>";      
      }
    }    
    /****************************** PREJURIDICO **************************************/
    if($monto > 0){
      $sancion_prejuridico = DB::table('extras')
      ->where([['credito_id','=',$request->credito_id],
        ['concepto','=','Prejuridico'],
        ['estado','=','Debe']])
      ->get();


      if(count($sancion_prejuridico) > 0){
        $prejuridico = DB::table('pagos')
        ->where([['credito_id','=',$request->credito_id],
          ['concepto','=','Prejuridico'],
          ['estado','=','Debe']])
        ->get();

        if(count($prejuridico) > 0 ){                               
          if($monto > $prejuridico[0]->debe){ 
            $abono = $prejuridico[0]->debe;
            $monto = $monto - $abono;
          }
          else{
            $abono = $monto;
            $monto = 0;
          }
        }  
        else{
          if($monto > $sancion_prejuridico[0]->valor){
            $abono = $sancion_prejuridico[0]->valor;
            $monto = $monto - $abono;
          }
          else{
            $abono = $monto;
            $monto = 0;
          }           
        }
        $fila_prejuridico = 
        "<tr class='otras_filas'><td>1</td>
        <td><a href='#' onclick='Eliminar(this.parentNode.parentNode.rowIndex)'>Prejuridico</a></td>
        <td></td>
        <td></td>
        <td class='vlr'>".$abono."</td>
      </tr>";        
    }
  }
  /****************************** SANCIONES **************************************/
  if($monto > 0){
    if($hay_sanciones){
      foreach ($sanciones as $sancion) {
        if($monto >= $dia_sancion){
          $monto_por_sancion = $monto_por_sancion + $dia_sancion;
          $monto = $monto - $sancion->valor;
          $contador++;
        }
      }
      $fila = 
      "<tr class='otras_filas'><td>".$contador."</td>
      <td><a href='#' onclick='Eliminar(this.parentNode.parentNode.rowIndex)'>Mora</a></td>
      <td></td>
      <td></td>
      <td class='vlr'>".$monto_por_sancion."</td>
    </tr>";    
  }

}  


/****************************** CUOTAS INCOMPLETAS **************************************/  
if($monto > 0){
  $pagos_parciales = 
  DB::table('pagos')
  ->where([['credito_id','=',$request->credito_id],['concepto','=','Cuota Parcial'],['estado','=','Debe']])
  ->orderBy('pago_hasta','asc')
  ->get();

  if(count($pagos_parciales) > 0){  
    foreach ($pagos_parciales as $pago) {

      if ($monto > $pago->debe) {
        $abono = $pago->debe; 
        $monto = $monto - $abono;
      }
      else{
        $abono = $monto;
        $monto = 0;
      }
      $fila_pagos_parciales = 
      $fila_pagos_parciales."<tr class='otras_filas'>
      <td>1</td>
      <td><a>Cuota Parcial</a></td>
      <td>".$pago->pago_desde."</td>
      <td>".$pago->pago_hasta."</td>
      <td class='vlr'>".$abono."</td>
    </tr>";
  }               
}  
}
/****************************** CUOTAS **************************************/      

if($monto > 0){

  $cuotas = $monto / $credito->precredito->vlr_cuota;

  if($cuotas > $credito->cuotas_faltantes ) {
    $cuotas = $credito->cuotas_faltantes;
  }

  $cuotas_completas   = intval($cuotas);
  $cuotas_incompletas = ceil($cuotas) - $cuotas_completas;
  $date = $credito->fecha_pago->fecha_pago;

  if($cuotas_completas > 0){
    $fecha = 
    calcularFecha($credito->fecha_pago->fecha_pago, $credito->precredito->periodo, 
                  $cuotas_completas, $credito->precredito->p_fecha, $credito->precredito->s_fecha, false);

    $monto_cuota    = $cuotas_completas * $credito->precredito->vlr_cuota;
    $monto          = $monto - $monto_cuota;

    $fila_cuotas_completas = 
    "<tr class='otras_filas'>
    <td>".$cuotas_completas."</td>
    <td><a>Cuota</a></td>
    <td>".$fecha['fecha_ini']."</td><td>".$fecha['fecha_fin']."</td>
    <td class='vlr'>".$monto_cuota."</td>
  </tr>";

  $date           = $fecha['fecha_fin']; 
  $primera_cuota  = false;
}

  if($cuotas_incompletas > 0){
    $fecha = calcularFecha($date, $credito->precredito->periodo, $cuotas_incompletas, 
      $credito->precredito->p_fecha, $credito->precredito->s_fecha,false );

    $fila_cuotas_incompletas = 
    "<tr class='otras_filas'><td>".$cuotas_incompletas."</td>
    <td><a>Cuota Parcial</a></td>
    <td>".$fecha['fecha_ini']."</td>
    <td>".$fecha['fecha_fin']."</td>
    <td class='vlr'>".$monto."</td>
  </tr>";
  $monto = 0;              
  }
}

    if($monto > 0){
      $fila_saldo = 
      "<tr class='otras_filas'>
      <td></td>
      <td></td>
      <td></td>
      <td style='color:#ff0000'><strong>Saldo a Favor</strong></td>
      <td style='color:#ff0000'>".$monto."</td>
    </tr>";
    }

    $fila = $fila_juridico.$fila_prejuridico.$fila.$fila_pagos_parciales.$fila_cuotas_completas.$fila_cuotas_incompletas.$fila_saldo;

    if ($request->ajax()){  return response()->json(['fila' => $fila , 'monto' => $monto]);  }
  }

}
