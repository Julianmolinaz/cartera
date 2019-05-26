<?php

namespace App\Traits\Cartera;

use Illuminate\Http\Request;
use DB;

trait ReportCarteraTrait{

    /**
     * sumatoria de la cartera de los puntos
     */

    public function totalizarTodaLaCarteraTr()
    {
        $this->getStructTr();
        $this->struct['puntoId'] = '';
        $this->struct['punto']   = '';

        for ($i=0; $i < count($this->report); $i++) { 

            $this->struct['carteraTotal$'] += $this->report[$i]['carteraTotal$'];
            $this->struct['carteraTotal#'] += $this->report[$i]['carteraTotal#'];

            foreach(['alDia','ideal','alerta','critica','prejuridico','castigada','juridicoSinCastigar'] as $status) {
                $this->struct[$status]['cartera$'] += $this->report[$i][$status]['cartera$'];
                $this->struct[$status]['cartera#'] += $this->report[$i][$status]['cartera#'];
        
            }
        }

        array_push($this->report, $this->struct);
    }

    /**
     * Genera los indicadores de c/u de los puntos
     */
    public function generarIndicadoresTr()
    {
        for ($i=0; $i < count($this->report); $i++) { 

            if($this->report[$i]['carteraTotal$'] > 0) {

                $carteraTotal = $this->report[$i]['carteraTotal$'];

                $this->report[$i]['alDia']['indicador'] = $this->report[$i]['alDia']['cartera$'] / $carteraTotal;
                $this->report[$i]['ideal']['indicador'] = $this->report[$i]['ideal']['cartera$'] / $carteraTotal;
                $this->report[$i]['alerta']['indicador'] = $this->report[$i]['alerta']['cartera$']  / $carteraTotal;
                $this->report[$i]['critica']['indicador'] = $this->report[$i]['critica']['cartera$'] / $carteraTotal;
                $this->report[$i]['prejuridico']['indicador'] = $this->report[$i]['prejuridico']['cartera$'] / $carteraTotal;
                $this->report[$i]['castigada']['indicador'] = $this->report[$i]['castigada']['cartera$'] / $carteraTotal;
            }          
        }
    }

    /**
     * total cartera en el punto
     */

    public function totalizarPorPuntoTr()
    {
        for ($i=0; $i < count($this->report); $i++) { 
            $this->report[$i]['carteraTotal$'] = 
                        $this->report[$i]['alDia']  ['cartera$'] +
                        $this->report[$i]['ideal']  ['cartera$'] +
                        $this->report[$i]['alerta'] ['cartera$'] +
                        $this->report[$i]['critica']['cartera$'];

            $this->report[$i]['carteraTotal#'] = 
                        $this->report[$i]['alDia']  ['cartera#'] +
                        $this->report[$i]['ideal']  ['cartera#'] +
                        $this->report[$i]['alerta'] ['cartera#'] +
                        $this->report[$i]['critica']['cartera#'];            
        }
    }

    /**
     * sumatoria de los saldos de c/u de los creditos
     * segun la clasificación: 'al dia', 'mora', 'prejuridico', etc... 
     * @recibe un objeto credito
     */

    public function agregarSaldoTr($credito)
    {
        $status = $this->getStatusTr($credito);

        for ($i=0; $i < count($this->report); $i++) { 
            
            if ( $this->report[$i]['puntoId'] == $credito->punto_id ) {

                $this->report[$i][$status]['cartera$'] += $credito->saldo;
                $this->report[$i][$status]['cartera#'] ++;
            }
        }
    }

    /**
     * genera el estatus del credito que puede ser
     * 'alDia', 'ideal','alerta','critica','prejuridico','castigada',
     * 'juridicoSinCastigar'
     * @recibe un objeto credito
     */

    public function getStatusTr($credito)
    {
        if ($credito->castigada == 'Si') {
            $status = 'castigada';
        } 
        else {
            if ($credito->estado == 'Al dia' || $credito->estado == 'Mora') {
                $status = $this->translateTypeMoraTr($this->tipoMorosoTr($credito));  
            } 
            else if ($credito->estado == 'Prejuridico') {
                $status = 'prejuridico';
            }
            else {
                $status = 'juridicoSinCastigar';
            }
        }

        return $status;
    }

}