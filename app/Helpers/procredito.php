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

    $now                = Carbon::now();
    $fecha              = fecha_plana($now->toDateString());

    Excel::create('294466092'.$fecha,function($excel){
        $excel->sheet('Sheetname',function($sheet){

            $generar_tipo_d     = 0;
            $now                = Carbon::now();
            $fecha              = fecha_plana($now->toDateString());
            $ids                = DB::table('creditos')
                                    ->whereIn('estado', 
                                    ['Al dia', 'Mora', 'Prejuridico','Juridico','Cancelado'])
                                    ->where('end_procredito','<>',1)
                                    ->select('id')
                                    ->get();

            $ids_array = array(); 
                    
            foreach($ids as $id){ array_push($ids_array, $id->id); }                

            $creditos       = Credito::find($ids_array);             
            $reporte_array  = array();

            foreach($creditos as $credito){

                // TIPO EEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE

                $c = 
                DB::table('creditos')
                            ->join('precreditos','creditos.precredito_id','=','precreditos.id')
                            ->join('clientes','precreditos.cliente_id','=','clientes.id')
                            ->where([['clientes.id','=',$credito->precredito->cliente->id],
                                    ['creditos.id','<>',$credito->id]])
                            ->select('creditos.id as id','creditos.estado as estado')
                            ->orderBy('creditos.id','desc')
                            ->first();  

                $refinanciacion = '';
                $id     = $credito->id;             

                if(count($c) > 0){
                    if($c->estado == 'Refinanciacion'){
                        $refinanciacion = 0;
                        $id     = $c->id;
                    }
                }       

                $temp = array(

                'tipo_de_registro'      => 'E', // para deudor
                'tipo_de_noveda'        => 1,
                'refinanciacion'        => $refinanciacion, // no obligatoria, 0 para refinanciación
                'fecha_de_corte'        => $fecha,
                'seccional'             => 17, 
                'consecutivo'           => '',
                'codigo_sucursal_viejo' => '',
                'tipo_doc_afiliado'     => '2', 
                'num_doc_afiliado'      => '94466092-1',
                'codigo_sucursal_nuevo' => 0,
                'tipo_garante'          => '1', 
                'tipo_doc_cliente'      => tipo_documento($credito->precredito->cliente->tipo_doc),
                'num_doc_cliente'       => $credito->precredito->cliente->num_doc,
                'primer_nombre'         => $credito->precredito->cliente->primer_nombre, 
                'segundo_nombre'        => $credito->precredito->cliente->segundo_nombre,       
                'primer_apellido'       => $credito->precredito->cliente->primer_apellido,      
                'segundo_apellido'      => $credito->precredito->cliente->segundo_apellido,      
                'nombre_comercial'      => '',        
                'pais'                  => '57',//Colombia
                'departamento'          => $credito->precredito->cliente->municipio->codigo_departamento, //municipios
                'ciudad'                => $credito->precredito->cliente->municipio->codigo_municipio, //municipios
                'tipo_direccion'        => '1',//Casa
                'direccion'             => $credito->precredito->cliente->direccion,
                'tipo_telefono'         => '2', // Celular
                'telefono'              => $credito->precredito->cliente->movil, // GORA
                'extension'             => '',
                'tipo_ubi_electronica'  => '',
                'ubicacion_electronica' => '',
                'cupo_credito'          => '',
                'cupo_utilizado'        => '',
                'tipo_obligacion'       => '7', // Pagaré
                'tipo_contrato'         => '1', // Venta
                'numero_obligacion'     => $id,
                'fecha_obligacion'      => fecha_plana($credito->created_at),
                'periodicidad_pago'     => periodicidad_pago($credito->precredito->periodo),
                'termino_contrato'      => '',
                'meses_celebrados'      => '',
                'meses_clausula_permanencia' => '',
                'valor_obligacion'      => (int)$credito->precredito->vlr_fin,
                'cargo_fijo'            => '',
                'saldos_f_corte'        => (int)$credito->saldo,
                'saldo_mora_f_corte'    => (int)saldo_mora($credito),
                'cuotas_pactadas'       => $credito->precredito->cuotas, 
                'cuotas_pagadas'        => $credito->precredito->cuotas -
                                            $credito->cuotas_faltantes,
                'cuotas_mora'           => cuotas_mora($credito,$now)['cts_mora'],
                'motivo_de_pago'        => motivo_pago($credito),
                'estado_titular'        => '',
                'tipo_doc_soporte'      => '',
                'numero_obligacion_referenciada' => ''   
                );

                array_push($reporte_array, $temp);

                // TIPO DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD

                // cuando el credito esta al dia **************************************

                if($credito->estado == 'Al dia'){
                    $factura = ultima_factura($credito);

                    // cuando el cliente ha realizado pagos

                    if($factura){
                        $numero_cuota   = 1;
                        $valor_pagado   = $factura->total;
                        $fecha_pago     = fecha_plana($factura->fecha);
                    }

                    // cuando el cliente esta al dia y aun no ha hecho el primer pago
                    else{
                        $generar_tipo_d = 1;    
                    }

                    if($generar_tipo_d == 0){
                        $temp_e = array(
                                        'tipo_de_registro'  => 'D', // detalle
                                        'tipo_obligacion'   => 7,   // 
                                        'numero_obligacion' => $credito->id ,
                                        'numero_cuota'      => $numero_cuota,
                                        'valor_cuota'       => (int)$credito->precredito->vlr_cuota,
                                        'valor_pagado'      => (int)$valor_pagado,
                                        'estado_obligacion' => estado($credito),
                                        'dias_en_mora'      => 0,
                                        'fecha_pago'        => $fecha_pago,
                                        'fecha_vencimiento' => fecha_vencimiento($credito)
                                        );
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
                                        'numero_obligacion' => $credito->id ,
                                        'numero_cuota'      => 1,
                                        'valor_cuota'       => (int)$credito->precredito->vlr_cuota,
                                        'valor_pagado'      => (int)$factura->total,
                                        'estado_obligacion' => 1,
                                        'dias_en_mora'      => 0,
                                        'fecha_pago'        => fecha_plana($factura->fecha),
                                        'fecha_vencimiento' => fecha_vencimiento($credito)
                                        );
                        $numero_cuota = 2;
                        array_push($reporte_array, $temp_e);

                    }
                    else{
                        $numero_cuota = 1;
                    }

                    $f = $credito->fecha_pago->fecha_pago;
                    $f = formatoFecha(dia($f),mes($f),ano($f));

                    $temp_e = array(
                                    'tipo_de_registro'  => 'D', // detalle
                                    'tipo_obligacion'   => 7,   // 
                                    'numero_obligacion' => $credito->id ,
                                    'numero_cuota'      => $numero_cuota,
                                    'valor_cuota'       => (int)$credito->precredito->vlr_cuota,
                                    'valor_pagado'      => 0,
                                    'estado_obligacion' => estado($credito),
                                    'dias_en_mora'      => dias_mora($credito,$now),
                                    'fecha_pago'        => '',
                                    'fecha_vencimiento' => fecha_plana($f)
                                    );
                    array_push($reporte_array, $temp_e);


                }

        // TIPO GGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGGG


        if( $credito->precredito->cliente->codeudor->id <> 100){

            $temp_g = array(
             'tipo_de_registro'      => 'G', // para deudor
             'tipo_de_noveda'        => '',
             'refinanciacion'        => '', // no obligatoria 
             'fecha_de_corte'        => '',
             'seccional'             => 17, 
             'consecutivo'           => '',
             'codigo_sucursal_viejo' => '',
             'tipo_doc_afiliado'     => '2', 
             'num_doc_afiliado'      => '94466092',
             'codigo_sucursal_nuevo' => 0,
             'tipo_garante'          => '2', 
             'tipo_doc_cliente'      => tipo_documento($credito->precredito->cliente->codeudor->tipo_docc),
             'num_doc_cliente'       => $credito->precredito->cliente->codeudor->num_docc,
             'primer_nombre'         => $credito->precredito->cliente->codeudor->primer_nombrec, //cliente
             'segundo_nombre'        => $credito->precredito->cliente->codeudor->segundo_nombrec, //cliente
             'primer_apellido'       => $credito->precredito->cliente->codeudor->primer_apellidoc, //cliente
             'segundo_apellido'      => $credito->precredito->cliente->codeudor->segundo_apellidoc, //cliente
             'nombre_comercial'      => '', //GORA
             'pais'                  => '57',//Colombia
             'departamento'          => 1,//$credito->precredito->cliente->codeudor->municipio->codigo_departamento, 
             'ciudad'                => 1,//$credito->precredito->cliente->codeudor->municipio->codigo_municipio, //
             'tipo_direccion'        => '1',//Casa
             'direccion'             => $credito->precredito->cliente->codeudor->direccionc,
             'tipo_telefono'         => '2', // Celular
             'telefono'              => $credito->precredito->cliente->codeudor->movilc, // GORA
             'extension'             => '',
             'tipo_ubi_electronica'  => '',
             'ubicacion_electronica' => '',
             'cupo_credito'          => '',
             'cupo_utilizado'        => '',
             'tipo_obligacion'       => '7', // Pagaré
             'tipo_contrato'         => '', 
             'numero_obligacion'     => '',
             'fecha_obligacion'      => '',
             'periodicidad_pago'     => '',
             'termino_contrato'      => '',
             'meses_celebrados'      => '',// no requerido
             'meses_clausula_permanencia' => '', // no requerido
             'valor_obligacion'      => '',
             'cargo_fijo'            => '',
             'saldos_f_corte'        => '',
             'saldo_mora_f_corte'    => '',
             'cuotas_pactadas'       => '',
             'cuotas_pagadas'        => '',
             'cuotas_mora'           => '',
             'motivo_de_pago'        => '',
             'estado_titular'        => '',
             'tipo_doc_soporte'      => '',
             'numero_obligacion'     => ''  
                );
    
            array_push($reporte_array, $temp_g);

        }
    }
    $sheet->fromArray($reporte_array,null,'A1',false,false);
        });
        })->download('txt');
       
        // dd($reporte_array);
        // return $reporte_array;

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

        if($credito->estado == 'Al dia'){
            return 0;
        }

        $corte      = Carbon::now();
        $total_multas = "";

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

            // consulta de si hay pagos por multas

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

        return $saldo_en_mora; 


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

        //$corte = Carbon::now();

        //pago_hasta es la fecha limite de ago

        $pago_hasta     = FechaCobro::where('credito_id',$credito->id)->get();
        $pago_hasta     = $pago_hasta[0]->fecha_pago;

        //se inician las variables

        $cuotas         = $credito->cuotas_faltantes;
        $parada         = FALSE;
        $cts_mora       = 0; // no incluye cuotas parciales
        $cts_mora_todas = 0; // incluye cuotas parciales
        

        $f_pago         = Carbon::create(ano($pago_hasta),mes($pago_hasta),dia($pago_hasta));


        if( $corte->gt($f_pago)){
            $cts_mora++;
            $cuotas--;
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

            $f_pago = Carbon::create(ano($f_pago),mes($f_pago),dia($f_pago));

            if( $corte->gt($f_pago) ){
                $cts_mora++;
                $cuotas--;
            }
            else{
                $parada = TRUE;
            }
        
        }

        //si existen pagosparciales se resta 1 al número de cuotas

        $cts_mora_todas  = $cts_mora;

        if( $cts_mora > 0 && pagos_parciales($credito,$corte) ){
            $cts_mora--;
        }

        return array('cts_mora' => $cts_mora , 'cts_mora_todas' => $cts_mora_todas );
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
                return 0;
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
            return 0;
        } 

        return $dias;    
    }

    // funcion que retorna el estado formateado para el archivo plano
    // recibe un objeto credito y retorna "Al dia" o "Mora"


    function estado($credito){

        $estado = '';

        if( $credito->estado == 'Mora' || $credito->estado == 'Prejuridico' || $credito->estado == 'Juridico'){
            $estado = 2;
        }
        else if( $credito->estado == 'Al dia'){
            $estado = 1;
        }
        else{
            $estado = null;
        }

        if( $credito->castigada == "Si"){
            $estado = 3;
        }

        return $estado; 
    }






?>