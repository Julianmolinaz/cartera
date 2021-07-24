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
                'min_vehiculos' => 1,
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'SOAT',
                'descripcion' => 'VENTA DE SOAT A CREDITO',
                'min_vehiculos' => 1,
                'created_at' => '2017-07-24 07:19:33',
                'updated_at' => '2017-07-24 07:21:15',
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'SOAT + R.T.M.',
                'descripcion' => 'VENTA DE SOAT Y REVISION A CREDITO',
                'min_vehiculos' => 1,
                'created_at' => '2017-07-24 07:21:53',
                'updated_at' => '2020-09-29 10:41:40',
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'CELULAR',
                'descripcion' => 'VENTA DE CELULARES A CREDITO',
                'min_vehiculos' => 0,
                'created_at' => '2017-07-24 07:22:40',
                'updated_at' => '2017-07-24 07:22:52',
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'CASCO',
                'descripcion' => 'VENTA DE CASCO A CREDITO',
                'min_vehiculos' => 0,
                'created_at' => '2017-07-24 07:23:36',
                'updated_at' => '2017-07-24 07:23:52',
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'ACCESORIOS',
                'descripcion' => 'VENTA DE ACCESORIOS A CREDITO',
                'min_vehiculos' => 0,
                'created_at' => '2017-07-24 07:25:28',
                'updated_at' => '2017-07-24 07:25:53',
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'LIBRE INVERSION',
                'descripcion' => 'CREDITOS PARA LIBRE INVERSION',
                'min_vehiculos' => 0,
                'created_at' => '2017-07-24 07:26:37',
                'updated_at' => '2017-07-24 07:26:54',
            ),
            7 => 
            array (
                'id' => 8,
                'nombre' => 'MOTOCICLETA',
                'descripcion' => 'MONTO MAXIMO $2.000.000',
                'min_vehiculos' => 0,
                'created_at' => '2017-08-01 08:37:55',
                'updated_at' => '2017-08-01 08:39:38',
            ),
            8 => 
            array (
                'id' => 9,
                'nombre' => 'LICENCIAS DE CONDUCCIÒN',
                'descripcion' => 'CRÉDITO PARA LICENCIAS DE CONDUCCIÓN',
                'min_vehiculos' => 0,
                'created_at' => '2017-08-01 08:40:24',
                'updated_at' => '2017-08-03 12:31:18',
            ),
            9 => 
            array (
                'id' => 10,
                'nombre' => 'FERRETERIA INDUSTRIAL',
                'descripcion' => 'cartera de Ferreteria Industrial del sr Alexander Lòpez',
                'min_vehiculos' => 0,
                'created_at' => '2017-09-12 07:28:08',
                'updated_at' => '2017-09-12 07:28:08',
            ),
            10 => 
            array (
                'id' => 11,
                'nombre' => 'ELECTRODOMESTICOS',
                'descripcion' => 'ELECTRODOMESTICOS',
                'min_vehiculos' => 0,
                'created_at' => '2017-09-15 11:17:02',
                'updated_at' => '2017-10-05 01:00:13',
            ),
            11 => 
            array (
                'id' => 12,
                'nombre' => 'MUEBLES Y ENSERES',
                'descripcion' => 'COMEDORES, JUEGOS DE SALA, JUEGOS ALCOBA',
                'min_vehiculos' => 0,
                'created_at' => '2019-10-25 17:20:23',
                'updated_at' => '2019-10-25 17:20:23',
            ),
            12 => 
            array (
                'id' => 13,
                'nombre' => 'ASISTENCIA + SOAT + RTM',
                'descripcion' => 'VENTA DE ASISTENCIA DE ASISTIMOTOS + SOAT + RTM',
                'min_vehiculos' => 1,
                'created_at' => '2020-05-18 11:16:52',
                'updated_at' => '2020-09-29 10:41:17',
            ),
            13 => 
            array (
                'id' => 14,
                'nombre' => 'ASISTENCIA + SOAT',
                'descripcion' => 'VENTA DE ASITENCIA DE ASISTIMOTOS Y SOAT',
                'min_vehiculos' => 1,
                'created_at' => '2020-05-18 11:17:05',
                'updated_at' => '2020-09-29 10:40:58',
            ),
            14 => 
            array (
                'id' => 15,
                'nombre' => 'SOAT + SOAT',
                'descripcion' => 'VENTA DE 2 SOAT A CREDITO',
                'min_vehiculos' => 2,
                'created_at' => NULL,
                'updated_at' => '2020-09-29 10:40:42',
            ),
            15 => 
            array (
                'id' => 16,
                'nombre' => 'R.T.M + R.T.M',
                'descripcion' => 'VENTA DE  2 REVISION TECNICO MECANICA A CREDITO',
                'min_vehiculos' => 2,
                'created_at' => NULL,
                'updated_at' => '2020-09-29 10:40:28',
            ),
            16 => 
            array (
                'id' => 17,
                'nombre' => 'SOAT + SOAT + RTM + RTM',
                'descripcion' => 'VENTA DE 2 SOAT Y 2 RTM',
                'min_vehiculos' => 2,
                'created_at' => '2020-09-29 10:24:49',
                'updated_at' => '2020-09-29 10:35:58',
            ),
            17 => 
            array (
                'id' => 18,
                'nombre' => 'SOAT + SOAT + RTM',
                'descripcion' => 'VENTA 2 SOAT Y 1 RTM',
                'min_vehiculos' => 2,
                'created_at' => '2020-09-29 10:25:15',
                'updated_at' => '2020-09-29 10:35:31',
            ),
            18 => 
            array (
                'id' => 19,
                'nombre' => 'SOAT + RTM + RTM',
                'descripcion' => 'VENTA DE 1 SOAT Y 2 RTM',
                'min_vehiculos' => 2,
                'created_at' => '2020-09-29 10:25:30',
                'updated_at' => '2020-09-29 10:25:56',
            ),
            19 => 
            array (
                'id' => 20,
                'nombre' => 'SOAT + SOAT + SOAT',
                'descripcion' => 'Tres soats',
                'min_vehiculos' => 3,
                'created_at' => '2020-09-30 12:37:41',
                'updated_at' => '2020-09-30 12:37:41',
            ),
            20 => 
            array (
                'id' => 21,
                'nombre' => 'ASISTENCIA + SOAT + SOAT + RTM',
                'descripcion' => 'VENTA DE ASISTENCIA DE ASISTIMOTOS + SOAT + SOAT + RTM',
                'min_vehiculos' => 2,
                'created_at' => '2020-09-30 17:26:54',
                'updated_at' => '2020-09-30 17:26:54',
            ),
            21 => 
            array (
                'id' => 22,
                'nombre' => 'ASISTENCIA + SOAT + SOAT + RTM + RTM',
                'descripcion' => 'VENTA DE ASISTENCIA DE ASISTIMOTOS + SOAT + SOAT + RTM + RTM',
                'min_vehiculos' => 2,
                'created_at' => '2020-09-30 17:27:29',
                'updated_at' => '2020-09-30 17:27:29',
            ),
            22 => 
            array (
                'id' => 23,
                'nombre' => 'ASISTENCIA + SOAT + RTM + RTM',
                'descripcion' => 'VENTA DE ASISTENCIA DE ASISTIMOTOS + SOAT + RTM + RTM',
                'min_vehiculos' => 2,
                'created_at' => '2020-09-30 17:27:56',
                'updated_at' => '2020-09-30 17:27:56',
            ),
        ));
        
        
    }
}
