<?php

use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('productos')->delete();
        
        \DB::table('productos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'R.T.M',
                'descripcion' => 'REVISION TENICOMECANICA',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'SOAT',
                'descripcion' => 'VENTA DE SOAT A CREDITO',
                'created_at' => '2017-07-24 07:19:33',
                'updated_at' => '2017-07-24 07:21:15',
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'SOAT R.T.M.',
                'descripcion' => 'VENTA DE SOAT Y REVISION A CREDITO',
                'created_at' => '2017-07-24 07:21:53',
                'updated_at' => '2017-07-24 07:22:13',
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'CELULAR',
                'descripcion' => 'VENTA DE CELULARES A CREDITO',
                'created_at' => '2017-07-24 07:22:40',
                'updated_at' => '2017-07-24 07:22:52',
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'CASCO',
                'descripcion' => 'VENTA DE CASCO A CREDITO',
                'created_at' => '2017-07-24 07:23:36',
                'updated_at' => '2017-07-24 07:23:52',
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'ACCESORIOS',
                'descripcion' => 'VENTA DE ACCESORIOS A CREDITO',
                'created_at' => '2017-07-24 07:25:28',
                'updated_at' => '2017-07-24 07:25:53',
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'LIBRE INVERSION',
                'descripcion' => 'CREDITOS PARA LIBRE INVERSION',
                'created_at' => '2017-07-24 07:26:37',
                'updated_at' => '2017-07-24 07:26:54',
            ),
            7 => 
            array (
                'id' => 8,
                'nombre' => 'MOTOCICLETA',
                'descripcion' => 'MONTO MAXIMO $2.000.000',
                'created_at' => '2017-08-01 08:37:55',
                'updated_at' => '2017-08-01 08:39:38',
            ),
            8 => 
            array (
                'id' => 9,
                'nombre' => 'LICENCIAS DE CONDUCCIÒN',
                'descripcion' => 'CRÉDITO PARA LICENCIAS DE CONDUCCIÓN',
                'created_at' => '2017-08-01 08:40:24',
                'updated_at' => '2017-08-03 12:31:18',
            ),
            9 => 
            array (
                'id' => 10,
                'nombre' => 'FERRETERIA INDUSTRIAL',
                'descripcion' => 'cartera de Ferreteria Industrial del sr Alexander Lòpez',
                'created_at' => '2017-09-12 07:28:08',
                'updated_at' => '2017-09-12 07:28:08',
            ),
            10 => 
            array (
                'id' => 11,
                'nombre' => 'ELECTRODOMESTICOS',
                'descripcion' => 'ELECTRODOMESTICOS',
                'created_at' => '2017-09-15 11:17:02',
                'updated_at' => '2017-10-05 01:00:13',
            ),
            11 => 
            array (
                'id' => 12,
                'nombre' => 'MUEBLES Y ENSERES',
                'descripcion' => 'COMEDORES, JUEGOS DE SALA, JUEGOS ALCOBA',
                'created_at' => '2019-10-25 17:20:23',
                'updated_at' => '2019-10-25 17:20:23',
            ),
        ));
        
        
    }
}
