<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Cliente;

class ClientesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('clientes')->delete();
        
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 100; $i++) { 

            Cliente::create([

                'primer_nombre' => $faker->firstNameMale,
                'segundo_nombre' => $faker->firstNameMale,
                'primer_apellido' => $faker->lastName,
                'segundo_apellido' => $faker->lastName,
                'genero' => 'Masculino',
                'tipo_doc' => 'Cedula Ciudadanía',
                'num_doc' => $faker->unique()->numberBetween(9999999, 11000000),
                'estado_civil' => $faker->randomElement($array = ['Soltero/a','Casado/a','Separado/a','Viudo/a','Union libre','Otro']),
                'fecha_exp' => $faker->date($format='Y-m-d', $timezone = 'UTC'),
                'lugar_exp' => 'Pereira',
                'fecha_nacimiento' => $faker->date($format='Y-m-d', $timezone = 'UTC'),
                'lugar_nacimiento' => 'Pereira',
                'nivel_estudios' => $faker->randomElement(['Primaria','Bachiller','Tecnico','Universitario','Postgrado','Ninguno']),
                'direccion' => $faker->address,
                'barrio' => $faker->citySuffix,
                'movil' => '3207809668',
                'antiguedad_movil' => $faker->randomDigit,
                'fijo' => $faker->numberBetween(3000000, 3999999),
                'email' => $faker->email,
                'anos_residencia' => $faker->numberBetween(1,30),
                'envio_correspondencia' => $faker->randomElement(['Casa','Empresa','Correo electronico']),
                'estrato' => $faker->numberBetween(1,6),
                'meses_residencia' => $faker->numberBetween(0,11),
                'tipo_vivienda' => $faker->randomElement(['Propia','Familiar','Alquilada']),
                'nombre_arrendador' => $faker->name,
                'telefono_arrendador' => $faker->numberBetween(3000000, 3999999),
                'tipo_actividad' => 'Independiente',
                'ocupacion' => 'Analista',
                'empresa' => 'Free',
                'dir_empresa' => 'direccion de prueba',
                'tel_empresa' => '321454454',
                'cargo' => '',
                'descripcion_actividad' => $faker->text,
                'doc_empresa' => '',
                'fecha_vinculacion' => '2000-01-01',
                'tipo_contrato' => '',
                'reportado' => 'no',
                'numero_de_creditos' => NULL,
                'calificacion' => NULL,
                'municipio_id' => 2,
                'codeudor_id' => NULL,
                'conyuge_id' => NULL,
                'user_create_id' => 2,
                'user_update_id' => NULL,
                'placa' => NULL,
                'version' => '2',
                'terminos' => 0,
                'created_at' => '2020-11-10 14:46:28',
                'updated_at' => '2020-11-10 14:46:28'
            ]);
        }
        
    }
}
