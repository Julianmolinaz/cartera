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
            // SOAT PARA BUS BUSETA URBANO
            33 => 
            array (
                'id' => 34,
                'producto_id' => '2',
                'tipo_vehiculo_id' => '10',
                'concepto' => 'Bus Buseta Urbano',
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
            //  RTM PARA MOTOS TODOS LOS conceptoS
            36 => 
            array (
                'id' => 37,
                'producto_id' => '1',
                'tipo_vehiculo_id' => '2',
                'concepto' => '',
                'valor' => '145000',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // RTM PARA AUTOS FAMILIARES TODOS LOS conceptoS
            37 => 
            array (
                'id' => 38,
                'producto_id' => '1',
                'tipo_vehiculo_id' => '7',
                'concepto' => '',
                'valor' => '211000',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CICLOMOTOS
            38 => 
            array (
                'id' => 39,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '1',               
                'concepto' => '',
                'valor' => '319050',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            //    SOAT PARA MOTOS de 50 a 99 
            39 => 
            array (
                'id' => 40,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '2',                
                'concepto' => '',
                'valor' => '505650',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA MOTOS de 100 a 199
            40 => 
            array (
                'id' => 41,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '2',                
                'concepto' => '',
                'valor' => '628950',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA MOTOS mas de 200
            41 => 
            array (
                'id' => 42,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '2',                
                'concepto' => '',
                'valor' => '690450',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
            // SOAT PARA CAMPEROS Y CAMIONETAS MENOS DE 1.500 de 0 a 9 años
            42 => 
            array (
                'id' => 43,
                'producto_id' => '3',
                'tipo_vehiculo_id' => '4',                
                'concepto' => '',
                'valor' => '713250',
                'estado' => '',
                'created_at' => '2017-07-23 22:41:23',
                'updated_at' => '2017-07-24 07:20:16',
            ),
        ));
    }
}
