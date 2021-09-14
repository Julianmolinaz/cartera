<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use App\Cliente;
use DB;

function res($success,$data,$message,$status=200)
{
    return response()->json([
        'success' => $success,
        'dat'     => $data,
        'message' => $message 
    ], $status);
}

function Ymd($input) {
    $caracter = substr($input,5,1);

    if ( $caracter == "/" ||  $caracter == "-"){
        $dia = substr($input,0,2);
        $mes = substr($input,3,2);
        $ano = substr($input,6,4);
        return ($ano.'-'.$mes.'-'.$dia);
    }
    else{  
        return $input;
    }
}

//funcion que invierte el formato de la fecha (dia, mes, año) a (año, mes, dia) o al contrario 
// recibe un string

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
        return ($dia.'-'.$mes.'-'.$ano);
    }
}

function inv_fech2($input){
  $caracter = substr($input,5,1);
  if ( $caracter == "/" ||  $caracter == "-"){
    $dia = substr($input,0,2);
    $mes = substr($input,3,2);
    $ano = substr($input,6,4);
    return ($ano.'-'.$mes.'-'.$dia);
  }
  else{
    return $input;
  }
}

function dia($input){
   $caracter = substr($input,5,1);
  if ( $caracter == "/" ||  $caracter == "-"){
    $dia = substr($input,0,2);
    return ($dia);
  }
  else{
    $dia = substr($input,8,2);
    return ($dia);
  }
}
function mes($input){
   $caracter = substr($input,5,1);
  if ( $caracter == "/" ||  $caracter == "-"){
    $mes = substr($input,3,2);
    return ($mes);
  }
  else{
    $mes = substr($input,5,2);
    return ($mes);
  }
}

function ano($input){
  $caracter = substr($input,5,1);
  if ( $caracter == "/" ||  $caracter == "-"){
    $ano = substr($input,6,4);
    return ($ano);
  }
  else{
    $ano = substr($input,0,4);
    return ($ano);
  }
}


function saluda(){
	echo "Hola mundo";
  echo "<br/>";
}

//// function that converts the enum values of a column into an array
function getEnumValues($table, $column)
{
  $type = DB::select( DB::raw("SHOW COLUMNS FROM $table WHERE Field = '$column'") )[0]->Type;
  preg_match('/^enum\((.*)\)$/', $type, $matches);
  $enum = array();
  foreach( explode(',', $matches[1]) as $value )
  {
    $v = trim( $value, "'" );
    $enum = array_add($enum, $v, $v);
  }
  return $enum;
}

/**
* funcion: ********* calcularFecha  **************
* entradas => 
* $date: fecha de afiliacion si no hay pagos o fecha ultima de pago si hay pagos. ej: 01-02-2017 ó 2017-02-01
* $periodo : puede ser "Quincenal" o "Mensual"
* $num_cuotas: número de cuotas quincenales o mensuales a calcular ej: $num_cuotas = 12
* $p_fecha : dia del mes para pagar la primera quincena o pagar la mensualidad ej: $p_fecha = 15
* $s_fecha : dia del mes para pagar la segunda quincena, no aplica para mensualidad, ej: $s_fecha = 30
* $primera_cuota : puede tener el valor true o false; true si es la primera o false si no es la primera cuota
*
* retorna => 
* dos fechas, la primera "fecha_ini" es la fecha inicial del pago y "fecha_fin" es la fecha final del pago 
*/

function calcularFecha($date, $periodo, $num_cuotas, $p_fecha, $s_fecha, $primera_cuota){

  if ($primera_cuota == 'true') {

    if($periodo == 'Quincenal')     {  $fecha_ini =  fecha_ini_quincenal($date, $p_fecha,$s_fecha);  }
    elseif ( $periodo == 'Mensual') {  $fecha_ini = fecha_ini_mensual($date, $p_fecha);              }
  }  
  else{  
    $fecha_ini = recuperar_fecha($date,$p_fecha,$s_fecha,$periodo);
    //$fecha_ini = formatoFecha(dia($date),mes($date),ano($date));  
  }
  $fecha_fin = pago_hasta($fecha_ini, $periodo, $num_cuotas, $p_fecha, $s_fecha);

  $array_fecha = array('fecha_ini' => aproximar_febrero($fecha_ini),'fecha_fin' => aproximar_febrero($fecha_fin) );

  //return aproximar_febrero($fecha_ini).'* *'.aproximar_febrero($fecha_fin);
  return $array_fecha;
} 


/**
* funcion: ********* fecha_ini_quincenal  **************
* entradas => 
* $date: fecha de afiliacion si no hay pagos o fecha ultima de pago si hay pagos. ej: 01-02-2017 ó 2017-02-01
* $p_fecha : dia del mes para pagar la primera quincena o pagar la mensualidad ej: $p_fecha = 15
* $s_fecha : dia del mes para pagar la segunda quincena, no aplica para mensualidad, ej: $s_fecha = 30
*
* retorna => 
* la fecha inicial (pago desde) con la cual se va a calcular la fecha final (pago hasta) cuando el 
* pago es Quincenal
*
* reglas=>
* La fecha inicial se asigna cuando se calcula por primera vez un pago
* si entre la fecha de creación del crédito y la siguiente fecha de pago (p_fecha, s_fecha) existen
* 7 o mas dias se asigna ese dia de pago ej: fecha del crédito ($date) = 05/02/2017 p_fecha = 15; s_fecha = 30
* entre el dia 5 y el dia 15 de p_fecha hay 10 dias por lo tanto retorna 15/02/2017
*/

function fecha_ini_quincenal($date,$p_fecha, $s_fecha){

  $f_credito = formatoFecha(dia($date),mes($date),ano($date));
  $carbon_f_credito = Carbon::create(ano($date),mes($date),dia($date),00,00,00);
  $ini = "";

  if( dia($f_credito) == $p_fecha){   $ini = formatoFecha($s_fecha,mes($f_credito),ano($f_credito));  }
  elseif (dia($f_credito) < $p_fecha) {  
    $diferencia = $p_fecha - dia($f_credito);
      if ( $diferencia >= 7 ) {       $ini = formatoFecha($p_fecha,mes($f_credito),ano($f_credito));     }
      else{                           $ini = formatoFecha($s_fecha,mes($f_credito),ano($f_credito));     }  
    }
    elseif (dia($f_credito) > $p_fecha) {
      if (dia($f_credito) == $s_fecha){ $ini = formatoFecha($p_fecha,mes($f_credito)+1,ano($f_credito)); }
      elseif (dia($f_credito) < $s_fecha) { 
        $diferencia = $s_fecha - dia($f_credito);        
        if ( $diferencia >= 7 ) {     $ini = formatoFecha($s_fecha,mes($f_credito),ano($f_credito));     }
        else{                         $ini = formatoFecha($p_fecha,mes($f_credito)+1,ano($f_credito));   }  
      }
      elseif ($f_credito > $s_fecha) {
        $carbon_f_credito->day = $p_fecha;
        $carbon_f_credito->addDays($carbon_f_credito->daysInMonth);
        $diferencia = $carbon_f_credito->diffInDays(Carbon::create(ano($date),mes($date),dia($date),00,00,00));

        if ( $diferencia >= 7 ) {     $ini = formatoFecha($p_fecha,mes($f_credito)+1,ano($f_credito));   }
        else{                         $ini = formatoFecha($s_fecha,mes($f_credito)+1,ano($f_credito));   } 
      }
    }
  return organizar($ini);
  }

/**
* funcion: ********* fecha_ini_mensual  **************
* entradas => 
* $date: fecha de afiliacion si no hay pagos o fecha ultima de pago si hay pagos. ej: 01-02-2017 ó 2017-02-01
* $p_fecha : dia del mes para pagar la primera quincena o pagar la mensualidad ej: $p_fecha = 15
*
* retorna => 
* la fecha inicial (pago desde) con la cual se va a calcular la fecha final (pago hasta) cuando el 
* pago es Mensual
*
* reglas=>
* La fecha inicial se asigna cuando se calcula por primera vez un pago
* si entre la fecha de creación del crédito y la siguiente fecha de pago (p_fecha) existen
* 7 o mas dias se asigna ese dia de pago ej: fecha del crédito ($date) = 15/02/2017 p_fecha = 30; 
* entre el dia 15 y el dia 30 de p_fecha hay 15 dias por lo tanto retorna 30/02/2017
* si esto no se cumple se incrementa el mes en uno ej 28/02/2017 p_fecha = 30, de 28 a 30 hay 2 dias
* por lo tanto la fecha inicial sería 30/03/2017
*/

function fecha_ini_mensual($date,$p_fecha){
  $f_credito = formatoFecha(dia($date),mes($date),ano($date));
  $carbon_f_credito = Carbon::create(ano($date),mes($date),dia($date),00,00,00);
  $ini = "";

  if( dia($f_credito) == $p_fecha){   $ini = formatoFecha($p_fecha,mes($f_credito)+1,ano($f_credito));  }
  elseif ( dia($f_credito) < $p_fecha ){
    $diferencia = $p_fecha - dia($f_credito);
    if ( $diferencia >= 7 ) {       $ini = formatoFecha($p_fecha,mes($f_credito),ano($f_credito));      }
    else{                           $ini = formatoFecha($p_fecha,mes($f_credito)+1,ano($f_credito));    } 
  }
  elseif(dia($f_credito) > $p_fecha){
    $carbon_f_credito->day = $p_fecha;
    $carbon_f_credito->addDays($carbon_f_credito->daysInMonth);
    $diferencia = $carbon_f_credito->diffInDays(Carbon::create(ano($date),mes($date),dia($date),00,00,00));

    if ( $diferencia >= 7 ) {     $ini = formatoFecha($p_fecha,mes($f_credito)+1,ano($f_credito));   }
    else{                         $ini = formatoFecha($p_fecha,mes($f_credito)+2,ano($f_credito));   } 
  } 
    
  return organizar($ini);
}  

/**
* funcion: ********* pago_hasta  **************
* entradas => 
* ver descripcionde la funcion 'calcularFecha'
*
* retorna => 
* la fecha final o pago hasta para el usuario
*
*/

function pago_hasta($fecha_ini, $periodo, $num_cuotas,$p_fecha, $s_fecha){

  if ($periodo == 'Quincenal') {
  
    $cuotas     = $num_cuotas;
    $quincenas  = $cuotas % 2;
    $meses      = intval( $cuotas / 2 );


    $fin = formatoFecha(dia($fecha_ini), mes($fecha_ini) + $meses ,ano($fecha_ini));

    if ( $quincenas == 1 ) { 
      if (dia($fecha_ini) == $p_fecha) { 
        $fin = formatoFecha($s_fecha,mes($fin),ano($fin)); 
      }
      elseif(dia($fecha_ini) == $s_fecha){ 
        $fin = formatoFecha($p_fecha,mes($fin)+1,ano($fin)); 
      }
    }

    return organizar($fin);
  }
  else{
    $fin = formatoFecha(dia($fecha_ini),mes($fecha_ini)+$num_cuotas,ano($fecha_ini));
    return organizar($fin);
  }  
}

/**
* funcion: ********* formatoFecha  **************
* entradas => 
* dia = 1 a 31; mes =  1 a 12; ano = 9999
*
* retorna => 
* Un string con el formato dd-mm-aaaa
* 
*/

function formatoFecha($dia,$mes,$ano){
  if(strlen($dia)<2){ $dia = "0".$dia;}
  if(strlen($mes)<2){ $mes = "0".$mes;}  

  return $dia.'-'.$mes.'-'.$ano;
}

// retorna true si es bisiesto o false si no lo es

function bisiesto($ano){
  if( $ano % 4 == 0 && ( $ano % 100 != 0 || $ano % 400 == 0 )){   return true;  }
  else{ return false;  }
}

// si al calcular una fecha el mes es mayor de 12 eje: 12/14/2017 retorna 12/02/2018

function organizar($fecha){
  $anos  = intval( mes($fecha) / 12 );
  $meses = mes($fecha) % 12;

  if( mes($fecha) > 12 ){ $fecha = formatoFecha(dia($fecha), $meses, ano($fecha)+$anos);  }
  return $fecha;
}


// cuando se calculan fechas se generan fechas como 30/02 o 29/02 estas fechas se aproximan a 01/03

function aproximar_febrero($fecha){
  if (dia($fecha) == 30 && mes($fecha) == 2)   {  $fecha = formatoFecha(1,3,ano($fecha));   }
  elseif(dia($fecha) == 29 && mes($fecha) == 2){  
    if (!bisiesto(ano($fecha))) {   $fecha = formatoFecha(1,3,ano($fecha));   }
  }
  return $fecha;
}

// cuando se recibe una fecha y se convirtio con la funcion aproximar_febrero anteriormente 
// se transforma esa fecha para poder calcular de una manera mas sencilla las demas fechas
// ej: 01/03/2017 cuando la fecha de pago son los 30 del mes entonces se convierte a 30/02/2017 

function recuperar_fecha($fecha,$p_fecha,$s_fecha,$periodo){

  if (dia($fecha) == 1 && mes($fecha) == 3) {
  
    if($periodo == 'Quincenal' && $s_fecha == 30 )   {  $fecha = formatoFecha(30,2,ano($fecha));  }
    elseif ($periodo == 'Mensual' && $p_fecha == 30) {  $fecha = formatoFecha(30,2,ano($fecha));  }
    if($periodo == 'Quincenal' && $s_fecha == 29 )   {  $fecha = formatoFecha(29,2,ano($fecha));  }
    elseif ($periodo == 'Mensual' && $p_fecha == 29) {  $fecha = formatoFecha(29,2,ano($fecha));  }

  }

    return formatoFecha(dia($fecha),mes($fecha),ano($fecha));
  
}

function fecha_cercana($fecha,$periodo,$p_fecha,$s_fecha){
  $dia = dia($fecha);
  $mes = mes($fecha);

  if($periodo == 'Quincenal'){
   if     ($dia  < $p_fecha && $dia < $s_fecha){  $dia = $p_fecha; }
   else if($dia == $p_fecha && $dia < $s_fecha){  $dia = $s_fecha; }
   else if($dia  > $p_fecha && $dia < $s_fecha){  $dia = $s_fecha; }
   else if($dia  > $p_fecha && $dia >= $s_fecha){  $dia = $p_fecha; $mes++; }
  }
  else{
   if ($dia >= $p_fecha)
        { $dia = $p_fecha; $mes++; }
   else { $dia = $p_fecha; }  
  }
  $fecha = formatoFecha($dia,$mes,ano($fecha));
  $fecha = aproximar_febrero($fecha);

  return organizar($fecha); 
}

function array_ids($elementos){
  $array = array();
  foreach($elementos as $elemento){ array_push( $array, $elemento->id );    }
  
  return $array;
}

/*
|--------------------------------------------------------------------------
| sum_pagos
|--------------------------------------------------------------------------
|
| recibe un objeto cliente
| retorna la sumatoria de los totales de todos sus pagos
| 
|
*/

function sum_pagos($credito){

  $sumatoria = 
      DB::table('facturas')
        ->where('descuento',false)
        ->where('credito_id','=',$credito->id)
        ->sum('total');

  return (int)$sumatoria;
}

function sum_descuentos($credito){

  $sumatoria = 
      DB::table('facturas')
        ->where('descuento',true)
        ->where('credito_id','=',$credito->id)
        ->sum('total');

  return (int)$sumatoria;
}

function sum_pagos_por_id($credito_id){

  $sumatoria = 
      DB::table('facturas')
          ->where('credito_id','=',$credito_id)
          ->sum('total');

  return (int)$sumatoria;
}


function sanciones_pagadas($credito_id){
  $sanciones = 
      DB::table('sanciones')
          ->where('credito_id',$credito_id)
          ->where('estado','Ok')
          ->sum('valor');

  return (int)$sanciones;
}

function bancos()
{
  return [
    'Banco Agrario',
    'Banco AV Villas',
    'Banco Caja Social',
    'Banco de Occidente',
    'Banco Popular',
    'Bancóldex',
    'Bancolombia',
    'BBVA',
    'Banco de Bogotá',
    'Citi',
    'Colpatria',
    'Davivienda',
    'GNB Sudameris',
    'Apostar'
  ];
}

function log($user_id ,$action ,$description ,$visible ,$ref_type ,$ref_id) 
{
    $log = new \App\Log();
    $log->user_create_id = $user_id;
    $log->action = $action;
    $log->description = $description;
    $log->visible = $visible;
    $log->ref_type = $ref_type;
    $log->ref_id = $ref_id;
    $log->save();
}




