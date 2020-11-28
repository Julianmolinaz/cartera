<?php

namespace App\MyService\Payments;

use App\Repositories;
use App\Http\Controllers as Ctrl;
use App as _;

class Payment 
{
    protected $pay; // abono
    protected $credit;
    protected $container; // 
    protected $delay; // sanciones diarias
    protected $repo;
    protected $rest;
    protected $date_ini;
    protected $date;
    protected $first_payment;
    protected $qty_partial;


    public function __construct($credit_id, $payment) 
    {
        $this->credit    = _\Credito::find($credit_id);
        $this->payment   = $payment;
        $this->repo      = new Repositories\PagoRepository();
        $this->date_init = $this->credit->fecha_pago->fecha_pago;
        $this->partial   = $this->repo->partialPayment($this->credit->id);
    }

    /*
    |--------------------------------------------------------------------------
    | make
    |--------------------------------------------------------------------------
    |
    | Execute all actions
    |
    */
    
    public function make()
    { 
        if ($this->payment > 0) {
            $this->paymentJuridico();
        }
        if ($this->payment > 0) {
            $this->paymentPrejuridico();
        }
        if ($this->payment > 0) {
            $this->paymentSanciones();
        }
        if ($this->payment > 0) {
            $this->secondPartialPayment();
        }
        if ($this->payment > 0) {
            $this->fullPayment();
        }
        if ($this->payment > 0) {
            $this->firstPartialPayment();
        }


        dd($this->container);
        
    }

    /*
    |--------------------------------------------------------------------------
    | paymentJuridico
    |--------------------------------------------------------------------------
    |
    | Scann Juridicos and payments in debe
    |
    */

    protected function paymentJuridico()
    {
        $fee = 0;

        // get extras juridicos in debe
        $sancion_juridico = $this->repo->getDebeDeJuridicos($this->credit->id);

        if ($sancion_juridico) { 

            // payments juridico
            $juridico =   $this->repo->getDebeJuridicos($this->credit->id);

            if ($juridico) { 

                if ($this->payment > $juridico->debe) { 
                    $fee = $juridico->debe;
                    $this->payment -= $fee; 
                } else {
                    $fee = $this->payment;
                    $this->payment = 0; 
                }
            } else {

                if ( $this->payment > $sancion_juridico->valor) {
                    $fee = $sancion_juridico->valor;
                    $this->payment -= $fee; 
                } else {
                    $fee = $this->payment;
                    $this->payment = 0; 
                }   
            }

            $this->container[] = [ 
                'cant'      => 1, 
                'concepto'  => 'Juridico', 
                'ini'       => '', 
                'fin'       => '', 
                'subtotal'  => $fee,
                'marcado'   => false 
            ];
        }//.if
    }//.generateJuridico


    /*
    |--------------------------------------------------------------------------
    | paymentPrejuridico
    |--------------------------------------------------------------------------
    |
    | Scann sanciones and payments in debe
    |
    */

    protected function paymentPrejuridico()
    {
        $fee = 0;
        $sancion_prejuridico = $this->repo->getDebePrejuridico($this->credit->id);

        if ($sancion_prejuridico) {

            $prejuridico = $this->repo->getDebeExcedentesPrejuridico($this->credit->id);
        
            if ($prejuridico) {   

                if ($this->payment > $prejuridico->debe) { 
                    $fee = $prejuridico->debe;
                    $this->payment -= $fee; 
                } else {
                    $fee = $this->payment;
                    $this->payment = 0; 
                }
            } else {
        
                if ($this->payment > $sancion_prejuridico->valor) {
                    $fee = $sancion_prejuridico->valor;
                    $this->payment -= $fee; 
                } else {
                    $fee = $this->payment;
                    $this->payment = 0; 
                }           
            }
        
            $this->container[] = [ 
                'cant'      => 1, 
                'concepto'  => 'Prejuridico', 
                'ini'       => '', 
                'fin'       => '', 
                'subtotal'  => $fee, 
                'marcado'   => false 
            ];
             
        }//.if
    }//.generatePrejuridico
    
    /*
    |--------------------------------------------------------------------------
    | paymentSanciones
    |--------------------------------------------------------------------------
    |
    | Scann sanciones and payments in debe
    |
    */

    protected function paymentSanciones()
    {
        $sanciones       = $this->repo->getDebeDeSanciones($this->credit->id);
        $count_penalties = 0;
        $val_penalties   = 0;
        $fee             = 0;
        $sancion_day     = _\Variable::find(1)->vlr_dia_sancion;


        if (count($sanciones) > 0) {

            foreach ($sanciones as $sancion) {

                if ($this->payment >= $sancion_day) { 
                    $val_penalties += $sancion_day;
                    $this->payment -= $sancion_day;
                    $count_penalties++;
                }
            }

            $this->container[] = [ 
                'cant'      => $count_penalties, 
                'concepto'  => 'Mora',  
                'ini'       => '', 
                'fin'       => '', 
                'subtotal'  => $val_penalties, 
                'marcado'   => false
            ];
    
        }
    }


    /*
    |--------------------------------------------------------------------------
    | secondPartialPayment
    |--------------------------------------------------------------------------
    |
    | Scann seconf partial payments (in debe)
    |
    */
    
    protected function secondPartialPayment()
    {
        $fee = 0;
        
        if ($this->partial) { 

            if ($this->payment > $this->partial->debe) {
                $fee = $this->partial->debe; 
                $this->payment -= $fee; 
            } else {
                $fee = $this->payment;
                $this->payment = 0; 
            }

            $this->container[] = [ 
                'cant'      => 1, 
                'concepto'  => 'Cuota Parcial', 
                'ini'       => $this->partial->pago_desde, 
                'fin'       => $this->partial->pago_hasta, 
                'subtotal'  => $fee, 
                'marcado'   => false 
            ];

            $this->date_ini = $this->partial->pago_desde;
                 
        }  
    }

    /*
    |--------------------------------------------------------------------------
    | fullPayment
    |--------------------------------------------------------------------------
    |
    | Generate the full payments posible
    |
    */

    protected function fullPayment()
    {
        $missing_feeds = $this->credit->cuotas_faltantes;
        $this->qty_partial = (int)(bool)$this->partial; 
        $qty = 0;
        
        $missing_fees_real = $missing_feeds - $this->qty_partial;

        $can_pay = intval($this->payment / $this->credit->precredito->vlr_cuota);

        if ($can_pay > $missing_fees_real) {
            $qty = $missing_fees_real;
        } else {
            $qty = $can_pay;
        }

        $date = Ctrl\calcularFecha (
            $this->credit->fecha_pago->fecha_pago, 
            $this->credit->precredito->periodo, 
            $qty, 
            $this->credit->precredito->p_fecha, 
            $this->credit->precredito->s_fecha, 
            false
        );

        $this->container[] = [ 
            'cant'      => $qty,  
            'concepto'  => 'Cuota', 
            'ini'       => Ctrl\inv_fech($date['fecha_ini']), 
            'fin'       => Ctrl\inv_fech($date['fecha_fin']), 
            'subtotal'  => $qty * $this->credit->precredito->vlr_cuota,       
            'marcado'   => false 
        ];

        $this->date           = $date['fecha_fin']; 
        $this->date_ini       = $date['fecha_ini'];
        $this->first_payment  = false;
    }

    protected function firstPartialPayment()
    {        
        if ($this->qty_partial) {
            
            $temp = [];

            $date = Ctrl\calcularFecha (
                $this->date, 
                $this->credit->precredito->periodo, 
                $this->qty_partial, 
                $this->credit->precredito->p_fecha, 
                $this->credit->precredito->s_fecha, 
                false
            );

            // calculate percentage

            $share_value = $this->credit->precredito->vlr_cuota;
            $permitted = $share_value * intval($this->credit->precredito->cartera->porcentaje_pago_parcial) / 100; 

            if ($this->payment >= $permitted || $this->credit->permitir_mover_fecha) {
                $temp = [ 
                    'cant'      => $this->qty_partial,
                    'concepto'  => 'Cuota Parcial', 
                    'ini'       => Ctrl\inv_fech($date['fecha_ini']),
                    'fin'       => Ctrl\inv_fech($date['fecha_fin']), 
                    'subtotal'  => $this->payment,             
                    'marcado'   => false 
                ];
            } else {
                $temp =  [
                    'cant'      => $this->qty_partial,
                    'concepto'  => 'Cuota Parcial', 
                    'ini'       => $this->date_ini,                 
                    'fin'       => $this->date, 
                    'subtotal'  => $this->payment,             
                    'marcado'   => true 
                ];  
            }

            if ($temp) $this->container[] = $temp;

            $sin_mover_fecha =  [ 
                'cant'      => $this->qty_partial,
                'concepto'  => 'Cuota Parcial', 
                'ini'       => $this->date_ini,                 
                'fin'       => $this->date, 
                'subtotal'  => $this->payment,             
                'marcado'   => true 
            ];

            $this->payment = 0;  

        }//.if
    }//.firstPartialPayment


    
    
}