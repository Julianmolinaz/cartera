<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\OtrosPagos;
use App\FechaCobro;
use Carbon\Carbon;
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

use Excel;
use Auth;
use DB;


function reporte_datacredito($f_corte, $data_asis = null)
{   
    $now            = Carbon::now();
    $punto          = Punto::find(1);
    $ids            = generar_listado_creditos($f_corte);

    try
    {                            
        $info_clientes_array = array();

        // REGISTRO DE CONTROL

        $registro_de_control = array(
            '1.1-indicador_inicial'     => 'HHHHHHHHHHHHHHHHHH', // 18 caracteres en H
            '1.2-codigo_suscriptor'     => '116881', // POR DEFINIR
            '1.3-tipo_cuenta'           => '11', //CREDITOS DE BAJO MONTO
            '1.4-fecha_corte'           => fecha_plana_Ymd($f_corte), // FECHA FORMATO YYYYMMDD
            '1.5-ampliacion_milenio'    => 'M',  //CUANDO EL AÑO ES DE 4 DIGITOS
            '1.6-indicador_miles'       => '0',  //????????????????????????????
            '1.7-tipo_entrega'          => 'T',  //Si el Maestro es completo y corresponde a la actualización total del mes
            '1.8-fecha_inicio_reporte'  => '00000000', //NO REQUERIDO <> T, DEPENDE DE 1.7
            '1.9-fecha_fin_reporte'     => '00000000', //NO REQUERIDO <> T, DEPENDE DE 1.7
            '1.10-indicador_partir'     => 'N', //Si la entidad necesita que el maestro sea partido en varios maestros
            '1.11-filler'               => '00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000', //746 posiciones en 0
        );

        global $str_control_ini;
        $str_control_ini = implode($registro_de_control);

        array_push($info_clientes_array,$registro_de_control);

        if($data_asis[0]){
            array_push($info_clientes_array, $data_asis[0]);
        }


        // REGISTRO CON INFORMACIÓN DE CLLIENTES

        foreach( $ids as $id ){
            set_time_limit(0);

            $credito = Credito::find($id);


            $registro_info_clientes = array(

                '2.1-tipo_identificacion'   => cast_number(tipo_identificacion_datacredito($credito->precredito->cliente->tipo_doc, $credito),1,'right'),
                '2.2-numero_identificacion' => cast_number($credito->precredito->cliente->num_doc,11,'right'),
                '2.3-numero_obligacion'     => cast_number($credito->id,18,'right'),
                '2.4-nombre_completo'       => cast_string(strtoupper(sanear_string($credito->precredito->cliente->nombre)),45),
                '2.5-situacion_titular'     => '0',// 0 normal
                '2.6-fecha_apertura'        => fecha_Ymd($credito->precredito->fecha),
                '2.7-fecha_vencimiento'     => vence_credito($credito),
                '2.8-responsable'           => '00',        // responsable del pago
                '2.9-tipo_obligacion'       => '1',         // 1-comercial ..... 5-microcrédito
                '2.10-subcidio_hipotecario' => '0',         // 0 = no; 1=si
                '2.11-fecha_subcidio'       => '00000000',  // fecha en la que se otorgo subsidio de credito hipotecario
                '2.12-termino_contrato'     => '2',         // 1-defiido, 2-indefinido
                '2.13-forma_pago'           => forma_pago($credito->estado), // 0-no pagada-vigente, 1-pago voluntario, 
                '2.14-periodicidad_pago'    => periodicidad_datacredito($credito), // 1-mensual, 9-quincenal 
                '2.15-novedad'              => cast_number(novedad($credito,$f_corte),2,'right'), //comportamiento que tuvo el manejo del crédito en el periodo 01-al dia,05-pago total 06-mora 30, 07-mora 60, 08-mora 90, 09-mora 120, 13-cartera castigada, 14-cartera recuperada
                '2.16-estado_origen'        => estado_origen($credito)['estado'],// 0-normal-creación apertura, 2-refinanciación
                '2.17-fecha_estado_origen'  => fecha_Ymd(estado_origen($credito)['fecha']), //fecha en la que se reporta el origen de la obligación
                '2.18-estado_cuenta'        => estado_cuenta($credito,$f_corte)['estado_cuenta'],// comportamiento del periodo 1-al dia, 2-mora, 3-pago total, 12-refinanciación
                '2.19-fecha_estado_cuenta'  => estado_cuenta($credito,$f_corte)['fecha'], // AAAAMMDD cred vigente => fecha corte, cancelado => fecha de cancelación
                '2.20-estado_plastico'      => '0',         // aplica solo para tarjeta de crédito
                '2.21-fecha_estado_plastico'=> '00000000', // aplica solo para tarjeta de crédito
                '2.22-adjetivo'             => adjetivo($credito)['adjetivo'],//0-sin adjetivo, 6-pre juridico, 7-juridico
                '2.23-fecha_adjetivo'       => adjetivo($credito)['fecha'],
                '2.24-clase_tarjeta'        => 0, // N/A
                '2.25-franquicia'           => 0, // N/A
                '2.26-nombre_marca_privada' => cast_string('',30), // N/A
                '2.27-tipo_moneda'          => 1, // Legal
                '2.28-tipo_garantia'        => 2, // Otra
                '2.29-calificacion'         => cast_string('',2), // N/A
                '2.30-prob_incumplimiento'  => cast_number('',3,'right'), // N/A
                '2.31-edad_mora'            => cast_number(dias_mora($credito,$f_corte),3, 'right'),//dias mora a la fecha
                '2.32-valor_inicial'        => cast_number( (int)$credito->precredito->vlr_fin,11, 'right'), // no incluye intereses
                '2.33-saldo_deuda'          => cast_number(saldo_deuda_capital($credito,$f_corte),11 ,'right'), 
                '2.34-valor_disponible'     => cast_number('',11,'right'),// N/A
                '2.35-vlr_cuota_mensual'    => cast_number((int)$credito->precredito->vlr_cuota,11, 'right'),
                '2.36-vlr_saldo_mora'       => cast_number(saldo_mora($credito),11,'right'),//*capital + intereses
                '2.37-total_cuotas'         => cast_number($credito->precredito->cuotas,3,'right'),//cuotas pactadas
                '2.38-cuotas_canceladas'    => cast_number(cuotas_canceladas($credito),3,'right'),
                '2.39-cuotas_mora'          => cast_number(cuotas_mora( $credito ,$f_corte)['cts_mora_todas'],3,'right'),//* numero de cuotas que el cliente a dejado de pagar
                '2.40-clausula_permanencia' => cast_number('',3,'right'), // N/A solo sector real,
                '2.41-fecha_clausula_perman'=> cast_number('',8,'right'), // N/A solo sector real,
                '2.42-fecha_limite_pago'    => fecha_limite_pago($credito,$f_corte), // fecha en que debió hacer el pago
                '2.43-fecha_pago'           => cast_string(fecha_Ymd(fecha_pago($credito)),8),// fecha del ultimo pago
                '2.44-oficina_radicacion'   => cast_string($punto->nombre,30),//oficina que maneja la obligación
                '2.45-ciudad_radicacion'    => cast_string($punto->municipio->nombre,20),
                '2.46-codigo_dane_radica'   => cast_number($punto->municipio->codigo_municipio,8,'right'), //codigo dane mmunicipio
                '2.47-ciudad_res_com'       => cast_string($credito->precredito->cliente->municipio->nombre,20),//ciudad de residencia del usuario
                '2.48-codigo_dane_res_com'  => cast_number($credito->precredito->cliente->municipio->codigo_municipio,8, 'right'),// codigo dane de la ciudad de residencia del usuario
                '2.49-depto_res_com'        => cast_string($credito->precredito->cliente->municipio->departamento,20),//depto ubicación residencia o comercial
                '2.50-dir_res_com'          => cast_string(sanear_string($credito->precredito->cliente->direccion),60), // direccion residencia o comercial 
                '2.51-tel_res_com'          => cast_number($credito->precredito->cliente->telefono,12, 'right'),// telefono residencia o comercial
                '2.52-ciudad_laboral'       => cast_string('',20),
                '2.53-cod_dane_ciudad_lab'  => cast_number('',8,'right'),
                '2.54-departamento_laboral' => cast_string('',20),
                '2.55-direccion_laboral'    => cast_string('',60),
                '2.56-tel_laboral'          => cast_number('',12,'right'),
                '2.57-ciud_correspondencia' => cast_string($credito->precredito->cliente->municipio->nombre,20),
                '2.58-cod_dane_ciud_corresp'=> cast_number($credito->precredito->cliente->municipio->codigo_municipio,8,'right'),
                '2.59-depto_correspondencia'=> cast_string($credito->precredito->cliente->municipio->departamento,20),
                '2.60-dir_correspondencia'  => cast_string(sanear_string($credito->precredito->cliente->direccion),60),
                '2.61-correo_electronico'   => cast_string($credito->precredito->cliente->email,60),
                '2.62-celular'              => cast_number($credito->precredito->cliente->movil,12,'right'),
                '2.63-suscriptor_destino'   => cast_number('',6,'right'),//N/A
                '2.64-numero_tarjeta'       => cast_number('',18,'right'), // N/A
                '2.65-detalle_garantia'     => cast_string('',1), // Identifica la clase de respaldo que avala el crédito
                '2.66-espacio_blanco'       => cast_string('',18)
            );

            array_push($info_clientes_array,$registro_info_clientes);

            len_line($registro_info_clientes);

            if( $credito->precredito->cliente->codeudor && $credito->precredito->cliente->codeudor->id != '100' )
            {
                $registro_info_codeudor = array(

                '2.1-tipo_identificacion'   => cast_number(tipo_identificacion_datacredito($credito->precredito->cliente->codeudor->tipo_docc, $credito),1,'right'),
                '2.2-numero_identificacion' => cast_number($credito->precredito->cliente->codeudor->num_docc,11,'right'),
                '2.3-numero_obligacion'     => cast_number($credito->id,18,'right'),
                '2.4-nombre_completo'       => cast_string(strtoupper(sanear_string($credito->precredito->cliente->codeudor->nombrec)),45),
                '2.5-situacion_titular'     => '0',// 0 normal
                '2.6-fecha_apertura'        => fecha_Ymd($credito->precredito->fecha),
                '2.7-fecha_vencimiento'     => vence_credito($credito),
                '2.8-responsable'           => '00',        // responsable del pago
                '2.9-tipo_obligacion'       => '1',         // 1-comercial ..... 5-microcrédito
                '2.10-subcidio_hipotecario' => '0',         // 0 = no; 1=si
                '2.11-fecha_subcidio'       => '00000000',  // fecha en la que se otorgo subsidio de credito hipotecario
                '2.12-termino_contrato'     => '2',         // 1-defiido, 2-indefinido
                '2.13-forma_pago'           => forma_pago($credito->estado), // 0-no pagada-vigente, 1-pago voluntario, 
                '2.14-periodicidad_pago'    => periodicidad_datacredito($credito), // 1-mensual, 9-quincenal 
                '2.15-novedad'              => cast_number(novedad($credito,$f_corte),2,'right'), //comportamiento que tuvo el manejo del crédito en el periodo 01-al dia,05-pago total 06-mora 30, 07-mora 60, 08-mora 90, 09-mora 120, 13-cartera castigada, 14-cartera recuperada
                '2.16-estado_origen'        => estado_origen($credito)['estado'],// 0-normal-creación apertura, 2-refinanciación
                '2.17-fecha_estado_origen'  => fecha_Ymd(estado_origen($credito)['fecha']), //fecha en la que se reporta el origen de la obligación
                '2.18-estado_cuenta'        => estado_cuenta($credito,$f_corte)['estado_cuenta'],// comportamiento del periodo 1-al dia, 2-mora, 3-pago total, 12-refinanciación
                '2.19-fecha_estado_cuenta'  => estado_cuenta($credito,$f_corte)['fecha'], // AAAAMMDD cred vigente => fecha corte, cancelado => fecha de cancelación
                '2.20-estado_plastico'      => '0',         // aplica solo para tarjeta de crédito
                '2.21-fecha_estado_plastico'=> '00000000', // aplica solo para tarjeta de crédito
                '2.22-adjetivo'             => adjetivo($credito)['adjetivo'],//0-sin adjetivo, 6-pre juridico, 7-juridico
                '2.23-fecha_adjetivo'       => adjetivo($credito)['fecha'],
                '2.24-clase_tarjeta'        => 0, // N/A
                '2.25-franquicia'           => 0, // N/A
                '2.26-nombre_marca_privada' => cast_string('',30), // N/A
                '2.27-tipo_moneda'          => 1, // Legal
                '2.28-tipo_garantia'        => 2, // Otra
                '2.29-calificacion'         => cast_string('',2), // N/A
                '2.30-prob_incumplimiento'  => cast_number('',3,'right'), // N/A
                '2.31-edad_mora'            => cast_number(dias_mora($credito,$f_corte),3, 'right'),//dias mora a la fecha
                '2.32-valor_inicial'        => cast_number( (int)$credito->precredito->vlr_fin,11, 'right'), // no incluye intereses
                '2.33-saldo_deuda'          => cast_number(saldo_deuda_capital($credito,$f_corte),11 ,'right'), 
                '2.34-valor_disponible'     => cast_number('',11,'right'),// N/A
                '2.35-vlr_cuota_mensual'    => cast_number((int)$credito->precredito->vlr_cuota,11, 'right'),
                '2.36-vlr_saldo_mora'       => cast_number(saldo_mora($credito),11,'right'),//*capital + intereses
                '2.37-total_cuotas'         => cast_number($credito->precredito->cuotas,3,'right'),//cuotas pactadas
                '2.38-cuotas_canceladas'    => cast_number(cuotas_canceladas($credito),3,'right'),
                '2.39-cuotas_mora'          => cast_number(cuotas_mora( $credito ,$f_corte)['cts_mora_todas'],3,'right'),//* numero de cuotas que el cliente a dejado de pagar
                '2.40-clausula_permanencia' => cast_number('',3,'right'), // N/A solo sector real,
                '2.41-fecha_clausula_perman'=> cast_number('',8,'right'), // N/A solo sector real,
                '2.42-fecha_limite_pago'    => fecha_limite_pago($credito,$f_corte), // fecha en que debió hacer el pago
                '2.43-fecha_pago'           => cast_string(fecha_Ymd(fecha_pago($credito)),8),// fecha del ultimo pago
                '2.44-oficina_radicacion'   => cast_string($punto->nombre,30),//oficina que maneja la obligación
                '2.45-ciudad_radicacion'    => cast_string($punto->municipio->nombre,20),
                '2.46-codigo_dane_radica'   => cast_number($punto->municipio->codigo_municipio,8,'right'), //codigo dane mmunicipio
                '2.47-ciudad_res_com'       => cast_string($credito->precredito->cliente->codeudor->municipio->nombre,20),//ciudad de residencia del usuario
                '2.48-codigo_dane_res_com'  => cast_number($credito->precredito->cliente->codeudor->municipio->codigo_municipio,8, 'right'),// codigo dane de la ciudad de residencia del usuario
                '2.49-depto_res_com'        => cast_string($credito->precredito->cliente->codeudor->municipio->departamento,20),//depto ubicación residencia o comercial
                '2.50-dir_res_com'          => cast_string(sanear_string($credito->precredito->cliente->codeudor->direccion),60), // direccion residencia o comercial 
                '2.51-tel_res_com'          => cast_number($credito->precredito->cliente->codeudor->telefono,12, 'right'),// telefono residencia o comercial
                '2.52-ciudad_laboral'       => cast_string('',20),
                '2.53-cod_dane_ciudad_lab'  => cast_number('',8,'right'),
                '2.54-departamento_laboral' => cast_string('',20),
                '2.55-direccion_laboral'    => cast_string('',60),
                '2.56-tel_laboral'          => cast_number('',12,'right'),
                '2.57-ciud_correspondencia' => cast_string($credito->precredito->cliente->codeudor->municipio->nombre,20),
                '2.58-cod_dane_ciud_corresp'=> cast_number($credito->precredito->cliente->codeudor->municipio->codigo_municipio,8,'right'),
                '2.59-depto_correspondencia'=> cast_string($credito->precredito->cliente->codeudor->municipio->departamento,20),
                '2.60-dir_correspondencia'  => cast_string(sanear_string($credito->precredito->cliente->codeudor->direccion),60),
                '2.61-correo_electronico'   => cast_string($credito->precredito->cliente->codeudor->email,60),
                '2.62-celular'              => cast_number($credito->precredito->cliente->codeudor->movil,12,'right'),
                '2.63-suscriptor_destino'   => cast_number('',6,'right'),//N/A
                '2.64-numero_tarjeta'       => cast_number('',18,'right'), // N/A
                '2.65-detalle_garantia'     => cast_string('',1), // Identifica la clase de respaldo que avala el crédito
                '2.66-espacio_blanco'       => cast_string('',18)
            );
        
                array_push($info_clientes_array,$registro_info_codeudor);
                len_line($registro_info_codeudor);
            }
        }// .foreach
        //dd($info_clientes_array);
    }
    catch(\Exception $e){
        dd($e);
    }
    
    $registro_fin = array(
        '3.1-identificador'         => 'ZZZZZZZZZZZZZZZZZZ',
        '3.2-fecha_proceso'         => fecha_plana_Ymd($now),
        '3.3-numero_registros'      => cast_number(count($info_clientes_array) + 2, 8, 'right'),//total registros + registro de control + registro fin
        '3.4-sumatoria_novedades'   => cast_number('',8,'right'),
        '3.5-filler'                => cast_string('',758)
    );

    array_push($info_clientes_array,$registro_fin);
    
    if($GLOBALS['errores_datacredito']){
        dd($GLOBALS['errores_datacredito']);
    }
    

    return $info_clientes_array;
    
}


?>