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
        

        \DB::table('bancos')->delete();
        
        \DB::table('bancos')->insert(array (
            0 => 
            array (
                
                'nombre' => 'Banco Agrario',
                'estado' => 'Activo',
            ),
            1 => 
            array (
                
                'nombre' => 'Banco AV Villas',
                'estado' => 'Activo',
            ),
            2 => 
            array (
                
                'nombre' => 'Banco Caja Social',
                'estado' => 'Activo',
            ),
            3 => 
            array (
                
                'nombre' => 'Banco de Occidente',
                'estado' => 'Activo',
            ),
            4 => 
            array (
                
                'nombre' => 'Banco Popular',
                'estado' => 'Activo',
            ),
            5 => 
            array (
                
                'nombre' => 'Bancóldex',
                'estado' => 'Activo',
            ),
            6 => 
            array (
                
                'nombre' => 'Bancolombia',
                'estado' => 'Activo',
            ),
            7 => 
            array (
                
                'nombre' => 'BBVA',
                'estado' => 'Activo',
            ),
            8 => 
            array (
                
                'nombre' => 'Banco de Bogotá',
                'estado' => 'Activo',
            ),
            9 => 
            array (
                
                'nombre' => 'Citi',
                'estado' => 'Activo',
            ),
            10 => 
            array (
                
                'nombre' => 'Colpatria',
                'estado' => 'Activo',
            ),
            11 => 
            array (
                
                'nombre' => 'Davivienda',
                'estado' => 'Activo',
            ),
            12 => 
            array (
                
                'nombre' => 'GNB Sudameris',
                'estado' => 'Activo',
            ),
            13 => 
            array (
                
                'nombre' => 'Apostar',
                'estado' => 'Activo',
            ),
            14 => 
            array (
                
                'nombre' => 'Unificacion',
                'estado' => 'Activo',
            ),
            15 => 
            array (
                
                'nombre' => 'PSE AV VILLAS',
                'estado' => 'Activo',
            ),
            16 => 
            array (
       
                'nombre' => 'Apostar',
                'estado' => 'Activo',
            ),
            17 => 
            array (

                'nombre' => 'Gana Gana',
                'estado' => 'Activo',
            ),
            18 => 
            array (
         
                'nombre' => 'Su Suerte',
                'estado' => 'Activo',
            ),
            19 => 
            array (
          
                'nombre' => 'Asistimotos',
                'estado' => 'Activo',
            )
        ));
        
        
    }
}
