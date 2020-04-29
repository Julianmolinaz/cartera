<?php

use Illuminate\Database\Seeder;

class OficiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('oficios')->insert([
            'nombre' => 'Asalariado'
        ]);

        \DB::table('oficios')->insert([
            'nombre' => 'Independiente'
        ]);

        \DB::table('oficios')->insert([
            'nombre' => 'Pensionado'
        ]);

        \DB::table('oficios')->insert([
            'nombre' => 'Socio'
        ]);

    }
}
