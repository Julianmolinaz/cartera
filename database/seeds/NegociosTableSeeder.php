<?php

use Illuminate\Database\Seeder;

class NegociosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('negocios')->delete();
        
        \DB::table('negocios')->insert(array (
            0 => 
            array (
                'id' => 18,
                'nombre' => 'INV-GORA',
                'descripcion' => 'NEGOCIOS MATRIZ ',
                'created_at' => '2019-08-28 22:08:23',
                'updated_at' => '2019-08-29 09:47:29',
            ),
            1 => 
            array (
                'id' => 19,
                'nombre' => 'RECAUDO TERCEROS',
            'descripcion' => 'COBROS DE CARTERAS DE TERCEROS (SOLO GESTION DE COBRO)',
                'created_at' => '2019-08-29 09:23:57',
                'updated_at' => '2019-08-29 09:23:57',
            ),
            2 => 
            array (
                'id' => 20,
                'nombre' => 'MULTINTEGRAL',
                'descripcion' => 'CARTERA ELECTRODOMESTICOS ',
                'created_at' => '2019-08-29 09:24:54',
                'updated_at' => '2019-08-29 09:24:54',
            ),
        ));
        
        
    }
}
