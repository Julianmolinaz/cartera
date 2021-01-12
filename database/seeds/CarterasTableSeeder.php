<?php

use Illuminate\Database\Seeder;

class CarterasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('carteras')->delete();
        
        \DB::table('carteras')->insert(array (
            0 => 
            array (
                'id' => 6,
                'nombre' => 'NEGOCIOS GORA PEREIRA',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2017-04-16 18:45:52',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            1 => 
            array (
                'id' => 10,
                'nombre' => 'JOSÉ DANILO LÓPEZ RAMÍREZ',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2017-04-18 08:55:26',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            2 => 
            array (
                'id' => 11,
                'nombre' => 'MICHEL GÓMEZ ALTAMIRANO',
                'estado' => 'Inactivo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2017-08-01 08:36:51',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            3 => 
            array (
                'id' => 12,
                'nombre' => 'HECTOR FABIO GOMEZ RAMIREZ',
                'estado' => 'Inactivo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2017-08-07 19:23:57',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            4 => 
            array (
                'id' => 13,
                'nombre' => 'CARTERA DE TERCEROS',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2017-08-11 14:29:10',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            5 => 
            array (
                'id' => 14,
            'nombre' => 'GORA G.L (JURÍDICO)',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2018-05-21 22:33:00',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            6 => 
            array (
                'id' => 15,
            'nombre' => 'DANILO G.L (JURIDICO)',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2018-06-10 08:37:33',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            7 => 
            array (
                'id' => 16,
            'nombre' => 'TERCEROS G.L (JURIDICO)',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2018-06-10 08:37:54',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            8 => 
            array (
                'id' => 17,
                'nombre' => 'PENDIENTES PARA G.L',
                'estado' => 'Inactivo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2018-07-07 19:19:11',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            9 => 
            array (
                'id' => 18,
            'nombre' => 'YORLADIS TERCERO (JURIDICO)',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2018-09-30 08:16:48',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            10 => 
            array (
                'id' => 19,
            'nombre' => 'YORLADIS GORA (JURIDICO)',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2018-09-30 08:37:23',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            11 => 
            array (
                'id' => 20,
            'nombre' => 'YORLADIS DANILO (JURIDICO)',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2018-09-30 08:38:20',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            12 => 
            array (
                'id' => 21,
                'nombre' => 'ASISTENCIA JURIDICA GORA',
                'estado' => 'Inactivo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2018-10-01 15:01:50',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            13 => 
            array (
                'id' => 22,
                'nombre' => 'ASISTENCIA JURIDICA DANILO',
                'estado' => 'Inactivo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2018-10-01 15:02:21',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            14 => 
            array (
                'id' => 23,
                'nombre' => 'DEPENDIENTE JURÍDICO GORA ',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2018-10-07 11:45:46',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            15 => 
            array (
                'id' => 24,
                'nombre' => 'ANA MILENA JURIDICO GORA',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2018-10-07 13:16:23',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            16 => 
            array (
                'id' => 25,
                'nombre' => 'ANA MILENA JURIDICO DANILO',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2018-10-07 13:16:43',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            17 => 
            array (
                'id' => 26,
                'nombre' => 'ANA MILENA JURIDICO TERCEROS',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2018-10-07 13:17:08',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            18 => 
            array (
                'id' => 27,
                'nombre' => 'DEPENDIENTE JURÍDICO DANILO ',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2018-10-07 14:29:53',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            19 => 
            array (
                'id' => 28,
                'nombre' => 'DEPENDIENTE JURÍDICO TERCEROS',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2018-10-07 14:37:50',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            20 => 
            array (
                'id' => 29,
                'nombre' => 'OBLIGACIONES PERDIDAS',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2019-02-03 09:56:43',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            21 => 
            array (
                'id' => 30,
                'nombre' => 'MULTINTEGRAL DE LA CHEC',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2019-02-03 09:56:58',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            22 => 
            array (
                'id' => 31,
                'nombre' => 'CARTERA TERCEROS-ASISTENCIA JURIDICA LEGAL SAS',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2019-02-12 09:52:24',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            23 => 
            array (
                'id' => 32,
                'nombre' => 'NESGOR',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2019-02-27 11:20:38',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            24 => 
            array (
                'id' => 33,
                'nombre' => 'OBLIGACIONES PENDIENTES A RECUPERAR',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2019-03-05 18:22:11',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            25 => 
            array (
                'id' => 34,
                'nombre' => 'PEQUEÑOS SALDOS PENDIENTES',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2019-05-03 13:01:21',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            26 => 
            array (
                'id' => 35,
                'nombre' => 'MULTINTEGRAL SOCIEDAD',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2019-07-15 11:38:20',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            27 => 
            array (
                'id' => 36,
                'nombre' => 'FACILCREDITOS SAS ZONA LA DORADA',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2019-07-22 17:01:47',
                'updated_at' => '2020-09-28 15:42:51',
            ),
            28 => 
            array (
                'id' => 37,
                'nombre' => 'GESTION LEGAL PENSIONADOS',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2020-01-16 20:17:18',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            29 => 
            array (
                'id' => 38,
                'nombre' => 'ANA MILENA JURIDICO NESGOR',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2020-01-20 19:01:06',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            30 => 
            array (
                'id' => 39,
                'nombre' => 'ANA MILENA JURIDICO MULTINTEGRAL CHEC',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => '60',
                'created_at' => '2020-01-20 20:04:56',
                'updated_at' => '2020-02-23 23:12:15',
            ),
            31 => 
            array (
                'id' => 40,
                'nombre' => 'ESTRATEGIA REPORT',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => NULL,
                'created_at' => '2020-05-18 11:18:01',
                'updated_at' => '2020-05-18 11:18:01',
            ),
            32 => 
            array (
                'id' => 41,
            'nombre' => 'MULTINTEGRAL GL (JURIDICO)',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => NULL,
                'created_at' => '2020-07-09 18:10:10',
                'updated_at' => '2020-07-09 18:10:10',
            ),
            33 => 
            array (
                'id' => 42,
                'nombre' => 'FACILCREDITOS SAS - SALDOS PENDIENTES A RECUPERAR',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => NULL,
                'created_at' => '2020-08-26 11:53:39',
                'updated_at' => '2020-08-26 11:53:39',
            ),
            34 => 
            array (
                'id' => 43,
                'nombre' => 'LIBRANZA PERIÓDICO DIARIO DEL OTÚN S.A.S.',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => NULL,
                'created_at' => '2020-09-16 11:41:10',
                'updated_at' => '2020-09-16 11:41:10',
            ),
            35 => 
            array (
                'id' => 44,
                'nombre' => 'FACILCREDITOS SAS ZONA NORTE',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => NULL,
                'created_at' => '2020-09-28 13:11:01',
                'updated_at' => '2020-09-28 13:11:01',
            ),
            36 => 
            array (
                'id' => 45,
                'nombre' => 'FACILCREDITOS SAS JURIDICO DRA. MIRIAM YORLADIS',
                'estado' => 'Activo',
                'porcentaje_pago_parcial' => NULL,
                'created_at' => '2020-09-28 13:11:57',
                'updated_at' => '2020-09-28 13:11:57',
            ),
        ));
        
        
    }
}
