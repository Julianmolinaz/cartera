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
            $this->struct['carteraTotalNo'] += $this->report[$i]['carteraTotalNo'];

            foreach(['alDia','ideal','alerta','critica','prejuridico','castigada','juridicoSinCastigar'] as $status) {
                $this->struct[$status]['cartera$'] += $this->report[$i][$status]['cartera$'];
                $this->struct[$status]['carteraNo'] += $this->report[$i][$status]['carteraNo'];
        
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

                $this->report[$i]['alDia']['indicador'] = round($this->report[$i]['alDia']['cartera$'] / $carteraTotal, 2);
                $this->report[$i]['ideal']['indicador'] = round($this->report[$i]['ideal']['cartera$'] / $carteraTotal, 2);
                $this->report[$i]['alerta']['indicador'] = round($this->report[$i]['alerta']['cartera$']  / $carteraTotal, 2);
                $this->report[$i]['critica']['indicador'] = round($this->report[$i]['critica']['cartera$'] / $carteraTotal, 2);
                $this->report[$i]['prejuridico']['indicador'] = round($this->report[$i]['prejuridico']['cartera$'] / $carteraTotal, 2);
                $this->report[$i]['castigada']['indicador'] = round($this->report[$i]['castigada']['cartera$'] / $carteraTotal, 2);
            }          
        }
    }

    /**
     * total cartera en el punto
     */

    public function totalizarPorPuntoTr()
    {

        for ($i=0; $i < count($this->report); $i++) { 
            $this->report[$i]['carteraTotal$'] = round(
                        $this->report[$i]['alDia']  ['cartera$'] +
                        $this->report[$i]['ideal']  ['cartera$'] +
                        $this->report[$i]['alerta'] ['cartera$'] +
                        $this->report[$i]['critica']['cartera$'] +
                        $this->report[$i]['prejuridico']['cartera$'],0);
 
            $this->report[$i]['carteraTotalNo'] =  round(
                        $this->report[$i]['alDia']  ['carteraNo'] +
                        $this->report[$i]['ideal']  ['carteraNo'] +
                        $this->report[$i]['alerta'] ['carteraNo'] +
                        $this->report[$i]['critica']['carteraNo'] +
                        $this->report[$i]['prejuridico']['carteraNo']);            
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
                $this->report[$i][$status]['carteraNo'] ++;
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