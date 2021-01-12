<?php

namespace App\Traits\Cartera;

use Exception;
use Illuminate\Http\Request;
use App\Codeudor;
use App\Conyuge;
use App\Cliente;
use App\Soat;
use Auth;
use DB;

trait StructTrait{

    /**
     * retorna la estructura de cada registro del reporte
     */

    public function getStructTr()
    {
        return [
            'carteraId' => '',
            'cartera'   => '',
            'puntoId'   => '',
            'punto'     => '',
            'carteraTotal$' => 0,
            'carteraTotalNo' => 0,
            'alDia'  => [
                'cartera$' => 0,
                'carteraNo' => 0,
                'indicador' => 0
            ],
            'ideal'  => [
                'cartera$' => 0,
                'carteraNo' => 0,
                'indicador' => 0
            ],
            'alerta'  => [
                'cartera$' => 0,
                'carteraNo' => 0,
                'indicador' => 0
            ],
            'critica' => [
                'cartera$' => 0,
                'carteraNo' => 0,
                'indicador' => 0
            ],
            'prejuridico' => [
                'cartera$' => 0,
                'carteraNo' => 0,
                'indicador' => 0
            ],
            'castigada' => [
                'cartera$' => 0,
                'carteraNo' => 0,
                'indicador' => 0
            ],
            'juridicoSinCastigar' => [
                'cartera$' => 0,
                'carteraNo' => 0,
                'indicador' => 0 
            ]
        ];
    }

    /**
     * Agrega la cartera a la estructura
     * @recibe un objeto cartera
     */

    public function setCarteraStructTr($cartera)
    {
        $this->struct['carteraId'] = $cartera->id;
        $this->struct['cartera']   = $cartera->nombre;
    }

    /**
     * crea un registro por c/u de los puntos
     */

    public function setPuntosStructTr()
    {
        $puntos = DB::table('puntos')
            ->groupBy('nombre')
            ->orderBy('nombre','ASC')
            ->get();

        //asignacion de carteras a c/u de las estructuras
        foreach($puntos as $punto) {
            $this->struct = $this->struct;
            $this->struct['puntoId'] = $punto->id;
            $this->struct['punto'] = $punto->nombre;
            array_push($this->report, $this->struct);
        }
    }

    /**
     * Retorna una estructura dotada de cartera 
     * y puntos
     * @input objeto cartera
     */

    public function setStructTr($cartera)
    {
        $this->setCarteraStructTr($cartera);
        $this->setPuntosStructTr();
    }


}
