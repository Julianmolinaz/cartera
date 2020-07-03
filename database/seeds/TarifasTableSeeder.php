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

            3 => 
            array (
                'id' => 4,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '2',
                'cilindraje_id' => '',
                'modelo' => '',
                'valor' => '360650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            4 => 
            array (
                'id' => 5,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '2',
                'cilindraje_id' => '2',
                'modelo' => '',
                'valor' => '360650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            5 => 
            array (
                'id' => 6,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '2',
                'cilindraje_id' => '2',
                'modelo' => '',
                'valor' => '360650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            6 => 
            array (
                'id' => 7,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '2',
                'cilindraje_id' => '2',
                'modelo' => '',
                'valor' => '360650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            7 => 
            array (
                'id' => 8,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '2',
                'cilindraje_id' => '2',
                'modelo' => '',
                'valor' => '360650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            8 => 
            array (
                'id' => 9,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '2',
                'cilindraje_id' => '2',
                'modelo' => '',
                'valor' => '360650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            9 => 
            array (
                'id' => 10,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '2',
                'cilindraje_id' => '2',
                'modelo' => '',
                'valor' => '360650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
        ));
    }
}
