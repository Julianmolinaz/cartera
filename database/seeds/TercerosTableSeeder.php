<?php

use Illuminate\Database\Seeder;

class TercerosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('terceros')->delete();
        
        \DB::table('terceros')->insert(array (
            0 => 
            array (
                'id' => 15,
                'tipo' => 'Proveedor',
                'regimen' => 'Regimen comun',
                'razon_social' => 'CDA A',
                'pnombre' => '',
                'snombre' => '',
                'papellido' => '',
                'sapellido' => '',
                'tipo_doc' => 'Cedula de ciudadania',
                'num_doc' => '999999999',
                'tel1' => 3333333,
                'tel2' => 0,
                'dir' => 'Direccion N',
                'mun_id' => 1,
                'email' => 'mail@mail.com',
                'created_by' => 2,
                'updated_by' => NULL,
                'created_at' => '2019-11-29 18:45:58',
                'updated_at' => '2019-11-29 18:45:58',
            ),
            1 => 
            array (
                'id' => 16,
                'tipo' => 'Proveedor',
                'regimen' => 'Gran contribuyente',
                'razon_social' => 'Prueba',
                'pnombre' => 'Prueba',
                'snombre' => '',
                'papellido' => 'Proveedor',
                'sapellido' => '',
                'tipo_doc' => 'Cedula de ciudadania',
                'num_doc' => '987654321',
                'tel1' => 0,
                'tel2' => 0,
                'dir' => '',
                'mun_id' => 1,
                'email' => '',
                'created_by' => 2,
                'updated_by' => NULL,
                'created_at' => '2019-12-19 21:44:18',
                'updated_at' => '2019-12-19 21:44:18',
            ),
            2 => 
            array (
                'id' => 17,
                'tipo' => 'Proveedor',
                'regimen' => 'Regimen comun',
                'razon_social' => 'CDA DEL CAFE',
                'pnombre' => 'Pablo',
                'snombre' => 'Adrian',
                'papellido' => 'Gonzalez',
                'sapellido' => 'Salazar',
                'tipo_doc' => 'Cedula de ciudadania',
                'num_doc' => '9873241',
                'tel1' => 33333333,
                'tel2' => 44444444,
                'dir' => 'direccion',
                'mun_id' => 1,
                'email' => 'test.free.pablo@gmail.com',
                'created_by' => 2,
                'updated_by' => NULL,
                'created_at' => '2020-03-13 01:10:57',
                'updated_at' => '2020-03-13 01:10:57',
            ),
            3 => 
            array (
                'id' => 18,
                'tipo' => 'Proveedor',
                'regimen' => 'Regimen comun',
                'razon_social' => 'CDA LA ROSA',
                'pnombre' => '',
                'snombre' => '',
                'papellido' => '',
                'sapellido' => '',
                'tipo_doc' => 'Nit empresarial',
                'num_doc' => '900975896-8',
                'tel1' => 65464654,
                'tel2' => 2147483647,
                'dir' => 'DIRECCION',
                'mun_id' => 2,
                'email' => 'etereosum@gmail.com',
                'created_by' => 2,
                'updated_by' => NULL,
                'created_at' => '2020-03-15 22:57:17',
                'updated_at' => '2020-03-15 22:57:17',
            ),
        ));
        
        
    }
}
