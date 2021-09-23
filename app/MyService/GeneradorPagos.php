<?php

namespace App\MyService;
use App\Http\Controllers as Ctrl;

use App as _;
use DB;

class GeneradorPagos
{
    protected $monto;
    protected $credito;
    protected $contenedor;
    protected $r;
    protected $date;
    protected $date_ini;
    protected $primera_cuota;
    protected $cuotas_incompletas;
    protected $cuotas_completas;
    

    public function __construct($monto, $credito_id)
    {
        $this->monto = $monto;
        $this->credito = _\Credito::find($credito_id);
    }

    // RETORNA CADA TIPO DE PAGO
    public function make() 
    {
            // PAGO A JURIDICO
        if ($this->monto > 0 ) $this->pagoJuridico();

            // PAGO A PREJURIDICO
        if ($this->monto > 0 ) $this->pagoPrejuridico();

            // PAGO A SANCIONES
        if ($this->monto > 0 ) $this->pagoSanciones();

            // PAGO CUOTA PARCIAL 2da VEZ
        if ($this->monto > 0 ) $this->pagoCuotaParcial2Vez();
        
            // PAGO CUOTA
        if ($this->monto > 0 ) $this->pagoCuota();
        
            // PAGO CUOTA PARCIAL 1ra VEZ
        if ($this->monto > 0 ) $this->pagoCuotaParcial1Vez();

        dd($this->contenedor,$this->monto);
    }

    // PAGO A JURIDICO
    public function pagoJuridico()
    {
        $sancion_juridico = DB::table('extras')
            ->where('credito_id',$this->credito->id)
            ->where('concepto','Juridico')
            ->where('estado','Debe')
            ->get();

        if (count($sancion_juridico) > 0) {
        
            $juridico = DB::table('pagos')
                ->where('credito_id',$this->credito->id)
                ->where('concepto','Juridico')
                ->where('estado','Debe')
                ->get();;

            if (count($juridico) > 0 ) { 
                if ($this->monto > $juridico[0]->debe) { 

                    $abono = $juridico[0]->debe;
                    $this->monto = $this->monto - $abono; 

                } else {
                    $abono = $this->monto;
                    $this->monto = 0; 
                }

            }  else {
                if ($this->monto > $sancion_juridico[0]->valor) {
                
                    $this->abono = $sancion_juridico[0]->valor;
                    $this->monto = $this->monto - $abono;
                
                } else {
                    
                    $abono = $this->monto;
                    $this->monto = 0; 
                }           
            }

            $temp = [ 
                    'cant' => 1, 
                    'concepto' => 'Juridico', 
                    'ini' => '', 
                    'fin' => '', 
                    'subtotal' => $abono,
                    'marcado' => false 
                ];

            $this->contenedor[] = $temp;
        }

    }

    // PAGO A PREJURIDICO
    public function pagoPrejuridico()
    {
        $sancion_prejuridico = DB::table('extras')
            ->where('credito_id',$this->credito->id)
            ->where('concepto','Prejuridico')
            ->where('estado','Debe')
            ->get();

        if (count($sancion_prejuridico) > 0) {
            $prejuridico = DB::table('pagos')
                ->where('credito_id',$this->credito->id)
                ->where('concepto','Prejuridico')
                ->where('estado','Debe')
                ->get();

            if (count($prejuridico) > 0 ) {                               
                if ($this->monto > $prejuridico[0]->debe) { 
                    $abono = $prejuridico[0]->debe;
                    $this->monto -= $abono; 
                } else {
                    $abono = $this->monto;
                    $this->monto = 0; 
                }
            }  
            else{
                if ($this->monto > $sancion_prejuridico[0]->valor) {
                    $abono = $sancion_prejuridico[0]->valor;
                    $this->monto -= $abono; 
                } else {
                    $abono = $this->monto;
                    $this->monto = 0; 
                }  
            }
            
            $temp = [ 
                'cant' => 1, 
                'concepto' => 'Prejuridico', 
                'ini' => '', 
                'fin' => '', 
                'subtotal' => $abono, 
                'marcado' => false 
            ];

            $this->contenedor[] = $temp; 
        }
    }

    // PAGO A SANCIONES
    public function pagoSanciones()
    {
        $dia_sancion = _\Variable::find(1)->vlr_dia_sancion;
        $contador = 0;
        $monto_por_sancion = 0;

        $sanciones = DB::table('sanciones')
            ->where('credito_id',$this->credito->id)
            ->where('estado','Debe')
            ->get();

        $hay_sanciones = count($sanciones) > 0;


        if ($hay_sanciones) {

            foreach ($sanciones as $sancion) {
                if ($this->monto >= $dia_sancion) {
                    $monto_por_sancion += $dia_sancion;
                    $this->monto -= $sancion->valor;
                    $contador++;
                }
            }

            $temp = [ 
                'cant' => $contador, 
                'concepto' => 'Mora',  
                'ini' => '', 
                'fin' => '', 
                'subtotal' => $monto_por_sancion, 
                'marcado' => false
            ];

            $this->contenedor[] = $temp;
        }
    }

    // PAGO CUOTA PARCIAL 2da VEZ

    public function pagoCuotaParcial2Vez()
    {
        $pagos_parciales = DB::table('pagos')
            ->where('credito_id',$this->credito->id)
            ->where('concepto','Cuota Parcial')
            ->where('estado','Debe')
            ->orderBy('pago_hasta','asc')
            ->get();

        if (count($pagos_parciales) > 0) {  

            foreach ($pagos_parciales as $pago) {

                if ($this->monto > $pago->debe) {

                    $this->abono = $pago->debe; 
                    $this->monto -= $abono; 

                } else {
                    
                    $abono = $this->monto;
                    $this->monto = 0; 
                }

                $temp = [ 
                    'cant'  => 1, 
                    'concepto' => 'Cuota Parcial', 
                    'ini' => $pago->pago_desde, 
                    'fin'   => $pago->pago_hasta, 
                    'subtotal' => $abono, 
                    'marcado' => false 
                ];

                $this->contenedor[] = $temp;
                $this->date_ini = $pago->pago_desde;
            }               
        }  
    }
    
    // PAGO CUOTA   
    public function pagoCuota()
    {
        $cuotas = $this->monto / $this->credito->precredito->vlr_cuota;

        if ($cuotas > $this->credito->cuotas_faltantes ) {
            $cuotas = $this->credito->cuotas_faltantes;
        }

        $this->cuotas_completas   = intval($cuotas);
        $this->cuotas_incompletas = ceil($cuotas) - $this->cuotas_completas;
        $this->date = $this->credito->fecha_pago->fecha_pago;

        if ($this->cuotas_completas > 0) {

            $fecha = (object) Ctrl\calcularFecha (
                $this->credito->fecha_pago->fecha_pago, 
                $this->credito->precredito->periodo, 
                $this->cuotas_completas, 
                $this->credito->precredito->p_fecha, 
                $this->credito->precredito->s_fecha,
                false
            );

            $monto_cuota = 
                $this->cuotas_completas * 
                $this->credito->precredito->vlr_cuota;

            $this->monto -= $monto_cuota;

            $temp = [ 
                'cant'      => $this->cuotas_completas,  
                'concepto'  => 'Cuota', 
                'ini'       => $fecha->fecha_ini, 
                'fin'       => $fecha->fecha_fin, 
                'subtotal'  => $monto_cuota,       
                'marcado'   => false 
            ];

            $this->contenedor[]   = $temp;
            $this->date           = $fecha->fecha_fin; 
            $this->date_ini       = $fecha->fecha_ini;
            $this->primera_cuota  = false;
        }
    }

        // PAGO CUOTA PARCIAL 1ra VEZ
    public function pagoCuotaParcial1Vez()
    {
        $fecha = (object) Ctrl\calcularFecha(
            $this->date, 
            $this->credito->precredito->periodo, 
            $this->cuotas_incompletas,
            $this->credito->precredito->p_fecha, 
            $this->credito->precredito->s_fecha,
            false 
        );

        // CALCULAR PORCENTAJE
        $vlr_cuota = $this->credito->precredito->vlr_cuota;
        $vlr_monto_permitido = 
            $vlr_cuota * 
            intval($this->credito->precredito->cartera->porcentaje_pago_parcial) / 100; 

        if (
            $this->monto >= $vlr_monto_permitido || 
            $this->credito->permitir_mover_fecha
            ) {

            $temp = [ 
                'cant'      => $this->cuotas_incompletas,
                'concepto'  => 'Cuota Parcial', 
                'ini'       => Ctrl\inv_fech($fecha->fecha_ini),
                'fin'       => Ctrl\inv_fech($fecha->fecha_fin), 
                'subtotal'  => $this->monto,             
                'marcado'   => false 
            ];

        } else {

        $temp = [
                'cant'      => $this->cuotas_incompletas,
                'concepto'  => 'Cuota Parcial', 
                'ini'       => $this->date_ini,                 
                'fin'       => $this->date, 
                'subtotal'  => $this->monto,             
                'marcado'   => true 
            ];  
        }

        $this->contenedor[] = $temp;


        $sin_mover_fecha = [ 
            'cant'      => $this->cuotas_incompletas,
            'concepto'  => 'Cuota Parcial', 
            'ini'       => $this->date_ini,                 
            'fin'       => $this->date, 
            'subtotal'  => $this->monto,             
            'marcado'   => true 
        ]; 
    }

}