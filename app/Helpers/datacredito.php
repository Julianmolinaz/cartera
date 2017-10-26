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
use App\Cliente;
use App\Sancion;
use App\Extra;
use App\FechaCobro;
use App\Punto;
use Excel;



function reporte_datacredito($fecha_corte){

    
    
    $now                = Carbon::now();
    $fecha              = fecha_plana($now->toDateString());
    $punto              = Punto::find(1);
    $ids                = DB::table('creditos')
                            ->whereIn('estado', 
                                ['Al dia', 'Mora', 'Prejuridico','Juridico','Cancelado','Cancelado por refinanciacion'])
                            ->where([['end_datacredito','<>',1],['created_at', '<' ,$fecha_corte->toDateTimeString()]])
                            ->select('id')
                            ->get();

    //dd(count(Credito::find(549)->pagos) );
    $ids_array = array();
    foreach($ids as $id){

        $credito = Credito::find($id->id);
        $bandera = 0;
        if( $credito->estado == 'Al dia' && count($credito->pagos) == 0 ){
            $bandera = 1;
        }
        if($bandera == 0){
            array_push($ids_array,$id->id);
        }   
    }
    
    $creditos = Credito::find($ids_array);

    dd($creditos);


    // $registro_de_control = array(
    //     '1.1-indicador_inicial'     => 'HHHHHHHHHHHHHHHHHHH',
    //     '1.2-codigo_suscriptor'     => '',      // POR DEFINIR
    //     '1.3-tipo_cuenta'           => '21',    //CREDITOS DE BAJO MONTO
    //     '1.4-fecha_corte'           => fecha_plana_Ymd($now), // FECHA FORMATO YYYYMMDD
    //     '1.5-ampliacion_milenio'    => 'M',     //CUANDO EL AÑO ES DE 4 DIGITOS
    //     '1.6-indicador_miles'       => '0',      //????????????????????????????
    //     '1.7-tipo_entrega'          => 'T',      
    //     '1.8-fecha_inicio_reporte'  => '00000000',      //NO REQUERIDO <> T, DEPENDE DE 1.7
    //     '1.9-fecha_fin_reporte'     => '00000000',      //NO REQUERIDO <> T, DEPENDE DE 1.7
    //     '1.10-indicador_partir'     => '0',
    //     '1.11-filler'               => '00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000',
    // );

    // $info_clientes_array = array();

    // foreach( $creditos as $credito ){

    //     $registro_info_clientes = array(
    //         '2.1-tipo_identificacion'   => tipo_identificacion_datacredito($credito->precredito->cliente),
    //         '2.2-numero_identificacion' => cast_number($credito->precredito->cliente->num_doc,11),
    //         '2.3-numero_obligacion'     => cast_string($credito->id,18),
    //         '2.4-nombre_completo'       => cast_string($credito->precredito->cliente->nombre,45),
    //         '2.5-situacion_titular'     => '0',
    //         '2.6-fecha_apertura'        => fecha_Ymd($credito->precredito->fecha),
    //         '2.7-fecha_vencimiento'     => vence_credito($credito),
    //         '2.8-responsable'           => '00',
    //         '2.9-tipo_obligacion'       => '1',
    //         '2.10-subcidio_hipotecario' => '0',
    //         '2.11-fecha_subcidio'       => '00000000',
    //         '2.12-termino_contrato'     => '2',
    //         '2.13-forma_pago'           => forma_pago($credito),
    //         '2.14-periodicidad_pago'    => periodicidad_datacredito($credito),
    //         '2.15-novedad'              => novedad($credito), // cual es la novedad para refinanciacion?
    //         '2.16-estado_origen'        => estado_origen($credito),
    //         '2.17-fecha_estado_origen'  => fecha_plana_Ymd($credito->created_at),
    //         '2.18-estado_cuenta'        => estado_cuenta($credito,$fecha_corte)['estado_cuenta'],
    //         '2.19-fecha_estado_cuenta'  => estado_cuenta($credito,$fecha_corte)['fecha'],
    //         '2.20-estado_plastico'      => '0',  
    //         '2.21-fecha_estado_plastico'=> '00000000',
    //         '2.22-adjetivo'             => adjetivo($credito)['adjetivo'],
    //         '2.23-fecha_adjetivo'       => adjetivo($credito)['fecha'],
    //         '2.24-clase_tarjeta'        => '',
    //         '2.25-franquicia'           => '',
    //         '2.26-nombre_marca_privada' => '',
    //         '2.27-tipo_moneda'          => 1,
    //         '2.28-tipo_garantia'        => '',//???????????????????
    //         '2.29-calificacion'         => '',//???????????????????
    //         '2.30-prob_incumplimiento'  => '',//???????????????????
    //         '2.31-edad_mora'            => dias_mora($credito),
    //         '2.32-valor_inicial'        => (int)$credito->precredito->vlr_fin,
    //         '2.33-saldo_deuda'          => saldo_deuda_capital($credito),
    //         '2.34-valor_disponible'     => 0,
    //         '2.35-vlr_cuota_mensual'    => (int)$credito->precredito->vlr_cuota,
    //         '2.36-vlr_saldo_mora'       => (int)$credito->saldo,
    //         '2.37-total_cuotas'         => $credito->precredito->cuotas,
    //         '2.38-cuotas_canceladas'    => $credito->precredito->cuotas - $credito->cuotas_faltantes,
    //         '2.39-cuotas_mora'          => cuotas_mora( $credito )['cts_mora_todas'],
    //         '2.40-clausula_permanencia' => '',
    //         '2.41-fecha_clausula_perman'=> '',
    //         '2.42-fecha_limite_pago'    => $credito->fecha_pago->pago_hasta,
    //         '2.43-fecha_pago'           => fecha_Ymd(inv_fech(fecha_pago($credito))),
    //         '2.44-oficina_radicacion'   => $punto->nombre,
    //         '2.45-ciudad_radicacion'    => $punto->municipio->nombre,
    //         '2.46-codigo_date_radica'   => $punto->municipio->codigo_municipio,
    //         '2.47-ciudad_res_com'       => $credito->precredito->cliente->municipio->nombre,
    //         '2.48-codigo_dane_res_com'  => $credito->precredito->cliente->municipio->codigo_municipio,
    //         '2.49-depto_res_com'        => $credito->precredito->cliente->municipio->departamento,
    //         '2.50-dir_res_com'          => $credito->precredito->cliente->direccion,
    //         '2.51-tel_res_com'          => $credito->precredito->cliente->telefono,
    //         '2.52-ciudad_laboral'       => '',
    //         '2.53-cod_dane_ciudad_lab'  => '',
    //         '2.54-departamento_laboral' => '',
    //         '2.55-direccion_laboral'    => '',
    //         '2.56-tel_laboral'          => '',
    //         '2.57-ciud_correspondencia' => '',
    //         '2.58-cod_dane_ciud_corresp'=> '',
    //         '2.59-depto_correspondencia'=> '',
    //         '2.60-dir_correspondencia'  => '',
    //         '2.61-correo_electronico'   => '',
    //         '2.62-celular'              => '',
    //         '2.63-suscriptor_destino'   => $credito->precredito->cliente->id,
    //         '2.64-numero_tarjeta'       => '',
    //         '2.65-detalle_garantia'     => '',
    //         '2.66-espacio_blanco'       => '');

    //         array_push($info_clientes_array,$registro_info_clientes);
    // }

    // $registro_fin = array(
    //     '3.1-identificador'         => 'ZZZZZZZZZZZZZZZZZZ',
    //     '3.2-fecha_proceso'         => fecha_plana_Ymd($now),
    //     '3.3-numero_registros'      => count($info_clientes_array)+2,
    //     '3.4-sumatoria_novedades'   => '',
    //     '3.5-filler'                => ''
    // );

    // foreach($ids as $id){ 
    //     array_push($ids_array, $id->id); 
    // }                
    
    // $creditos       = Credito::find($ids_array);             
    // $reporte_array  = array();

        //ciclo para recorrer creditos

    //return $registro_info_clientes;
    
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

function fecha_plana_Ymd($obj_date){
    $date = $obj_date->toDateString();
    $date = inv_fech(formatoFecha(dia($date),mes($date),ano($date)));
    $date = str_replace('-','',$date);
    return $date;
}


/*
|--------------------------------------------------------------------------
| tipo_identificacion_datacredito
|--------------------------------------------------------------------------
|
| recibe un objeto cliente
| retorna un numero entre 1 y 4 para identificar el  tipo de documento 
| ver documento maestro datacredito 
|
*/

function tipo_identificacion_datacredito($cliente){

    if( $cliente->tipo_doc == 'Cedula Ciudadanía' ||
        $cliente->tipo_doc == 'Número único de Identificación Personal' ||
        $cliente->tipo_doc == 'Tarjeta de Identidad'){   
            return 1;   
        }
    else if( $cliente->tipo_doc == 'Nit'   ||  
              $cliente->tipo_doc =='Rut'){  
                  return 2;   
            }
    else if( $cliente->tipo_doc == 'Nit de Extranjería'){
        return 3;
    }
    else if( $cliente->tipo_doc == 'Cedula de Extranjería' ||
             $cliente->tipo_doc == 'Pasaporte'  ||
             $cliente->tipo_doc == 'Pase Diplomático' ||
             $cliente->tipo_doc == 'Carnet Diplomático'){
        return 4;
    }
    
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


function cast_number($data, $len){
    while(strlen($data) < $len){
        $data = '0'.$data;
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
function cast_string($string, $len){
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

function fecha_Ymd($str){
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
|
*/

function vence_credito($credito){

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
| retorna 0-No pagado vigente, 1-pago voluntario, 2-proceso juridicos
|
*/
function forma_pago($credito){

    $forma_pago = '';

    if( $credito->estado == 'Cancelado' ){
        //si esta cancelado deberia ser marcado para que no vuelva a ser reportado en datacredito
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


function novedad($credito){

    $estado = $credito->estado;
    $novedad = '';

    if($estado == 'Al dia' || ($estado == 'Mora' && dias_mora($credito) < 30)){
        $novedad = '01';
    }
    if( ($estado == 'Mora' && dias_mora($credito) >= 30) || $estado == 'Prejuridico' || $estado == 'Juridico'){
        $dias_mora = dias_mora($credito);
        
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
    if($estado == 'Cancelado' || $credito->saldo == 0){
        $novedad = '05';
    }
    
    return $novedad;
}

function estado_origen($credito){
    $estado_origen = 0;
    if($credito->refinanciacion == 'Si'){
        $estado_origen = 2;
    }
    return $estado_origen;
}

function estado_cuenta($credito,$fecha_corte){

    $estado_cuenta = '';
    $fecha = fecha_plana_Ymd($fecha_corte);

    if( $credito->estado == 'Al dia' || 
        ($credito->estado == 'Mora' && dias_mora($credito) < 30)
    ){
        $estado_cuenta = '01';
    }
    if( $credito->estado == 'Mora' && dias_mora($credito) > 30){
        $estado_cuenta = '02';
    }
    if($credito->estado == 'Cancelado'){
        $fecha = fecha_plana_Ymd($credito->updated_at);
        $estado_cuenta = '03';
    }
    if( $credito->estado == 'Juridico' ||
        $credito->estado == 'Prejuridico')
    {
        $estado_cuenta = '02';
    }
    return array('fecha' => $fecha,'estado_cuenta' => $estado_cuenta);
}

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
| recibe un objeto credito
| retorna el saldo del vlr_credito (saldo del capital sin intereses)
|
*/

function saldo_deuda_capital($credito){
    $suma_multas = 0;
    $multas = $credito->multas;
    if( count($multas) > 0){
        foreach($multas as $multa){
            if($multa->estado == 'Debe'){
                $suma_multas += $multa->valor;
            }
        }
    }

    $saldo = $credito->saldo - dias_mora($credito) - $suma_multas;

    return (int)$saldo;
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
?>