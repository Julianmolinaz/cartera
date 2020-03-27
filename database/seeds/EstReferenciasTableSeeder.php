<?php

use Illuminate\Database\Seeder;

class EstReferenciasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('est_referencias')->delete();
        
        \DB::table('est_referencias')->insert(array (
            0 => 
            array (
                'id' => 1,
            'criterio' => 'Validacion cuatro (4) referencias',
                'puntaje' => 5,
            ),
            1 => 
            array (
                'id' => 2,
            'criterio' => 'Validacion tres (3) referencias',
                'puntaje' => 4,
            ),
            2 => 
            array (
                'id' => 3,
            'criterio' => 'Validacion dos (2) referencias',
                'puntaje' => 3,
            ),
            3 => 
            array (
                'id' => 4,
            'criterio' => 'Dos (2) referencias inconsistentes',
                'puntaje' => 1,
            ),
            4 => 
            array (
                'id' => 5,
            'criterio' => 'Una (1) referencia inconsistente',
                'puntaje' => 2,
            ),
            5 => 
            array (
                'id' => 6,
                'criterio' => 'Referencias no favorables',
                'puntaje' => 0,
            ),
        ));
        
        
    }
}
