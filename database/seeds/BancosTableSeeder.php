<?php

use Illuminate\Database\Seeder;

class BancosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
       // CONFIGURACION 

        \DB::table('bancos')->delete();
        
        \DB::table('bancos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Banco Agrario',
                'estado' => 'Activo',
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Banco AV Villas',
                'estado' => 'Activo',
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'Banco Caja Social',
                'estado' => 'Activo',
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'Banco de Occidente',
                'estado' => 'Activo',
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'Banco Popular',
                'estado' => 'Activo',
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'Bancóldex',
                'estado' => 'Activo',
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'Bancolombia',
                'estado' => 'Activo',
            ),
            7 => 
            array (
                'id' => 8,
                'nombre' => 'BBVA',
                'estado' => 'Activo',
            ),
            8 => 
            array (
                'id' => 9,
                'nombre' => 'Banco de Bogotá',
                'estado' => 'Activo',
            ),
            9 => 
            array (
                'id' => 10,
                'nombre' => 'Citi',
                'estado' => 'Activo',
            ),
            10 => 
            array (
                'id' => 11,
                'nombre' => 'Colpatria',
                'estado' => 'Activo',
            ),
            11 => 
            array (
                'id' => 12,
                'nombre' => 'Davivienda',
                'estado' => 'Activo',
            ),
            12 => 
            array (
                'id' => 13,
                'nombre' => 'GNB Sudameris',
                'estado' => 'Activo',
            ),
            13 => 
            array (
                'id' => 14,
                'nombre' => 'Apostar',
                'estado' => 'Activo',
            ),
            14 => 
            array (
                'id' => 15,
                'nombre' => 'Gana Gana',
                'estado' => 'Activo',
            ),
            15 => 
            array (
                'id' => 16,
                'nombre' => 'Su Suerte',
                'estado' => 'Activo',
            ),
            16 => 
            array (
                'id' => 17,
                'nombre' => 'Asistimotos',
                'estado' => 'Activo',
            ),
        ));
        
        
    }
}
