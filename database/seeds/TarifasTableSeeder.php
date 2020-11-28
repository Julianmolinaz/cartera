<?php

use Illuminate\Database\Seeder;


class TarifasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tarifas')->delete();
        
        \DB::table('tarifas')->insert(array (

            // SOAT PARA CICLOMOTOS
            0 => 
            array (
                'id' => 1,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '2',                
                'concepto' => 'Ciclomotores',
                'valor' => '174050',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
                // SOAT PARA MOTOS de 50 a 99 
            1 => 
            array (
                'id' => 2,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '2',                
                'concepto' => 'Menos 100 C.C.',
                'valor' => '360650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA MOTOS de 100 a 199
            2 => 
            array (
                'id' => 3,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '2',                
                'concepto' => 'De 100 a 200 C.C.',
                'valor' => '483950',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA MOTOS mas de 200
            3 => 
            array (
                'id' => 4,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '2',                
                'concepto' => 'Más 200 C.C.',
                'valor' => '545450',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA MOTOCARROS
            
            4 => 
            array (
                'id' => 5,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '2',                
                'concepto' => 'Motocarro',
                'valor' => '545450',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CAMPEROS Y CAMIONETAS MENOS DE 1.500 de 0 a 9 años
            5 => 
            array (
                'id' => 6,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '4',                
                'concepto' => 'Menos 1.500 C.C. De 0-9 años',
                'valor' => '568250',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            //SOAT PARA CAMPEROS Y CAMIONETAS MENOS DE 1.500 DE 10 AÑOS O MÁS
            6 => 
            array (
                'id' => 7,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '4',                
                'concepto' => 'Menos 1.500 C.C. De 10 años o más',
                'valor' => '682850',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CAMPEROS Y CAMIONETAS DE 1.500 A 2.5000 DE 0 A 9 AÑOS
            7 => 
            array (
                'id' => 8,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '4',                
                'concepto' => 'De 1.500-2.500 C.C. De 0 a 9 años',
                'valor' => '678350',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
             // SOAT PARA CAMPEROS Y CAMIONETAS DE 1.500 A 2.500 DE 10 AÑOS O MÁS
            8 => 
            array (
                'id' => 9,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '4',                
                'concepto' => 'De 1.500-2.500 C.C. De 10 años o más',
                'valor' => '803450',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CAMPEROS Y CAMIONETAS MÁS DE 2.5000 DE 0 A 9 AÑOS
            9 => 
            array (
                'id' => 10,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '4',                
                'concepto' => 'Más 2.500 C.C. De 0 a 9 años',
                'valor' => '795650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CAMPEROS Y CAMIONETAS MÁS DE 2.500 DE 10 AÑOS O MÁS
            10 => 
            array (
                'id' => 11,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '4',                
                'concepto' => 'Más 2.500 C.C. De 10 años o más',
                'valor' => '912800',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CARGA O MIXTO MENOS DE 5 TONELADAS
            11 => 
            array (
                'id' => 12,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '5',                
                'concepto' => 'Menos 5 Toneladas',
                'valor' => '636650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CARGA O MIXTO DE 5 A 15 TONELADAS 
            12 => 
            array (
                'id' => 13,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '5',               
                'concepto' => 'De 5-15 Toneladas',
                'valor' => '919400',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CARGA O MIXTO MÁS DE 15 TONELADAS 
            13 => 
            array (
                'id' => 14,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '5',
                'concepto' => 'Más 15 Tolneladas',
                'valor' => '1162100',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
             // SOAT PARA OFICIALES ESPECIALES MENOS DE 1.500
             14 => 
             array (
                 'id' => 15,
                 'producto_id' => '2',
                 'tipo_vehiculo_id' => '6',                 
                 'concepto' => 'Menos 1.500 C.C.',
                 'valor' => '716150',
                 'estado' => '',
                 'created_at' => '2017-07-23 22:41:23',
                 'updated_at' => '2017-07-24 07:20:16',
             ),
             // SOAT PARA OFICIALES ESPECIALES DE 1.500 A 2.500
             15 => 
             array (
                 'id' => 16,
                 'producto_id' => '2',
                 'tipo_vehiculo_id' => '6',                 
                 'concepto' => 'De 1.500-2.500 C.C.',
                 'valor' => '902750',
                 'estado' => '',
                 'created_at' => '2017-07-23 22:41:23',
                 'updated_at' => '2017-07-24 07:20:16',
             ),
             // SOAT PARA OFICIALES ESPECIALES MÁS DE 2.500
             16 => 
             array (
                 'id' => 17,
                 'producto_id' => '2',
                 'tipo_vehiculo_id' => '6',                 
                 'concepto' => 'Más 2.500 C.C.',
                 'valor' => '1082150',
                 'estado' => '',
                 'created_at' => '2017-07-23 22:41:23',
                 'updated_at' => '2017-07-24 07:20:16',
             ),
             // SOAT PARA AUTOS FAMILIARES MENOS DE 1.500 de 0 a 9 años
            17 => 
            array (
                'id' => 18,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '7',                
                'concepto' => 'Menos 1.500 C.C. De 0 a 9 años',
                'valor' => '320750',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA AUTOS FAMILIARES MENOS DE 1.500 DE 10 AÑOS O MÁS
            18 => 
            array (
                'id' => 19,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '7',                
                'concepto' => 'Menos 1.500 C.C. De 10 años o más',
                'valor' => '424700',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA AUTOS FAMILIARES DE 1.500 A 2.5000 DE 0 A 9 AÑOS
            19 => 
            array (
                'id' => 20,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '7',                
                'concepto' => 'De 1.500-2.500 C.C. De 0 a 9 años',
                'valor' => '390050',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
             // SOAT PARA AUTOS FAMILIARES DE 1.500 A 2.500 DE 10 AÑOS O MÁS
            20 => 
            array (
                'id' => 21,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '7',                
                'concepto' => 'De 1.500-2.500 C.C. De 10 años o más',
                'valor' => '485300',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA AUTOS FAMILIARES MÁS DE 2.5000 DE 0 A 9 AÑOS
            21 => 
            array (
                'id' => 22,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '7',                
                'concepto' => 'Más 2.500 C.C. De 0 a 9 años',
                'valor' => '455900',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA AUTOS FAMILIARES MÁS DE 2.500 DE 10 AÑOS O MÁS
            22 => 
            array (
                'id' => 23,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '7',               
                'concepto' => 'Más 2.500 C.C. De 10 años o más',
                'valor' => '540650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA VEHICULO 6 O + PASAJEROS MENOS 2.500 DE 0 A 9 AÑOS
            23 => 
            array (
                'id' => 24,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '8',
                'concepto' => 'Menos 2.500 C.C. De 0 a 9 años',
                'valor' => '571250',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA VEHICULO 6 O + PASAJEROS MENOS 2.500 DE 10 AÑOS O MÁS
            24 => 
            array (
                'id' => 25,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '8',
                'concepto' => 'Menos 2.500 C.C. De 10 años o más',
                'valor' => '729350',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA VEHICULO 6 O + PASAJEROS MÁS DE 2.5000 DE 0 A 9 AÑOS
            25 => 
            array (
                'id' => 26,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '8',                
                'concepto' => 'Más 2.500 C.C. De 0 a 9 años',
                'valor' => '764900',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA VEHICULO 6 O + PASAJEROS MÁS DE 2.500 DE 10 AÑOS O MÁS
            26 => 
            array (
                'id' => 27,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '8',               
                'concepto' => 'Más 2.500 C.C. De 10 años o más',
                'valor' => '918500',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA AUTOS SERVICIO PUBLICO MENOS DE 1.500 de 0 a 9 años
            27 => 
            array (
                'id' => 28,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '9',                
                'concepto' => 'Menos 1.500 C.C. De 0 a 9 años',
                'valor' => '397100',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA AUTOS SERVICIO PUBLICO MENOS DE 1.500 DE 10 AÑOS O MÁS
            28 => 
            array (
                'id' => 29,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '9',                
                'concepto' => 'Menos 1.500 C.C. De 10 años o más',
                'valor' => '495800',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA AUTOS SERVICIO PUBLICO DE 1.500 A 2.5000 DE 0 A 9 AÑOS
            29 => 
            array (
                'id' => 30,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '9',                
                'concepto' => 'De 1.500-2.500 C.C. De 0 a 9 años',
                'valor' => '493250',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
             // SOAT PARA AUTOS SERVICIO PUBLICO DE 1.500 A 2.500 DE 10 AÑOS O MÁS
            30 => 
            array (
                'id' => 31,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '9',                
                'concepto' => 'De 1.500-2.500 C.C. De 10 años o más',
                'valor' => '609950',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA AUTOS SERVICIO PUBLICO MÁS DE 2.5000 DE 0 A 9 AÑOS
            31 => 
            array (
                'id' => 32,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '9',                
                'concepto' => 'Más 2.500 C.C. De 0 a 9 años',
                'valor' => '636650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA AUTOS SERVICIO PUBLICO MÁS DE 2.500 DE 10 AÑOS O MÁS
            32 => 
            array (
                'id' => 33,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '9',
                'concepto' => 'Más 2.500 C.C. De 10 años o más',
                'valor' => '746900',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA Bus Buseta Servicio Publico
            33 => 
            array (
                'id' => 34,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '10',
                'concepto' => 'Bus Buseta Servicio Publico',
                'valor' => '950150',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA SERVICIO PUBLICO INTERMUNICIPAL MENOS DE 10 PASAJEROS
            34 => 
            array (
                'id' => 35,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '11',
                'concepto' => 'Menos 10 pasajeros',
                'valor' => '939500',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA SERVICIO PUBLICO INTERMUNICIPAL MÁS DE 10 PASAJEROS
            35 => 
            array (
                'id' => 36,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '11',
                'concepto' => 'Más 10 pasajeros',
                'valor' => '1363550',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            //  RTM PARA MOTOS TODOS LOS COPNCEPTOS
            36 => 
            array (
                'id' => 37,
                'producto_id' => '1',
                'tipo_vehiculo_id' => '2',
                'concepto' => 'Todos los modelos y cilindrajes',
                'valor' => '143500',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // RTM PARA CAMPEROS Y CAMIONETAS TODOS LOS CONCEPTOS
            37 => 
            array (
                'id' => 38,
                'producto_id' => '1',
                'tipo_vehiculo_id' => '4',                
                'concepto' => 'Todos los modelos y cilindrajes',
                'valor' => '210200',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // RTM PARA CARGA O MIXTO TODOS LOS CONCEPTOS
            38 => 
            array (
                'id' => 39,
                'producto_id' => '1',
                'tipo_vehiculo_id' => '5',                
                'concepto' => 'Todos los modelos y cilindrajes',
                'valor' => '210200',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // RTM PARA OFICIALES ESPECIALES TODOS LOS CONCEPTOS
            39 => 
            array (
                'id' => 40,
                'producto_id' => '1',
                'tipo_vehiculo_id' => '6',                
                'concepto' => 'Todos los modelos y cilindrajes',
                'valor' => '210200',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // RTM PARA AUTOS FAMILIARES TODOS LOS CONCEPTOS
            40 => 
            array (
                'id' => 41,
                'producto_id' => '1',
                'tipo_vehiculo_id' => '7',
                'concepto' => 'Todos los modelos y cilindrajes',
                'valor' => '210200',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
             // RTM PARA VEHICULOS DE 6 PASAJEROS O MAS TODOS LOS CONCEPTOS
            41 => 
            array (
                'id' => 42,
                'producto_id' => '1',
                'tipo_vehiculo_id' => '8',
                'concepto' => 'Todos los modelos y cilindrajes',
                'valor' => '210200',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
              // RTM PARA AUTOS SERVICIO PUBLICO TODOS LOS CONCEPTOS
            42 => 
            array (
                'id' => 43,
                'producto_id' => '1',
                'tipo_vehiculo_id' => '9',
                'concepto' => 'Todos los modelos y cilindrajes',
                'valor' => '210200',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
              // RTM PARA BUS BUSETA SERVICIO PUBLICO TODOS LOS CONCEPTOS
            43 => 
            array (
                'id' => 44,
                'producto_id' => '1',
                'tipo_vehiculo_id' => '10',
                'concepto' => 'Todos los modelos y cilindrajes',
                'valor' => '210200',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
              // RTM PARA SERVICIO PUBLICO INTERDEPARTAMENTL TODOS LOS CONCEPTOS
            44 => 
            array (
                'id' => 45,
                'producto_id' => '1',
                'tipo_vehiculo_id' => '11',
                'concepto' => 'Todos los modelos y cilindrajes',
                'valor' => '210200',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
              // RTM PARA SERVICIO PUBLICO INTERDEPARTAMENTL TODOS LOS CONCEPTOS
            45 => 
            array (
                'id' => 46,
                'producto_id' => '1',
                'tipo_vehiculo_id' => '3',
                'concepto' => 'Todos los modelos y cilindrajes',
                'valor' => '210200',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA CICLOMOTOS
            46 => 
            array (
                'id' => 47,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '2',               
                'concepto' => 'Ciclomotores',
                'valor' => '317050',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            //    SOAT Y RTM PARA MOTOS de 50 a 99 
            47 => 
            array (
                'id' => 48,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '2',                
                'concepto' => 'Menos 100 C.C.',
                'valor' => '504150',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA MOTOS de 100 a 199
            48 => 
            array (
                'id' => 49,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '2',                
                'concepto' => 'De 100 a 200 C.C.',
                'valor' => '627450',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA MOTOS mas de 200
            49 => 
            array (
                'id' => 50,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '2',                
                'concepto' => 'Más de 200 C.C.',
                'valor' => '688950',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
             // SOAT Y RTM PARA MOTOCARROS
            50 => 
            array (
                'id' => 51,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '3',                
                'concepto' => 'Más de 200 C.C.',
                'valor' => '688950',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA CAMPEROS Y CAMIONETAS MENOS DE 1.500 de 0 a 9 años
            51 => 
            array (
                'id' => 52,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '4',                
                'concepto' => 'Menos 1.500 C.C. De 0-9 años',
                'valor' => '779050',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            //SOAT Y RTM PARA CAMPEROS Y CAMIONETAS MENOS DE 1.500 DE 10 AÑOS O MÁS
            52 => 
            array (
                'id' => 53,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '4',                
                'concepto' => 'Menos 1.500 C.C. De 10 años o más',
                'valor' => '893050',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA CAMPEROS Y CAMIONETAS DE 1.500 A 2.5000 DE 0 A 9 AÑOS
            53 => 
            array (
                'id' => 54,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '4',                
                'concepto' => 'De 1.500-2.500 C.C. De 0 a 9 años',
                'valor' => '888550',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
             // SOAT Y RTM PARA CAMPEROS Y CAMIONETAS DE 1.500 A 2.500 DE 10 AÑOS O MÁS
            54 => 
            array (
                'id' => 55,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '4',                
                'concepto' => 'De 1.500-2.500 C.C. De 10 años o más',
                'valor' => '1013650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA CAMPEROS Y CAMIONETAS MÁS DE 2.5000 DE 0 A 9 AÑOS
            55 => 
            array (
                'id' => 56,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '4',                
                'concepto' => 'Más 2.500 C.C. De 0 a 9 años',
                'valor' => '1005850',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA CAMPEROS Y CAMIONETAS MÁS DE 2.500 DE 10 AÑOS O MÁS
            56 => 
            array (
                'id' => 57,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '4',                
                'concepto' => 'Más 2.500 C.C. De 10 años o más',
                'valor' => '1123000',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA CARGA O MIXTO MENOS DE 5 TONELADAS
            57 => 
            array (
                'id' => 58,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '5',                
                'concepto' => 'Menos 5 Toneladas',
                'valor' => '636650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA CARGA O MIXTO DE 5 A 15 TONELADAS 
            58 => 
            array (
                'id' => 59,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '5',               
                'concepto' => 'De 5-15 Toneladas',
                'valor' => '919400',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA CARGA O MIXTO MÁS DE 15 TONELADAS 
            59 => 
            array (
                'id' => 60,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '5',
                'concepto' => 'Más 15 Tolneladas',
                'valor' => '1162100',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA OFICIALES ESPECIALES MENOS DE 1.500
             60 => 
             array (
                 'id' => 61,
                 'producto_id' => '3',
                 'tipo_vehiculo_id' => '6',                 
                 'concepto' => 'Menos 1.500 C.C.',
                 'valor' => '716150',
                 'estado' => '',
                 'created_at' => '2017-07-23 22:41:23',
                 'updated_at' => '2017-07-24 07:20:16',
             ),
             // SOAT Y RTM PARA OFICIALES ESPECIALES DE 1.500 A 2.500
             61 => 
             array (
                 'id' => 62,
                 'producto_id' => '3',
                 'tipo_vehiculo_id' => '6',                 
                 'concepto' => 'De 1.500-2.500 C.C.',
                 'valor' => '902750',
                 'estado' => '',
                 'created_at' => '2017-07-23 22:41:23',
                 'updated_at' => '2017-07-24 07:20:16',
             ),
             // SOAT Y RTM PARA OFICIALES ESPECIALES MÁS DE 2.500
             62 => 
             array (
                 'id' => 63,
                 'producto_id' => '3',
                 'tipo_vehiculo_id' => '6',                 
                 'concepto' => 'Más 2.500 C.C.',
                 'valor' => '1082150',
                 'estado' => '',
                 'created_at' => '2017-07-23 22:41:23',
                 'updated_at' => '2017-07-24 07:20:16',
             ),
            // SOAT Y RTM PARA AUTOS FAMILIARES MENOS DE 1.500 de 0 a 9 años
            63 => 
            array (
                'id' => 64,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '7',                
                'concepto' => 'Menos 1.500 C.C. De 0 a 9 años',
                'valor' => '320750',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA AUTOS FAMILIARES MENOS DE 1.500 DE 10 AÑOS O MÁS
            64 => 
            array (
                'id' => 65,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '7',                
                'concepto' => 'Menos 1.500 C.C. De 10 años o más',
                'valor' => '424700',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA AUTOS FAMILIARES DE 1.500 A 2.5000 DE 0 A 9 AÑOS
            65 => 
            array (
                'id' => 66,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '7',                
                'concepto' => 'De 1.500-2.500 C.C. De 0 a 9 años',
                'valor' => '390050',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
             // SOAT Y RTM PARA AUTOS FAMILIARES DE 1.500 A 2.500 DE 10 AÑOS O MÁS
            66 => 
            array (
                'id' => 67,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '7',                
                'concepto' => 'De 1.500-2.500 C.C. De 10 años o más',
                'valor' => '485300',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA AUTOS FAMILIARES MÁS DE 2.5000 DE 0 A 9 AÑOS
            67 => 
            array (
                'id' => 68,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '7',                
                'concepto' => 'Más 2.500 C.C. De 0 a 9 años',
                'valor' => '455900',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA AUTOS FAMILIARES MÁS DE 2.500 DE 10 AÑOS O MÁS
            68 => 
            array (
                'id' => 69,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '7',               
                'concepto' => 'Más 2.500 C.C. De 10 años o más',
                'valor' => '540650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA VEHICULO 6 O + PASAJEROS MENOS 2.500 DE 0 A 9 AÑOS
            69 => 
            array (
                'id' => 70,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '8',
                'concepto' => 'Menos 2.500 C.C. De 0 a 9 años',
                'valor' => '571250',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA VEHICULO 6 O + PASAJEROS MENOS 2.500 DE 10 AÑOS O MÁS
            70 => 
            array (
                'id' => 71,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '8',
                'concepto' => 'Menos 2.500 C.C. De 10 años o más',
                'valor' => '729350',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA VEHICULO 6 O + PASAJEROS MÁS DE 2.5000 DE 0 A 9 AÑOS
            71 => 
            array (
                'id' => 72,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '8',                
                'concepto' => 'Más 2.500 C.C. De 0 a 9 años',
                'valor' => '764900',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA VEHICULO 6 O + PASAJEROS MÁS DE 2.500 DE 10 AÑOS O MÁS
            72 => 
            array (
                'id' => 73,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '8',               
                'concepto' => 'Más 2.500 C.C. De 10 años o más',
                'valor' => '918500',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA AUTOS SERVICIO PUBLICO MENOS DE 1.500 de 0 a 9 años
            73 => 
            array (
                'id' => 74,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '9',                
                'concepto' => 'Menos 1.500 C.C. De 0 a 9 años',
                'valor' => '397100',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA AUTOS SERVICIO PUBLICO MENOS DE 1.500 DE 10 AÑOS O MÁS
            74 => 
            array (
                'id' => 75,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '9',                
                'concepto' => 'Menos 1.500 C.C. De 10 años o más',
                'valor' => '495800',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA AUTOS SERVICIO PUBLICO DE 1.500 A 2.5000 DE 0 A 9 AÑOS
            75 => 
            array (
                'id' => 76,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '9',                
                'concepto' => 'De 1.500-2.500 C.C. De 0 a 9 años',
                'valor' => '493250',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
             // SOAT Y RTM PARA AUTOS SERVICIO PUBLICO DE 1.500 A 2.500 DE 10 AÑOS O MÁS
            76 => 
            array (
                'id' => 77,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '9',                
                'concepto' => 'De 1.500-2.500 C.C. De 10 años o más',
                'valor' => '609950',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA AUTOS SERVICIO PUBLICO MÁS DE 2.5000 DE 0 A 9 AÑOS
            77 => 
            array (
                'id' => 78,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '9',                
                'concepto' => 'Más 2.500 C.C. De 0 a 9 años',
                'valor' => '636650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA AUTOS SERVICIO PUBLICO MÁS DE 2.500 DE 10 AÑOS O MÁS
            78 => 
            array (
                'id' => 79,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '9',
                'concepto' => 'Más 2.500 C.C. De 10 años o más',
                'valor' => '746900',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA Bus Buseta Servicio Publico
            79 => 
            array (
                'id' => 80,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '10',
                'concepto' => 'Bus Buseta Servicio Publico',
                'valor' => '950150',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA SERVICIO PUBLICO INTERMUNICIPAL MENOS DE 10 PASAJEROS
            81 => 
            array (
                'id' => 82,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '11',
                'concepto' => 'Menos 10 pasajeros',
                'valor' => '939500',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT Y RTM PARA SERVICIO PUBLICO INTERMUNICIPAL MÁS DE 10 PASAJEROS
            82 => 
            array (
                'id' => 83,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '11',
                'concepto' => 'Más 10 pasajeros',
                'valor' => '1363550',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
        ));

    }
}
