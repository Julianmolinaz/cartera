<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use App\Credito;
use App\Pago;
use App\Sancion;
use App\Variable;
use App\FechaCobro;
use App\Auditoria;


class Sanciones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generar:sanciones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generador de sanciones';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function hola(){
        return "hola";
    }

    function inv_fech($input){
      $caracter = substr($input,5,1);
      if ( $caracter == "/" ||  $caracter == "-"){
        $dia = substr($input,0,2);
        $mes = substr($input,3,2);
        $ano = substr($input,6,4);
        return ($ano.'-'.$mes.'-'.$dia);
        }
    else{
        $dia = substr($input,8,2);
        $mes = substr($input,5,2);
        $ano = substr($input,0,4);
        return ($ano.'-'.$mes.'-'.$dia);
        }
    }

    //EXTRAE EL DIA DE UNA FECHA

    function dia($input){ 
        $caracter = substr($input,5,1);
        if ( $caracter == "/" ||  $caracter == "-") { $dia = substr($input,0,2);   return ($dia);   }
        else                                        { $dia = substr($input,8,2);   return ($dia);   }
    }

    //ETRAE EL MES DE UNA FECHA

    function mes($input){
        $caracter = substr($input,5,1);
        if ( $caracter == "/" ||  $caracter == "-") { $mes = substr($input,3,2);   return ($mes);   }
        else                                        { $mes = substr($input,5,2);   return ($mes);   }
    }

    //EXTRAE EL AÑO DE UNA FECHA

    function ano($input){
        $caracter = substr($input,5,1);
        if ( $caracter == "/" ||  $caracter == "-") { $ano = substr($input,6,4);   return ($ano);    }
        else                                        { $ano = substr($input,0,4);   return ($ano);    }
    }

    function calcularFecha($date,$periodo, $num_cuotas, $p_fecha, $s_fecha, $primera_cuota){
        if ($primera_cuota == 'true') {
            if($periodo == 'Quincenal')     {  $fecha_ini = $this->fecha_ini_quincenal($date, $p_fecha,$s_fecha);  }
            elseif ( $periodo == 'Mensual') {  $fecha_ini = $this->fecha_ini_mensual($date, $p_fecha);             }
        }  
        else{  $fecha_ini = $this->recuperar_fecha($date,$p_fecha,$s_fecha,$periodo);  }
        $fecha_fin = $this->pago_hasta($fecha_ini, $periodo, $num_cuotas, $p_fecha, $s_fecha);
        $array_fecha = array('fecha_ini' => $this->aproximar_febrero($fecha_ini),'fecha_fin' => $this->aproximar_febrero($fecha_fin));

        return $array_fecha;
    }

    //CALCULA LA PRIMERA FECHA DE PAGO

    function fecha_ini_quincenal($date,$p_fecha, $s_fecha){ 

      $f_credito = $this->formatoFecha($this->dia($date),$this->mes($date),$this->ano($date));
      $carbon_f_credito = Carbon::create($this->ano($date),$this->mes($date),$this->dia($date),00,00,00);
      $ini = "";

      if( $this->dia($f_credito) == $p_fecha){   
        $ini = $this->formatoFecha($s_fecha,$this->mes($f_credito),$this->ano($f_credito)); 
      }
      elseif ($this->dia($f_credito) < $p_fecha) {  

        $diferencia = $p_fecha - $this->dia($f_credito);

          if ( $diferencia >= 7 ) { 
            $ini = $this->formatoFecha($p_fecha,$this->mes($f_credito),$this->ano($f_credito));     
          }
          else{                           
            $ini = $this->formatoFecha($s_fecha,$this->mes($f_credito),$this->ano($f_credito));     
          }  
        }
      elseif ($this->dia($f_credito) > $p_fecha) {
        if ($this->dia($f_credito) == $s_fecha){ 
          $ini = $this->formatoFecha($p_fecha,$this->mes($f_credito)+1,$this->ano($f_credito)); 
        }
        elseif ($this->dia($f_credito) < $s_fecha) { 
          $diferencia = $s_fecha - $this->dia($f_credito);        
          
          if ( $diferencia >= 7 ) {     
            $ini = $this->formatoFecha($s_fecha,$this->mes($f_credito),$this->ano($f_credito));     
          }
          else{                         
            $ini = $this->formatoFecha($p_fecha,$this->mes($f_credito)+1,$this->ano($f_credito));   
          }  
        }
        elseif ($f_credito > $s_fecha) {
          $carbon_f_credito->day = $p_fecha;
          $carbon_f_credito->addDays($carbon_f_credito->daysInMonth);
          $diferencia = $carbon_f_credito->diffInDays(Carbon::create($this->ano($date),$this->mes($date),$this->dia($date),00,00,00));

          if ( $diferencia >= 7 ) {     
            $ini = $this->formatoFecha($p_fecha,$this->mes($f_credito)+1,$this->ano($f_credito));   
          }
          else{                         
            $ini = $this->formatoFecha($s_fecha,$this->mes($f_credito)+1,$this->ano($f_credito));   
          } 
          }
        }
      return $this->organizar($ini);
    } 

    function fecha_ini_mensual($date,$p_fecha){
        $f_credito = $this->formatoFecha($this->dia($date),$this->mes($date),$this->ano($date));
        $carbon_f_credito = Carbon::create($this->ano($date),$this->mes($date),$this->dia($date),00,00,00);
        $ini = "";

        if( $this->dia($f_credito) == $p_fecha){   
          $ini = $this->formatoFecha($p_fecha,$this->mes($f_credito)+1,$this->ano($f_credito));  
        }
        elseif ( $this->dia($f_credito) < $p_fecha ){
        $diferencia = $p_fecha - $this->dia($f_credito);
          if ( $diferencia >= 7 ) {       
            $ini = $this->formatoFecha($p_fecha,$this->mes($f_credito),$this->ano($f_credito));      
          }
          else{                           
            $ini = $this->formatoFecha($p_fecha,$this->mes($f_credito)+1,$this->ano($f_credito));    
          } 
        }
        elseif($this->dia($f_credito) > $p_fecha){
          $carbon_f_credito->day = $p_fecha;
          $carbon_f_credito->addDays($carbon_f_credito->daysInMonth);
          $diferencia = $carbon_f_credito->diffInDays(Carbon::create($this->ano($date),$this->mes($date),$this->dia($date),00,00,00));

          if ( $diferencia >= 7 ) {     
            $ini = $this->formatoFecha($p_fecha,$this->mes($f_credito)+1,$this->ano($f_credito));   
          }
          else{                         
            $ini = $this->formatoFecha($p_fecha,$this->mes($f_credito)+2,$this->ano($f_credito));   
          } 
        } 

        return $this->organizar($ini);
        }

    //GENERA LA FECHA DEL PROXIMO PAGO    

    function pago_hasta($fecha_ini, $periodo, $num_cuotas,$p_fecha, $s_fecha){

      if ($periodo == 'Quincenal') {
      
        $cuotas     = $num_cuotas;
        $quincenas  = $cuotas % 2;
        $meses      = intval( $cuotas / 2 );


        $fin = $this->formatoFecha($this->dia($fecha_ini), $this->mes($fecha_ini) + $meses ,$this->ano($fecha_ini));

        if ( $quincenas == 1 ) { 
          if ($this->dia($fecha_ini) == $p_fecha) { $fin = $this->formatoFecha($s_fecha,$this->mes($fin),$this->ano($fin)); }
          elseif($this->dia($fecha_ini) == $s_fecha){ $fin = $this->formatoFecha($p_fecha,$this->mes($fin)+1,$this->ano($fin)); }
        }

        return $this->organizar($fin);
      }
      else{
        $fin = $this->formatoFecha($this->dia($fecha_ini),$this->mes($fecha_ini)+$num_cuotas,$this->ano($fecha_ini));
        return $this->organizar($fin);
      }  
    } 

    //FORMATEA LA FECHA DD-MM-AAAA

    function formatoFecha($dia,$mes,$ano){
      if(strlen($dia)<2){ $dia = "0".$dia;}
      if(strlen($mes)<2){ $mes = "0".$mes;}  

      return $dia.'-'.$mes.'-'.$ano;
    }

    //DETERMINA SI UN AÑO ES BISIESTO O NO

    function bisiesto($ano){
      if( $ano % 4 == 0 && ( $ano % 100 != 0 || $ano % 400 == 0 )){   return true;  }
      else{ return false;  }
    }

    //ORGANIZA LA FECHA EN FORMATO DD-MM-AAAA

    function organizar($fecha){

      $anos  = intval( $this->mes($fecha) / 12 );
      $meses = $this->mes($fecha) % 12;

      if( $this->mes($fecha) > 12 ){ 
        $fecha = $this->formatoFecha(dia($fecha), $meses, $this->ano($fecha)+$anos);  
      }
      return $fecha;
    }

    //ADELANTA LA FECHA DE PAGO CUANDO EL MES DE FEBRERO NO TIENE LA FECHA ACORDADA DE PAGO

    function aproximar_febrero($fecha){
      if ($this->dia($fecha) == 30 && $this->mes($fecha) == 2)   {  
        $fecha = $this->formatoFecha(1,3,$this->ano($fecha));   
      }
      elseif($this->dia($fecha) == 29 && $this->mes($fecha) == 2){  

        if (!$this->bisiesto($this->ano($fecha))) {   
          $fecha = $this->formatoFecha(1,3,ano($fecha));   }
      }
      return $fecha;
    }

    //AJUSTA LA FECHA PARA LA EXCEPCION DEL MES DE FEBRERO

    function recuperar_fecha($fecha,$p_fecha,$s_fecha,$periodo){

      if ($this->dia($fecha) == 1 && $this->mes($fecha) == 3) {
      
        if($periodo == 'Quincenal' && $s_fecha == 30 )   {  $fecha = $this->formatoFecha(30,2,ano($fecha));  }
        elseif ($periodo == 'Mensual' && $p_fecha == 30) {  $fecha = $this->formatoFecha(30,2,ano($fecha));  }
        if($periodo == 'Quincenal' && $s_fecha == 29 )   {  $fecha = $this->formatoFecha(29,2,ano($fecha));  }
        elseif ($periodo == 'Mensual' && $p_fecha == 29) {  $fecha = $this->formatoFecha(29,2,ano($fecha));  }

      }

        return $this->formatoFecha($this->dia($fecha),$this->mes($fecha),$this->ano($fecha));
      
    }

    //GENERADOR DE LAS SANCIONES DIARIAS

    function generar_sanciones($credito_id){

        $credito = Credito::find($credito_id);
        $now = Carbon::today();

        $fecha = FechaCobro::where('credito_id',$credito_id)->get();


        $fecha_cobro = $fecha[0]->fecha_pago;
        

        $fecha_tope = Carbon::create($this->ano($fecha_cobro) , $this->mes($fecha_cobro) , $this->dia($fecha_cobro) ,23,59,59);

        $validacion = $fecha_tope->gt($now);

        if( $validacion == true ){
            if( $credito->estado != 'Al dia' ){
                $credito->estado  = 'Al dia';
                $credito->user_update_id = 1;
                $credito->updated_at = $credito->updated_at;
                $credito->save();
            }
        }
        else{
          $vlr_sancion = Variable::find(1)->vlr_dia_sancion;

          if( $credito->estado == 'Al dia' ){
              $credito->estado  = 'Mora';
              $credito->saldo   = $credito->saldo + $vlr_sancion;
              $credito->user_update_id = 1;
              $credito->save();
              $sancion = new Sancion();
              $sancion->credito_id = $credito->id;
              $sancion->valor = $vlr_sancion;
              $sancion->estado = 'Debe';
              $sancion->save();
          }
          else{

              $credito->saldo   = $credito->saldo + $vlr_sancion;
              $credito->user_update_id = 1;
              $credito->save();

              $sancion = new Sancion();
              $sancion->credito_id = $credito->id;
              $sancion->valor = $vlr_sancion;
              $sancion->estado = 'Debe';
              $sancion->save();

          }
        }

        return $credito->estado;
        
    }

public function handle()
{

    $auditoria = new Auditoria();  
    $auditoria->concepto = 'Sanciones';
    $auditoria->clave_ini = 1;
    $auditoria->clave_fin = 0;
    $auditoria->save();

    DB::beginTransaction();

    try{

        // $creditos = DB::table('creditos')
        //             ->whereIn('Estado',['Al dia','Mora','Prejuridico','Juridico'])
        //             ->get();
        $creditos = DB::table('creditos')
                    ->whereIn('id',['102','117','118','119','120','124','132','158','164','214','215','218','219','225','248','261','309','312','328','363',
                    '377','429','437','443','444','448','449','461','463','492','493','504','515','522','523','524','532','542','545','557','558','572','577',
                    '613','617','621','626','630','635','636','638','644','649','650','654','656','657','658','665','669','674','677','678','679','681','685',
                    '689','690','699','711','714','716','720','725','730','732','745','754','755','756','763','771','782','793','796','804','808','810','813',
                    '816','817','818','847','874','908','912','919','923','936','960','971','980','985','1009','1066','1077','1086','1096','1104','1110',
                    '1119','1121','1127','1130','1133','1164','1185','1195','1202','1212','1235','1236','1237','1238','1239','1241','1243','1252',
                    '1253','1255','1261','1262','1263','1264','1265','1267','1268','1269','1271','1273','1275','1276','1278','1282','1283','1286',
                    '1299','1301','1302','1303','1304','1306','1309','1312','1313','1314','1315','1316','1317','1318','1329','1332','1334','1335',
                    '1336','1337','1339','1341','1349','1351','1353','1355','1356','1358','1359','1363','1364','1365','1367','1368','1369','1373',
                    '1375','1378','1379','1380','1381','1388','1389','1390','1398','1400','1401','1402','1409','1413','1415','1416','1419','1421',
                    '1422','1423','1424','1425','1426','1428','1430','1431','1432','1440','1441','1444','1446','1448','1449','1450','1451','1455',
                    '1456','1457','1460','1463','1464','1466','1470','1473','1474','1489','1518','1552','1572','1618','1663','1755','1756','1776',
                    '1878','1880','1881','1886','1925','1941','1959','1970','1979','1981','2125','2232','2235','2282','2290','2292','2296','2415',
                    '2416','2459','2600','2660','2902','3108','3230','3398'])
                    ->get();

        foreach ($creditos as $credito) {
          echo $credito->id.' ';
          $this->generar_sanciones($credito->id);
        }

        $auditoria->clave_fin = 1;
        $auditoria->save();

        DB::commit();

      } catch (\Exception $e) {
        echo "****ERROR****";
        DB::rollback();
      }   

}                                    


}
