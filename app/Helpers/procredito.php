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
use Excel;


function reporte_procredito(){

    try{
 
        $now                = Carbon::now(); // fecha actual
        $fecha              = fecha_plana($now->toDateString()); // convertir fecha 

        DB::table('cancelados')->delete(); // vaciar tabla cancelados

        $no_admitidos       = no_admitidos(); // listado de creditos que generan error

        $ids                = DB::table('creditos')
                            //->where('creditos.id',642)
                            ->whereIn('estado', ['Al dia', 'Mora', 'Prejuridico','Juridico','Cancelado'])
                            ->where('end_procredito','<>',1)
                            ->whereNotIn('id',$no_admitidos)
                            ->select('id')
                            ->get();

        $reporte_array  = array();

        for($i = 0; $i < count($ids); $i++ ){

            $credito = Credito::find($ids[$i]->id);
            if( $credito->estado == 'Cancelado' ||  $credito->saldo == 0){
                DB::table('cancelados')->insert(
                    ['credito_id' => $credito->id,
                     'created_at' => Carbon::now()]);
            }
               
            $bandera            = 0;
            $generar_tipo_d     = 0;

            // TIPO EEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE


            if($credito->refinanciacion == 'Si'){
                $credito_id = $credito->credito_refinanciado_id;
                $refinanciacion = '0'; }
            else{
                $credito_id = $credito->id;
                $refinanciacion = ''; }

            $tipo_documento = tipo_documento($credito->precredito->cliente->tipo_doc);
            if($tipo_documento == '2'){
                $nombre_comercial = 
                str_replace("ñ", "N",str_replace("Ñ", "N",$credito->precredito->cliente->primer_nombre)).' '.
                str_replace("ñ", "N",str_replace("Ñ", "N",$credito->precredito->cliente->segundo_nombre)).' '.
                str_replace("ñ", "N",str_replace("Ñ", "N",$credito->precredito->cliente->primer_apellido)).' '.
                str_replace("ñ", "N",str_replace("Ñ", "N",$credito->precredito->cliente->segundo_apellido));
            }
            else{
                $nombre_comercial = '';
            }
                 
        $temp = array(

        '1-tipo_de_registro'      => 'E', // para deudor
        '2-tipo_de_noveda'        => 1, //campo fijo
        '3-refinanciacion'        => $refinanciacion, // no obligatoria, 0 para refinanciación
        '4-fecha_de_corte'        => $fecha, //formato DDMMYYYY
        '5-seccional'             => 17, //seccional del afiliado 17 para Risaralda
        '6-consecutivo'           => '', //no requerido
        '7-codigo_sucursal_viejo' => '', //no requerido
        '8-tipo_doc_afiliado'     => '2', //nit
        '9-num_doc_afiliado'      => '94466092', //nit del afiliado
        '10-codigo_sucursal_nuevo'=> '0',
        '11-tipo_garante'         => '1', //Deudor
        '12-tipo_doc_cliente'     => $tipo_documento,
        '13-num_doc_cliente'      => $credito->precredito->cliente->num_doc,
        '14-primer_nombre'        => str_replace("ñ", "N",str_replace("Ñ", "N",$credito->precredito->cliente->primer_nombre)), 
        '15-segundo_nombre'       => str_replace("ñ", "N",str_replace("Ñ", "N",$credito->precredito->cliente->segundo_nombre)), 
        '16-primer_apellido'      => str_replace("ñ", "N",str_replace("Ñ", "N",$credito->precredito->cliente->primer_apellido)), 
        '17-segundo_apellido'     => str_replace("ñ", "N",str_replace("Ñ", "N",$credito->precredito->cliente->segundo_apellido)), 
        '18-nombre_comercial'     => $nombre_comercial,        
        '19-pais'                 => '57',//Colombia
        '20-departamento'         => $credito->precredito->cliente->municipio->codigo_departamento, //municipios
        '21-ciudad'               => $credito->precredito->cliente->municipio->codigo_municipio, //municipios
        '22-tipo_direccion'       => '1',//Casa
        '23-direccion'            => str_replace("Ñ", "N",str_replace("ñ", "N",$credito->precredito->cliente->direccion)),
        '24-tipo_telefono'        => '2', // Celular
        '25-telefono'             => $credito->precredito->cliente->movil, 
        '26-extension'            => '',
        '27-tipo_ubi_electronica' => '',
        '28-ubicacion_electronica'=> '',
        '29-cupo_credito'         => '',
        '30-cupo_utilizado'       => '',
        '31-tipo_obligacion'      => '7', // Pagaré
        '32-tipo_contrato'        => '1', // Venta
        '33-numero_obligacion'    => $credito_id,
        '34-fecha_obligacion'     => fecha_plana($credito->created_at),
        '35-periodicidad_pago'    => periodicidad_pago($credito->precredito->periodo),
        '36-termino_contrato'     => '',
        '37-meses_celebrados'     => '',
        '38-meses_clausula_permanencia'=> '',
        '39-valor_obligacion'     => (int)$credito->precredito->vlr_fin,
        '40-cargo_fijo'           => '',
        '41-saldos_f_corte'       => (string)((int)$credito->saldo),
        '42-saldo_mora_f_corte'   => (string)saldo_mora($credito),
        '43-cuotas_pactadas'      => cuotas_pactadas($credito), 
        '44-cuotas_pagadas'       => (string)($credito->precredito->cuotas -
                                    $credito->cuotas_faltantes),
        '45-cuotas_mora'          => (string)(cuotas_mora($credito,$now)['cts_mora']),
        '46-motivo_de_pago'       => motivo_pago($credito),
        '47-estado_titular'       => '',
        '48-tipo_doc_soporte'     => '',
        '49-numero_obligacion_referenciada'=> '' );

        array_push($reporte_array, $temp);

        // TIPO DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD

        // cuando el credito esta al dia **************************************

        if($credito->estado == 'Al dia'){
            $factura = ultima_factura($credito);

        // cuando el cliente ha realizado pagos

        if( $factura ){ 
            $numero_cuota   = 1;
            $valor_pagado   = $factura->total;
            $fecha_pago     = fecha_plana($factura->fecha);}

        // cuando el cliente esta al dia y aun no ha hecho el primer pago
        else{
            $generar_tipo_d = 1; }

        if($generar_tipo_d == 0){
            $temp_e = array(
                'tipo_de_registro'  => 'D', // detalle
                'tipo_obligacion'   => '7',   // 
                'numero_obligacion' => $credito_id ,
                'numero_cuota'      => $numero_cuota,
                'valor_cuota'       => (int)$credito->precredito->vlr_cuota,
                'valor_pagado'      => (int)$valor_pagado,
                'estado_obligacion' => estado($credito,$now),
                'dias_en_mora'      => '0',
                'fecha_pago'        => $fecha_pago,
                'fecha_vencimiento' => fecha_vencimiento($credito) );

            array_push($reporte_array, $temp_e);
        }

    }

    // cuando el credito esta en un estado diferente al dia **************************************

    else{


        $factura = ultima_factura($credito);

        if( $factura ){

            $temp_e = array(
                'tipo_de_registro'  => 'D', // detalle
                'tipo_obligacion'   => 7,   // 
                'numero_obligacion' => $credito_id ,
                'numero_cuota'      => 1,
                'valor_cuota'       => (int)$credito->precredito->vlr_cuota,
                'valor_pagado'      => (string)((int)$factura->total),
                'estado_obligacion' => 1,
                'dias_en_mora'      => '0',
                'fecha_pago'        => fecha_plana($factura->fecha),
                'fecha_vencimiento' => fecha_vencimiento($credito) );
             
            $numero_cuota = 2;
            array_push($reporte_array, $temp_e);
        }
        else{ 
            $numero_cuota = 1;  }

        if($credito->estado == 'Cancelado'){
            $bandera = 1; }
        elseif($credito->estado == 'Mora' || $credito->estado == 'Prejuridico'
                || $credito->estado == 'Juridico'){
                
            if(dias_mora($credito,$now) <= 20){
                $bandera = 0;  }
        }

        if($bandera == 0){

            $f = $credito->fecha_pago->fecha_pago;
            $f = formatoFecha(dia($f),mes($f),ano($f));
            $temp_e = array(
                'tipo_de_registro'  => 'D', // detalle
                'tipo_obligacion'   => '7',   // 
                'numero_obligacion' => $credito_id ,
                'numero_cuota'      => $numero_cuota,
                'valor_cuota'       => (int)$credito->precredito->vlr_cuota,
                'valor_pagado'      => '0',
                'estado_obligacion' => estado($credito,$now),
                'dias_en_mora'      => dias_mora($credito,$now),
                'fecha_pago'        => '',
                'fecha_vencimiento' => fecha_plana($f) );

            array_push($reporte_array, $temp_e);   
    
            } //.if
        }//.else

        // TIPO GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG


        if( $credito->precredito->cliente->codeudor->id <> 100){

            $temp_g = array(
                '1-tipo_de_registro'      => 'G', // para deudor
                '2-tipo_de_noveda'        => 1,
                '3-refinanciacion'        => '', // no obligatoria 
                '4-fecha_de_corte'        => $fecha, //formato DDMMYYYY
                '5-seccional'             => 17, 
                '6-consecutivo'           => '',
                '7-codigo_sucursal_viejo' => '',
                '8-tipo_doc_afiliado'     => '2', 
                '9-num_doc_afiliado'      => '94466092',
                '10-codigo_sucursal_nuevo' => '0',
                '11-tipo_garante'          => '2', 
                '12-tipo_doc_cliente'      => tipo_documento($credito->precredito->cliente->codeudor->tipo_docc),
                '13-num_doc_cliente'       => $credito->precredito->cliente->codeudor->num_docc,
                '14-primer_nombre'         => str_replace("ñ", "N",str_replace("Ñ", "N",$credito->precredito->cliente->codeudor->primer_nombrec)), //cliente
                '15-segundo_nombre'        => str_replace("ñ", "N",str_replace("Ñ", "N",$credito->precredito->cliente->codeudor->segundo_nombrec)), //cliente
                '16-primer_apellido'       => str_replace("ñ", "N",str_replace("Ñ", "N",$credito->precredito->cliente->codeudor->primer_apellidoc)), //cliente
                '17-segundo_apellido'      => str_replace("ñ", "N",str_replace("Ñ", "N",$credito->precredito->cliente->codeudor->segundo_apellidoc)), //cliente
                '18-nombre_comercial'      => '',
                '19-pais'                  => '57',//Colombia
                '20-departamento'          => $credito->precredito->cliente->municipio->codigo_departamento, //municipios 
                '21-ciudad'                => $credito->precredito->cliente->municipio->codigo_municipio, //municipios
                '22-tipo_direccion'        => '1',//Casa
                '23-direccion'             => str_replace("ñ", "N",str_replace("Ñ", "N",$credito->precredito->cliente->codeudor->direccionc)),
                '24-tipo_telefono'         => '2', // Celular
                '25-telefono'              => $credito->precredito->cliente->codeudor->movilc, 
                '26-extension'             => '',
                '27-tipo_ubi_electronica'  => '',
                '28-ubicacion_electronica' => '',
                '29-cupo_credito'          => '',
                '30-cupo_utilizado'        => '',
                '31-tipo_obligacion'       => '7', // Pagaré
                '32-tipo_contrato'         => '', 
                '33-numero_obligacion'     => $credito_id,
                '34-fecha_obligacion'      => '',
                '35-periodicidad_pago'     => '',
                '36-termino_contrato'      => '',
                '37-meses_celebrados'      => '',// no requerido
                '38-meses_clausula_permanencia' => '', // no requerido
                '39-valor_obligacion'      => '',
                '40-cargo_fijo'            => '',
                '41-saldos_f_corte'        => '',
                '42-saldo_mora_f_corte'    => '',
                '43-cuotas_pactadas'       => '',
                '44-cuotas_pagadas'        => '',
                '45-cuotas_mora'           => '',
                '46-motivo_de_pago'        => '',
                '47-estado_titular'        => '',
                '48-tipo_doc_soporte'      => '',
                '49-numero_obligacion'     => '' );

            array_push($reporte_array, $temp_g);

            }//.if
        
        }//.foreach

        //dd($reporte_array);

        return $reporte_array;

    }//.try
    catch(\Exception $e){
        dd($e);
    }

}
    /*
    |--------------------------------------------------------------------------
    | cuotas_pactadas
    |--------------------------------------------------------------------------
    |
    | recibe un objeto credito  
    | retorna numero de cuotas pactadas
    | Si el credito viene de una migración, no tiene pagos y esta en Mora
    | el numero de cuotas pactadas se iguala al numero de cutas por pagar.  
    */
    function cuotas_pactadas($credito){
        $cts = $credito->precredito->cuotas;
        $cts_faltantes = $credito->cuotas_faltantes;
        if($cts_faltantes < $cts ){
            //si la cantidad de pagos es 0
            if( DB::table('facturas')->where([['credito_id','=',$credito->id]])->count() == 0){
                $credito->precredito->cuotas = $cts_faltantes;  
                return $cts_faltantes;
            }else{
                return $cts;
            }
        }else{
            return $cts;
        }
    }



    /*
    |--------------------------------------------------------------------------
    | saldo_mora
    |--------------------------------------------------------------------------
    |
    | recibe un objeto credito  
    | retorna el saldo en mora a la fecha de corte
    | 
    |
    */

    function saldo_mora( $credito ){


        $corte      = Carbon::now();
        $total_multas = "";

        if(dias_mora($credito,$corte) <= 20){
            return '0';
        }

        if($credito->estado == 'Al dia' || $credito->estado == 'Cancelado'){
            return '0';
        }

        $sanciones  = 
            Sancion::where('credito_id',$credito->id)
                ->where('estado','Debe')
                ->sum('valor');

        $multas     =
            Extra::where('credito_id',$credito->id)
                ->where('estado','Debe')
                ->get();

        //***************************//

        // si existen multas        
                
        if( count($multas) > 0 ){

            // consulta si hay pagos por multas

            $pagos_por_multa = 
                DB::table('pagos')
                    ->where([['credito_id','=',$credito->id],
                             ['concepto','=','Prejuridico'],
                             ['estado','=','Debe']])
                    ->orWhere([['credito_id','=',$credito->id],
                             ['concepto','=','Juridico'],
                             ['estado','=','Debe']])
                    ->get();

            // haya hecho pagos
            
            if( count($pagos_por_multa) > 0){

                $total_multas = $pagos_por_multa[0]->debe;
                
            }

            // no haya hecho pagos

            else{
                $total_multas = $multas[0]->valor;
                
            }  

        }else{
            $total_multas = 0;
        }

         //***************************//

        // si no hay pagos parciales se iguala a 0        

        if( !pagos_parciales($credito,$corte) ){
            $total_parciales = 0;
        }
        else{
            $total_parciales = pagos_parciales($credito,$corte);
        }   

        //se calcula el numero de cuotas en mora , no se incluyen cuotas parciales
        
        $cuotas_mora =  cuotas_mora($credito,$corte); 
   
        $cuotas_mora =  $cuotas_mora['cts_mora'];

        $vlr_cuotas_mora = $cuotas_mora * $credito->precredito->vlr_cuota;

        
        // sumatoria saldo en mora

        $saldo_en_mora = $sanciones + $total_multas + $total_parciales + $vlr_cuotas_mora ;

        return (int)$saldo_en_mora; 
    }


    /*
    |-------------------------------------------------------------------------- 
    | cuotas_mora
    |--------------------------------------------------------------------------
    |
    | recibe un objeto credito,
    | retorna un array con dos elementos
    | cts_mora que no incluyen los pagos parciales 
    | y cts_mora_todas que incluye los
    | pagos parciales
    */

    function cuotas_mora( $credito ,$corte){

        // a los Cancelados se les quita las cuotas en mora
        if($credito->estado == 'Cancelado'){       
            return array('cts_mora' => 0 , 'cts_mora_todas' => 0 );
        }
        
        //CALCULA LOS DIAS EN MORA
        $dias_mora = dias_mora($credito, $corte);

        // echo 'dias en mora: '.$dias_mora.'<br>';

        //SI LOS DIAS EN MORA SON MAS DE 20 ENTRA AL IF

        if($dias_mora > 20){
            
            //pago_hasta es la fecha limite de pago

            $pago_hasta     = FechaCobro::where('credito_id',$credito->id)->get();

            $pago_hasta     = $pago_hasta[0]->fecha_pago;

            // echo 'pago hasta. '.$pago_hasta.'<br>';

            //se inician las variables

            $cuotas         = $credito->cuotas_faltantes;
            // ECHO 'CUOTAS FALTANTES 1: '.$cuotas.'<br>';

            $parada         = FALSE;
            $cts_mora       = 0; // no incluye cuotas parciales
            $cts_mora_todas = 0; // incluye cuotas parciales
            

            $f_pago         = Carbon::create(ano($pago_hasta),mes($pago_hasta),dia($pago_hasta));


            if( $corte->gt($f_pago)){
                $cts_mora++;
                $cuotas--;
                // echo 'cuotas en mora: '.$cts_mora.'<br>';
                // echo 'cuotas '.$cuotas.'<br>';
            }
            else{
                $parada = TRUE;
            }

            while( $cuotas > 0 && $parada == FALSE){   


                $f_pago  = pago_hasta($f_pago->toDateString(), 
                                    $credito->precredito->periodo, 
                                    1,
                                    $credito->precredito->p_fecha, 
                                    $credito->precredito->s_fecha
                                    );

                // echo 'fecha_pago'.$f_pago.'<br>';
                $f_pago = Carbon::create(ano($f_pago),mes($f_pago),dia($f_pago));

                if( $corte->gt($f_pago) ){
                    $cts_mora++;
                    $cuotas--;
                }
                else{
                    // echo 'true';
                    $parada = TRUE;
                }
            
            }

            //si existen pagosparciales se resta 1 al número de cuotas

            $cts_mora_todas  = $cts_mora;

            //oRganizar

            //if( $cts_mora > 1 && pagos_parciales($credito,$corte) ){

            
            if( $cts_mora > 1 && pagos_parciales($credito,$corte) ){
                $cts_mora--;
                // echo 'cts con parcial: '.$cts_mora.'<br>';
            }
            return array('cts_mora' => $cts_mora , 'cts_mora_todas' => $cts_mora_todas );

        }//end if
        else{
            return array('cts_mora' => 0 , 'cts_mora_todas' => 0 );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | pagos_parciales
    |--------------------------------------------------------------------------
    |
    | recibe un objeto credito y retorna 
    | TRUE si tiene pagos parciales y FALSE si no tiene pagos parciales
    | 
    |
    */


    function pagos_parciales( $credito,$corte ){
        $total_parciales = 
            DB::table('pagos')
                ->where([['credito_id','=',$credito->id],
                         ['concepto','=','Cuota Parcial'],
                         ['estado','=','Debe'],
                         ['created_at','<=',$corte]])
                ->sum('Debe');

        // si no hay pagos parciales se iguala a 0        

        if( count($total_parciales) == null ){
            return FALSE;
        }    
        else{
            return $total_parciales;
        } 

    }

    function fecha_plana($fecha){
    
        $fecha = formatoFecha(dia($fecha),mes($fecha),ano($fecha));
        $fecha = str_replace('-','', $fecha);
        return $fecha; 

    }   

    function periodicidad_pago($periodo){
        switch ($periodo) {
            case 'Quincenal':
                $dias = '15';
                break;
            
            case 'Mensual':
                $dias = '30';
                break;
        }

        return $dias;
    }



    function tipo_documento($documento){
        switch ($documento) {

            case 'Cedula Ciudadanía':                       $tipo = '1'; break;
            case 'Nit':                                     $tipo = '2'; break;
            case 'Cedula de Extranjería':                   $tipo = '3'; break;
            case 'Pasaporte':                               $tipo = '4'; break;
            case 'Pase Diplomático':                        $tipo = '5'; break;
            case 'Carnet Diplomático':                      $tipo = '6'; break;
            case 'Tarjeta de Identidad':                    $tipo = '7'; break;
            case 'Rut':                                     $tipo = '8'; break;
            case 'Número único de Identificación Personal': $tipo = '9'; break;
            case 'Nit de Extranjería':                      $tipo = '10'; break;
            default:                                        $tipo = '';  break;
        }

        return $tipo;
    }



    function motivo_pago($credito){

        //Si el credito se canceló o el saldo de la deuda es 0

        if( $credito->estado == 'Cancelado' ||  $credito->saldo == 0){
      
            $pago_por_multas  = 
            DB::table('pagos')
                ->where('credito_id', '=', $credito->id)
                ->where(function ($query) {
                    $query->where('concepto', '=', 'Prejuridico')
                          ->orWhere('concepto', '=', 'Juridico');
                })
                ->get();

            if( count($pago_por_multas) > 0){
                return 1;
            }else{
                return '';
            }   
            $credito->estado = 'Finalizado en Procredito';
            $credito->save();
        }
        return '';
    }


    // retorna el objeto del ultimo pago, recibe un objeto credito


    function ultima_factura($credito){

        $factura = DB::table('facturas')
                    ->where([['credito_id','=',$credito->id]])
                    ->orderBy('id','desc')
                    ->first();

        return $factura;

    }

    //retorna el objeto de la penultima factura, si no existe retorna null, recibe un obj credito

    function penultima_factura($credito){

        $ultima  = ultima_factura($credito);

        if($ultima){
            $factura = DB::table('facturas')
                        ->where([['credito_id','=',$credito->id],['id','<>',$ultima->id]])
                        ->orderBy('id','desc')
                        ->first();
            return $factura;
        }
        else{
            return null;
        }
    }

    // calcula la fecha de vencimiento del ultimo pago, recibe un objeto credito retorna una fecha ddmmyyyy

    function fecha_vencimiento($credito){
        $vencimiento   = penultima_factura($credito);

        if($vencimiento != null){
            $f = $vencimiento->fecha_proximo_pago;
            $fecha = formatoFecha(dia($f),mes($f),ano($f)); // dd/mm/yyyy
            $fecha = fecha_plana($fecha);

            return $fecha;

        }
        else{
            $vencimiento = calcularFecha($credito->precredito->fecha, 
                                         $credito->precredito->periodo, 
                                         1, 
                                         $credito->precredito->p_fecha, 
                                         $credito->precredito->s_fecha, 
                                         'true');
            return fecha_plana($vencimiento['fecha_ini']);
        }
    }


    // Calcula el número de días en mora, recibe un objeto credito y un objeto carbon con la fecha de corte
    // retorna el numero de dias en mora

    function dias_mora($credito,$corte){
        $dias = 
            DB::table('sanciones')
            ->where([['credito_id','=',$credito->id],['estado','=','Debe'],['created_at','<=',$corte]])
            ->count('id');

        if($dias == null){
            return '0';
        }
        else{
            return $dias;
        }     
    }

    // funcion que retorna el estado formateado para el archivo plano
    // recibe un objeto credito y retorna "Al dia" o "Mora"


    function estado($credito,$corte){

        $estado = '';
        $dias_mora = dias_mora($credito,$corte);

        if( ($credito->estado == 'Mora'  && $dias_mora > 20)
            || $credito->estado == 'Prejuridico' 
            || $credito->estado == 'Juridico'){
            $estado = 2;
        }
        else if( $credito->estado == 'Al dia'
                 || ($credito->estado == 'Mora'  && $dias_mora <= 20)){
            $estado = 1;
        }
        else{
            $estado = 1;
        }

        if( $credito->castigada == "Si"){
            if($credito->estado == 'Al dia'){
                $estado = 4;
            }else{
                $estado = 3;
            }
        }

        return $estado; 
    }






?>