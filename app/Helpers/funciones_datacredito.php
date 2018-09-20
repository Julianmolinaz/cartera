<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\OtrosPagos;
use App\FechaCobro;
use App\Variable;
use App\Sancion;
use App\Credito;
use App\Cartera;
use App\Cliente;
use App\Llamada;
use App\Factura;
use App\Egreso;
use App\Punto;
use App\Extra;
use App\User;
use App\Pago;

use Carbon\Carbon;
use Excel;
use Auth;
use DB;

$errores_datacredito = array();

/*
|--------------------------------------------------------------------------
| generar_listado_creditos
|--------------------------------------------------------------------------
|
| Permite generar el listado de los creditos a reportar en el informe
| @recibe una fecha de corte que corresponde al periodo que se va a reportar
| @retorna un array con los ids de los créditos que deben ser reportados
|
*/

function generar_listado_creditos($fecha_corte)
{
    $now    = Carbon::now();
    $dias_mora_para_reportar = 30;
    $ids_array = array();       

    $ids    = 
    DB::table('creditos')
        ->join('precreditos','creditos.precredito_id','=','precreditos.id')
        //->where('creditos.id',3549)
        ->whereIn('creditos.estado', ['Al dia', 'Mora', 'Prejuridico','Juridico', 'Cancelado'])
        ->where([['creditos.end_datacredito','<>',1]]) //no marcados como finalizado
        ->select('creditos.id')
        ->get();

    foreach($ids as $id)
    {
        $credito        = Credito::find($id->id);
        $bandera        = 0;
        $x              = $credito->precredito->fecha;
        $fecha_apertura = Carbon::create(ano($x),mes($x),dia($x));

        // bandera = 0 => el crédito se selecciona;
        // bandera = 1 => el crédito se descarta

        if( $fecha_apertura->gt($fecha_corte) ){ 
            $bandera = 1; }

        //se descartan los créditos nuevos que no han hecho su primer pago    
        if( $credito->estado == 'Al dia' && count($credito->pagos) == 0 ){ 
            $bandera = 1; }

        //se descartan los creditos con moras inferiores o iguales que $dias_mora_para_reportar

        if(($credito->estado == 'Mora'          ||  
            $credito->estado == 'Prejuridico'   || 
            $credito->estado == 'Juridico'      ||
            $credito->estado == 'Cancelado por refinanciacion' ) 
            && count( sanciones_vigentes( $credito) ) <= $dias_mora_para_reportar){
            $bandera = 1;}

        //si los créditos marcados son bandera 0 se seleccionan
        if($bandera == 0){
            array_push($ids_array,$id->id);
        }  
    } // .foreach

    return $ids_array;

}// .function

/*
|--------------------------------------------------------------------------
| tipo_identificacion_datacredito
|--------------------------------------------------------------------------
|
| @recibe un Ttipo de documento
| @retorna un numero entre 1 y 4 para identificar el  tipo de documento documento
| 1-Cédulas de ciudadanía y NUIP 
| 2-Nit empresarial
| 3-Nit de extranjería
| 4-Cedulas de  extranjería
|
*/

function tipo_identificacion_datacredito($tipo_doc, $credito){

    if( $tipo_doc == 'Cedula Ciudadanía'                        ||
        $tipo_doc == 'Número único de Identificación Personal'  ||
        $tipo_doc == 'Tarjeta de Identidad'){   
            return 1;   
        }
    else if( $tipo_doc == 'Nit'  || $tipo_doc =='Rut'){  
        return 2; }

    else if( $tipo_doc == 'Nit de Extranjería'){
        return 3; }

    else if( $tipo_doc == 'Cedula de Extranjería'   ||
             $tipo_doc == 'Pasaporte'               ||
             $tipo_doc == 'Pase Diplomático'        ||
             $tipo_doc == 'Carnet Diplomático'){
        return 4;
    }
    else{
        array_push($GLOBALS['errores_datacredito'],'Error en tipo de documento cliente: '.$credito->id);
    }
    
}

function sanciones_vigentes($credito){
    $sanciones = array();
    foreach($credito->sanciones as $sancion){
        if( $sancion->estado == 'Debe' ){
            array_push($sanciones,$sancion->id);
        }
    }
    return $sanciones;
}

function fecha_limite_pago($credito, $corte)
{
    if($credito->estado == 'Al dia' || 'Cancelado'){

        if(count($credito->pagos) > 0){
            return fecha_Ymd(inv_fech($credito->pagos->last()->pago_desde));
        }
        else{
            return fecha_Ymd(inv_fech($credito->fecha_pago->fecha_pago));
        }
        
    }
    else if($credito->estado == 'Prejuridico' ||
            $credito->estado == 'Juridico' ||
            $credito->estado == 'Cancelado por refinanciacion'){

        return fecha_Ymd(inv_fech($credito->fecha_pago->fecha_pago)) ;
    }

}


/*
|--------------------------------------------------------------------------
| fecha_plana_Ymd
|--------------------------------------------------------------------------
|
| recibe un objeto carbon
| retorn una fecha en formato yyyymmdd 
|
*/

function fecha_plana_Ymd($obj_date)
{ 
    $date = $obj_date->toDateString();
    $date = inv_fech(formatoFecha(dia($date),mes($date),ano($date)));
    $date = str_replace('-','',$date);
    $date = str_replace(' ','',$date);
    $date = str_replace(':','',$date);
    return $date;
}




/*
|--------------------------------------------------------------------------
| cast_number
|--------------------------------------------------------------------------
|
| recibe un string y un entero que indica el tamaño requerido
| retorna el valor alineado a la derecha con seros a la izquierda ejemplo
| cast('hola',10); .. retorna '000000hola'
|
*/


function cast_number($data, $len, $align)
{
    if($align == 'right'){
        while(strlen($data) < $len){
            $data = '0'.$data;
        }
    }
    elseif($align == 'left'){
        while(strlen($data) < $len){
            $data = $data.'0';
        }
    }
    else{
        array_push($GLOBALS['errores_datacredito'],'Error al hacer cast credito: '.$data);
    }
    return $data;  
}


/*
|--------------------------------------------------------------------------
| cast_string
|--------------------------------------------------------------------------
|
| recibe un string y un entero que indica el tamaño requerido
| retorna un string alineado a la izquiereda completado con espacios a la derecha ejemplo
| cast('hola',10); .. retorna 'hola      '
|
*/
function cast_string($string, $len)
{
    while(strlen($string) < $len){
        $string = $string.' ';
    }
    if( strlen($string) > $len ){
        return substr($string,0,$len);
    }
    else{
        return $string;
    }
}

/*
|--------------------------------------------------------------------------
| fecha_Ymd
|--------------------------------------------------------------------------
|
| recibe un string con una fecha dd-mm-yyyy
| retorna una fecha en formato yyyymmdd
|
*/

function fecha_Ymd($str)
{
    $str = inv_fech($str);
    return str_replace('-','',$str);
}

/*
|--------------------------------------------------------------------------
| vence_credito
|--------------------------------------------------------------------------
|
| recibe un objeto credito
| retorna la fecha ideal en la que finaliza el crédito
| pago_hasta() esta en helpers.php
|
*/

function vence_credito($credito)
{

    $fecha_ini  = $credito->fecha_pago->fecha_pago;
    $periodo    = $credito->precredito->periodo;
    $num_cuotas = $credito->cuotas_faltantes;
    $p_fecha    = $credito->precredito->p_fecha;
    $s_fecha    = $credito->precredito->s_fecha;

    $vencimiento = pago_hasta($fecha_ini, $periodo, $num_cuotas,$p_fecha, $s_fecha);
    $vencimiento = fecha_Ymd($vencimiento);
    
    return $vencimiento;
}

/*
|--------------------------------------------------------------------------
| forma_pago
|--------------------------------------------------------------------------
|
| recibe un objeto credito
| retorna 0-No pagado vigente, 1-pago voluntario, 2-proceso ejecutivo
| 4-reestructuración / refinanciación
|
*/
function forma_pago($credito){

    $forma_pago = '';

    if( $credito->estado == 'Cancelado' ){
        $forma_pago = '1';
    }
    else if ( $credito->estado == 'Cancelado por refinanciacion' ){
        $forma_pago = '4';
    }
    else{
        $forma_pago = '0';
    }

    return $forma_pago;

}

/*
|--------------------------------------------------------------------------
| periodicidad
|--------------------------------------------------------------------------
|
| recibe un objeto credito
| retorna 1 si es mensual el pago o 9 si es quincenal
|
*/


function periodicidad_datacredito($credito){
    $periodicidad = '';
    if($credito->precredito->periodo == 'Mensual'){
        $periodicidad = 1;
    }
    else if($credito->precredito->periodo == 'Quincenal'){
        $periodicidad = 9;
    }
    return $periodicidad;
}

/*
|--------------------------------------------------------------------------
| novedad
|--------------------------------------------------------------------------
|
| recibe un objeto credito
| retorna lla novedad que puede ser: AL DIA,PAGO TOTAL,MORA DE 30 DIAS,
| MORA DE 60 DIAS,MORA DE 90 DIAS,MORA DE 120 DIAS O MAS.$_COOKIE
|
| Importante: cuando el credito esta Canelado y el saldo en 0 para no volver 
| a enviarlo en el proximo reporte se coloca en '1' el campo end_datacredito 
| en la tabla creditos y así queda marcado.
|
*/


function novedad($credito,$corte){

    $estado     = $credito->estado;
    $dias_mora  = dias_mora($credito, $corte);
    $novedad    = '';

    if($estado == 'Al dia' || ($estado == 'Mora' && $dias_mora < 30) )
    {
        $novedad = '01'; // al día
    }
    if( ($estado == 'Mora' && $dias_mora >= 30) || $estado == 'Prejuridico' || $estado == 'Juridico')
    {        
        if($dias_mora >= 30 && $dias_mora <= 59){
            $novedad = '06';
        }
        else if($dias_mora >= 60 && $dias_mora <= 89){
            $novedad = '07';
        }
        else if($dias_mora >= 90 && $dias_mora <= 119){
            $novedad = '08';
        }
        else if($dias_mora >=120){
            $novedad = '09';
        }
    }
    if( $estado == 'Cancelado' || $credito->saldo == 0){
        // $credito->end_datacredito = 1;
        // $credito->save();
        $novedad = '05';
    }
    if( ( $credito->castigada == 'Si' && 
          ($estado == 'Mora' || $estado == 'Prejuridico' || $estado == 'Juridico') && 
          $dias_mora >= 30 && 
          $credito->saldo > 0 ) ){
        $novedad = '13'; // cartera castigada
    }

    if( ( $credito->castigada == 'Si' && 
          ($estado == 'Mora' || $estado == 'Prejuridico' || $estado == 'Juridico') && 
          $dias_mora >= 30 && 
          $credito->saldo <= 0 ) ){
          $novedad = '14'; // cartera recuperada
    }

    return $novedad;
}


/*
|--------------------------------------------------------------------------
| estado_origen
|--------------------------------------------------------------------------
|
| recibe un objeto credito
| retorna 0 => Normal-Creación por apertura
| retorna 2 => Refinanciación
|
|
*/

function estado_origen($credito){

    if( $credito->credito_refinanciado_id != NULL ){
        $fecha  = $credito->refinanciado->precredito->fecha;
        $estado = 2;
    }
    else{
        $fecha  = $credito->precredito->fecha;
        $estado = 0;
    }
    return ['estado' => $estado, 'fecha' => $fecha];
}



/*
|--------------------------------------------------------------------------
| estado_cuenta
|--------------------------------------------------------------------------
|
| recibe un objeto credito
| retorna el estado y la fecha del estado
| 
| Es el comportamiento que tuvo el manejo del crédito durante el curso de los días 
| comprendidos entre la fecha de corte del mes  anterior  y  la  fecha  de  corte  actual,  
| correspondiente  al  mes  en  que  se  toma  la  información  para  ser  enviada  a 
| DataCrédito y debe ser reportada codificada en 2 dígitos. 
|
*/

function estado_cuenta($credito,$fecha_corte){

    $estado_cuenta = '';
    $fecha = fecha_plana_Ymd($fecha_corte);

    if( $credito->estado == 'Al dia' || ($credito->estado == 'Mora' && dias_mora($credito,$fecha_corte) < 30)){
        $estado_cuenta = '01'; // Al día
    }
    if( $credito->estado == 'Mora' && dias_mora($credito,$fecha_corte) > 30){
        $estado_cuenta = '02'; // En mora
    }
    if( $credito->estado == 'Juridico' || $credito->estado == 'Prejuridico')
    {
        $estado_cuenta = '02'; // En mora
    }
    if( $credito->estado == 'Cancelado por refinanciacion'){
        $fecha = fecha_plana_Ymd($credito->updated_at);
        $estado_cuenta = '12'; // Cancelada por reestructuración / refinanciación
    }
    if($credito->estado == 'Cancelado' || $credito->saldo == 0){
        $fecha = fecha_plana_Ymd($credito->updated_at);
        $estado_cuenta = '03'; // Pago total
    }
    return array('fecha' => $fecha,'estado_cuenta' => $estado_cuenta);
}


/*
|--------------------------------------------------------------------------
| adjetivo
|--------------------------------------------------------------------------
|
| recibe un objeto credito
| retorna el adjetivo y la fecha
| detalle mas específico de la obligación
|
*/

function adjetivo($credito){

    $adjetivo = '0';
    $fecha = '00000000';

    if($credito->estado == 'Prejuridico'){
        $adjetivo = '6';
        $fecha = fecha_plana_Ymd( $credito->updated_at );
    }
    else if($credito->estado == 'Juridico'){
        $adjetivo = '7';
        $fecha = fecha_plana_Ymd( $credito->updated_at );
    }
    return ['adjetivo' => $adjetivo,'fecha' => $fecha];
}

/*
|--------------------------------------------------------------------------
| saldo_deuda_capital
|--------------------------------------------------------------------------
|
| recibe un objeto credito y la fecha de corte
| retorna el saldo del vlr_credito (saldo del capital sin intereses)
|
*/

function saldo_deuda_capital($credito, $corte){
    
    if($credito->saldo == 0 || $credito->cuotas_faltantes == 0){ return 0; }

    $pagos = DB::table('pagos')
                ->where([['created_at','<=',inv_fech($corte)],['credito_id','=',$credito->id]])
                ->get();

    if($credito->precredito->cuotas != 0){
        $valor_real_cuota = $credito->precredito->vlr_fin / $credito->precredito->cuotas;
    }
    else{
        array_push($GLOBALS['errores_datacredito'], '2.33-División por 0 credito: '.$credito->id.' cuotas: '.$credito->precredito->cuotas);
        $valor_real_cuota = 0;
    }
    $sum_pagos = 0;
    $vlr_cuota = $credito->precredito->vlr_cuota;

    foreach($pagos as $pago){
        if($pago->concepto == 'Cuota'){
           $cuotas = $pago->abono / $credito->precredito->vlr_cuota; 
           $sum_pagos = $sum_pagos + ($valor_real_cuota * $cuotas); 
        }
        elseif($pago->concepto == 'Cuota Parcial'){
            $parcial_real = $pago->abono * $valor_real_cuota / $vlr_cuota ;
            $sum_pagos = $sum_pagos + $parcial_real;
        }
    }

    return (int)($credito->precredito->vlr_fin - $sum_pagos) ;
}

function fecha_pago($credito){
    $factura = ultima_factura($credito);
    if($factura){
        return $factura->fecha;
    }
    else{
        return '';
    }
}

$GLOBALS['errores_datacredito'] = array();

function cuotas_canceladas($credito){

    $cts            = $credito->precredito->cuotas;
    $cts_faltantes  = $credito->cuotas_faltantes;
    $cts_canceladas = 0;


    $cts_canceladas = $cts - $cts_faltantes;

    if ( $cts_canceladas < 0 || $cts_canceladas > $cts )
    {
        array_push($GLOBALS['errores_datacredito'], '2.38-EXISTE UN PROBLEMA CON LAS CUOTAS CANCELADAS EN EL CRÉDITO ' . $credito->id  . 
                ' : cuotas pactadas ('. $cts .') - cuotas faltantes ('.$cts_faltantes .') = '.$cts_canceladas.'<br>');
    }

    return $cts_canceladas;
}


/*
|--------------------------------------------------------------------------
| saldo_en_mora
|--------------------------------------------------------------------------
|
| recibe un objeto credito y la fecha de corte
| retorna 
| detalle mas específico de la obligación
|
*/

function saldo_en_mora($credito,$corte){
    $sanciones_diarias  = 0;
    $cta_parcial        = 0;
    $cuotas             = 0;

    try
    {
        if( $credito->estado != 'Al dia' && dias_mora($credito,$corte) > 30 ){

            $sanciones_diarias = dias_mora($credito, $corte) * Variable::find(1)->vlr_dia_sancion;
            $cuotas = cuotas_mora($credito, $corte)['cts_mora'] * $credito->precredito->vlr_cuota;

            $cuota_parcial = DB::table('pagos')
                                ->where([['credito_id','=',$credito->id],
                                        ['concepto','=','Cuota Parcial'],
                                        ['estado','=','Debe'],
                                        ['created_at','<=',$corte]])
                                ->get();

            if($cuota_parcial){
                $cta_parcial = (int)$cuota_parcial[0]->debe;
            }
        }

        return (int)($sanciones_diarias + $cta_parcial + $cuotas);     
    }
    catch(\Exception $e){
        dd($e->getMessage() .' ' . $credito->id);
    }


    function cts_mora($credito, $corte)
    {
        // a los Cancelados se les quita las cuotas en mora
        if( $credito->estado == 'Cancelado' || $credito->estado == 'Cancelado por refinanciacion' ){       
            return array('cts_mora' => 0 , 'cts_mora_todas' => 0 );
        }

        //CALCULA LOS DIAS EN MORA
        $dias_mora = dias_mora($credito, $corte);

        if( $dias_mora > DIAS_PARA_REPORTAR )
        {
            //pago_hasta es la fecha limite de pago

            $pago_hasta     = FechaCobro::where('credito_id',$credito->id)->get();
            $pago_hasta     = $pago_hasta[0]->fecha_pago;
            $f_pago         = Carbon::create(ano($pago_hasta),mes($pago_hasta),dia($pago_hasta));

        }// .if


    }


}
