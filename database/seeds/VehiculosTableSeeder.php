<?php

use Illuminate\Database\Seeder;

class VehiculosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('vehiculos')->delete();
        
        \DB::table('vehiculos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'placa' => '6GYJ4',
                'vencimiento_soat' => '2000-01-01',
                'vencimiento_rtm' => '2000-01-01',
                'tipo_vehiculo_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'placa' => 'JGHU7',
                'vencimiento_soat' => '2000-01-01',
                'vencimiento_rtm' => '2000-01-01',
                'tipo_vehiculo_id' => 7,
            ),
            2 => 
            array (
                'id' => 3,
                'placa' => 'JFR8',
                'vencimiento_soat' => '2000-01-01',
                'vencimiento_rtm' => '2000-01-01',
                'tipo_vehiculo_id' => 7,
            ),
            3 => 
            array (
                'id' => 4,
                'placa' => 'JFR8',
                'vencimiento_soat' => '2000-01-01',
                'vencimiento_rtm' => '2000-01-01',
                'tipo_vehiculo_id' => 7,
            ),
            4 => 
            array (
                'id' => 5,
                'placa' => 'KGKI98',
                'vencimiento_soat' => '2000-01-01',
                'vencimiento_rtm' => '2000-01-01',
                'tipo_vehiculo_id' => 3,
            ),
        ));
        
        
    }
}
