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

        
            [
                'nombre' => 'Moto',
                'estado' => ''
            ],

        
            [
                'nombre' => 'Moto',
                'estado' => ''
            ],

        
            [
                'nombre' => 'Motocarro',
                'estado' => ''
            ],

        
            [
                'nombre' => 'Camperos y Camionetas',
                'estado' => ''
            ],

        
            [
                'nombre' => 'Carga o Mixto',
                'estado' => ''
            ],

        
            [
                'nombre' => 'Oficiales Especiales',
                'estado' => ''
            ],

        
            [
                'nombre' => 'Autos Familiares',
                'estado' => ''
            ],
            
        
            [
                'nombre' => 'Vehiculos 6 o + pasajeros',
                'estado' => ''
            ],

        
            [
                'nombre' => 'Autos Servicio Publico',
                'estado' => ''
            ],

        
            [
                'nombre' => 'Bus Buseta Servicio Publico',
                'estado' => ''
            ],

        
            [
                'nombre' => 'Servcio Publico Intermunicipal',
                'estado' => ''
            ],
        ));
    }
}
