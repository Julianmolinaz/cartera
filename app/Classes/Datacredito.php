<?php

namespace App\Classes;

class Datacredito
{
    protected $tipo_entrega;

    // public function __construct()
    // {
    //     // $this->tipo_entrega = $tipo_entrega;
    // }

    public function make()
    {
        // $registro_de_control = $this->getHeaderReport();
    }

    // public function getHeaderReport()
    // {
    //     if ($this->tipo_entrega == 'T') {

    //         $fecha_inicio_reporte = '00000000';
    //         $fecha_fin_reporte = '00000000';

    //     } else if ($this->tipo_entrega == 'F') {

    //         $fecha_inicio_reporte = '';
    //         $fecha_fin_reporte = '00000000';
    //     }

    //     $registro_de_control = array(
    //         '1.1-indicador_inicial'     => 'HHHHHHHHHHHHHHHHHH', // 18 caracteres en H
    //         '1.2-codigo_suscriptor'     => '116881', // POR DEFINIR
    //         '1.3-tipo_cuenta'           => '11', //CREDITOS DE BAJO MONTO
    //         '1.4-fecha_corte'           => fecha_plana_Ymd($f_corte), // FECHA FORMATO YYYYMMDD
    //         '1.5-ampliacion_milenio'    => 'M',  //CUANDO EL AÑO ES DE 4 DIGITOS
    //         '1.6-indicador_miles'       => '0',  //????????????????????????????
    //         '1.7-tipo_entrega'          => 'T',  //Si el Maestro es completo y corresponde a la actualización total del mes
    //         '1.8-fecha_inicio_reporte'  => $fecha_fin_reporte, 
    //         '1.9-fecha_fin_reporte'     => $fecha_fin_reporte,
    //         '1.10-indicador_partir'     => 'N', //Si la entidad necesita que el maestro sea partido en varios maestros
    //         '1.11-filler'               => '00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000', //746 posiciones en 0
    //     );
    // }
}
