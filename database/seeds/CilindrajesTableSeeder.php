<?php

use Illuminate\Database\Seeder;

class CilindrajesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('cilindrajes')->delete();
        
        \DB::table('cilindrajes')->insert(array (

            0 => 
            array (
                'id' => 1,
                'rango' => 'De 100 a 500 W',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            1 => 
            array (
                'id' => 2,
                'rango' => 'De 50 a 99 C.C',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            2 => 
            array (
                'id' => 3,
                'rango' => 'De 100 a 199 C.C',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            3 => 
            array (
                'id' => 4,
                'rango' => 'Más de 200 C.C',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            4 => 
            array (
                'id' => 5,
                'rango' => 'Menos de 1.500 C.C.',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            5 => 
            array (
                'id' => 6,
                'rango' => 'De 1.500 a 2.500 C.C.',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            6 => 
            array (
                'id' => 7,
                'rango' => 'Más de 2.500 C.C.',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            
            7 => 
            array (
                'id' => 8,
                'rango' => 'Menos de 5 Toneladas',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            8 => 
            array (
                'id' => 9,
                'rango' => 'De 5 a 15 Toneladas',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            9 => 
            array (
                'id' => 10,
                'rango' => 'Más de 15 Toneladas',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            10 => 
            array (
                'id' => 11,
                'rango' => 'Urbano más de 2.5000 C.C.',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),

            11 => 
            array (
                'id' => 12,
                'rango' => 'Menos de 10 Pasajeros',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
        
            12 => 
            array (
                'id' => 13,
                'rango' => 'Más de 10 Pasajeros',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            13 => 
            array (
                'id' => 14,
                'rango' => 'Menos de 2.500',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
        ));
    }
}
