<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Credito;
use App\Pago;
use App\Sancion;
use App\Variable;
use App\FechaCobro;
use App\Auditoria;
use DB;


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
              //$credito->saldo   = $credito->saldo + $vlr_sancion;
              $credito->user_update_id = 1;
              $credito->save();
              //$sancion = new Sancion();
              //$sancion->credito_id = $credito->id;
              //$sancion->valor = $vlr_sancion;
              //$sancion->estado = 'Debe';
              //$sancion->save();
          }
          //else{

            //  $credito->saldo   = $credito->saldo + $vlr_sancion;
            //  $credito->user_update_id = 1;
            //  $credito->save();

            //  $sancion = new Sancion();
            //  $sancion->credito_id = $credito->id;
            //  $sancion->valor = $vlr_sancion;
            //  $sancion->estado = 'Debe';
            //  $sancion->save();

          //}
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

        $creditos = DB::table('creditos')
                    ->whereIn('Estado',['Al dia','Mora','Prejuridico','Juridico'])
                    ->get();

        foreach ($creditos as $credito) {
          echo $credito->id.' ';
          $this->generar_sanciones($credito->id);
        }
        $auditoria->clave_fin = 1;
        $auditoria->save();

        DB::commit();

      } catch (\Exception $e) {
        echo "****ERROR**" . $e->getMessage();
        DB::rollback();
      }   

}                                    


}
