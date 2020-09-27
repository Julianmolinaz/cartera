<?php

use Illuminate\Database\Seeder;

class VariablesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // CONFIGURACION

        \DB::table('variables')->delete();
        
        \DB::table('variables')->insert(array (
            0 => 
            array (
                'id' => 1,
                'meses_min' => 1,
                'meses_max' => 60,
                'vlr_dia_sancion' => 1000,
                'vlr_estudio_tipico' => 8000,
                'vlr_estudio_domicilio' => 15000,
                'razon_social' => 'INVERSIONES GORA SAS',
                'nit' => '900975741-8',
                'telefono_1' => '3172520 ext 2',
                'telefono_2' => '',
                'created_at' => NULL,
                'updated_at' => '2019-03-29 11:43:55',
            ),
        ));
        
        
    }
}
