<?php

use Illuminate\Database\Seeder; 

class TipoVehiculosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tipo_vehiculos')->delete();
        
        \DB::table('tipo_vehiculos')->insert(array (

        
            // [
            //     'id' => 1,
            //     'nombre' => 'Moto',
            //     'estado' => ''
            // ],

        
            [
                'id' => 2,
                'nombre' => 'Moto',
                'estado' => ''
            ],

        
            [
                'id' => 3,
                'nombre' => 'Motocarro',
                'estado' => ''
            ],

        
            [
                'id' => 4,
                'nombre' => 'Camperos y Camionetas',
                'estado' => ''
            ],

        
            [
                'id' => 5,
                'nombre' => 'Carga o Mixto',
                'estado' => ''
            ],

        
            [
                'id' => 6,
                'nombre' => 'Oficiales Especiales',
                'estado' => ''
            ],

        
            [
                'id' => 7,
                'nombre' => 'Autos Familiares',
                'estado' => ''
            ],
            
        
            [
                'id' => 8,
                'nombre' => 'Vehiculos 6 o + pasajeros',
                'estado' => ''
            ],

        
            [
                'id' => 9,
                'nombre' => 'Autos Servicio Publico',
                'estado' => ''
            ],

        
            [
                'id' => 10,
                'nombre' => 'Bus Buseta Servicio Publico',
                'estado' => ''
            ],

        
            [
                'id' => 11,
                'nombre' => 'Servcio Publico Intermunicipal',
                'estado' => ''
            ],
        ));
    }
}
