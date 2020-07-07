<?php

use Illuminate\Database\Seeder;

class TarifasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tarifas')->delete();
        
        \DB::table('tarifas')->insert(array (

            // SOAT PARA CICLOMOTOS
            0 => 
            array (
                'id' => 1,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '1',
                'cilindraje_id' => '1',
                'modelo' => '',
                'valor' => '174050',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
                // SOAT PARA MOTOS de 50 a 99 
            1 => 
            array (
                'id' => 2,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '2',
                'cilindraje_id' => '2',
                'modelo' => '',
                'valor' => '360650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA MOTOS de 100 a 199
            2 => 
            array (
                'id' => 3,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '2',
                'cilindraje_id' => '3',
                'modelo' => '',
                'valor' => '483950',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA MOTOS mas de 200
            3 => 
            array (
                'id' => 4,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '2',
                'cilindraje_id' => '4',
                'modelo' => '',
                'valor' => '545450',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA MOTOCARROS
            4 => 
            array (
                'id' => 5,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '3',
                'cilindraje_id' => '4',
                'modelo' => '',
                'valor' => '545450',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CAMPEROS Y CAMIONETAS MENOS DE 1.500 de 0 a 9 años
            5 => 
            array (
                'id' => 6,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '4',
                'cilindraje_id' => '5',
                'modelo' => 'De 0 a 9 años',
                'valor' => '568250',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CAMPEROS Y CAMIONETAS MENOS DE 1.500 DE 10 AÑOS O MÁS
            6 => 
            array (
                'id' => 7,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '4',
                'cilindraje_id' => '5',
                'modelo' => 'De 10 años o más',
                'valor' => '682850',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CAMPEROS Y CAMIONETAS DE 1.500 A 2.5000 DE 0 A 9 AÑOS
            7 => 
            array (
                'id' => 8,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '4',
                'cilindraje_id' => '6',
                'modelo' => 'De 0 a 9 años',
                'valor' => '678350',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
             // SOAT PARA CAMPEROS Y CAMIONETAS DE 1.500 A 2.500 DE 10 AÑOS O MÁS
            8 => 
            array (
                'id' => 9,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '4',
                'cilindraje_id' => '6',
                'modelo' => 'De 10 años o más',
                'valor' => '803450',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CAMPEROS Y CAMIONETAS MÁS DE 2.5000 DE 0 A 9 AÑOS
            9 => 
            array (
                'id' => 10,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '4',
                'cilindraje_id' => '7',
                'modelo' => 'De 0 a 9 años',
                'valor' => '795650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CAMPEROS Y CAMIONETAS MÁS DE 2.500 DE 10 AÑOS O MÁS
            10 => 
            array (
                'id' => 11,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '4',
                'cilindraje_id' => '7',
                'modelo' => 'De 10 años o más',
                'valor' => '912800',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CARGA O MIXTO MENOS DE 5 TONELADAS
            11 => 
            array (
                'id' => 12,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '5',
                'cilindraje_id' => '8',
                'modelo' => '',
                'valor' => '636650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CARGA O MIXTO DE 5 A 15 TONELADAS 
            12 => 
            array (
                'id' => 13,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '5',
                'cilindraje_id' => '9',
                'modelo' => '',
                'valor' => '919400',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CARGA O MIXTO MÁS DE 15 TONELADAS 
            13 => 
            array (
                'id' => 14,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '5',
                'cilindraje_id' => '10',
                'modelo' => '',
                'valor' => '1082150',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
             // SOAT PARA OFICIALES ESPECIALES 
             14 => 
             array (
                 'id' => 15,
                 'producto_id' => '2',
                 'tipo_vehiculo_id' => '5',
                 'cilindraje_id' => '8',
                 'modelo' => '',
                 'valor' => '636650',
                 'estado' => '',
                 'created_at' => '2017-07-23 22:41:23',
                 'updated_at' => '2017-07-24 07:20:16',
             ),
             // SOAT PARA OFICIALES ESPECIALES 
             15 => 
             array (
                 'id' => 16,
                 'producto_id' => '2',
                 'tipo_vehiculo_id' => '5',
                 'cilindraje_id' => '9',
                 'modelo' => '',
                 'valor' => '919400',
                 'estado' => '',
                 'created_at' => '2017-07-23 22:41:23',
                 'updated_at' => '2017-07-24 07:20:16',
             ),
             // SOAT PARA OFICIALES ESPECIALES
             16 => 
             array (
                 'id' => 17,
                 'producto_id' => '2',
                 'tipo_vehiculo_id' => '5',
                 'cilindraje_id' => '10',
                 'modelo' => '',
                 'valor' => '1082150',
                 'estado' => '',
                 'created_at' => '2017-07-23 22:41:23',
                 'updated_at' => '2017-07-24 07:20:16',
             ),
        ));
    }
}
