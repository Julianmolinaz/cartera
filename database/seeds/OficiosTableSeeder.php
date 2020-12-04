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
        \DB::table('oficios')->delete();
        
        \DB::table('oficios')->insert(array (
            0 => 
            array (
                'id' => 3,
                'nombre' => 'Abogado/a',
            ),
            1 => 
            array (
                'id' => 23,
                'nombre' => 'Administrador De Finca',
            ),
            2 => 
            array (
                'id' => 20,
                'nombre' => 'Administrador/a',
            ),
            3 => 
            array (
                'id' => 27,
                'nombre' => 'Agente De Transito',
            ),
            4 => 
            array (
                'id' => 29,
                'nombre' => 'Agricultor',
            ),
            5 => 
            array (
                'id' => 32,
                'nombre' => 'Albañil',
            ),
            6 => 
            array (
                'id' => 33,
                'nombre' => 'Almacenista',
            ),
            7 => 
            array (
                'id' => 34,
                'nombre' => 'Alquiler De Equipos',
            ),
            8 => 
            array (
                'id' => 8,
                'nombre' => 'Ama De Casa',
            ),
            9 => 
            array (
                'id' => 35,
                'nombre' => 'Ama De Llaves',
            ),
            10 => 
            array (
                'id' => 36,
                'nombre' => 'Analista',
            ),
            11 => 
            array (
                'id' => 30,
                'nombre' => 'Apicultor',
            ),
            12 => 
            array (
                'id' => 39,
                'nombre' => 'Arquitecto',
            ),
            13 => 
            array (
                'id' => 40,
                'nombre' => 'Arrendatario/a',
            ),
            14 => 
            array (
                'id' => 42,
                'nombre' => 'Arriero',
            ),
            15 => 
            array (
                'id' => 41,
                'nombre' => 'Artesano',
            ),
            16 => 
            array (
                'id' => 43,
                'nombre' => 'Aseador',
            ),
            17 => 
            array (
                'id' => 4,
                'nombre' => 'Asesor Comercial',
            ),
            18 => 
            array (
                'id' => 44,
                'nombre' => 'Asistente',
            ),
            19 => 
            array (
                'id' => 45,
                'nombre' => 'Atención Al Cliente',
            ),
            20 => 
            array (
                'id' => 46,
                'nombre' => 'Auxiliar Administrativo',
            ),
            21 => 
            array (
                'id' => 26,
                'nombre' => 'Auxiliar Contable',
            ),
            22 => 
            array (
                'id' => 48,
                'nombre' => 'Auxiliar De Bodega',
            ),
            23 => 
            array (
                'id' => 49,
                'nombre' => 'Auxiliar De Construcción',
            ),
            24 => 
            array (
                'id' => 50,
                'nombre' => 'Auxiliar De Servicios Generales',
            ),
            25 => 
            array (
                'id' => 51,
                'nombre' => 'Auxiliar Operativo',
            ),
            26 => 
            array (
                'id' => 53,
                'nombre' => 'Ayudante De Construcción',
            ),
            27 => 
            array (
                'id' => 54,
                'nombre' => 'Barbero',
            ),
            28 => 
            array (
                'id' => 19,
                'nombre' => 'Belleza',
            ),
            29 => 
            array (
                'id' => 55,
                'nombre' => 'Bodeguero',
            ),
            30 => 
            array (
                'id' => 56,
                'nombre' => 'Bombero',
            ),
            31 => 
            array (
                'id' => 57,
                'nombre' => 'Caficultor',
            ),
            32 => 
            array (
                'id' => 22,
                'nombre' => 'Cajero',
            ),
            33 => 
            array (
                'id' => 58,
                'nombre' => 'Camarero',
            ),
            34 => 
            array (
                'id' => 59,
                'nombre' => 'Carpintero',
            ),
            35 => 
            array (
                'id' => 61,
                'nombre' => 'Chef',
            ),
            36 => 
            array (
                'id' => 21,
                'nombre' => 'Cobrador',
            ),
            37 => 
            array (
                'id' => 62,
                'nombre' => 'Cocinero',
            ),
            38 => 
            array (
                'id' => 63,
                'nombre' => 'Comerciante',
            ),
            39 => 
            array (
                'id' => 11,
                'nombre' => 'Conductor',
            ),
            40 => 
            array (
                'id' => 64,
                'nombre' => 'Constructor',
            ),
            41 => 
            array (
                'id' => 89,
                'nombre' => 'Contador/a',
            ),
            42 => 
            array (
                'id' => 65,
                'nombre' => 'Coordinador',
            ),
            43 => 
            array (
                'id' => 87,
                'nombre' => 'Decorador',
            ),
            44 => 
            array (
                'id' => 66,
                'nombre' => 'Docente',
            ),
            45 => 
            array (
                'id' => 67,
                'nombre' => 'Domicilio',
            ),
            46 => 
            array (
                'id' => 86,
                'nombre' => 'Dueño De Negocio',
            ),
            47 => 
            array (
                'id' => 68,
                'nombre' => 'Ebanista',
            ),
            48 => 
            array (
                'id' => 85,
                'nombre' => 'Electricista',
            ),
            49 => 
            array (
                'id' => 69,
                'nombre' => 'Empleado Domestico',
            ),
            50 => 
            array (
                'id' => 71,
                'nombre' => 'Enfermera',
            ),
            51 => 
            array (
                'id' => 70,
                'nombre' => 'Estilista',
            ),
            52 => 
            array (
                'id' => 7,
                'nombre' => 'Estudiante',
            ),
            53 => 
            array (
                'id' => 94,
                'nombre' => 'Farmaceuta',
            ),
            54 => 
            array (
                'id' => 31,
                'nombre' => 'Ganadero',
            ),
            55 => 
            array (
                'id' => 82,
                'nombre' => 'Gerente',
            ),
            56 => 
            array (
                'id' => 2,
                'nombre' => 'Ingeniero',
            ),
            57 => 
            array (
                'id' => 1,
                'nombre' => 'Ingeniero De Sistemas',
            ),
            58 => 
            array (
                'id' => 84,
                'nombre' => 'Instalador',
            ),
            59 => 
            array (
                'id' => 91,
                'nombre' => 'Jardinero',
            ),
            60 => 
            array (
                'id' => 72,
                'nombre' => 'Maestro De Obra',
            ),
            61 => 
            array (
                'id' => 37,
                'nombre' => 'Manicurista',
            ),
            62 => 
            array (
                'id' => 81,
                'nombre' => 'Mayordomo',
            ),
            63 => 
            array (
                'id' => 12,
                'nombre' => 'Mecánico',
            ),
            64 => 
            array (
                'id' => 13,
                'nombre' => 'Mensajero',
            ),
            65 => 
            array (
                'id' => 73,
                'nombre' => 'Mesero',
            ),
            66 => 
            array (
                'id' => 14,
                'nombre' => 'Minero',
            ),
            67 => 
            array (
                'id' => 80,
                'nombre' => 'Modista',
            ),
            68 => 
            array (
                'id' => 6,
                'nombre' => 'Músico',
            ),
            69 => 
            array (
                'id' => 74,
                'nombre' => 'Obrero',
            ),
            70 => 
            array (
                'id' => 75,
                'nombre' => 'Oficial',
            ),
            71 => 
            array (
                'id' => 15,
                'nombre' => 'Oficios Varios',
            ),
            72 => 
            array (
                'id' => 17,
                'nombre' => 'Operario',
            ),
            73 => 
            array (
                'id' => 90,
                'nombre' => 'Panadero',
            ),
            74 => 
            array (
                'id' => 9,
                'nombre' => 'Pensionado',
            ),
            75 => 
            array (
                'id' => 16,
                'nombre' => 'Policia',
            ),
            76 => 
            array (
                'id' => 93,
                'nombre' => 'Profesional Deportivo',
            ),
            77 => 
            array (
                'id' => 52,
                'nombre' => 'Profesor/a',
            ),
            78 => 
            array (
                'id' => 79,
                'nombre' => 'Psicologo/a',
            ),
            79 => 
            array (
                'id' => 83,
                'nombre' => 'Religioso',
            ),
            80 => 
            array (
                'id' => 92,
                'nombre' => 'Rentista De Capital',
            ),
            81 => 
            array (
                'id' => 78,
                'nombre' => 'Secretario/a',
            ),
            82 => 
            array (
                'id' => 76,
                'nombre' => 'Soldado',
            ),
            83 => 
            array (
                'id' => 88,
                'nombre' => 'Soldador',
            ),
            84 => 
            array (
                'id' => 77,
                'nombre' => 'Supervisor',
            ),
            85 => 
            array (
                'id' => 24,
                'nombre' => 'Taxista',
            ),
            86 => 
            array (
                'id' => 28,
                'nombre' => 'Técnico',
            ),
            87 => 
            array (
                'id' => 25,
                'nombre' => 'Tendero',
            ),
            88 => 
            array (
                'id' => 10,
                'nombre' => 'Trabajador Público',
            ),
            89 => 
            array (
                'id' => 18,
                'nombre' => 'Transporte',
            ),
            90 => 
            array (
                'id' => 5,
                'nombre' => 'Vendedor',
            ),
            91 => 
            array (
                'id' => 60,
                'nombre' => 'Vigilancia Privada',
            ),
        ));
        
    }
}
