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

function sanciones_vigentes($credito){
    $sanciones = array();
    foreach($credito->sanciones as $sancion){
        if( $sancion->estado == 'Debe' ){
            array_push($sanciones,$sancion->id);
        }
    }
    return $sanciones;
}

function reporte_datacredito($fecha_corte){


            $now    = Carbon::now();
            $fecha  = fecha_plana($now->toDateString());
            $punto  = Punto::find(1);
            $ids    = DB::table('creditos')
                        ->join('precreditos','creditos.precredito_id','=','precreditos.id')
                        ->whereIn('creditos.estado', 
                            ['Al dia', 'Mora', 'Prejuridico','Juridico','Cancelado','Cancelado por refinanciacion'])
                        ->where([['creditos.end_datacredito','<>',1]])
                        ->select('creditos.id')
                        ->get();

            try{                            
                $ids_array = array();

                foreach($ids as $id){

                    $credito = Credito::find($id->id);
                    $bandera = 0;
                    $x = $credito->precredito->fecha;
                    $fecha_apertura = Carbon::create(ano($x),mes($x),dia($x));

                    if( $fecha_apertura->gt($fecha_corte) ){ $bandera = 1; }

                    if( $credito->estado == 'Al dia' && count($credito->pagos) == 0 ){ $bandera = 1;}

                    if(    ($credito->estado == 'Mora'          ||  
                            $credito->estado == 'Prejuridico'   || 
                            $credito->estado == 'Juridico'      ||
                            $credito->estado == 'Cancelado por refinanciacion' ) 
                            && count( sanciones_vigentes( $credito) ) < 30){
                            $bandera = 1;
                        }
                    if($bandera == 0){
                        array_push($ids_array,$id->id);
                    }   
                }

                $creditos = Credito::find($ids_array);

                $info_clientes_array = array();

                $registro_de_control = array(
                    '1.1-indicador_inicial'     => 'HHHHHHHHHHHHHHHHHHH',
                    '1.2-codigo_suscriptor'     => '',      // POR DEFINIR
                    '1.3-tipo_cuenta'           => '21',    //CREDITOS DE BAJO MONTO
                    '1.4-fecha_corte'           => fecha_plana_Ymd($now), // FECHA FORMATO YYYYMMDD
                    '1.5-ampliacion_milenio'    => 'M',     //CUANDO EL AÑO ES DE 4 DIGITOS
                    '1.6-indicador_miles'       => '0',      //????????????????????????????
                    '1.7-tipo_entrega'          => 'T',      
                    '1.8-fecha_inicio_reporte'  => '00000000',      //NO REQUERIDO <> T, DEPENDE DE 1.7
                    '1.9-fecha_fin_reporte'     => '00000000',      //NO REQUERIDO <> T, DEPENDE DE 1.7
                    '1.10-indicador_partir'     => '0',
                    '1.11-filler'               => '00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000',
                );

                global $str_control_ini;
                $str_control_ini = implode($registro_de_control);

                array_push($info_clientes_array,$registro_de_control);
            

                foreach( $creditos as $credito ){

                    $registro_info_clientes = array(
                        '2.1-tipo_identificacion'   => cast_number(tipo_identificacion_datacredito($credito->precredito->cliente->tipo_doc),1),
                        '2.2-numero_identificacion' => cast_number($credito->precredito->cliente->num_doc,11),
                        '2.3-numero_obligacion'     => cast_string($credito->id,18),
                        '2.4-nombre_completo'       => cast_string($credito->precredito->cliente->nombre,45),
                        '2.5-situacion_titular'     => '0',
                        '2.6-fecha_apertura'        => fecha_Ymd($credito->precredito->fecha),
                        '2.7-fecha_vencimiento'     => vence_credito($credito),
                        '2.8-responsable'           => '00',
                        '2.9-tipo_obligacion'       => '1',
                        '2.10-subcidio_hipotecario' => '0',
                        '2.11-fecha_subcidio'       => '00000000',
                        '2.12-termino_contrato'     => '2',
                        '2.13-forma_pago'           => cast_number(forma_pago($credito),1),
                        '2.14-periodicidad_pago'    => periodicidad_datacredito($credito),
                        '2.15-novedad'              => cast_number(novedad($credito,$fecha_corte),2), // cual es la novedad para refinanciacion?
                        '2.16-estado_origen'        => estado_origen($credito)['estado'],
                        '2.17-fecha_estado_origen'  => fecha_Ymd(estado_origen($credito)['fecha']),
                        '2.18-estado_cuenta'        => estado_cuenta($credito,$fecha_corte)['estado_cuenta'],
                        '2.19-fecha_estado_cuenta'  => estado_cuenta($credito,$fecha_corte)['fecha'],
                        '2.20-estado_plastico'      => '0',  
                        '2.21-fecha_estado_plastico'=> '00000000',
                        '2.22-adjetivo'             => adjetivo($credito)['adjetivo'],
                        '2.23-fecha_adjetivo'       => adjetivo($credito)['fecha'],
                        '2.24-clase_tarjeta'        => 0,
                        '2.25-franquicia'           => 0,
                        '2.26-nombre_marca_privada' => cast_string('',30),
                        '2.27-tipo_moneda'          => 1,
                        '2.28-tipo_garantia'        => 2,
                        '2.29-calificacion'         => cast_string('',2),
                        '2.30-prob_incumplimiento'  => cast_number('',3),
                        '2.31-edad_mora'            => cast_number(dias_mora($credito,$fecha_corte),3),
                        '2.32-valor_inicial'        => cast_number( (int)$credito->precredito->vlr_fin,11 ),
                        '2.33-saldo_deuda'          => cast_number(saldo_deuda_capital($credito,$fecha_corte),11),
                        '2.34-valor_disponible'     => cast_number('',11),
                        '2.35-vlr_cuota_mensual'    => cast_number((int)$credito->precredito->vlr_cuota,11),
                        '2.36-vlr_saldo_mora'       => cast_number(saldo_en_mora($credito,$fecha_corte),11),//????????????????por hacer
                        '2.37-total_cuotas'         => cast_number($credito->precredito->cuotas,3),
                        '2.38-cuotas_canceladas'    => cast_number(cuotas_canceladas($credito),3),
                        '2.39-cuotas_mora'          => cast_number(cuotas_mora( $credito ,$fecha_corte)['cts_mora_todas'],3),
                        '2.40-clausula_permanencia' => cast_number('',3),
                        '2.41-fecha_clausula_perman'=> cast_number('',8), 
                        '2.42-fecha_limite_pago'    => fecha_limite_pago($credito,$fecha_corte),
                        '2.43-fecha_pago'           => cast_string(fecha_Ymd(fecha_pago($credito)),8),
                        '2.44-oficina_radicacion'   => cast_string($punto->nombre,30),
                        '2.45-ciudad_radicacion'    => cast_string($punto->municipio->nombre,20),
                        '2.46-codigo_date_radica'   => cast_number($punto->municipio->codigo_municipio,8),
                        '2.47-ciudad_res_com'       => cast_string($credito->precredito->cliente->municipio->nombre,20),
                        '2.48-codigo_dane_res_com'  => cast_number($credito->precredito->cliente->municipio->codigo_municipio,8),
                        '2.49-depto_res_com'        => cast_string($credito->precredito->cliente->municipio->departamento,20),
                        '2.50-dir_res_com'          => cast_string($credito->precredito->cliente->direccion,60),
                        '2.51-tel_res_com'          => cast_number($credito->precredito->cliente->telefono,12),
                        '2.52-ciudad_laboral'       => cast_string('',20),
                        '2.53-cod_dane_ciudad_lab'  => cast_number('',8),
                        '2.54-departamento_laboral' => cast_string('',20),
                        '2.55-direccion_laboral'    => cast_string('',60),
                        '2.56-tel_laboral'          => cast_number('',12),
                        '2.57-ciud_correspondencia' => cast_string($credito->precredito->cliente->municipio->nombre,20),
                        '2.58-cod_dane_ciud_corresp'=> cast_number($credito->precredito->cliente->municipio->codigo_municipio,8),
                        '2.59-depto_correspondencia'=> cast_string($credito->precredito->cliente->municipio->departamento,20),
                        '2.60-dir_correspondencia'  => cast_string($credito->precredito->cliente->direccion,60),
                        '2.61-correo_electronico'   => cast_string($credito->precredito->cliente->email,60),
                        '2.62-celular'              => cast_number($credito->precredito->cliente->movil,12),
                        '2.63-suscriptor_destino'   => cast_number('',6),
                        '2.64-numero_tarjeta'       => cast_number('',18),
                        '2.65-detalle_garantia'     => cast_string('',1),
                        '2.66-espacio_blanco'       => cast_string('',18)
                    );

                        array_push($info_clientes_array,$registro_info_clientes);

                        // if( $credito->precredito->cliente->codeudor->id != '100' ){

                        //     $registro_info_clientes = array(
                        //         '2.1-tipo_identificacion'   => cast_number(tipo_identificacion_datacredito($credito->precredito->cliente->codeudor->tipo_docc),1),
                        //         '2.2-numero_identificacion' => cast_number($credito->precredito->cliente->codeudor->num_docc,11),
                        //         '2.3-numero_obligacion'     => cast_string($credito->id,18),
                        //         '2.4-nombre_completo'       => cast_string($credito->precredito->cliente->codeudor->nombrec,45),
                        //         '2.5-situacion_titular'     => '0',
                        //         '2.6-fecha_apertura'        => fecha_Ymd($credito->precredito->fecha),
                        //         '2.7-fecha_vencimiento'     => vence_credito($credito),
                        //         '2.8-responsable'           => '01',
                        //         '2.9-tipo_obligacion'       => '1',
                        //         '2.10-subcidio_hipotecario' => '0',
                        //         '2.11-fecha_subcidio'       => '00000000',
                        //         '2.12-termino_contrato'     => '2',
                        //         '2.13-forma_pago'           => cast_number(forma_pago($credito),1),
                        //         '2.14-periodicidad_pago'    => periodicidad_datacredito($credito),
                        //         '2.15-novedad'              => cast_number(novedad($credito,$fecha_corte),2), // cual es la novedad para refinanciacion?
                        //         '2.16-estado_origen'        => estado_origen($credito)['estado'],
                        //         '2.17-fecha_estado_origen'  => fecha_Ymd(estado_origen($credito)['fecha']),
                        //         '2.18-estado_cuenta'        => estado_cuenta($credito,$fecha_corte)['estado_cuenta'],
                        //         '2.19-fecha_estado_cuenta'  => estado_cuenta($credito,$fecha_corte)['fecha'],
                        //         '2.20-estado_plastico'      => '0',  
                        //         '2.21-fecha_estado_plastico'=> '00000000',
                        //         '2.22-adjetivo'             => adjetivo($credito)['adjetivo'],
                        //         '2.23-fecha_adjetivo'       => adjetivo($credito)['fecha'],
                        //         '2.24-clase_tarjeta'        => 0,
                        //         '2.25-franquicia'           => 0,
                        //         '2.26-nombre_marca_privada' => cast_string('',30),
                        //         '2.27-tipo_moneda'          => 1,
                        //         '2.28-tipo_garantia'        => 2,
                        //         '2.29-calificacion'         => cast_string('',2),
                        //         '2.30-prob_incumplimiento'  => cast_number('',3),
                        //         '2.31-edad_mora'            => cast_number(dias_mora($credito,$fecha_corte),3),
                        //         '2.32-valor_inicial'        => cast_number( (int)$credito->precredito->vlr_fin,11),
                        //         '2.33-saldo_deuda'          => cast_number(saldo_deuda_capital($credito,$fecha_corte),11),
                        //         '2.34-valor_disponible'     => cast_number('',11),
                        //         '2.35-vlr_cuota_mensual'    => cast_number((int)$credito->precredito->vlr_cuota,11),
                        //         '2.36-vlr_saldo_mora'       => cast_number(saldo_en_mora($credito,$fecha_corte),11),//????????????????por hacer
                        //         '2.37-total_cuotas'         => cast_number($credito->precredito->cuotas,3),
                        //         '2.38-cuotas_canceladas'    => cast_number(cuotas_canceladas($credito),3),
                        //         '2.39-cuotas_mora'          => cast_number(cuotas_mora( $credito ,$fecha_corte)['cts_mora_todas'],3),
                        //         '2.40-clausula_permanencia' => cast_number('',3),
                        //         '2.41-fecha_clausula_perman'=> cast_number('',8),
                        //         '2.42-fecha_limite_pago'    => fecha_limite_pago($credito,$fecha_corte),
                        //         '2.43-fecha_pago'           => cast_string(fecha_Ymd(inv_fech(fecha_pago($credito))),8),
                        //         '2.44-oficina_radicacion'   => cast_string($punto->nombre,30),
                        //         '2.45-ciudad_radicacion'    => cast_string($punto->municipio->nombre,20),
                        //         '2.46-codigo_date_radica'   => cast_number($punto->municipio->codigo_municipio,8),
                        //         '2.47-ciudad_res_com'       => cast_string($credito->precredito->cliente->codeudor->municipio->nombre,20),
                        //         '2.48-codigo_dane_res_com'  => cast_number($credito->precredito->cliente->codeudor->municipio->codigo_municipio,8),
                        //         '2.49-depto_res_com'        => cast_string($credito->precredito->cliente->codeudor->municipio->departamento,20),
                        //         '2.50-dir_res_com'          => cast_string($credito->precredito->cliente->codeudor->direccion,60),
                        //         '2.51-tel_res_com'          => cast_number($credito->precredito->cliente->codeudor->telefono,12),
                        //         '2.52-ciudad_laboral'       => cast_string('',20),
                        //         '2.53-cod_dane_ciudad_lab'  => cast_number('',8),
                        //         '2.54-departamento_laboral' => cast_string('',20),
                        //         '2.55-direccion_laboral'    => cast_string('',60),
                        //         '2.56-tel_laboral'          => cast_number('',12),
                        //         '2.57-ciud_correspondencia' => cast_string($credito->precredito->cliente->codeudor->municipio->nombre,20),
                        //         '2.58-cod_dane_ciud_corresp'=> cast_number($credito->precredito->cliente->codeudor->municipio->codigo_municipio,8),
                        //         '2.59-depto_correspondencia'=> cast_string($credito->precredito->cliente->codeudor->municipio->departamento,20),
                        //         '2.60-dir_correspondencia'  => cast_string($credito->precredito->cliente->codeudor->direccionc,60),
                        //         '2.61-correo_electronico'   => cast_string($credito->precredito->cliente->codeudor->emailc,60),
                        //         '2.62-celular'              => cast_number($credito->precredito->cliente->codeudor->movilc,12),
                        //         '2.63-suscriptor_destino'   => cast_number('',6),
                        //         '2.64-numero_tarjeta'       => cast_number('',18),
                        //         '2.65-detalle_garantia'     => cast_string('',1),
                        //         '2.66-espacio_blanco'       => cast_string('',18));
                    
                        //         array_push($info_clientes_array,$registro_info_clientes);
                        // }
                }

            }catch(\Exception $e){
                dd($e);
            }
            $registro_fin = array(
                '3.1-identificador'         => 'ZZZZZZZZZZZZZZZZZZ',
                '3.2-fecha_proceso'         => fecha_plana_Ymd($now),
                '3.3-numero_registros'      => cast_number(count($info_clientes_array)+2, 8),
                '3.4-sumatoria_novedades'   => cast_number('',8),
                '3.5-filler'                => cast_string('',758)
            );

        


            array_push($info_clientes_array,$registro_fin);
            $data = '';

            foreach($info_clientes_array as $array){
                $data .= implode($array);
            }

            
            
        global $array;
        $array = [$data];
        
        // Excel::create('csv',function($excel){
        //     $excel->sheet('Sheetname',function($sheet){

        //         global $array;
                
        //         $sheet->fromArray($array,null,'A1',false,false); });
            
        //     })->download('txt');

        return $info_clientes_array;
    
}


function fecha_limite_pago($credito, $corte){

    
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

function fecha_plana_Ymd($obj_date){ 
    $date = $obj_date->toDateString();
    $date = inv_fech(formatoFecha(dia($date),mes($date),ano($date)));
    $date = str_replace('-','',$date);
    $date = str_replace(' ','',$date);
    $date = str_replace(':','',$date);
    return $date;
}


/*
|--------------------------------------------------------------------------
| tipo_identificacion_datacredito
|--------------------------------------------------------------------------
|
| recibe un objeto cliente o codeudor, el rol puede ser 'cliente' o 'codeuodr'
| esto con el fin de extraer el tipo de documento segun el rol
| retorna un numero entre 1 y 4 para identificar el  tipo de documento 
| ver documento maestro datacredito 
|
*/

function tipo_identificacion_datacredito($tipo_doc){


    if( $tipo_doc == 'Cedula Ciudadanía' ||
        $tipo_doc == 'Número único de Identificación Personal' ||
        $tipo_doc == 'Tarjeta de Identidad'){   
            return 1;   
        }
    else if( $tipo_doc == 'Nit'   ||  
              $tipo_doc =='Rut'){  
                  return 2;   
            }
    else if( $tipo_doc == 'Nit de Extranjería'){
        return 3;
    }
    else if( $tipo_doc == 'Cedula de Extranjería' ||
             $tipo_doc == 'Pasaporte'  ||
             $tipo_doc == 'Pase Diplomático' ||
             $tipo_doc == 'Carnet Diplomático'){
        return 4;
    }
    else{
        dd('error tipo de identificacion');
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


function novedad($credito,$corte){

    $estado = $credito->estado;
    $novedad = '';

    if($estado == 'Al dia' || 
        ($estado == 'Mora' && dias_mora($credito, $corte) < 30) ||
        ($estado == 'Cancelado por refinanciacion' && dias_mora($credito, $corte) < 30) 
        ){
        $novedad = '01';
    }
    if( ($estado == 'Mora' && dias_mora($credito,$corte) >= 30) || 
        $estado == 'Prejuridico' || $estado == 'Juridico' ||
        ($estado == 'Cancelado por refinanciacion' && dias_mora($credito,$corte) >= 30)
        ){
        $dias_mora = dias_mora($credito,$corte);
        
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

    

    if($credito->credito_refinanciado_id != NULL ){
        $fecha  = $credito->refinanciado->precredito->fecha;
        $estado = 2;
    }
    else{
        $fecha  = $credito->precredito->fecha;
        $estado = 0;
    }
    return ['estado' => $estado, 'fecha' => $fecha];
}

function estado_cuenta($credito,$fecha_corte){

    $estado_cuenta = '';
    $fecha = fecha_plana_Ymd($fecha_corte);

    if( $credito->estado == 'Al dia' || 
        ($credito->estado == 'Mora' && dias_mora($credito,$fecha_corte) < 30)
    ){
        $estado_cuenta = '01';
    }
    if( $credito->estado == 'Mora' && dias_mora($credito,$fecha_corte) > 30){
        $estado_cuenta = '02';
    }
    if( $credito->estado == 'Juridico' ||
        $credito->estado == 'Prejuridico')
    {
        $estado_cuenta = '02';
    }
    if( $credito->estado == 'Cancelado por refinanciacion'){
        $fecha = fecha_plana_Ymd($credito->updated_at);
        $estado_cuenta = '12';
    }
    if($credito->estado == 'Cancelado' || $credito->saldo == 0){
        $fecha = fecha_plana_Ymd($credito->updated_at);
        $estado_cuenta = '03';
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
| recibe un objeto credito y la fecha de corte
| retorna el saldo del vlr_credito (saldo del capital sin intereses)
|
*/

function saldo_deuda_capital($credito, $corte){
    
    if($credito->saldo == 0 || $credito->cuotas_faltantes == 0){ return 0; }

    $pagos = DB::table('pagos')
                ->where([['created_at','<=',inv_fech($corte)],['credito_id','=',$credito->id]])
                ->get();


    $valor_real_cuota = $credito->precredito->vlr_fin / $credito->precredito->cuotas;
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


function cuotas_canceladas($credito){
    $cuotas_canceladas =    $credito->precredito->cuotas - $credito->cuotas_faltantes;
    $adicional = 0;
    $pago_por_cuota = 0;
    $pagos = $credito->pagos;

    foreach($pagos as $pago){
        if( ($pago->concepto == 'Cuota Parcial' && $pago->estado == 'Debe') || 
            ($cuotas_canceladas == 0  && count($pagos) > 0) ){
            $adicional = 1;
        }
        if($pago->concepto == 'Cuota'){
           $pago_por_cuota++;     
        }      
    }
    if( $pago_por_cuota > 0){ $adicional = 0; }

    return $cuotas_canceladas + $adicional;

}


function saldo_en_mora($credito,$corte){
    $sanciones_diarias = 0;
    $cta_parcial = 0;
    $cuotas = 0;

    //dd(dias_mora($credito,$corte) );

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



?>