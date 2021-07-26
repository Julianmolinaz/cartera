<?php

use Illuminate\Database\Seeder;

class EstDatacreditosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('est_datacreditos')->delete();
        
        \DB::table('est_datacreditos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'criterio' => 'E',
                'puntaje' => 5,
            ),
            1 => 
            array (
                'id' => 2,
                'criterio' => 'A',
                'puntaje' => 4,
            ),
            2 => 
            array (
                'id' => 3,
                'criterio' => 'B',
                'puntaje' => 3,
            ),
            3 => 
            array (
                'id' => 4,
                'criterio' => 'C',
                'puntaje' => 2,
            ),
            4 => 
            array (
                'id' => 5,
                'criterio' => '7',
                'puntaje' => 2,
            ),
            5 => 
            array (
                'id' => 6,
                'criterio' => 'P',
                'puntaje' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'criterio' => 'Otros',
                'puntaje' => 1,
            ),
        ));
        
        
    }
}
