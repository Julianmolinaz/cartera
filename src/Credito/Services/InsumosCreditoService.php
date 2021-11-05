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
        dd($this->struct());
        return $this->struct();
    }

    private function struct()
    {
        return [ 
            'estados'         => $this->getEstados()
        ];
    }

    private function getEstados()
    {
        $estados = getEnumValues2('creditos', 'estado');
        
        return $estados;
    }
}
