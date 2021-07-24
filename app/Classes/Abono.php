<?php

namespace App\Classes;

use App\Repositories\PagoRepository;
use App\Http\Controllers as Ctrl;
use App as _;
use DB;

/**
 * Permite distribuir un monto entre los conceptos de pago.
 * Mueve fechas si es necesario y asigna saldo a favor si hay
 * un sobrante
 */

class Abono
{
    public $contenedor; // donde se guardan todos los conceptos
    public $total_pago; // valor total del pago
    public $monto; // restante del total_pago al descontarle los conceptos
    public $credito; // obligación a la que se le carga el pago
    public $repo; // consultas a la base de datos
    public $fecha_inicial; //fecha del próximo pago
    public $cts_faltantes; 
    public $vlr_permitido; //valor de la cuota * porcentaje de pago parcial 

    public function __construct ($credito_id, $total_pago)
    {
        $this->credito       = _\Credito::find($credito_id);
        $this->total_pago    = $total_pago;
        $this->monto         = $total_pago;
        $this->repo          = new PagoRepository();
        $this->fecha_inicial = $this->credito->fecha_pago->fecha_pago;
        $this->cts_faltantes = $this->credito->cuotas_faltantes;

        /**
         * Se permite mover la fecha solo si el monto de la cuota es igual o supera un 
         * tanto porciento, ejemplo: solo se mueve la fecha si a la cuota de $100.000
         * se le abona $60.000 o mas, que corresponde al 60 % permitido
         */

        $this->vlr_permitido = $this->valorPermitido();
    }

    public function valorPermitido()
    {
        return $this->credito->precredito->vlr_cuota * 
            intval($this->credito->precredito->cartera->porcentaje_pago_parcial) / 100;
    }

    /**
     * Función principal que ejecuta todo el proceso de generación 
     * del abono que luego será cargado como un pago
     * @return $this->contenedor = la distribución del monto 
     * a traves de los diferentes conceptos
     * 
     * RESPETAR EL ORDEN DEL LLAMADO DE LAS FUNCIONES
     */

    public function make()
    {
        if ($this->monto > 0) {
            $this->pagoJuridico();
        }

        if ($this->monto > 0) {
            $this->pagoPrejuridico();
        }

        if ($this->monto > 0) {
            $this->pagoSanciones();
        }

        if ($this->monto > 0 && $this->cts_faltantes > 0) {
            $this->pagoCuotaParcialSegundaVez();
        }

        if ($this->monto > 0 && $this->cts_faltantes > 0) {
            $this->pagoCuota();
        }

        if ($this->monto > 0 && $this->cts_faltantes > 0) {
            $this->pagoCuotaParcialPrimeraVez();
        }

        $this->totales();

        if ($this->monto > 0) {
            $this->saldoFavor();
        }

        return $this->contenedor;

    }

    /**
     * pagoJuridico
     */

    public function pagoJuridico () 
    {
        $juridico = $this->repo->getDebeDeJuridicos($this->credito->id);
        $abono = 0;
        $temp = $this->struct();

        if ($juridico) {

            $pago = $this->repo->getDebeJuridicos($this->credito->id);

            if ($pago) {

                if ($this->monto > $pago->debe) {
                    $abono = $pago->debe;
                    $this->monto -= $abono;
                } else {
                    $abono = $this->monto;
                    $this->monto = 0;
                }

            } else {

                if ($this->monto > $juridico->valor) {
                    $abono = $juridico->valor;
                    $this->monto -= $abono;
                } else {
                    $abono = $this->monto;
                    $this->monto = 0;
                }
            }

            $temp['cant'] = 1;
            $temp['concepto'] = 'Juridico';
            $temp['subtotal'] = $abono;

            $this->contenedor[] = $temp;
        }
    }

    /**
     * pagoPrejuridico
     */


    public function pagoPrejuridico () 
    {
        $prejuridico = $this->repo->getDebePrejuridico($this->credito->id);
        $abono = 0;
        $temp = $this->struct();

        if ($prejuridico) {

            $pago = $this->repo->getDebeExcedentesPrejuridico($this->credito->id);

            if ($pago) {

                if ($this->monto > $pago->debe) {
                    $abono = $pago->debe;
                    $this->monto -= $abono;
                } else {
                    $abono = $this->monto;
                    $this->monto = 0;
                }

            } else {

                if ($this->monto > $prejuridico->valor) {
                    $abono = $prejuridico->valor;
                    $this->monto -= $abono;
                } else {
                    $abono = $this->monto;
                    $this->monto = 0;
                }
            }

            $temp['cant'] = 1;
            $temp['concepto'] = 'Prejuridico';
            $temp['subtotal'] = $abono;

            $this->contenedor[] = $temp;

        }
    }

    /**
     * pagoSanciones
     */

    public function pagoSanciones () 
    {
        $sanciones = $this->repo->getDebeDeSanciones($this->credito->id);

        $vlr_dia_sancion = DB::table('variables')
            ->select('vlr_dia_sancion')
            ->first()
            ->vlr_dia_sancion;

        $contador_sanciones = 0;
        $temp = $this->struct();
        $abono = 0;

        if (count($sanciones) > 0) {
            
            foreach ($sanciones as $sancion) {
                if ($this->monto >= $vlr_dia_sancion) {
                    $abono += $vlr_dia_sancion;
                    $this->monto -= $vlr_dia_sancion;
                    $contador_sanciones ++;
                }
            }

            $temp['cant'] = $contador_sanciones;
            $temp['concepto'] = 'Mora';
            $temp['subtotal'] = $abono;
            
            $this->contenedor[] = $temp;
        }
    }

    /**
     * pagoCuotaParcialSegundaVez
     */

    public function pagoCuotaParcialSegundaVez () 
    {
        $cta_parcial = $this->repo->partialPayment($this->credito->id);
        $abono       = 0;
        $temp        = $this->struct();
        $flag        = false;

        // Si existe un pago anterior por cuota parcial en debe
        
        if ($cta_parcial) {
            
            if ($this->monto >= $cta_parcial->debe) {

                $abono = $cta_parcial->debe;
                $this->monto -= $abono;
                $this->cts_faltantes --;

                // Marca que la cuota parcial se canceló en su totalidad
                $flag = true;

            } else {

                $abono = $this->monto;
                $this->monto = 0;

            }

            if ($abono >= $this->vlr_permitido || ($this->moverFechaPorAcumulacionDePagos() && $flag) ) {

                 $fecha = (Object) Ctrl\calcularFecha(
                    $this->fecha_inicial, 
                    $this->credito->precredito->periodo, 
                    1, 
                    $this->credito->precredito->p_fecha, 
                    $this->credito->precredito->s_fecha,
                    false 
                );

                $temp['ini'] = Ctrl\Ymd($fecha->fecha_ini);
                $temp['fin'] = Ctrl\Ymd($fecha->fecha_fin);

                $this->fecha_inicial = Ctrl\Ymd($fecha->fecha_fin);

            } else {

                $temp['ini'] = Ctrl\Ymd($cta_parcial->pago_hasta);
                $temp['fin'] = Ctrl\Ymd($cta_parcial->pago_hasta);
            }

            $temp['cant'] = 1;
            $temp['concepto'] = 'Cuota Parcial';
            $temp['subtotal'] = $abono;

            $this->contenedor[] = $temp;
        }
    }

    /**
     * pagoCuota
     */

    public function pagoCuota () 
    {
        $vlr_cuota = $this->credito->precredito->vlr_cuota;
        $cts_pagar = $this->monto / $vlr_cuota;
        $cts_pagadas = 0;
        $temp = $this->struct();

        if ( ($cts_pagar >= 1) && ($cts_pagar < $this->cts_faltantes) ) {
            $cts_pagadas = intval($cts_pagar);
        } else if ($cts_pagar >= $this->cts_faltantes) {
            $cts_pagadas = $this->cts_faltantes;
        }

        $this->cts_faltantes -= $cts_pagadas;
        $abono = $cts_pagadas * $vlr_cuota;
        $this->monto -=  $abono;

        if ($cts_pagadas > 0) {

            $fecha = (Object) Ctrl\calcularFecha(
                $this->fecha_inicial, 
                $this->credito->precredito->periodo, 
                $cts_pagadas, 
                $this->credito->precredito->p_fecha, 
                $this->credito->precredito->s_fecha, 
                false
            );

            $temp['cant'] = $cts_pagadas;
            $temp['concepto'] = 'Cuota';
            $temp['ini'] = Ctrl\Ymd($fecha->fecha_ini);
            $temp['fin'] = Ctrl\Ymd($fecha->fecha_fin);
            $temp['subtotal'] = $abono;

            $this->contenedor[] = $temp;
            $this->fecha_inicial = Ctrl\Ymd($fecha->fecha_fin);
        }
    }

    /**
     * pagoCuotaParcialPrimeraVez
     */


    public function pagoCuotaParcialPrimeraVez () 
    {
        $temp = $this->struct();

        // Si el monto de la cuota parcial es igual o mayor al % de cuota permitido

        if ($this->monto >= $this->vlr_permitido) {

            $fecha = (Object) Ctrl\calcularFecha(
                $this->fecha_inicial, 
                $this->credito->precredito->periodo, 
                1, 
                $this->credito->precredito->p_fecha, 
                $this->credito->precredito->s_fecha, 
                false
            );

            $temp['ini'] = Ctrl\Ymd($fecha->fecha_ini);
            $temp['fin'] = Ctrl\Ymd($fecha->fecha_fin);

            $this->fecha_inicial = Ctrl\Ymd($fecha->fecha_fin);

        } else {

            $temp['ini'] = Ctrl\Ymd($this->fecha_inicial);
            $temp['fin'] = Ctrl\Ymd($this->fecha_inicial);

            $temp['marcado'] = true;
        }

        $temp['cant'] = 1;
        $temp['concepto'] = 'Cuota Parcial';
        $temp['subtotal'] = $this->monto;

        $this->monto = 0;
        $this->contenedor[] = $temp;
    }

    /**
     * Totales
     */

    public function totales()
    {
        $temp = $this->struct();

        $temp['concepto'] = 'Total';
        $temp['subtotal'] = $this->total_pago;

        $this->contenedor[] = $temp;
    }


    /**
     * saldoFavor
     */

    public function saldoFavor()
    {
        $temp = $this->struct();
        $temp['concepto'] = 'Saldo a Favor';
        $temp['subtotal'] = $this->monto;

        $this->contenedor[] = $temp;
    }


    /**
     * Retorna una estructura de datos
     * donde se almacenaran c/u de los conceptos de pago
     */

    public function struct () 
    {
        return  [ 
            'cant'      => '', 
            'concepto'  => '',  
            'ini'       => '', 
            'fin'       => '', 
            'subtotal'  => '', 
            'marcado'   => false
        ];
    }

    /**
     * Evalua si los pagos parciales hechos sobre una misma cuota
     * no han movido la fecha de pago.
     * Se sabe que la fecha de pago no se ha movido si 
     * el pago_desde == pago_hasta
     */

    public function moverFechaPorAcumulacionDePagos()
    {
        $pagos = DB::table('pagos')
            ->where([['credito_id', $this->credito->id],['concepto', 'Cuota Parcial']])
            ->orderBy('id', 'DESC')
            ->get();

        $flag = false;
        $arr = [];
        $count = count($pagos);


        for ($i=0; $i < $count; $i++) { 
        
            if ($pagos[$i]->debe > 0) {
                $arr[] = $pagos[$i];
            } else {
                $i = $count; 
            }
        }
    
        $flag_move = true;

        foreach ($arr as $element) {
            if ($element->pago_desde != $element->pago_hasta) {
                $flag_move = false;
            }
        }

        return $flag_move;
    }

}