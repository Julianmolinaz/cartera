<?php

use Illuminate\Database\Seeder;

class EstViviendasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('est_viviendas')->delete();
        
        \DB::table('est_viviendas')->insert(array (
            0 => 
            array (
                'id' => 1,
            'criterio' => 'Mayor a tres (3) años familiar o propia',
                'puntaje' => 5,
            ),
            1 => 
            array (
                'id' => 2,
            'criterio' => 'Mayor a tres (3) años alquilada',
                'puntaje' => 5,
            ),
            2 => 
            array (
                'id' => 3,
            'criterio' => 'Mayor a dos (2) años',
                'puntaje' => 4,
            ),
            3 => 
            array (
                'id' => 4,
            'criterio' => 'Menor a dos (2) años',
                'puntaje' => 3,
            ),
            4 => 
            array (
                'id' => 5,
            'criterio' => 'Menor a un (1) año',
                'puntaje' => 2,
            ),
            5 => 
            array (
                'id' => 6,
            'criterio' => 'Menor a cuatro (4) meses',
                'puntaje' => 1,
            ),
        ));
        
        
    }
}
