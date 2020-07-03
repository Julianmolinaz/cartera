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

            0 => 
            array (
                'id' => 1,
                'nombre' => 'Ciclomotores',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            1 => 
            array (
                'id' => 2,
                'nombre' => 'Moto',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            2 => 
            array (
                'id' => 3,
                'nombre' => 'Motocarro',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            3 => 
            array (
                'id' => 4,
                'nombre' => 'Camperos y Camionetas',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            4 => 
            array (
                'id' => 5,
                'nombre' => 'Carga o Mixto',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            5 => 
            array (
                'id' => 6,
                'nombre' => 'Oficiales Especiales',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            6 => 
            array (
                'id' => 7,
                'nombre' => 'Autos Familiares',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            
            7 => 
            array (
                'id' => 8,
                'nombre' => 'Vehiculos 6 o + pasajeros',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            8 => 
            array (
                'id' => 9,
                'nombre' => 'Autos Servicio Publico',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            9 => 
            array (
                'id' => 10,
                'nombre' => 'Bus Buseta Servicio Publico',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            10 => 
            array (
                'id' => 11,
                'nombre' => 'Servcio Publico Intermunicipal',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
        ));
    }
}
