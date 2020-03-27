<?php

use Illuminate\Database\Seeder;

class CallBusquedasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('call_busquedas')->delete();
        
        \DB::table('call_busquedas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'busqueda' => 'Todos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-09-24 18:34:23',
                'updated_at' => '2017-12-29 20:15:58',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 9,
                'busqueda' => 'Morosos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-09-25 08:43:11',
                'updated_at' => '2017-10-05 16:51:33',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 10,
                'busqueda' => 'Morosos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-09-25 11:20:13',
                'updated_at' => '2017-12-15 11:19:06',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 15,
                'busqueda' => 'Morosos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-09-25 11:48:14',
                'updated_at' => '2017-12-29 16:39:47',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 25,
                'busqueda' => 'Morosos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-09-26 14:46:11',
                'updated_at' => '2017-12-14 16:43:11',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 8,
                'busqueda' => 'Todos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-10-01 19:01:51',
                'updated_at' => '2017-12-22 17:06:15',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 36,
                'busqueda' => 'Todos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-10-09 16:17:02',
                'updated_at' => '2017-10-25 12:28:33',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 32,
                'busqueda' => 'Morosos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-10-11 08:49:36',
                'updated_at' => '2017-12-19 15:18:27',
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 34,
                'busqueda' => 'Morosos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-10-16 09:25:15',
                'updated_at' => '2017-11-30 10:59:49',
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 30,
                'busqueda' => 'Todos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-10-16 09:44:26',
                'updated_at' => '2017-12-29 18:48:37',
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 20,
                'busqueda' => 'Todos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-10-16 09:50:46',
                'updated_at' => '2017-10-23 11:34:24',
            ),
            11 => 
            array (
                'id' => 12,
                'user_id' => 27,
                'busqueda' => 'Todos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-10-16 12:09:57',
                'updated_at' => '2017-10-16 12:09:57',
            ),
            12 => 
            array (
                'id' => 13,
                'user_id' => 28,
                'busqueda' => 'Morosos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-10-17 12:03:13',
                'updated_at' => '2017-12-01 13:24:08',
            ),
            13 => 
            array (
                'id' => 14,
                'user_id' => 33,
                'busqueda' => 'Todos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-11-20 10:49:03',
                'updated_at' => '2017-11-20 10:49:03',
            ),
            14 => 
            array (
                'id' => 15,
                'user_id' => 37,
                'busqueda' => 'Todos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-11-22 11:16:46',
                'updated_at' => '2017-12-19 10:20:10',
            ),
            15 => 
            array (
                'id' => 16,
                'user_id' => 38,
                'busqueda' => 'Morosos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-12-12 08:14:58',
                'updated_at' => '2017-12-20 15:39:20',
            ),
            16 => 
            array (
                'id' => 17,
                'user_id' => 41,
                'busqueda' => 'Agenda',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-12-13 08:50:30',
                'updated_at' => '2017-12-13 10:46:35',
            ),
            17 => 
            array (
                'id' => 18,
                'user_id' => 40,
                'busqueda' => 'Morosos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-12-13 10:23:08',
                'updated_at' => '2017-12-29 09:57:05',
            ),
            18 => 
            array (
                'id' => 19,
                'user_id' => 17,
                'busqueda' => 'Todos',
                'rango_ini' => NULL,
                'rango_fin' => NULL,
                'created_at' => '2017-12-26 18:23:46',
                'updated_at' => '2017-12-26 18:23:46',
            ),
        ));
        
        
    }
}
