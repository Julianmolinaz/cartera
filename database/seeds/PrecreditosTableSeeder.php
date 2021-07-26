<?php

use Illuminate\Database\Seeder;

use Faker\Factory;
use App\Precredito;


class PrecreditosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('precreditos')->delete();

        $faker = Factory::create();

        for ($i=0; $i < 100; $i++) { 

            Precredito::create([
                'id' => $i + 1,
                'num_fact' => $faker->unique()->numberBetween(999999,9999999),
                'fecha' => $faker->dateTimeBetween('2020-11-01', '2020-11-10')->format('Y-m-d'),
                'cartera_id' => 6,
                'funcionario_id' => 2,
                'cliente_id' => $faker->unique()->numberBetween(1,100),
                'producto_id' => $faker->numberBetween(1,23),
                'vlr_fin' => 400000.0,
                'periodo' => $faker->randomElement(['Mensual','Quincenal']),
                'meses' => 4,
                'cuotas' => 8,
                'vlr_cuota' => 70100.0,
                'p_fecha' => '2',
                's_fecha' => '17',
                'estudio' => 'Tipico',
                'cuota_inicial' => $faker->randomElement([0,50000,100000]),
                'aprobado' => 'En estudio',
                'version' => '2',
                'observaciones' => '',
                'user_create_id' => 2,
                'user_update_id' => NULL,
                'created_at' => '2020-11-10 15:09:18',
                'updated_at' => '2020-11-10 15:09:18',
            ]); 

                   
        }
    }
}
