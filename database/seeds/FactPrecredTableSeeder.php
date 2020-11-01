<?php

use Illuminate\Database\Seeder;

class FactPrecredTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('fact_precred_conceptos')->delete();
        
        \DB::table('fact_precred_conceptos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Estudio tipico',
                'estado' => 'Activo',
                'valor' => 8000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Cuota inicial',
                'estado' => 'Activo',
                'valor' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'Estudio domicilio',
                'estado' => 'Activo',
                'valor' => 13000.0,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));

    }
}
