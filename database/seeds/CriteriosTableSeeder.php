<?php

use Illuminate\Database\Seeder;

class CriteriosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('criterios')->delete();
        
        \DB::table('criterios')->insert(array (
            0 => 
            array (
                'id' => 1,
                'criterio' => 'MORA',
                'descripcion' => '',
                'created_at' => NULL,
                'updated_at' => '2017-09-22 22:48:10',
            ),
            1 => 
            array (
                'id' => 2,
                'criterio' => 'PRE-JURIDICO',
                'descripcion' => '',
                'created_at' => NULL,
                'updated_at' => '2017-09-22 22:48:26',
            ),
            2 => 
            array (
                'id' => 14,
                'criterio' => 'JURIDICO',
                'descripcion' => '',
                'created_at' => '2017-06-29 07:45:26',
                'updated_at' => '2017-09-22 22:48:53',
            ),
            3 => 
            array (
                'id' => 15,
                'criterio' => 'ACUERDO DE PAGO',
                'descripcion' => '',
                'created_at' => '2017-08-01 08:41:46',
                'updated_at' => '2017-08-01 08:41:46',
            ),
            4 => 
            array (
                'id' => 16,
                'criterio' => 'OFRECIMIENTO DE RECOMPRA',
                'descripcion' => 'Por ser un cliente tipo B o BB y se llama a ofrecer un nuevo credito',
                'created_at' => '2017-09-29 20:58:05',
                'updated_at' => '2017-09-29 20:58:05',
            ),
            5 => 
            array (
                'id' => 17,
                'criterio' => 'SEGUIMIENTO CON ALTO GRADO',
                'descripcion' => 'Para clientes, que la única manera de cancelar es con varias llamadas',
                'created_at' => '2018-03-04 14:46:45',
                'updated_at' => '2018-03-04 14:46:45',
            ),
            6 => 
            array (
                'id' => 18,
                'criterio' => 'CLIENTE RE-DIRECCIONADO AL DPTO DE CARTERA',
                'descripcion' => 'Cliente,que se debe remitir, al dpto de cartera para que le realicen un seguimiento más detallado al cliente',
                'created_at' => '2018-03-04 14:48:54',
                'updated_at' => '2018-03-04 14:48:54',
            ),
            7 => 
            array (
                'id' => 19,
                'criterio' => 'CAMBIO DE FECHAS DE PAGO',
                'descripcion' => 'Cuando el cliente solicita cambio de fechas de pago',
                'created_at' => '2018-04-22 19:34:07',
                'updated_at' => '2018-04-22 19:34:07',
            ),
            8 => 
            array (
                'id' => 20,
                'criterio' => 'CLIENTE CON CALAMIDAD DOMESTICA',
                'descripcion' => 'Cliente con deseo de pago pero tener dificultada fuerte, para realizar el cumplimiento de la obligaciòn',
                'created_at' => '2018-04-22 19:35:11',
                'updated_at' => '2018-04-22 19:35:11',
            ),
            9 => 
            array (
                'id' => 21,
                'criterio' => 'INFORMACIÓN GENERAL ',
                'descripcion' => 'No es llamada de cobro, sino una información diferente a cartera',
                'created_at' => '2018-06-06 11:48:12',
                'updated_at' => '2018-06-06 11:48:12',
            ),
        ));
        
        
    }
}
