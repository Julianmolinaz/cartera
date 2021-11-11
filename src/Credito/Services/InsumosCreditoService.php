<?php

namespace Src\Credito\Services;
use DB;


class InsumosCreditoService
{
    public function __construct()
    {

    }

    public function execute() 
    {  
        return $this->struct();
    }

    private function struct()
    {
        return [ 
            'estado'    => $this->getEstados(),
            'castigada' => $this->getCastigada(),
            'mes'       => $this->getMesRef(),
            'anio'      => $this->getAnioRef()
        ];
    }

    private function getEstados()
    {
        $estado = getEnumValues2('creditos', 'estado');
        
        return $estado;
    }

    private function getCastigada()
    {
        $castigada = getEnumValues2('creditos', 'castigada');
        
        return $castigada;
    }

    private function getMesRef()
    {
        $mes = getEnumValues2('creditos', 'mes');
        
        return $mes;
    }

    private function getAnioRef()
    {
        $anio = \Carbon\Carbon::now();
        $anios = [$anio->year -1, $anio->year];

        return $anios;
    }
}
