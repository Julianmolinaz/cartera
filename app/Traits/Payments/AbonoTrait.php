<?php

namespace App\Traits\Payments;

use Illuminate\Http\Request;
use App\Repositories\PagoRepository;
Use App\Http\Controllers as Ctrl;
use Carbon\Carbon;
use Exception;
use App as _;
use Auth;
use DB;

trait AbonoTrait
{
    /*
    |--------------------------------------------------------------------------
    | abonos
    |--------------------------------------------------------------------------
    |
    | Distribuye un valor suministrado en el pago de la obligacion
    | Recibe request con el monto y el credito
    | Retorna arreglo con los pagos generados
    | 
    */    

    public function abonos(Request $request)
    {
        $repo              = new PagoRepository(); //querys
        $contenedor        = [];  // almacena los pagos 
        $monto             = $request->monto; // payment
        $credito           = _\Credito::find($request->credito_id);
        $saldo_cts         = $credito->cuotas_faltantes; // cuotas faltantes
        $sanciones         = $repo->getDebeDeSanciones($credito->id);
        $cta_parcial       = $repo->partialPayment($credito->id); 
        $hay_sanciones     = count($sanciones) > 0;
        $dia_sancion       = _\Variable::find(1)->vlr_dia_sancion;
        $monto_por_sancion = 0;
        $contador          = 0;
        $sin_mover_fecha   = []; //array donde se almacena Cuota Parcial sin movimiento de fecha (pago_hasta)
        $date_ini          = $credito->fecha_pago->fecha_pago; //fecha de referencia inicial para cuota parcial sin cambio de fecha
        

        /**
         * JURIDICO
         */


        if ($monto > 0) {

            $sancion_juridico = $repo->getDebeDeJuridicos($credito->id);

            if($sancion_juridico) {
            
                $juridico =   $repo->getDebeJuridicos($credito->id);

                if ($juridico) { 

                    if ($monto > $juridico[0]->debe) { 
                        $abono = $juridico[0]->debe;
                        $monto = $monto - $abono; 
                    } else {
                        $abono = $monto;
                        $monto = 0; 
                    }

                }  else {

                    if ($monto > $sancion_juridico->valor) {
                        $abono = $sancion_juridico->valor;
                        $monto = $monto - $abono; 
                    } else {
                        $abono = $monto;
                        $monto = 0; 
                    }           
                }

                $temp = [ 
                    'cant'      => 1, 
                    'concepto'  => 'Juridico', 
                    'ini'       => '', 
                    'fin'       => '', 
                    'subtotal'  => $abono,
                    'marcado'   => false 
                ];
                            
                array_push($contenedor, $temp);
            }
        }    
    

        /**
         * PREJURIDICO
         */


        if ($monto > 0) {
            $sancion_prejuridico = $repo->getDebePrejuridico($request->credito_id);

            if ($sancion_prejuridico) {

                $prejuridico = $repo->getDebeExcedentesPrejuridico($request->credito_id);

                if ( $prejuridico ) {   

                    if ($monto > $prejuridico->debe) { 
                        $abono = $prejuridico->debe;
                        $monto = $monto - $abono; 
                    } else {
                        $abono = $monto;
                        $monto = 0; 
                    }
                } else {

                    if ($monto > $sancion_prejuridico->valor) {
                        $abono = $sancion_prejuridico->valor;
                        $monto = $monto - $abono; 
                    } else {
                        $abono = $monto;
                        $monto = 0; 
                    }           
                }
            
                $temp = [ 
                    'cant'      => 1, 
                    'concepto'  => 'Prejuridico', 
                    'ini'       => '', 
                    'fin'       => '', 
                    'subtotal'  => $abono, 
                    'marcado'   => false 
                ];

                array_push($contenedor, $temp);        
            }
        }

        
        /**
         * SANCIONES
         */


        if($monto > 0){
            if($hay_sanciones){

                foreach ($sanciones as $sancion) {
                    if ($monto >= $dia_sancion) {
                        $monto_por_sancion = $monto_por_sancion + $dia_sancion;
                        $monto = $monto - $sancion->valor;
                        $contador++;
                    }
                }

                $temp = [ 
                    'cant'      => $contador, 
                    'concepto'  => 'Mora',  
                    'ini'       => '', 
                    'fin'       => '', 
                    'subtotal'  => $monto_por_sancion, 
                    'marcado'   => false
                ];

                array_push($contenedor, $temp);
            }
        }  

        
        /**
         * CUOTAS INCOMPLETAS SEGUNDA VEZ
         * Cuando inicialmente se abona al excedente de una cuota parcial no se mueve la fecha
         */


        if ($monto > 0 && $saldo_cts > 0) {

            if ($cta_parcial) {  
                
                $pago = $cta_parcial;

                if ($monto >= $pago->debe) {
                    $abono = $pago->debe; 
                    $monto = $monto - $abono; 
                    $saldo_cts--;
                } else {
                    $abono = $monto;
                    $monto = 0; 
                }

                $temp = [ 
                    'cant'     => 1, 
                    'concepto' => 'Cuota Parcial', 
                    'ini'      => Ctrl\Ymd($pago->pago_desde), 
                    'fin'      => Ctrl\Ymd($pago->pago_hasta), 
                    'subtotal' => $abono, 
                    'marcado'  => false 
                ];

                array_push($contenedor, $temp);
                $date_ini = $pago->pago_desde;
                           
            }  
        }

        /**
         * CUOTA 
         * Se mueve la fecha sin novedad cuando la cuota es completa
         */
     

        if ($monto > 0 && $saldo_cts > 0) {
            
            $cts_faltantes = $credito->cuotas_faltantes;
            $vlr_cta       = $credito->precredito->vlr_cuota;
            $cts_pagadas   = 0;

            if ($cta_parcial) $cts_faltantes--;

            $cts_a_pagar = $monto / $vlr_cta;

            if ( ($cts_a_pagar >= 1) &&  ($cts_a_pagar < $cts_faltantes) ) {
                $cts_pagadas = intval($cts_a_pagar);
            } else if ($cts_a_pagar >= $cts_faltantes) {
                $cts_pagadas = $cts_faltantes;
            } else {
                $cts_pagadas = 0;
            }

            $saldo_cts -= $cts_pagadas;

            $monto -= $cts_pagadas * $vlr_cta;

            $date = $credito->fecha_pago->fecha_pago;

            if ($cts_pagadas > 0) {

                $fecha = Ctrl\calcularFecha(
                    $credito->fecha_pago->fecha_pago, 
                    $credito->precredito->periodo, 
                    $cts_pagadas, 
                    $credito->precredito->p_fecha, 
                    $credito->precredito->s_fecha, 
                    false
                );

                $temp = [ 
                    'cant'      => $cts_pagadas,  
                    'concepto'  => 'Cuota', 
                    'ini'       => Ctrl\Ymd($fecha['fecha_ini']), 
                    'fin'       => Ctrl\Ymd($fecha['fecha_fin']), 
                    'subtotal'  => $vlr_cta * $cts_pagadas,
                    'marcado'   => false 
                ];

                array_push($contenedor, $temp);

                $date           = $fecha['fecha_fin']; 
                $date_ini       = $fecha['fecha_ini'];
                $primera_cuota  = false;
            }


            /**
             * CTS INCOMPLETAs PRIMERA VEZ
             */


            if ($monto > 0 && $saldo_cts > 0) {

                $fecha = Ctrl\calcularFecha(
                    $date, 
                    $credito->precredito->periodo, 
                    1, 
                    $credito->precredito->p_fecha, 
                    $credito->precredito->s_fecha,
                    false 
                );

                // CALCULAR PORCENTAJE

                $vlr_cuota   = $credito->precredito->vlr_cuota;
                $porcentaje  = intval($credito->precredito->cartera->porcentaje_pago_parcial);
                $porcentaje_ = ($porcentaje > 0) ? $porcentaje : 60;

                $vlr_monto_permitido = $vlr_cuota *  ($porcentaje_ / 100); 

                if ($monto >= $vlr_monto_permitido || $credito->permitir_mover_fecha) {

                    $temp = [ 
                        'cant'      => 1,
                        'concepto'  => 'Cuota Parcial', 
                        'ini'       => Ctrl\Ymd($fecha['fecha_ini']),
                        'fin'       => Ctrl\Ymd($fecha['fecha_fin']), 
                        'subtotal'  => $monto,             
                        'marcado'   => false 
                    ];

                } else {

                    $temp =  [
                        'cant'      => 1,
                        'concepto'  => 'Cuota Parcial', 
                        'ini'       => Ctrl\Ymd($date_ini),                 
                        'fin'       => Ctrl\Ymd($date), 
                        'subtotal'  => $monto,             
                        'marcado'   => true 
                    ];  
                }

                $monto = 0;

                array_push($contenedor, $temp);

            }
        }

        $temp = [ 
            'cant'      => '', 
            'concepto'  => 'Total',
            'ini'       => '',
            'fin'       => '', 
            'subtotal'  => $request->monto, 
            'marcado'   => false 
        ];

        array_push($contenedor, $temp);

        if ($monto > 0) {
            $temp = [ 
                'cant'      => '', 
                'concepto'  => 'Saldo a Favor',
                'ini'       => '',
                'fin'       => '', 
                'subtotal'  => $monto, 
                'marcado'   => false 
            ];

            array_push($contenedor, $temp); 
        }

        $res = [
            'error' => false, 
            'data' => $contenedor, 
            'cta_parcial_sin_movimiento_de_fecha' => $sin_mover_fecha
        ];

        if (isset($request->interno) ) return $res;

        return response()->json($res);
    }

    /**
     * JURIDICO
     */

    public function abonoJuridico()
    {
    
    }
}


