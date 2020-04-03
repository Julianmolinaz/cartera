<?php

use Illuminate\Database\Seeder;

class ConsecutivosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // CONFIGURACION

        \DB::table('consecutivos')->delete();
        
        \DB::table('consecutivos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'componente' => 'egresos',
                'prefijo' => 'CE',
                'incrementable' => 3497,
            ),
        ));

        \DB::table('consecutivos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'componente' => 'facturas',
                'prefijo' => '',
                'incrementable' => 0,
            ),
        ));
        
        
    }
}
