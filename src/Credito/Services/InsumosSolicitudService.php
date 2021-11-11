<?php

namespace Src\Credito\Services;
use DB;


class InsumosSolicitudService
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
            'arr_estudios'         => $this->getEstudios(),
            'arr_periodos'         => $this->getArrPeriodos(),
            'carteras'             => $this->getCarteras(),
            'estados_aprobacion'   => $this->getEstadosAprobacion(),
            'now'                  => $this->getNow(),
            'rango_meses'          => $this->getRange(),
            'variables'            => $this->getVariables(),
            'vendedores'           => $this->getVendedores(),
            'puntos'               => $this->getPuntos(),
        ];
    }

    private function getCarteras()
    {
        $carteras = DB::table('carteras')
            ->where('estado', 'Activo')
            ->select('id', 'nombre')
            ->orderBy('nombre')
            ->get();

        return $carteras;
    }

    private function getNow()
    {
        $now = \Carbon\Carbon::now();

        return $now;
    }

    private function getEstadosAprobacion()
    {
        $estados_aprobacion = getEnumValues2('precreditos', 'aprobado');

        return $estados_aprobacion;
    }

    private function getArrPeriodos()
    {
        $arr_periodos = getEnumValues2('precreditos', 'periodo');

        return $arr_periodos;
    }

    private function getEstudios()
    {
        $arr_estudios = getEnumValues2('precreditos', 'estudio');

        return $arr_estudios;
    }

    private function getRange()
    {
        $range = [];
        $variables = DB::table('variables')->first();

        foreach (range($variables->meses_min, $variables->meses_max) as $numero) {
            $range[] = $numero;
        }

        return $range;
    }

    private function getVendedores()
    {
        $vendedores = DB::table('users')
            ->select('id','name','punto_id')
            ->orderBy('name')
            ->where('estado','activo')
            ->where('id','<>',1)
            ->get();

        return $vendedores;
    }

    private function getVariables()
    {
        $variables = DB::table('variables')
            ->orderBy('id')
            ->find(1);
        
        return $variables;
    }

    private function getPuntos()
    {
        $variables = DB::table('puntos')
            ->select('id', 'nombre')
            ->orderBy('nombre')
            ->get();
        
        return $variables;
    }
}