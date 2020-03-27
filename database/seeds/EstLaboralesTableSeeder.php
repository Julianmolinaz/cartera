<?php

use Illuminate\Database\Seeder;

class EstLaboralesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('est_laborales')->delete();
        
        \DB::table('est_laborales')->insert(array (
            0 => 
            array (
                'id' => 1,
            'criterio' => 'Dependiente mayor de dos (2) años',
                'puntaje' => 5,
            ),
            1 => 
            array (
                'id' => 2,
            'criterio' => 'Dependiente mayor de un (1) año',
                'puntaje' => 4,
            ),
            2 => 
            array (
                'id' => 3,
            'criterio' => 'Dependiente menor o igual a un (1) año',
                'puntaje' => 3,
            ),
            3 => 
            array (
                'id' => 4,
                'criterio' => 'Dependiente menor de 6 meses',
                'puntaje' => 2,
            ),
            4 => 
            array (
                'id' => 5,
            'criterio' => 'Independiente mayor de tres (3) años sin Cámara',
                'puntaje' => 4,
            ),
            5 => 
            array (
                'id' => 6,
            'criterio' => 'Independiente mayor de tres (3) años con Cámara',
                'puntaje' => 5,
            ),
            6 => 
            array (
                'id' => 7,
            'criterio' => 'Independiente mayor de un (1) año',
                'puntaje' => 3,
            ),
            7 => 
            array (
                'id' => 8,
            'criterio' => 'Independiente menor de un (1) año',
                'puntaje' => 2,
            ),
        ));
        
        
    }
}
