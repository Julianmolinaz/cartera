<?php

use Illuminate\Database\Seeder;

class MunicipiosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // CONFIGURACION

        \DB::table('municipios')->delete();
        
        \DB::table('municipios')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'PEREIRA',
                'departamento' => 'RISARALDA',
                'codigo_municipio' => '001',
                'codigo_departamento' => '66',
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'DOSQUEBRADAS',
                'departamento' => 'RISARALDA',
                'codigo_municipio' => '170',
                'codigo_departamento' => '66',
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'MANIZALES',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '001',
                'codigo_departamento' => '17',
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'ARMENIA',
                'departamento' => 'QUINDIO',
                'codigo_municipio' => '001',
                'codigo_departamento' => '63',
            ),
            4 => 
            array (
                'id' => 100,
                'nombre' => '',
                'departamento' => '',
                'codigo_municipio' => NULL,
                'codigo_departamento' => NULL,
            ),
            5 => 
            array (
                'id' => 101,
                'nombre' => 'ABEJORRAL',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '002',
                'codigo_departamento' => '05',
            ),
            6 => 
            array (
                'id' => 102,
                'nombre' => 'ABREGO',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '003',
                'codigo_departamento' => '54',
            ),
            7 => 
            array (
                'id' => 103,
                'nombre' => 'ABRIAQUI',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '004',
                'codigo_departamento' => '05',
            ),
            8 => 
            array (
                'id' => 104,
                'nombre' => 'ACACIAS',
                'departamento' => 'META',
                'codigo_municipio' => '006',
                'codigo_departamento' => '50',
            ),
            9 => 
            array (
                'id' => 105,
                'nombre' => 'ACANDI',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '006',
                'codigo_departamento' => '27',
            ),
            10 => 
            array (
                'id' => 106,
                'nombre' => 'ACEVEDO',
                'departamento' => 'HUILA',
                'codigo_municipio' => '006',
                'codigo_departamento' => '41',
            ),
            11 => 
            array (
                'id' => 107,
                'nombre' => 'ACHI',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '006',
                'codigo_departamento' => '13',
            ),
            12 => 
            array (
                'id' => 108,
                'nombre' => 'AGRADO',
                'departamento' => 'HUILA',
                'codigo_municipio' => '013',
                'codigo_departamento' => '41',
            ),
            13 => 
            array (
                'id' => 109,
                'nombre' => 'AGUA DE DIOS',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '001',
                'codigo_departamento' => '25',
            ),
            14 => 
            array (
                'id' => 110,
                'nombre' => 'AGUACHICA',
                'departamento' => 'CESAR',
                'codigo_municipio' => '011',
                'codigo_departamento' => '20',
            ),
            15 => 
            array (
                'id' => 111,
                'nombre' => 'AGUADA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '013',
                'codigo_departamento' => '68',
            ),
            16 => 
            array (
                'id' => 112,
                'nombre' => 'AGUADAS',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '013',
                'codigo_departamento' => '17',
            ),
            17 => 
            array (
                'id' => 113,
                'nombre' => 'AGUAZUL',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '010',
                'codigo_departamento' => '85',
            ),
            18 => 
            array (
                'id' => 114,
                'nombre' => 'AGUSTIN CODAZZI',
                'departamento' => 'CESAR',
                'codigo_municipio' => '013',
                'codigo_departamento' => '20',
            ),
            19 => 
            array (
                'id' => 115,
                'nombre' => 'AIPE',
                'departamento' => 'HUILA',
                'codigo_municipio' => '016',
                'codigo_departamento' => '41',
            ),
            20 => 
            array (
                'id' => 116,
                'nombre' => 'ALBAN',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '019',
                'codigo_departamento' => '25',
            ),
            21 => 
            array (
                'id' => 117,
                'nombre' => 'ALBAN',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '019',
                'codigo_departamento' => '52',
            ),
            22 => 
            array (
                'id' => 118,
                'nombre' => 'ALBANIA',
                'departamento' => 'CAQUETÁ',
                'codigo_municipio' => '029',
                'codigo_departamento' => '18',
            ),
            23 => 
            array (
                'id' => 119,
                'nombre' => 'ALBANIA',
                'departamento' => 'LA GUAJIRA',
                'codigo_municipio' => '035',
                'codigo_departamento' => '44',
            ),
            24 => 
            array (
                'id' => 120,
                'nombre' => 'ALBANIA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '020',
                'codigo_departamento' => '68',
            ),
            25 => 
            array (
                'id' => 121,
                'nombre' => 'ALCALA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '020',
                'codigo_departamento' => '76',
            ),
            26 => 
            array (
                'id' => 122,
                'nombre' => 'ALDANA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '022',
                'codigo_departamento' => '52',
            ),
            27 => 
            array (
                'id' => 123,
                'nombre' => 'ALEJANDRIA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '021',
                'codigo_departamento' => '05',
            ),
            28 => 
            array (
                'id' => 124,
                'nombre' => 'ALGARROBO',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '030',
                'codigo_departamento' => '47',
            ),
            29 => 
            array (
                'id' => 125,
                'nombre' => 'ALGECIRAS',
                'departamento' => 'HUILA',
                'codigo_municipio' => '020',
                'codigo_departamento' => '41',
            ),
            30 => 
            array (
                'id' => 126,
                'nombre' => 'ALMAGUER',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '022',
                'codigo_departamento' => '19',
            ),
            31 => 
            array (
                'id' => 127,
                'nombre' => 'ALMEIDA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '022',
                'codigo_departamento' => '15',
            ),
            32 => 
            array (
                'id' => 128,
                'nombre' => 'ALPUJARRA',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '024',
                'codigo_departamento' => '73',
            ),
            33 => 
            array (
                'id' => 129,
                'nombre' => 'ALTAMIRA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '026',
                'codigo_departamento' => '41',
            ),
            34 => 
            array (
                'id' => 130,
                'nombre' => 'ALTO BAUDO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '025',
                'codigo_departamento' => '27',
            ),
            35 => 
            array (
                'id' => 131,
                'nombre' => 'ALTOS DEL ROSARIO',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '030',
                'codigo_departamento' => '13',
            ),
            36 => 
            array (
                'id' => 132,
                'nombre' => 'ALVARADO',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '026',
                'codigo_departamento' => '73',
            ),
            37 => 
            array (
                'id' => 133,
                'nombre' => 'AMAGA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '030',
                'codigo_departamento' => '05',
            ),
            38 => 
            array (
                'id' => 134,
                'nombre' => 'AMALFI',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '031',
                'codigo_departamento' => '05',
            ),
            39 => 
            array (
                'id' => 135,
                'nombre' => 'AMBALEMA',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '030',
                'codigo_departamento' => '73',
            ),
            40 => 
            array (
                'id' => 136,
                'nombre' => 'ANAPOIMA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '035',
                'codigo_departamento' => '25',
            ),
            41 => 
            array (
                'id' => 137,
                'nombre' => 'ANCUYA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '036',
                'codigo_departamento' => '52',
            ),
            42 => 
            array (
                'id' => 138,
                'nombre' => 'ANDALUCIA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '036',
                'codigo_departamento' => '76',
            ),
            43 => 
            array (
                'id' => 139,
                'nombre' => 'ANDES',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '034',
                'codigo_departamento' => '05',
            ),
            44 => 
            array (
                'id' => 140,
                'nombre' => 'ANGELOPOLIS',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '036',
                'codigo_departamento' => '05',
            ),
            45 => 
            array (
                'id' => 141,
                'nombre' => 'ANGOSTURA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '038',
                'codigo_departamento' => '05',
            ),
            46 => 
            array (
                'id' => 142,
                'nombre' => 'ANOLAIMA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '040',
                'codigo_departamento' => '25',
            ),
            47 => 
            array (
                'id' => 143,
                'nombre' => 'ANORI',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '040',
                'codigo_departamento' => '05',
            ),
            48 => 
            array (
                'id' => 144,
                'nombre' => 'ANSERMA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '042',
                'codigo_departamento' => '17',
            ),
            49 => 
            array (
                'id' => 145,
                'nombre' => 'ANSERMANUEVO',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '041',
                'codigo_departamento' => '76',
            ),
            50 => 
            array (
                'id' => 146,
                'nombre' => 'ANZA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '044',
                'codigo_departamento' => '05',
            ),
            51 => 
            array (
                'id' => 147,
                'nombre' => 'ANZOATEGUI',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '043',
                'codigo_departamento' => '73',
            ),
            52 => 
            array (
                'id' => 148,
                'nombre' => 'APARTADO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '045',
                'codigo_departamento' => '05',
            ),
            53 => 
            array (
                'id' => 149,
                'nombre' => 'APIA',
                'departamento' => 'RISARALDA',
                'codigo_municipio' => '045',
                'codigo_departamento' => '66',
            ),
            54 => 
            array (
                'id' => 150,
                'nombre' => 'APULO',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '599',
                'codigo_departamento' => '25',
            ),
            55 => 
            array (
                'id' => 151,
                'nombre' => 'AQUITANIA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '047',
                'codigo_departamento' => '15',
            ),
            56 => 
            array (
                'id' => 152,
                'nombre' => 'ARACATACA',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '053',
                'codigo_departamento' => '47',
            ),
            57 => 
            array (
                'id' => 153,
                'nombre' => 'ARANZAZU',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '050',
                'codigo_departamento' => '17',
            ),
            58 => 
            array (
                'id' => 154,
                'nombre' => 'ARATOCA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '051',
                'codigo_departamento' => '68',
            ),
            59 => 
            array (
                'id' => 155,
                'nombre' => 'ARAUCA',
                'departamento' => 'ARAUCA',
                'codigo_municipio' => '001',
                'codigo_departamento' => '81',
            ),
            60 => 
            array (
                'id' => 156,
                'nombre' => 'ARAUQUITA',
                'departamento' => 'ARAUCA',
                'codigo_municipio' => '065',
                'codigo_departamento' => '81',
            ),
            61 => 
            array (
                'id' => 157,
                'nombre' => 'ARBELAEZ',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '053',
                'codigo_departamento' => '25',
            ),
            62 => 
            array (
                'id' => 158,
                'nombre' => 'ARBOLEDA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '051',
                'codigo_departamento' => '52',
            ),
            63 => 
            array (
                'id' => 159,
                'nombre' => 'ARBOLEDAS',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '051',
                'codigo_departamento' => '54',
            ),
            64 => 
            array (
                'id' => 160,
                'nombre' => 'ARBOLETES',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '051',
                'codigo_departamento' => '05',
            ),
            65 => 
            array (
                'id' => 161,
                'nombre' => 'ARCABUCO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '051',
                'codigo_departamento' => '15',
            ),
            66 => 
            array (
                'id' => 162,
                'nombre' => 'ARENAL',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '042',
                'codigo_departamento' => '13',
            ),
            67 => 
            array (
                'id' => 163,
                'nombre' => 'ARGELIA',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '050',
                'codigo_departamento' => '19',
            ),
            68 => 
            array (
                'id' => 164,
                'nombre' => 'ARGELIA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '054',
                'codigo_departamento' => '76',
            ),
            69 => 
            array (
                'id' => 165,
                'nombre' => 'ARGELIA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '055',
                'codigo_departamento' => '05',
            ),
            70 => 
            array (
                'id' => 166,
                'nombre' => 'ARIGUANI',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '058',
                'codigo_departamento' => '47',
            ),
            71 => 
            array (
                'id' => 167,
                'nombre' => 'ARJONA',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '052',
                'codigo_departamento' => '13',
            ),
            72 => 
            array (
                'id' => 169,
                'nombre' => 'ARMERO',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '055',
                'codigo_departamento' => '73',
            ),
            73 => 
            array (
                'id' => 170,
                'nombre' => 'ARROYOHONDO',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '062',
                'codigo_departamento' => '13',
            ),
            74 => 
            array (
                'id' => 171,
                'nombre' => 'ASTREA',
                'departamento' => 'CESAR',
                'codigo_municipio' => '032',
                'codigo_departamento' => '20',
            ),
            75 => 
            array (
                'id' => 172,
                'nombre' => 'ATACO',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '067',
                'codigo_departamento' => '73',
            ),
            76 => 
            array (
                'id' => 173,
                'nombre' => 'ATRATO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '050',
                'codigo_departamento' => '27',
            ),
            77 => 
            array (
                'id' => 174,
                'nombre' => 'AYAPEL',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '068',
                'codigo_departamento' => '23',
            ),
            78 => 
            array (
                'id' => 175,
                'nombre' => 'BAGADO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '073',
                'codigo_departamento' => '27',
            ),
            79 => 
            array (
                'id' => 176,
                'nombre' => 'BAHIA SOLANO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '075',
                'codigo_departamento' => '27',
            ),
            80 => 
            array (
                'id' => 177,
                'nombre' => 'BAJO BAUDO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '077',
                'codigo_departamento' => '27',
            ),
            81 => 
            array (
                'id' => 178,
                'nombre' => 'BALBOA',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '075',
                'codigo_departamento' => '19',
            ),
            82 => 
            array (
                'id' => 179,
                'nombre' => 'BALBOA',
                'departamento' => 'RISARALDA',
                'codigo_municipio' => '075',
                'codigo_departamento' => '66',
            ),
            83 => 
            array (
                'id' => 180,
                'nombre' => 'BARANOA',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '078',
                'codigo_departamento' => '08',
            ),
            84 => 
            array (
                'id' => 181,
                'nombre' => 'BARAYA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '078',
                'codigo_departamento' => '41',
            ),
            85 => 
            array (
                'id' => 182,
                'nombre' => 'BARBACOAS',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '079',
                'codigo_departamento' => '52',
            ),
            86 => 
            array (
                'id' => 183,
                'nombre' => 'BARBOSA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '077',
                'codigo_departamento' => '68',
            ),
            87 => 
            array (
                'id' => 184,
                'nombre' => 'BARBOSA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '079',
                'codigo_departamento' => '05',
            ),
            88 => 
            array (
                'id' => 185,
                'nombre' => 'BARICHARA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '079',
                'codigo_departamento' => '68',
            ),
            89 => 
            array (
                'id' => 186,
                'nombre' => 'BARRANCA DE UPIA',
                'departamento' => 'META',
                'codigo_municipio' => '110',
                'codigo_departamento' => '50',
            ),
            90 => 
            array (
                'id' => 187,
                'nombre' => 'BARRANCABERMEJA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '081',
                'codigo_departamento' => '68',
            ),
            91 => 
            array (
                'id' => 188,
                'nombre' => 'BARRANCAS',
                'departamento' => 'LA GUAJIRA',
                'codigo_municipio' => '078',
                'codigo_departamento' => '44',
            ),
            92 => 
            array (
                'id' => 189,
                'nombre' => 'BARRANCO DE LOBA',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '074',
                'codigo_departamento' => '13',
            ),
            93 => 
            array (
                'id' => 190,
                'nombre' => 'BARRANCO MINAS',
                'departamento' => 'GUAINÍA',
                'codigo_municipio' => '343',
                'codigo_departamento' => '94',
            ),
            94 => 
            array (
                'id' => 191,
                'nombre' => 'BARRANQUILLA',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '001',
                'codigo_departamento' => '08',
            ),
            95 => 
            array (
                'id' => 192,
                'nombre' => 'BECERRIL',
                'departamento' => 'CESAR',
                'codigo_municipio' => '045',
                'codigo_departamento' => '20',
            ),
            96 => 
            array (
                'id' => 193,
                'nombre' => 'BELALCAZAR',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '088',
                'codigo_departamento' => '17',
            ),
            97 => 
            array (
                'id' => 194,
                'nombre' => 'BELEN',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '083',
                'codigo_departamento' => '52',
            ),
            98 => 
            array (
                'id' => 195,
                'nombre' => 'BELEN',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '087',
                'codigo_departamento' => '15',
            ),
            99 => 
            array (
                'id' => 196,
                'nombre' => 'BELEN DE LOS ANDAQUIES',
                'departamento' => 'CAQUETÁ',
                'codigo_municipio' => '094',
                'codigo_departamento' => '18',
            ),
            100 => 
            array (
                'id' => 197,
                'nombre' => 'BELEN DE UMBRIA',
                'departamento' => 'RISARALDA',
                'codigo_municipio' => '088',
                'codigo_departamento' => '66',
            ),
            101 => 
            array (
                'id' => 198,
                'nombre' => 'BELLO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '088',
                'codigo_departamento' => '05',
            ),
            102 => 
            array (
                'id' => 199,
                'nombre' => 'BELMIRA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '086',
                'codigo_departamento' => '05',
            ),
            103 => 
            array (
                'id' => 200,
                'nombre' => 'BELTRAN',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '086',
                'codigo_departamento' => '25',
            ),
            104 => 
            array (
                'id' => 201,
                'nombre' => 'BERBEO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '090',
                'codigo_departamento' => '15',
            ),
            105 => 
            array (
                'id' => 202,
                'nombre' => 'BETANIA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '091',
                'codigo_departamento' => '05',
            ),
            106 => 
            array (
                'id' => 203,
                'nombre' => 'BETEITIVA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '092',
                'codigo_departamento' => '15',
            ),
            107 => 
            array (
                'id' => 204,
                'nombre' => 'BETULIA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '092',
                'codigo_departamento' => '68',
            ),
            108 => 
            array (
                'id' => 205,
                'nombre' => 'BETULIA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '093',
                'codigo_departamento' => '05',
            ),
            109 => 
            array (
                'id' => 206,
                'nombre' => 'BITUIMA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '095',
                'codigo_departamento' => '25',
            ),
            110 => 
            array (
                'id' => 207,
                'nombre' => 'BOAVITA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '097',
                'codigo_departamento' => '15',
            ),
            111 => 
            array (
                'id' => 208,
                'nombre' => 'BOCHALEMA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '099',
                'codigo_departamento' => '54',
            ),
            112 => 
            array (
                'id' => 209,
                'nombre' => 'D.C.',
                'departamento' => 'BOGOTÁ',
                'codigo_municipio' => '001',
                'codigo_departamento' => '11',
            ),
            113 => 
            array (
                'id' => 210,
                'nombre' => 'BOJACA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '099',
                'codigo_departamento' => '25',
            ),
            114 => 
            array (
                'id' => 211,
                'nombre' => 'BOJAYA',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '099',
                'codigo_departamento' => '27',
            ),
            115 => 
            array (
                'id' => 212,
                'nombre' => 'BOLIVAR',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '100',
                'codigo_departamento' => '19',
            ),
            116 => 
            array (
                'id' => 213,
                'nombre' => 'BOLIVAR',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '101',
                'codigo_departamento' => '68',
            ),
            117 => 
            array (
                'id' => 214,
                'nombre' => 'BOLIVAR',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '100',
                'codigo_departamento' => '76',
            ),
            118 => 
            array (
                'id' => 215,
                'nombre' => 'BOSCONIA',
                'departamento' => 'CESAR',
                'codigo_municipio' => '060',
                'codigo_departamento' => '20',
            ),
            119 => 
            array (
                'id' => 216,
                'nombre' => 'BOYACA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '104',
                'codigo_departamento' => '15',
            ),
            120 => 
            array (
                'id' => 217,
                'nombre' => 'BRICEÑO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '106',
                'codigo_departamento' => '15',
            ),
            121 => 
            array (
                'id' => 218,
                'nombre' => 'BRICEÑO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '107',
                'codigo_departamento' => '05',
            ),
            122 => 
            array (
                'id' => 219,
                'nombre' => 'BUCARAMANGA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '001',
                'codigo_departamento' => '68',
            ),
            123 => 
            array (
                'id' => 220,
                'nombre' => 'BUCARASICA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '109',
                'codigo_departamento' => '54',
            ),
            124 => 
            array (
                'id' => 221,
                'nombre' => 'BUENAVENTURA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '109',
                'codigo_departamento' => '76',
            ),
            125 => 
            array (
                'id' => 222,
                'nombre' => 'BUENAVISTA',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '079',
                'codigo_departamento' => '23',
            ),
            126 => 
            array (
                'id' => 223,
                'nombre' => 'BUENAVISTA',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '110',
                'codigo_departamento' => '70',
            ),
            127 => 
            array (
                'id' => 224,
                'nombre' => 'BUENAVISTA',
                'departamento' => 'QUINDIO',
                'codigo_municipio' => '111',
                'codigo_departamento' => '63',
            ),
            128 => 
            array (
                'id' => 225,
                'nombre' => 'BUENAVISTA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '109',
                'codigo_departamento' => '15',
            ),
            129 => 
            array (
                'id' => 226,
                'nombre' => 'BUENOS AIRES',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '110',
                'codigo_departamento' => '19',
            ),
            130 => 
            array (
                'id' => 227,
                'nombre' => 'BUESACO',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '110',
                'codigo_departamento' => '52',
            ),
            131 => 
            array (
                'id' => 228,
                'nombre' => 'BUGALAGRANDE',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '113',
                'codigo_departamento' => '76',
            ),
            132 => 
            array (
                'id' => 229,
                'nombre' => 'BURITICA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '113',
                'codigo_departamento' => '05',
            ),
            133 => 
            array (
                'id' => 230,
                'nombre' => 'BUSBANZA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '114',
                'codigo_departamento' => '15',
            ),
            134 => 
            array (
                'id' => 231,
                'nombre' => 'CABRERA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '120',
                'codigo_departamento' => '25',
            ),
            135 => 
            array (
                'id' => 232,
                'nombre' => 'CABRERA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '121',
                'codigo_departamento' => '68',
            ),
            136 => 
            array (
                'id' => 233,
                'nombre' => 'CABUYARO',
                'departamento' => 'META',
                'codigo_municipio' => '124',
                'codigo_departamento' => '50',
            ),
            137 => 
            array (
                'id' => 234,
                'nombre' => 'CACAHUAL',
                'departamento' => 'GUAINÍA',
                'codigo_municipio' => '886',
                'codigo_departamento' => '94',
            ),
            138 => 
            array (
                'id' => 235,
                'nombre' => 'CACERES',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '120',
                'codigo_departamento' => '05',
            ),
            139 => 
            array (
                'id' => 236,
                'nombre' => 'CACHIPAY',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '123',
                'codigo_departamento' => '25',
            ),
            140 => 
            array (
                'id' => 237,
                'nombre' => 'CACHIRA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '128',
                'codigo_departamento' => '54',
            ),
            141 => 
            array (
                'id' => 238,
                'nombre' => 'CACOTA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '125',
                'codigo_departamento' => '54',
            ),
            142 => 
            array (
                'id' => 239,
                'nombre' => 'CAICEDO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '125',
                'codigo_departamento' => '05',
            ),
            143 => 
            array (
                'id' => 240,
                'nombre' => 'CAICEDONIA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '122',
                'codigo_departamento' => '76',
            ),
            144 => 
            array (
                'id' => 241,
                'nombre' => 'CAIMITO',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '124',
                'codigo_departamento' => '70',
            ),
            145 => 
            array (
                'id' => 242,
                'nombre' => 'CAJAMARCA',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '124',
                'codigo_departamento' => '73',
            ),
            146 => 
            array (
                'id' => 243,
                'nombre' => 'CAJIBIO',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '130',
                'codigo_departamento' => '19',
            ),
            147 => 
            array (
                'id' => 244,
                'nombre' => 'CAJICA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '126',
                'codigo_departamento' => '25',
            ),
            148 => 
            array (
                'id' => 245,
                'nombre' => 'CALAMAR',
                'departamento' => 'GUAVIARE',
                'codigo_municipio' => '015',
                'codigo_departamento' => '95',
            ),
            149 => 
            array (
                'id' => 246,
                'nombre' => 'CALAMAR',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '140',
                'codigo_departamento' => '13',
            ),
            150 => 
            array (
                'id' => 247,
                'nombre' => 'CALARCA',
                'departamento' => 'QUINDIO',
                'codigo_municipio' => '130',
                'codigo_departamento' => '63',
            ),
            151 => 
            array (
                'id' => 248,
                'nombre' => 'CALDAS',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '129',
                'codigo_departamento' => '05',
            ),
            152 => 
            array (
                'id' => 249,
                'nombre' => 'CALDAS',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '131',
                'codigo_departamento' => '15',
            ),
            153 => 
            array (
                'id' => 250,
                'nombre' => 'CALDONO',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '137',
                'codigo_departamento' => '19',
            ),
            154 => 
            array (
                'id' => 251,
                'nombre' => 'CALI',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '001',
                'codigo_departamento' => '76',
            ),
            155 => 
            array (
                'id' => 252,
                'nombre' => 'CALIFORNIA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '132',
                'codigo_departamento' => '68',
            ),
            156 => 
            array (
                'id' => 253,
                'nombre' => 'CALIMA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '126',
                'codigo_departamento' => '76',
            ),
            157 => 
            array (
                'id' => 254,
                'nombre' => 'CALOTO',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '142',
                'codigo_departamento' => '19',
            ),
            158 => 
            array (
                'id' => 255,
                'nombre' => 'CAMPAMENTO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '134',
                'codigo_departamento' => '05',
            ),
            159 => 
            array (
                'id' => 256,
                'nombre' => 'CAMPO DE LA CRUZ',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '137',
                'codigo_departamento' => '08',
            ),
            160 => 
            array (
                'id' => 257,
                'nombre' => 'CAMPOALEGRE',
                'departamento' => 'HUILA',
                'codigo_municipio' => '132',
                'codigo_departamento' => '41',
            ),
            161 => 
            array (
                'id' => 258,
                'nombre' => 'CAMPOHERMOSO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '135',
                'codigo_departamento' => '15',
            ),
            162 => 
            array (
                'id' => 259,
                'nombre' => 'CANALETE',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '090',
                'codigo_departamento' => '23',
            ),
            163 => 
            array (
                'id' => 260,
                'nombre' => 'CAÑASGORDAS',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '138',
                'codigo_departamento' => '05',
            ),
            164 => 
            array (
                'id' => 261,
                'nombre' => 'CANDELARIA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '130',
                'codigo_departamento' => '76',
            ),
            165 => 
            array (
                'id' => 262,
                'nombre' => 'CANDELARIA',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '141',
                'codigo_departamento' => '08',
            ),
            166 => 
            array (
                'id' => 263,
                'nombre' => 'CANTAGALLO',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '160',
                'codigo_departamento' => '13',
            ),
            167 => 
            array (
                'id' => 264,
                'nombre' => 'CAPARRAPI',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '148',
                'codigo_departamento' => '25',
            ),
            168 => 
            array (
                'id' => 265,
                'nombre' => 'CAPITANEJO',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '147',
                'codigo_departamento' => '68',
            ),
            169 => 
            array (
                'id' => 266,
                'nombre' => 'CAQUEZA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '151',
                'codigo_departamento' => '25',
            ),
            170 => 
            array (
                'id' => 267,
                'nombre' => 'CARACOLI',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '142',
                'codigo_departamento' => '05',
            ),
            171 => 
            array (
                'id' => 268,
                'nombre' => 'CARAMANTA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '145',
                'codigo_departamento' => '05',
            ),
            172 => 
            array (
                'id' => 269,
                'nombre' => 'CARCASI',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '152',
                'codigo_departamento' => '68',
            ),
            173 => 
            array (
                'id' => 270,
                'nombre' => 'CAREPA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '147',
                'codigo_departamento' => '05',
            ),
            174 => 
            array (
                'id' => 271,
                'nombre' => 'CARMEN DE APICALA',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '148',
                'codigo_departamento' => '73',
            ),
            175 => 
            array (
                'id' => 272,
                'nombre' => 'CARMEN DE CARUPA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '154',
                'codigo_departamento' => '25',
            ),
            176 => 
            array (
                'id' => 273,
                'nombre' => 'CARMEN DEL DARIEN',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '150',
                'codigo_departamento' => '27',
            ),
            177 => 
            array (
                'id' => 274,
                'nombre' => 'CAROLINA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '150',
                'codigo_departamento' => '05',
            ),
            178 => 
            array (
                'id' => 275,
                'nombre' => 'CARTAGENA',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '001',
                'codigo_departamento' => '13',
            ),
            179 => 
            array (
                'id' => 276,
                'nombre' => 'CARTAGENA DEL CHAIRA',
                'departamento' => 'CAQUETÁ',
                'codigo_municipio' => '150',
                'codigo_departamento' => '18',
            ),
            180 => 
            array (
                'id' => 277,
                'nombre' => 'CARTAGO',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '147',
                'codigo_departamento' => '76',
            ),
            181 => 
            array (
                'id' => 278,
                'nombre' => 'CARURU',
                'departamento' => 'VAUPÉS',
                'codigo_municipio' => '161',
                'codigo_departamento' => '97',
            ),
            182 => 
            array (
                'id' => 279,
                'nombre' => 'CASABIANCA',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '152',
                'codigo_departamento' => '73',
            ),
            183 => 
            array (
                'id' => 280,
                'nombre' => 'CASTILLA LA NUEVA',
                'departamento' => 'META',
                'codigo_municipio' => '150',
                'codigo_departamento' => '50',
            ),
            184 => 
            array (
                'id' => 281,
                'nombre' => 'CAUCASIA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '154',
                'codigo_departamento' => '05',
            ),
            185 => 
            array (
                'id' => 282,
                'nombre' => 'CEPITA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '160',
                'codigo_departamento' => '68',
            ),
            186 => 
            array (
                'id' => 283,
                'nombre' => 'CERETE',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '162',
                'codigo_departamento' => '23',
            ),
            187 => 
            array (
                'id' => 284,
                'nombre' => 'CERINZA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '162',
                'codigo_departamento' => '15',
            ),
            188 => 
            array (
                'id' => 285,
                'nombre' => 'CERRITO',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '162',
                'codigo_departamento' => '68',
            ),
            189 => 
            array (
                'id' => 286,
                'nombre' => 'CERRO SAN ANTONIO',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '161',
                'codigo_departamento' => '47',
            ),
            190 => 
            array (
                'id' => 287,
                'nombre' => 'CERTEGUI',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '160',
                'codigo_departamento' => '27',
            ),
            191 => 
            array (
                'id' => 288,
                'nombre' => 'VALLEDUPAR',
                'departamento' => 'CESAR',
                'codigo_municipio' => '001',
                'codigo_departamento' => '20',
            ),
            192 => 
            array (
                'id' => 289,
                'nombre' => 'CHACHAGUI',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '240',
                'codigo_departamento' => '52',
            ),
            193 => 
            array (
                'id' => 290,
                'nombre' => 'CHAGUANI',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '168',
                'codigo_departamento' => '25',
            ),
            194 => 
            array (
                'id' => 291,
                'nombre' => 'CHALAN',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '230',
                'codigo_departamento' => '70',
            ),
            195 => 
            array (
                'id' => 292,
                'nombre' => 'CHAMEZA',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '015',
                'codigo_departamento' => '85',
            ),
            196 => 
            array (
                'id' => 293,
                'nombre' => 'CHAPARRAL',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '168',
                'codigo_departamento' => '73',
            ),
            197 => 
            array (
                'id' => 294,
                'nombre' => 'CHARALA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '167',
                'codigo_departamento' => '68',
            ),
            198 => 
            array (
                'id' => 295,
                'nombre' => 'CHARTA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '169',
                'codigo_departamento' => '68',
            ),
            199 => 
            array (
                'id' => 296,
                'nombre' => 'CHIA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '175',
                'codigo_departamento' => '25',
            ),
            200 => 
            array (
                'id' => 297,
                'nombre' => 'CHIVOLO',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '170',
                'codigo_departamento' => '47',
            ),
            201 => 
            array (
                'id' => 298,
                'nombre' => 'CHIGORODO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '172',
                'codigo_departamento' => '05',
            ),
            202 => 
            array (
                'id' => 299,
                'nombre' => 'CHIMA',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '168',
                'codigo_departamento' => '23',
            ),
            203 => 
            array (
                'id' => 300,
                'nombre' => 'CHIMA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '176',
                'codigo_departamento' => '68',
            ),
            204 => 
            array (
                'id' => 301,
                'nombre' => 'CHIMICHAGUA',
                'departamento' => 'CESAR',
                'codigo_municipio' => '175',
                'codigo_departamento' => '20',
            ),
            205 => 
            array (
                'id' => 302,
                'nombre' => 'CHINACOTA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '172',
                'codigo_departamento' => '54',
            ),
            206 => 
            array (
                'id' => 303,
                'nombre' => 'CHINAVITA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '172',
                'codigo_departamento' => '15',
            ),
            207 => 
            array (
                'id' => 304,
                'nombre' => 'CHINCHINA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '174',
                'codigo_departamento' => '17',
            ),
            208 => 
            array (
                'id' => 305,
                'nombre' => 'CHINU',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '182',
                'codigo_departamento' => '23',
            ),
            209 => 
            array (
                'id' => 306,
                'nombre' => 'CHIPAQUE',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '178',
                'codigo_departamento' => '25',
            ),
            210 => 
            array (
                'id' => 307,
                'nombre' => 'CHIPATA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '179',
                'codigo_departamento' => '68',
            ),
            211 => 
            array (
                'id' => 308,
                'nombre' => 'CHIQUINQUIRA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '176',
                'codigo_departamento' => '15',
            ),
            212 => 
            array (
                'id' => 309,
                'nombre' => 'CHIQUIZA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '232',
                'codigo_departamento' => '15',
            ),
            213 => 
            array (
                'id' => 310,
                'nombre' => 'CHIRIGUANA',
                'departamento' => 'CESAR',
                'codigo_municipio' => '178',
                'codigo_departamento' => '20',
            ),
            214 => 
            array (
                'id' => 311,
                'nombre' => 'CHISCAS',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '180',
                'codigo_departamento' => '15',
            ),
            215 => 
            array (
                'id' => 312,
                'nombre' => 'CHITA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '183',
                'codigo_departamento' => '15',
            ),
            216 => 
            array (
                'id' => 313,
                'nombre' => 'CHITAGA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '174',
                'codigo_departamento' => '54',
            ),
            217 => 
            array (
                'id' => 314,
                'nombre' => 'CHITARAQUE',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '185',
                'codigo_departamento' => '15',
            ),
            218 => 
            array (
                'id' => 315,
                'nombre' => 'CHIVATA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '187',
                'codigo_departamento' => '15',
            ),
            219 => 
            array (
                'id' => 316,
                'nombre' => 'CHIVOR',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '236',
                'codigo_departamento' => '15',
            ),
            220 => 
            array (
                'id' => 317,
                'nombre' => 'CHOACHI',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '181',
                'codigo_departamento' => '25',
            ),
            221 => 
            array (
                'id' => 318,
                'nombre' => 'CHOCONTA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '183',
                'codigo_departamento' => '25',
            ),
            222 => 
            array (
                'id' => 319,
                'nombre' => 'CICUCO',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '188',
                'codigo_departamento' => '13',
            ),
            223 => 
            array (
                'id' => 320,
                'nombre' => 'CIENAGA',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '189',
                'codigo_departamento' => '47',
            ),
            224 => 
            array (
                'id' => 321,
                'nombre' => 'CIENAGA DE ORO',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '189',
                'codigo_departamento' => '23',
            ),
            225 => 
            array (
                'id' => 322,
                'nombre' => 'CIENEGA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '189',
                'codigo_departamento' => '15',
            ),
            226 => 
            array (
                'id' => 323,
                'nombre' => 'CIMITARRA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '190',
                'codigo_departamento' => '68',
            ),
            227 => 
            array (
                'id' => 324,
                'nombre' => 'CIRCASIA',
                'departamento' => 'QUINDIO',
                'codigo_municipio' => '190',
                'codigo_departamento' => '63',
            ),
            228 => 
            array (
                'id' => 325,
                'nombre' => 'CISNEROS',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '190',
                'codigo_departamento' => '05',
            ),
            229 => 
            array (
                'id' => 326,
                'nombre' => 'CIUDAD BOLIVAR',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '101',
                'codigo_departamento' => '05',
            ),
            230 => 
            array (
                'id' => 327,
                'nombre' => 'CLEMENCIA',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '222',
                'codigo_departamento' => '13',
            ),
            231 => 
            array (
                'id' => 328,
                'nombre' => 'COCORNA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '197',
                'codigo_departamento' => '05',
            ),
            232 => 
            array (
                'id' => 329,
                'nombre' => 'COELLO',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '200',
                'codigo_departamento' => '73',
            ),
            233 => 
            array (
                'id' => 330,
                'nombre' => 'COGUA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '200',
                'codigo_departamento' => '25',
            ),
            234 => 
            array (
                'id' => 331,
                'nombre' => 'COLOMBIA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '206',
                'codigo_departamento' => '41',
            ),
            235 => 
            array (
                'id' => 332,
                'nombre' => 'COLON',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '203',
                'codigo_departamento' => '52',
            ),
            236 => 
            array (
                'id' => 333,
                'nombre' => 'COLON',
                'departamento' => 'PUTUMAYO',
                'codigo_municipio' => '219',
                'codigo_departamento' => '86',
            ),
            237 => 
            array (
                'id' => 334,
                'nombre' => 'COLOSO',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '204',
                'codigo_departamento' => '70',
            ),
            238 => 
            array (
                'id' => 335,
                'nombre' => 'COMBITA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '204',
                'codigo_departamento' => '15',
            ),
            239 => 
            array (
                'id' => 336,
                'nombre' => 'CONCEPCION',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '207',
                'codigo_departamento' => '68',
            ),
            240 => 
            array (
                'id' => 337,
                'nombre' => 'CONCEPCION',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '206',
                'codigo_departamento' => '05',
            ),
            241 => 
            array (
                'id' => 338,
                'nombre' => 'CONCORDIA',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '205',
                'codigo_departamento' => '47',
            ),
            242 => 
            array (
                'id' => 339,
                'nombre' => 'CONCORDIA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '209',
                'codigo_departamento' => '05',
            ),
            243 => 
            array (
                'id' => 340,
                'nombre' => 'CONDOTO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '205',
                'codigo_departamento' => '27',
            ),
            244 => 
            array (
                'id' => 341,
                'nombre' => 'CONFINES',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '209',
                'codigo_departamento' => '68',
            ),
            245 => 
            array (
                'id' => 342,
                'nombre' => 'CONSACA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '207',
                'codigo_departamento' => '52',
            ),
            246 => 
            array (
                'id' => 343,
                'nombre' => 'CONTADERO',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '210',
                'codigo_departamento' => '52',
            ),
            247 => 
            array (
                'id' => 344,
                'nombre' => 'CONTRATACION',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '211',
                'codigo_departamento' => '68',
            ),
            248 => 
            array (
                'id' => 345,
                'nombre' => 'CONVENCION',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '206',
                'codigo_departamento' => '54',
            ),
            249 => 
            array (
                'id' => 346,
                'nombre' => 'COPACABANA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '212',
                'codigo_departamento' => '05',
            ),
            250 => 
            array (
                'id' => 347,
                'nombre' => 'COPER',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '212',
                'codigo_departamento' => '15',
            ),
            251 => 
            array (
                'id' => 348,
                'nombre' => 'CORDOBA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '215',
                'codigo_departamento' => '52',
            ),
            252 => 
            array (
                'id' => 349,
                'nombre' => 'CORDOBA',
                'departamento' => 'QUINDIO',
                'codigo_municipio' => '212',
                'codigo_departamento' => '63',
            ),
            253 => 
            array (
                'id' => 350,
                'nombre' => 'CORDOBA',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '212',
                'codigo_departamento' => '13',
            ),
            254 => 
            array (
                'id' => 351,
                'nombre' => 'CORINTO',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '212',
                'codigo_departamento' => '19',
            ),
            255 => 
            array (
                'id' => 352,
                'nombre' => 'COROMORO',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '217',
                'codigo_departamento' => '68',
            ),
            256 => 
            array (
                'id' => 353,
                'nombre' => 'COROZAL',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '215',
                'codigo_departamento' => '70',
            ),
            257 => 
            array (
                'id' => 354,
                'nombre' => 'CORRALES',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '215',
                'codigo_departamento' => '15',
            ),
            258 => 
            array (
                'id' => 355,
                'nombre' => 'COTA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '214',
                'codigo_departamento' => '25',
            ),
            259 => 
            array (
                'id' => 356,
                'nombre' => 'COTORRA',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '300',
                'codigo_departamento' => '23',
            ),
            260 => 
            array (
                'id' => 357,
                'nombre' => 'COVARACHIA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '218',
                'codigo_departamento' => '15',
            ),
            261 => 
            array (
                'id' => 359,
                'nombre' => 'COYAIMA',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '217',
                'codigo_departamento' => '73',
            ),
            262 => 
            array (
                'id' => 360,
                'nombre' => 'CRAVO NORTE',
                'departamento' => 'ARAUCA',
                'codigo_municipio' => '220',
                'codigo_departamento' => '81',
            ),
            263 => 
            array (
                'id' => 361,
                'nombre' => 'CUASPUD',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '224',
                'codigo_departamento' => '52',
            ),
            264 => 
            array (
                'id' => 362,
                'nombre' => 'CUBARA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '223',
                'codigo_departamento' => '15',
            ),
            265 => 
            array (
                'id' => 363,
                'nombre' => 'CUBARRAL',
                'departamento' => 'META',
                'codigo_municipio' => '223',
                'codigo_departamento' => '50',
            ),
            266 => 
            array (
                'id' => 364,
                'nombre' => 'CUCAITA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '224',
                'codigo_departamento' => '15',
            ),
            267 => 
            array (
                'id' => 365,
                'nombre' => 'CUCUNUBA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '224',
                'codigo_departamento' => '25',
            ),
            268 => 
            array (
                'id' => 366,
                'nombre' => 'CUCUTA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '001',
                'codigo_departamento' => '54',
            ),
            269 => 
            array (
                'id' => 367,
                'nombre' => 'CUCUTILLA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '223',
                'codigo_departamento' => '54',
            ),
            270 => 
            array (
                'id' => 368,
                'nombre' => 'CUITIVA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '226',
                'codigo_departamento' => '15',
            ),
            271 => 
            array (
                'id' => 369,
                'nombre' => 'CUMARAL',
                'departamento' => 'META',
                'codigo_municipio' => '226',
                'codigo_departamento' => '50',
            ),
            272 => 
            array (
                'id' => 370,
                'nombre' => 'CUMARIBO',
                'departamento' => 'VICHADA',
                'codigo_municipio' => '773',
                'codigo_departamento' => '99',
            ),
            273 => 
            array (
                'id' => 371,
                'nombre' => 'CUMBAL',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '227',
                'codigo_departamento' => '52',
            ),
            274 => 
            array (
                'id' => 372,
                'nombre' => 'CUMBITARA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '233',
                'codigo_departamento' => '52',
            ),
            275 => 
            array (
                'id' => 373,
                'nombre' => 'CUNDAY',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '226',
                'codigo_departamento' => '73',
            ),
            276 => 
            array (
                'id' => 374,
                'nombre' => 'CURILLO',
                'departamento' => 'CAQUETÁ',
                'codigo_municipio' => '205',
                'codigo_departamento' => '18',
            ),
            277 => 
            array (
                'id' => 375,
                'nombre' => 'CURITI',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '229',
                'codigo_departamento' => '68',
            ),
            278 => 
            array (
                'id' => 376,
                'nombre' => 'CURUMANI',
                'departamento' => 'CESAR',
                'codigo_municipio' => '228',
                'codigo_departamento' => '20',
            ),
            279 => 
            array (
                'id' => 377,
                'nombre' => 'DABEIBA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '234',
                'codigo_departamento' => '05',
            ),
            280 => 
            array (
                'id' => 378,
                'nombre' => 'DAGUA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '233',
                'codigo_departamento' => '76',
            ),
            281 => 
            array (
                'id' => 379,
                'nombre' => 'DIBULLA',
                'departamento' => 'LA GUAJIRA',
                'codigo_municipio' => '090',
                'codigo_departamento' => '44',
            ),
            282 => 
            array (
                'id' => 380,
                'nombre' => 'DISTRACCION',
                'departamento' => 'LA GUAJIRA',
                'codigo_municipio' => '098',
                'codigo_departamento' => '44',
            ),
            283 => 
            array (
                'id' => 381,
                'nombre' => 'DOLORES',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '236',
                'codigo_departamento' => '73',
            ),
            284 => 
            array (
                'id' => 382,
                'nombre' => 'DON MATIAS',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '237',
                'codigo_departamento' => '05',
            ),
            285 => 
            array (
                'id' => 383,
                'nombre' => 'DUITAMA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '238',
                'codigo_departamento' => '15',
            ),
            286 => 
            array (
                'id' => 384,
                'nombre' => 'DURANIA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '239',
                'codigo_departamento' => '54',
            ),
            287 => 
            array (
                'id' => 385,
                'nombre' => 'EBEJICO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '240',
                'codigo_departamento' => '05',
            ),
            288 => 
            array (
                'id' => 386,
                'nombre' => 'EL AGUILA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '243',
                'codigo_departamento' => '76',
            ),
            289 => 
            array (
                'id' => 387,
                'nombre' => 'EL BAGRE',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '250',
                'codigo_departamento' => '05',
            ),
            290 => 
            array (
                'id' => 388,
                'nombre' => 'EL BANCO',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '245',
                'codigo_departamento' => '47',
            ),
            291 => 
            array (
                'id' => 389,
                'nombre' => 'EL CAIRO',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '246',
                'codigo_departamento' => '76',
            ),
            292 => 
            array (
                'id' => 390,
                'nombre' => 'EL CALVARIO',
                'departamento' => 'META',
                'codigo_municipio' => '245',
                'codigo_departamento' => '50',
            ),
            293 => 
            array (
                'id' => 391,
                'nombre' => 'EL CANTON DEL SAN PABLO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '135',
                'codigo_departamento' => '27',
            ),
            294 => 
            array (
                'id' => 392,
                'nombre' => 'EL CARMEN',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '245',
                'codigo_departamento' => '54',
            ),
            295 => 
            array (
                'id' => 393,
                'nombre' => 'EL CARMEN DE ATRATO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '245',
                'codigo_departamento' => '27',
            ),
            296 => 
            array (
                'id' => 394,
                'nombre' => 'EL CARMEN DE BOLIVAR',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '244',
                'codigo_departamento' => '13',
            ),
            297 => 
            array (
                'id' => 395,
                'nombre' => 'EL CARMEN DE CHUCURI',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '235',
                'codigo_departamento' => '68',
            ),
            298 => 
            array (
                'id' => 396,
                'nombre' => 'EL CARMEN DE VIBORAL',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '148',
                'codigo_departamento' => '05',
            ),
            299 => 
            array (
                'id' => 397,
                'nombre' => 'EL CASTILLO',
                'departamento' => 'META',
                'codigo_municipio' => '251',
                'codigo_departamento' => '50',
            ),
            300 => 
            array (
                'id' => 398,
                'nombre' => 'EL CERRITO',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '248',
                'codigo_departamento' => '76',
            ),
            301 => 
            array (
                'id' => 399,
                'nombre' => 'EL CHARCO',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '250',
                'codigo_departamento' => '52',
            ),
            302 => 
            array (
                'id' => 400,
                'nombre' => 'EL COCUY',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '244',
                'codigo_departamento' => '15',
            ),
            303 => 
            array (
                'id' => 401,
                'nombre' => 'EL COLEGIO',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '245',
                'codigo_departamento' => '25',
            ),
            304 => 
            array (
                'id' => 402,
                'nombre' => 'EL COPEY',
                'departamento' => 'CESAR',
                'codigo_municipio' => '238',
                'codigo_departamento' => '20',
            ),
            305 => 
            array (
                'id' => 403,
                'nombre' => 'EL DONCELLO',
                'departamento' => 'CAQUETÁ',
                'codigo_municipio' => '247',
                'codigo_departamento' => '18',
            ),
            306 => 
            array (
                'id' => 404,
                'nombre' => 'EL DORADO',
                'departamento' => 'META',
                'codigo_municipio' => '270',
                'codigo_departamento' => '50',
            ),
            307 => 
            array (
                'id' => 405,
                'nombre' => 'EL DOVIO',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '250',
                'codigo_departamento' => '76',
            ),
            308 => 
            array (
                'id' => 406,
                'nombre' => 'EL ENCANTO',
                'departamento' => 'AMAZONAS',
                'codigo_municipio' => '263',
                'codigo_departamento' => '91',
            ),
            309 => 
            array (
                'id' => 407,
                'nombre' => 'EL ESPINO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '248',
                'codigo_departamento' => '15',
            ),
            310 => 
            array (
                'id' => 408,
                'nombre' => 'EL GUACAMAYO',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '245',
                'codigo_departamento' => '68',
            ),
            311 => 
            array (
                'id' => 409,
                'nombre' => 'EL GUAMO',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '248',
                'codigo_departamento' => '13',
            ),
            312 => 
            array (
                'id' => 410,
                'nombre' => 'EL LITORAL DEL SAN JUAN',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '250',
                'codigo_departamento' => '27',
            ),
            313 => 
            array (
                'id' => 411,
                'nombre' => 'EL MOLINO',
                'departamento' => 'LA GUAJIRA',
                'codigo_municipio' => '110',
                'codigo_departamento' => '44',
            ),
            314 => 
            array (
                'id' => 412,
                'nombre' => 'EL PASO',
                'departamento' => 'CESAR',
                'codigo_municipio' => '250',
                'codigo_departamento' => '20',
            ),
            315 => 
            array (
                'id' => 413,
                'nombre' => 'EL PAUJIL',
                'departamento' => 'CAQUETÁ',
                'codigo_municipio' => '256',
                'codigo_departamento' => '18',
            ),
            316 => 
            array (
                'id' => 414,
                'nombre' => 'EL PEÑOL',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '254',
                'codigo_departamento' => '52',
            ),
            317 => 
            array (
                'id' => 415,
                'nombre' => 'EL PEÑON',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '258',
                'codigo_departamento' => '25',
            ),
            318 => 
            array (
                'id' => 416,
                'nombre' => 'EL PEÑON',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '250',
                'codigo_departamento' => '68',
            ),
            319 => 
            array (
                'id' => 417,
                'nombre' => 'EL PEÑON',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '268',
                'codigo_departamento' => '13',
            ),
            320 => 
            array (
                'id' => 418,
                'nombre' => 'EL PIÑON',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '258',
                'codigo_departamento' => '47',
            ),
            321 => 
            array (
                'id' => 419,
                'nombre' => 'EL PLAYON',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '255',
                'codigo_departamento' => '68',
            ),
            322 => 
            array (
                'id' => 420,
                'nombre' => 'EL RETEN',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '268',
                'codigo_departamento' => '47',
            ),
            323 => 
            array (
                'id' => 421,
                'nombre' => 'EL RETORNO',
                'departamento' => 'GUAVIARE',
                'codigo_municipio' => '025',
                'codigo_departamento' => '95',
            ),
            324 => 
            array (
                'id' => 422,
                'nombre' => 'EL ROBLE',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '233',
                'codigo_departamento' => '70',
            ),
            325 => 
            array (
                'id' => 423,
                'nombre' => 'EL ROSAL',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '260',
                'codigo_departamento' => '25',
            ),
            326 => 
            array (
                'id' => 424,
                'nombre' => 'EL ROSARIO',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '256',
                'codigo_departamento' => '52',
            ),
            327 => 
            array (
                'id' => 425,
                'nombre' => 'EL SANTUARIO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '697',
                'codigo_departamento' => '05',
            ),
            328 => 
            array (
                'id' => 426,
                'nombre' => 'EL TABLON DE GOMEZ',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '258',
                'codigo_departamento' => '52',
            ),
            329 => 
            array (
                'id' => 427,
                'nombre' => 'EL TAMBO',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '256',
                'codigo_departamento' => '19',
            ),
            330 => 
            array (
                'id' => 428,
                'nombre' => 'EL TAMBO',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '260',
                'codigo_departamento' => '52',
            ),
            331 => 
            array (
                'id' => 429,
                'nombre' => 'EL TARRA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '250',
                'codigo_departamento' => '54',
            ),
            332 => 
            array (
                'id' => 430,
                'nombre' => 'EL ZULIA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '261',
                'codigo_departamento' => '54',
            ),
            333 => 
            array (
                'id' => 431,
                'nombre' => 'ELIAS',
                'departamento' => 'HUILA',
                'codigo_municipio' => '244',
                'codigo_departamento' => '41',
            ),
            334 => 
            array (
                'id' => 432,
                'nombre' => 'ENCINO',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '264',
                'codigo_departamento' => '68',
            ),
            335 => 
            array (
                'id' => 433,
                'nombre' => 'ENCISO',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '266',
                'codigo_departamento' => '68',
            ),
            336 => 
            array (
                'id' => 434,
                'nombre' => 'ENTRERRIOS',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '264',
                'codigo_departamento' => '05',
            ),
            337 => 
            array (
                'id' => 435,
                'nombre' => 'ENVIGADO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '266',
                'codigo_departamento' => '05',
            ),
            338 => 
            array (
                'id' => 436,
                'nombre' => 'ESPINAL',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '268',
                'codigo_departamento' => '73',
            ),
            339 => 
            array (
                'id' => 437,
                'nombre' => 'FACATATIVA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '269',
                'codigo_departamento' => '25',
            ),
            340 => 
            array (
                'id' => 438,
                'nombre' => 'FALAN',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '270',
                'codigo_departamento' => '73',
            ),
            341 => 
            array (
                'id' => 439,
                'nombre' => 'FILADELFIA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '272',
                'codigo_departamento' => '17',
            ),
            342 => 
            array (
                'id' => 440,
                'nombre' => 'FILANDIA',
                'departamento' => 'QUINDIO',
                'codigo_municipio' => '272',
                'codigo_departamento' => '63',
            ),
            343 => 
            array (
                'id' => 441,
                'nombre' => 'FIRAVITOBA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '272',
                'codigo_departamento' => '15',
            ),
            344 => 
            array (
                'id' => 442,
                'nombre' => 'FLANDES',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '275',
                'codigo_departamento' => '73',
            ),
            345 => 
            array (
                'id' => 443,
                'nombre' => 'FLORENCIA',
                'departamento' => 'CAQUETÁ',
                'codigo_municipio' => '001',
                'codigo_departamento' => '18',
            ),
            346 => 
            array (
                'id' => 444,
                'nombre' => 'FLORENCIA',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '290',
                'codigo_departamento' => '19',
            ),
            347 => 
            array (
                'id' => 445,
                'nombre' => 'FLORESTA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '276',
                'codigo_departamento' => '15',
            ),
            348 => 
            array (
                'id' => 446,
                'nombre' => 'FLORIAN',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '271',
                'codigo_departamento' => '68',
            ),
            349 => 
            array (
                'id' => 447,
                'nombre' => 'FLORIDA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '275',
                'codigo_departamento' => '76',
            ),
            350 => 
            array (
                'id' => 448,
                'nombre' => 'FLORIDABLANCA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '276',
                'codigo_departamento' => '68',
            ),
            351 => 
            array (
                'id' => 449,
                'nombre' => 'FOMEQUE',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '279',
                'codigo_departamento' => '25',
            ),
            352 => 
            array (
                'id' => 450,
                'nombre' => 'FONSECA',
                'departamento' => 'LA GUAJIRA',
                'codigo_municipio' => '279',
                'codigo_departamento' => '44',
            ),
            353 => 
            array (
                'id' => 451,
                'nombre' => 'FORTUL',
                'departamento' => 'ARAUCA',
                'codigo_municipio' => '300',
                'codigo_departamento' => '81',
            ),
            354 => 
            array (
                'id' => 452,
                'nombre' => 'FOSCA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '281',
                'codigo_departamento' => '25',
            ),
            355 => 
            array (
                'id' => 453,
                'nombre' => 'FRANCISCO PIZARRO',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '520',
                'codigo_departamento' => '52',
            ),
            356 => 
            array (
                'id' => 454,
                'nombre' => 'FREDONIA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '282',
                'codigo_departamento' => '05',
            ),
            357 => 
            array (
                'id' => 455,
                'nombre' => 'FRESNO',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '283',
                'codigo_departamento' => '73',
            ),
            358 => 
            array (
                'id' => 456,
                'nombre' => 'FRONTINO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '284',
                'codigo_departamento' => '05',
            ),
            359 => 
            array (
                'id' => 457,
                'nombre' => 'FUENTE DE ORO',
                'departamento' => 'META',
                'codigo_municipio' => '287',
                'codigo_departamento' => '50',
            ),
            360 => 
            array (
                'id' => 458,
                'nombre' => 'FUNDACION',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '288',
                'codigo_departamento' => '47',
            ),
            361 => 
            array (
                'id' => 459,
                'nombre' => 'FUNES',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '287',
                'codigo_departamento' => '52',
            ),
            362 => 
            array (
                'id' => 460,
                'nombre' => 'FUNZA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '286',
                'codigo_departamento' => '25',
            ),
            363 => 
            array (
                'id' => 461,
                'nombre' => 'FUQUENE',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '288',
                'codigo_departamento' => '25',
            ),
            364 => 
            array (
                'id' => 462,
                'nombre' => 'FUSAGASUGA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '290',
                'codigo_departamento' => '25',
            ),
            365 => 
            array (
                'id' => 463,
                'nombre' => 'GACHALA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '293',
                'codigo_departamento' => '25',
            ),
            366 => 
            array (
                'id' => 464,
                'nombre' => 'GACHANCIPA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '295',
                'codigo_departamento' => '25',
            ),
            367 => 
            array (
                'id' => 465,
                'nombre' => 'GACHANTIVA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '293',
                'codigo_departamento' => '15',
            ),
            368 => 
            array (
                'id' => 466,
                'nombre' => 'GACHETA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '297',
                'codigo_departamento' => '25',
            ),
            369 => 
            array (
                'id' => 467,
                'nombre' => 'GALAN',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '296',
                'codigo_departamento' => '68',
            ),
            370 => 
            array (
                'id' => 468,
                'nombre' => 'GALAPA',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '296',
                'codigo_departamento' => '08',
            ),
            371 => 
            array (
                'id' => 469,
                'nombre' => 'GALERAS',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '235',
                'codigo_departamento' => '70',
            ),
            372 => 
            array (
                'id' => 470,
                'nombre' => 'GAMA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '299',
                'codigo_departamento' => '25',
            ),
            373 => 
            array (
                'id' => 471,
                'nombre' => 'GAMARRA',
                'departamento' => 'CESAR',
                'codigo_municipio' => '295',
                'codigo_departamento' => '20',
            ),
            374 => 
            array (
                'id' => 472,
                'nombre' => 'GAMBITA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '298',
                'codigo_departamento' => '68',
            ),
            375 => 
            array (
                'id' => 473,
                'nombre' => 'GAMEZA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '296',
                'codigo_departamento' => '15',
            ),
            376 => 
            array (
                'id' => 474,
                'nombre' => 'GARAGOA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '299',
                'codigo_departamento' => '15',
            ),
            377 => 
            array (
                'id' => 475,
                'nombre' => 'GARZON',
                'departamento' => 'HUILA',
                'codigo_municipio' => '298',
                'codigo_departamento' => '41',
            ),
            378 => 
            array (
                'id' => 476,
                'nombre' => 'GENOVA',
                'departamento' => 'QUINDIO',
                'codigo_municipio' => '302',
                'codigo_departamento' => '63',
            ),
            379 => 
            array (
                'id' => 477,
                'nombre' => 'GIGANTE',
                'departamento' => 'HUILA',
                'codigo_municipio' => '306',
                'codigo_departamento' => '41',
            ),
            380 => 
            array (
                'id' => 478,
                'nombre' => 'GINEBRA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '306',
                'codigo_departamento' => '76',
            ),
            381 => 
            array (
                'id' => 479,
                'nombre' => 'GIRALDO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '306',
                'codigo_departamento' => '05',
            ),
            382 => 
            array (
                'id' => 480,
                'nombre' => 'GIRARDOT',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '307',
                'codigo_departamento' => '25',
            ),
            383 => 
            array (
                'id' => 481,
                'nombre' => 'GIRARDOTA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '308',
                'codigo_departamento' => '05',
            ),
            384 => 
            array (
                'id' => 482,
                'nombre' => 'GIRON',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '307',
                'codigo_departamento' => '68',
            ),
            385 => 
            array (
                'id' => 483,
                'nombre' => 'GOMEZ PLATA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '310',
                'codigo_departamento' => '05',
            ),
            386 => 
            array (
                'id' => 484,
                'nombre' => 'GONZALEZ',
                'departamento' => 'CESAR',
                'codigo_municipio' => '310',
                'codigo_departamento' => '20',
            ),
            387 => 
            array (
                'id' => 485,
                'nombre' => 'GRAMALOTE',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '313',
                'codigo_departamento' => '54',
            ),
            388 => 
            array (
                'id' => 486,
                'nombre' => 'GRANADA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '312',
                'codigo_departamento' => '25',
            ),
            389 => 
            array (
                'id' => 487,
                'nombre' => 'GRANADA',
                'departamento' => 'META',
                'codigo_municipio' => '313',
                'codigo_departamento' => '50',
            ),
            390 => 
            array (
                'id' => 488,
                'nombre' => 'GRANADA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '313',
                'codigo_departamento' => '05',
            ),
            391 => 
            array (
                'id' => 489,
                'nombre' => 'GUEPSA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '327',
                'codigo_departamento' => '68',
            ),
            392 => 
            array (
                'id' => 490,
                'nombre' => 'GUICAN',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '332',
                'codigo_departamento' => '15',
            ),
            393 => 
            array (
                'id' => 491,
                'nombre' => 'GUACA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '318',
                'codigo_departamento' => '68',
            ),
            394 => 
            array (
                'id' => 492,
                'nombre' => 'GUACAMAYAS',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '317',
                'codigo_departamento' => '15',
            ),
            395 => 
            array (
                'id' => 493,
                'nombre' => 'GUACARI',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '318',
                'codigo_departamento' => '76',
            ),
            396 => 
            array (
                'id' => 495,
                'nombre' => 'GUACHETA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '297',
                'codigo_departamento' => '25',
            ),
            397 => 
            array (
                'id' => 496,
                'nombre' => 'GUACHUCAL',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '317',
                'codigo_departamento' => '52',
            ),
            398 => 
            array (
                'id' => 497,
                'nombre' => 'GUADALAJARA DE BUGA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '111',
                'codigo_departamento' => '76',
            ),
            399 => 
            array (
                'id' => 498,
                'nombre' => 'GUADALUPE',
                'departamento' => 'HUILA',
                'codigo_municipio' => '319',
                'codigo_departamento' => '41',
            ),
            400 => 
            array (
                'id' => 499,
                'nombre' => 'GUADALUPE',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '320',
                'codigo_departamento' => '68',
            ),
            401 => 
            array (
                'id' => 500,
                'nombre' => 'GUADALUPE',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '315',
                'codigo_departamento' => '05',
            ),
            402 => 
            array (
                'id' => 501,
                'nombre' => 'GUADUAS',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '320',
                'codigo_departamento' => '25',
            ),
            403 => 
            array (
                'id' => 502,
                'nombre' => 'GUAITARILLA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '320',
                'codigo_departamento' => '52',
            ),
            404 => 
            array (
                'id' => 503,
                'nombre' => 'GUALMATAN',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '323',
                'codigo_departamento' => '52',
            ),
            405 => 
            array (
                'id' => 504,
                'nombre' => 'GUAMAL',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '318',
                'codigo_departamento' => '47',
            ),
            406 => 
            array (
                'id' => 505,
                'nombre' => 'GUAMAL',
                'departamento' => 'META',
                'codigo_municipio' => '318',
                'codigo_departamento' => '50',
            ),
            407 => 
            array (
                'id' => 506,
                'nombre' => 'GUAMO',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '319',
                'codigo_departamento' => '73',
            ),
            408 => 
            array (
                'id' => 507,
                'nombre' => 'GUAPI',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '318',
                'codigo_departamento' => '19',
            ),
            409 => 
            array (
                'id' => 508,
                'nombre' => 'GUAPOTA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '322',
                'codigo_departamento' => '68',
            ),
            410 => 
            array (
                'id' => 509,
                'nombre' => 'GUARANDA',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '265',
                'codigo_departamento' => '70',
            ),
            411 => 
            array (
                'id' => 510,
                'nombre' => 'GUARNE',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '318',
                'codigo_departamento' => '05',
            ),
            412 => 
            array (
                'id' => 511,
                'nombre' => 'GUASCA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '322',
                'codigo_departamento' => '25',
            ),
            413 => 
            array (
                'id' => 512,
                'nombre' => 'GUATAPE',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '321',
                'codigo_departamento' => '05',
            ),
            414 => 
            array (
                'id' => 513,
                'nombre' => 'GUATAQUI',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '324',
                'codigo_departamento' => '25',
            ),
            415 => 
            array (
                'id' => 514,
                'nombre' => 'GUATAVITA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '326',
                'codigo_departamento' => '25',
            ),
            416 => 
            array (
                'id' => 515,
                'nombre' => 'GUATEQUE',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '322',
                'codigo_departamento' => '15',
            ),
            417 => 
            array (
                'id' => 516,
                'nombre' => 'GUATICA',
                'departamento' => 'RISARALDA',
                'codigo_municipio' => '318',
                'codigo_departamento' => '66',
            ),
            418 => 
            array (
                'id' => 517,
                'nombre' => 'GUAVATA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '324',
                'codigo_departamento' => '68',
            ),
            419 => 
            array (
                'id' => 518,
                'nombre' => 'GUAYABAL DE SIQUIMA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '328',
                'codigo_departamento' => '25',
            ),
            420 => 
            array (
                'id' => 519,
                'nombre' => 'GUAYABETAL',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '335',
                'codigo_departamento' => '25',
            ),
            421 => 
            array (
                'id' => 520,
                'nombre' => 'GUAYATA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '325',
                'codigo_departamento' => '15',
            ),
            422 => 
            array (
                'id' => 521,
                'nombre' => 'GUTIERREZ',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '339',
                'codigo_departamento' => '25',
            ),
            423 => 
            array (
                'id' => 522,
                'nombre' => 'HACARI',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '344',
                'codigo_departamento' => '54',
            ),
            424 => 
            array (
                'id' => 523,
                'nombre' => 'HATILLO DE LOBA',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '300',
                'codigo_departamento' => '13',
            ),
            425 => 
            array (
                'id' => 524,
                'nombre' => 'HATO',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '344',
                'codigo_departamento' => '68',
            ),
            426 => 
            array (
                'id' => 525,
                'nombre' => 'HATO COROZAL',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '125',
                'codigo_departamento' => '85',
            ),
            427 => 
            array (
                'id' => 526,
                'nombre' => 'HATONUEVO',
                'departamento' => 'LA GUAJIRA',
                'codigo_municipio' => '378',
                'codigo_departamento' => '44',
            ),
            428 => 
            array (
                'id' => 527,
                'nombre' => 'HELICONIA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '347',
                'codigo_departamento' => '05',
            ),
            429 => 
            array (
                'id' => 528,
                'nombre' => 'HERRAN',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '347',
                'codigo_departamento' => '54',
            ),
            430 => 
            array (
                'id' => 529,
                'nombre' => 'HERVEO',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '347',
                'codigo_departamento' => '73',
            ),
            431 => 
            array (
                'id' => 530,
                'nombre' => 'HISPANIA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '353',
                'codigo_departamento' => '05',
            ),
            432 => 
            array (
                'id' => 531,
                'nombre' => 'HOBO',
                'departamento' => 'HUILA',
                'codigo_municipio' => '349',
                'codigo_departamento' => '41',
            ),
            433 => 
            array (
                'id' => 532,
                'nombre' => 'HONDA',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '349',
                'codigo_departamento' => '73',
            ),
            434 => 
            array (
                'id' => 533,
                'nombre' => 'IBAGUE',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '001',
                'codigo_departamento' => '73',
            ),
            435 => 
            array (
                'id' => 534,
                'nombre' => 'ICONONZO',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '352',
                'codigo_departamento' => '73',
            ),
            436 => 
            array (
                'id' => 535,
                'nombre' => 'ILES',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '352',
                'codigo_departamento' => '52',
            ),
            437 => 
            array (
                'id' => 536,
                'nombre' => 'IMUES',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '354',
                'codigo_departamento' => '52',
            ),
            438 => 
            array (
                'id' => 537,
                'nombre' => 'INIRIDA',
                'departamento' => 'GUAINIA',
                'codigo_municipio' => '001',
                'codigo_departamento' => '94',
            ),
            439 => 
            array (
                'id' => 538,
                'nombre' => 'INZA',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '355',
                'codigo_departamento' => '19',
            ),
            440 => 
            array (
                'id' => 539,
                'nombre' => 'IPIALES',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '356',
                'codigo_departamento' => '52',
            ),
            441 => 
            array (
                'id' => 540,
                'nombre' => 'IQUIRA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '357',
                'codigo_departamento' => '41',
            ),
            442 => 
            array (
                'id' => 541,
                'nombre' => 'ISNOS',
                'departamento' => 'HUILA',
                'codigo_municipio' => '359',
                'codigo_departamento' => '41',
            ),
            443 => 
            array (
                'id' => 542,
                'nombre' => 'ISTMINA',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '361',
                'codigo_departamento' => '27',
            ),
            444 => 
            array (
                'id' => 543,
                'nombre' => 'ITAGUI',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '360',
                'codigo_departamento' => '05',
            ),
            445 => 
            array (
                'id' => 544,
                'nombre' => 'ITUANGO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '361',
                'codigo_departamento' => '05',
            ),
            446 => 
            array (
                'id' => 545,
                'nombre' => 'IZA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '362',
                'codigo_departamento' => '15',
            ),
            447 => 
            array (
                'id' => 546,
                'nombre' => 'JAMBALO',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '364',
                'codigo_departamento' => '19',
            ),
            448 => 
            array (
                'id' => 547,
                'nombre' => 'JAMUNDI',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '364',
                'codigo_departamento' => '76',
            ),
            449 => 
            array (
                'id' => 548,
                'nombre' => 'JARDIN',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '364',
                'codigo_departamento' => '05',
            ),
            450 => 
            array (
                'id' => 549,
                'nombre' => 'JENESANO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '367',
                'codigo_departamento' => '15',
            ),
            451 => 
            array (
                'id' => 550,
                'nombre' => 'JERICO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '368',
                'codigo_departamento' => '05',
            ),
            452 => 
            array (
                'id' => 551,
                'nombre' => 'JERICO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '368',
                'codigo_departamento' => '15',
            ),
            453 => 
            array (
                'id' => 552,
                'nombre' => 'JERUSALEN',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '368',
                'codigo_departamento' => '25',
            ),
            454 => 
            array (
                'id' => 553,
                'nombre' => 'JESUS MARIA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '368',
                'codigo_departamento' => '68',
            ),
            455 => 
            array (
                'id' => 554,
                'nombre' => 'JORDAN',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '370',
                'codigo_departamento' => '68',
            ),
            456 => 
            array (
                'id' => 555,
                'nombre' => 'JUAN DE ACOSTA',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '372',
                'codigo_departamento' => '08',
            ),
            457 => 
            array (
                'id' => 556,
                'nombre' => 'JUNIN',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '372',
                'codigo_departamento' => '25',
            ),
            458 => 
            array (
                'id' => 557,
                'nombre' => 'JURADO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '372',
                'codigo_departamento' => '27',
            ),
            459 => 
            array (
                'id' => 558,
                'nombre' => 'LA APARTADA',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '350',
                'codigo_departamento' => '23',
            ),
            460 => 
            array (
                'id' => 559,
                'nombre' => 'LA ARGENTINA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '378',
                'codigo_departamento' => '41',
            ),
            461 => 
            array (
                'id' => 560,
                'nombre' => 'LA BELLEZA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '377',
                'codigo_departamento' => '68',
            ),
            462 => 
            array (
                'id' => 561,
                'nombre' => 'LA CALERA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '377',
                'codigo_departamento' => '25',
            ),
            463 => 
            array (
                'id' => 562,
                'nombre' => 'LA CAPILLA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '380',
                'codigo_departamento' => '15',
            ),
            464 => 
            array (
                'id' => 563,
                'nombre' => 'LA CEJA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '376',
                'codigo_departamento' => '05',
            ),
            465 => 
            array (
                'id' => 564,
                'nombre' => 'LA CELIA',
                'departamento' => 'RISARALDA',
                'codigo_municipio' => '383',
                'codigo_departamento' => '66',
            ),
            466 => 
            array (
                'id' => 565,
                'nombre' => 'LA CHORRERA',
                'departamento' => 'AMAZONAS',
                'codigo_municipio' => '405',
                'codigo_departamento' => '91',
            ),
            467 => 
            array (
                'id' => 566,
                'nombre' => 'LA CRUZ',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '378',
                'codigo_departamento' => '52',
            ),
            468 => 
            array (
                'id' => 567,
                'nombre' => 'LA CUMBRE',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '377',
                'codigo_departamento' => '76',
            ),
            469 => 
            array (
                'id' => 568,
                'nombre' => 'LA DORADA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '380',
                'codigo_departamento' => '17',
            ),
            470 => 
            array (
                'id' => 569,
                'nombre' => 'LA ESPERANZA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '385',
                'codigo_departamento' => '54',
            ),
            471 => 
            array (
                'id' => 570,
                'nombre' => 'LA ESTRELLA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '380',
                'codigo_departamento' => '05',
            ),
            472 => 
            array (
                'id' => 571,
                'nombre' => 'LA FLORIDA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '381',
                'codigo_departamento' => '52',
            ),
            473 => 
            array (
                'id' => 572,
                'nombre' => 'LA GLORIA',
                'departamento' => 'CESAR',
                'codigo_municipio' => '383',
                'codigo_departamento' => '20',
            ),
            474 => 
            array (
                'id' => 573,
                'nombre' => 'LA GUADALUPE',
                'departamento' => 'GUAINÍA',
                'codigo_municipio' => '885',
                'codigo_departamento' => '94',
            ),
            475 => 
            array (
                'id' => 574,
                'nombre' => 'LA JAGUA DE IBIRICO',
                'departamento' => 'CESAR',
                'codigo_municipio' => '400',
                'codigo_departamento' => '20',
            ),
            476 => 
            array (
                'id' => 575,
                'nombre' => 'LA JAGUA DEL PILAR',
                'departamento' => 'LA GUAJIRA',
                'codigo_municipio' => '420',
                'codigo_departamento' => '44',
            ),
            477 => 
            array (
                'id' => 576,
                'nombre' => 'LA LLANADA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '385',
                'codigo_departamento' => '52',
            ),
            478 => 
            array (
                'id' => 577,
                'nombre' => 'LA MACARENA',
                'departamento' => 'META',
                'codigo_municipio' => '350',
                'codigo_departamento' => '50',
            ),
            479 => 
            array (
                'id' => 578,
                'nombre' => 'LA MERCED',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '388',
                'codigo_departamento' => '17',
            ),
            480 => 
            array (
                'id' => 579,
                'nombre' => 'LA MESA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '386',
                'codigo_departamento' => '25',
            ),
            481 => 
            array (
                'id' => 580,
                'nombre' => 'LA MONTAÑITA',
                'departamento' => 'CAQUETÁ',
                'codigo_municipio' => '410',
                'codigo_departamento' => '18',
            ),
            482 => 
            array (
                'id' => 581,
                'nombre' => 'LA PALMA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '394',
                'codigo_departamento' => '25',
            ),
            483 => 
            array (
                'id' => 582,
                'nombre' => 'LA PAZ',
                'departamento' => 'CESAR',
                'codigo_municipio' => '621',
                'codigo_departamento' => '20',
            ),
            484 => 
            array (
                'id' => 583,
                'nombre' => 'LA PAZ',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '397',
                'codigo_departamento' => '68',
            ),
            485 => 
            array (
                'id' => 584,
                'nombre' => 'LA PEDRERA',
                'departamento' => 'AMAZONAS',
                'codigo_municipio' => '407',
                'codigo_departamento' => '91',
            ),
            486 => 
            array (
                'id' => 585,
                'nombre' => 'LA PEÑA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '398',
                'codigo_departamento' => '25',
            ),
            487 => 
            array (
                'id' => 586,
                'nombre' => 'LA PINTADA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '390',
                'codigo_departamento' => '05',
            ),
            488 => 
            array (
                'id' => 587,
                'nombre' => 'LA PLATA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '396',
                'codigo_departamento' => '41',
            ),
            489 => 
            array (
                'id' => 588,
                'nombre' => 'LA PLAYA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '398',
                'codigo_departamento' => '54',
            ),
            490 => 
            array (
                'id' => 589,
                'nombre' => 'LA PRIMAVERA',
                'departamento' => 'VICHADA',
                'codigo_municipio' => '524',
                'codigo_departamento' => '99',
            ),
            491 => 
            array (
                'id' => 590,
                'nombre' => 'LA SALINA',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '136',
                'codigo_departamento' => '85',
            ),
            492 => 
            array (
                'id' => 591,
                'nombre' => 'LA SIERRA',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '392',
                'codigo_departamento' => '19',
            ),
            493 => 
            array (
                'id' => 592,
                'nombre' => 'LA TEBAIDA',
                'departamento' => 'QUINDIO',
                'codigo_municipio' => '401',
                'codigo_departamento' => '63',
            ),
            494 => 
            array (
                'id' => 593,
                'nombre' => 'LA TOLA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '390',
                'codigo_departamento' => '52',
            ),
            495 => 
            array (
                'id' => 594,
                'nombre' => 'LA UNION',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '399',
                'codigo_departamento' => '52',
            ),
            496 => 
            array (
                'id' => 595,
                'nombre' => 'LA UNION',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '400',
                'codigo_departamento' => '70',
            ),
            497 => 
            array (
                'id' => 596,
                'nombre' => 'LA UNION',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '400',
                'codigo_departamento' => '76',
            ),
            498 => 
            array (
                'id' => 597,
                'nombre' => 'LA UNION',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '400',
                'codigo_departamento' => '05',
            ),
            499 => 
            array (
                'id' => 598,
                'nombre' => 'LA UVITA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '403',
                'codigo_departamento' => '15',
            ),
        ));
        \DB::table('municipios')->insert(array (
            0 => 
            array (
                'id' => 599,
                'nombre' => 'LA VEGA',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '397',
                'codigo_departamento' => '19',
            ),
            1 => 
            array (
                'id' => 600,
                'nombre' => 'LA VEGA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '402',
                'codigo_departamento' => '25',
            ),
            2 => 
            array (
                'id' => 601,
                'nombre' => 'LA VICTORIA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '403',
                'codigo_departamento' => '76',
            ),
            3 => 
            array (
                'id' => 602,
                'nombre' => 'LA VICTORIA',
                'departamento' => 'AMAZONAS',
                'codigo_municipio' => '430',
                'codigo_departamento' => '91',
            ),
            4 => 
            array (
                'id' => 603,
                'nombre' => 'LA VICTORIA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '401',
                'codigo_departamento' => '15',
            ),
            5 => 
            array (
                'id' => 604,
                'nombre' => 'LA VIRGINIA',
                'departamento' => 'RISARALDA',
                'codigo_municipio' => '400',
                'codigo_departamento' => '66',
            ),
            6 => 
            array (
                'id' => 605,
                'nombre' => 'LABATECA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '377',
                'codigo_departamento' => '54',
            ),
            7 => 
            array (
                'id' => 606,
                'nombre' => 'LABRANZAGRANDE',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '377',
                'codigo_departamento' => '15',
            ),
            8 => 
            array (
                'id' => 607,
                'nombre' => 'LANDAZURI',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '385',
                'codigo_departamento' => '68',
            ),
            9 => 
            array (
                'id' => 608,
                'nombre' => 'LEBRIJA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '406',
                'codigo_departamento' => '68',
            ),
            10 => 
            array (
                'id' => 609,
                'nombre' => 'LEGUIZAMO',
                'departamento' => 'PUTUMAYO',
                'codigo_municipio' => '573',
                'codigo_departamento' => '86',
            ),
            11 => 
            array (
                'id' => 610,
                'nombre' => 'LEIVA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '405',
                'codigo_departamento' => '52',
            ),
            12 => 
            array (
                'id' => 611,
                'nombre' => 'LEJANIAS',
                'departamento' => 'META',
                'codigo_municipio' => '400',
                'codigo_departamento' => '50',
            ),
            13 => 
            array (
                'id' => 612,
                'nombre' => 'LENGUAZAQUE',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '407',
                'codigo_departamento' => '25',
            ),
            14 => 
            array (
                'id' => 613,
                'nombre' => 'LERIDA',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '408',
                'codigo_departamento' => '73',
            ),
            15 => 
            array (
                'id' => 614,
                'nombre' => 'LETICIA',
                'departamento' => 'AMAZONAS',
                'codigo_municipio' => '001',
                'codigo_departamento' => '91',
            ),
            16 => 
            array (
                'id' => 615,
                'nombre' => 'LIBANO',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '411',
                'codigo_departamento' => '73',
            ),
            17 => 
            array (
                'id' => 616,
                'nombre' => 'LIBORINA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '411',
                'codigo_departamento' => '05',
            ),
            18 => 
            array (
                'id' => 617,
                'nombre' => 'LINARES',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '411',
                'codigo_departamento' => '52',
            ),
            19 => 
            array (
                'id' => 618,
                'nombre' => 'LLORO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '413',
                'codigo_departamento' => '27',
            ),
            20 => 
            array (
                'id' => 619,
                'nombre' => 'LOPEZ',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '418',
                'codigo_departamento' => '19',
            ),
            21 => 
            array (
                'id' => 620,
                'nombre' => 'LORICA',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '417',
                'codigo_departamento' => '23',
            ),
            22 => 
            array (
                'id' => 621,
                'nombre' => 'LOS ANDES',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '418',
                'codigo_departamento' => '52',
            ),
            23 => 
            array (
                'id' => 622,
                'nombre' => 'LOS CORDOBAS',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '419',
                'codigo_departamento' => '23',
            ),
            24 => 
            array (
                'id' => 623,
                'nombre' => 'LOS PALMITOS',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '418',
                'codigo_departamento' => '70',
            ),
            25 => 
            array (
                'id' => 624,
                'nombre' => 'LOS PATIOS',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '405',
                'codigo_departamento' => '54',
            ),
            26 => 
            array (
                'id' => 625,
                'nombre' => 'LOS SANTOS',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '418',
                'codigo_departamento' => '68',
            ),
            27 => 
            array (
                'id' => 626,
                'nombre' => 'LOURDES',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '418',
                'codigo_departamento' => '54',
            ),
            28 => 
            array (
                'id' => 627,
                'nombre' => 'LURUACO',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '421',
                'codigo_departamento' => '08',
            ),
            29 => 
            array (
                'id' => 628,
                'nombre' => 'MACANAL',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '425',
                'codigo_departamento' => '15',
            ),
            30 => 
            array (
                'id' => 629,
                'nombre' => 'MACARAVITA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '425',
                'codigo_departamento' => '68',
            ),
            31 => 
            array (
                'id' => 630,
                'nombre' => 'MACEO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '425',
                'codigo_departamento' => '05',
            ),
            32 => 
            array (
                'id' => 631,
                'nombre' => 'MACHETA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '426',
                'codigo_departamento' => '25',
            ),
            33 => 
            array (
                'id' => 632,
                'nombre' => 'MADRID',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '430',
                'codigo_departamento' => '25',
            ),
            34 => 
            array (
                'id' => 633,
                'nombre' => 'MAGANGUE',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '430',
                'codigo_departamento' => '13',
            ),
            35 => 
            array (
                'id' => 634,
                'nombre' => 'MAGUI',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '427',
                'codigo_departamento' => '52',
            ),
            36 => 
            array (
                'id' => 635,
                'nombre' => 'MAHATES',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '433',
                'codigo_departamento' => '13',
            ),
            37 => 
            array (
                'id' => 636,
                'nombre' => 'MAICAO',
                'departamento' => 'LA GUAJIRA',
                'codigo_municipio' => '430',
                'codigo_departamento' => '44',
            ),
            38 => 
            array (
                'id' => 637,
                'nombre' => 'MAJAGUAL',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '429',
                'codigo_departamento' => '70',
            ),
            39 => 
            array (
                'id' => 638,
                'nombre' => 'MALAGA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '432',
                'codigo_departamento' => '68',
            ),
            40 => 
            array (
                'id' => 639,
                'nombre' => 'MALAMBO',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '433',
                'codigo_departamento' => '08',
            ),
            41 => 
            array (
                'id' => 640,
                'nombre' => 'MALLAMA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '435',
                'codigo_departamento' => '52',
            ),
            42 => 
            array (
                'id' => 641,
                'nombre' => 'MANATI',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '436',
                'codigo_departamento' => '08',
            ),
            43 => 
            array (
                'id' => 642,
                'nombre' => 'MANAURE',
                'departamento' => 'CESAR',
                'codigo_municipio' => '443',
                'codigo_departamento' => '20',
            ),
            44 => 
            array (
                'id' => 643,
                'nombre' => 'MANAURE',
                'departamento' => 'LA GUAJIRA',
                'codigo_municipio' => '560',
                'codigo_departamento' => '44',
            ),
            45 => 
            array (
                'id' => 644,
                'nombre' => 'MANI',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '139',
                'codigo_departamento' => '85',
            ),
            46 => 
            array (
                'id' => 645,
                'nombre' => 'MANTA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '436',
                'codigo_departamento' => '25',
            ),
            47 => 
            array (
                'id' => 646,
                'nombre' => 'MANZANARES',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '433',
                'codigo_departamento' => '17',
            ),
            48 => 
            array (
                'id' => 647,
                'nombre' => 'MAPIRIPAN',
                'departamento' => 'META',
                'codigo_municipio' => '325',
                'codigo_departamento' => '50',
            ),
            49 => 
            array (
                'id' => 648,
                'nombre' => 'MAPIRIPANA',
                'departamento' => 'GUAINÍA',
                'codigo_municipio' => '663',
                'codigo_departamento' => '94',
            ),
            50 => 
            array (
                'id' => 649,
                'nombre' => 'MARGARITA',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '440',
                'codigo_departamento' => '13',
            ),
            51 => 
            array (
                'id' => 650,
                'nombre' => 'MARIA LA BAJA',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '442',
                'codigo_departamento' => '13',
            ),
            52 => 
            array (
                'id' => 651,
                'nombre' => 'MARINILLA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '440',
                'codigo_departamento' => '05',
            ),
            53 => 
            array (
                'id' => 652,
                'nombre' => 'MARIPI',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '442',
                'codigo_departamento' => '15',
            ),
            54 => 
            array (
                'id' => 653,
                'nombre' => 'MARIQUITA',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '443',
                'codigo_departamento' => '73',
            ),
            55 => 
            array (
                'id' => 654,
                'nombre' => 'MARMATO',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '442',
                'codigo_departamento' => '17',
            ),
            56 => 
            array (
                'id' => 655,
                'nombre' => 'MARQUETALIA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '444',
                'codigo_departamento' => '17',
            ),
            57 => 
            array (
                'id' => 656,
                'nombre' => 'MARSELLA',
                'departamento' => 'RISARALDA',
                'codigo_municipio' => '440',
                'codigo_departamento' => '66',
            ),
            58 => 
            array (
                'id' => 657,
                'nombre' => 'MARULANDA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '446',
                'codigo_departamento' => '17',
            ),
            59 => 
            array (
                'id' => 658,
                'nombre' => 'MATANZA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '444',
                'codigo_departamento' => '68',
            ),
            60 => 
            array (
                'id' => 659,
                'nombre' => 'MEDELLIN',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '001',
                'codigo_departamento' => '05',
            ),
            61 => 
            array (
                'id' => 660,
                'nombre' => 'MEDINA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '438',
                'codigo_departamento' => '25',
            ),
            62 => 
            array (
                'id' => 661,
                'nombre' => 'MEDIO ATRATO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '425',
                'codigo_departamento' => '27',
            ),
            63 => 
            array (
                'id' => 662,
                'nombre' => 'MEDIO BAUDO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '430',
                'codigo_departamento' => '27',
            ),
            64 => 
            array (
                'id' => 663,
                'nombre' => 'MEDIO SAN JUAN',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '450',
                'codigo_departamento' => '27',
            ),
            65 => 
            array (
                'id' => 664,
                'nombre' => 'MELGAR',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '449',
                'codigo_departamento' => '73',
            ),
            66 => 
            array (
                'id' => 665,
                'nombre' => 'MERCADERES',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '450',
                'codigo_departamento' => '19',
            ),
            67 => 
            array (
                'id' => 666,
                'nombre' => 'MESETAS',
                'departamento' => 'META',
                'codigo_municipio' => '330',
                'codigo_departamento' => '50',
            ),
            68 => 
            array (
                'id' => 667,
                'nombre' => 'MILAN',
                'departamento' => 'CAQUETÁ',
                'codigo_municipio' => '460',
                'codigo_departamento' => '18',
            ),
            69 => 
            array (
                'id' => 668,
                'nombre' => 'MIRAFLORES',
                'departamento' => 'GUAVIARE',
                'codigo_municipio' => '200',
                'codigo_departamento' => '95',
            ),
            70 => 
            array (
                'id' => 669,
                'nombre' => 'MIRAFLORES',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '455',
                'codigo_departamento' => '15',
            ),
            71 => 
            array (
                'id' => 670,
                'nombre' => 'MIRANDA',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '455',
                'codigo_departamento' => '19',
            ),
            72 => 
            array (
                'id' => 671,
                'nombre' => 'MIRITI  PARANAS',
                'departamento' => 'AMAZONAS',
                'codigo_municipio' => '460',
                'codigo_departamento' => '91',
            ),
            73 => 
            array (
                'id' => 672,
                'nombre' => 'MISTRATO',
                'departamento' => 'RISARALDA',
                'codigo_municipio' => '456',
                'codigo_departamento' => '66',
            ),
            74 => 
            array (
                'id' => 673,
                'nombre' => 'MITU',
                'departamento' => 'VAUPÉS',
                'codigo_municipio' => '001',
                'codigo_departamento' => '97',
            ),
            75 => 
            array (
                'id' => 674,
                'nombre' => 'MOCOA',
                'departamento' => 'PUTUMAYO',
                'codigo_municipio' => '001',
                'codigo_departamento' => '86',
            ),
            76 => 
            array (
                'id' => 675,
                'nombre' => 'MOGOTES',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '464',
                'codigo_departamento' => '68',
            ),
            77 => 
            array (
                'id' => 676,
                'nombre' => 'MOLAGAVITA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '468',
                'codigo_departamento' => '68',
            ),
            78 => 
            array (
                'id' => 677,
                'nombre' => 'MOMIL',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '464',
                'codigo_departamento' => '23',
            ),
            79 => 
            array (
                'id' => 678,
                'nombre' => 'MOMPOS',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '468',
                'codigo_departamento' => '13',
            ),
            80 => 
            array (
                'id' => 679,
                'nombre' => 'MONGUA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '464',
                'codigo_departamento' => '15',
            ),
            81 => 
            array (
                'id' => 680,
                'nombre' => 'MONGUI',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '466',
                'codigo_departamento' => '15',
            ),
            82 => 
            array (
                'id' => 681,
                'nombre' => 'MONIQUIRA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '469',
                'codigo_departamento' => '15',
            ),
            83 => 
            array (
                'id' => 682,
                'nombre' => 'MOÑITOS',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '500',
                'codigo_departamento' => '23',
            ),
            84 => 
            array (
                'id' => 683,
                'nombre' => 'MONTEBELLO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '467',
                'codigo_departamento' => '05',
            ),
            85 => 
            array (
                'id' => 684,
                'nombre' => 'MONTECRISTO',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '458',
                'codigo_departamento' => '13',
            ),
            86 => 
            array (
                'id' => 685,
                'nombre' => 'MONTELIBANO',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '466',
                'codigo_departamento' => '23',
            ),
            87 => 
            array (
                'id' => 686,
                'nombre' => 'MONTENEGRO',
                'departamento' => 'QUINDIO',
                'codigo_municipio' => '470',
                'codigo_departamento' => '63',
            ),
            88 => 
            array (
                'id' => 687,
                'nombre' => 'MONTERIA',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '001',
                'codigo_departamento' => '23',
            ),
            89 => 
            array (
                'id' => 688,
                'nombre' => 'MONTERREY',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '162',
                'codigo_departamento' => '85',
            ),
            90 => 
            array (
                'id' => 689,
                'nombre' => 'MORALES',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '473',
                'codigo_departamento' => '19',
            ),
            91 => 
            array (
                'id' => 690,
                'nombre' => 'MORALES',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '473',
                'codigo_departamento' => '13',
            ),
            92 => 
            array (
                'id' => 691,
                'nombre' => 'MORELIA',
                'departamento' => 'CAQUETÁ',
                'codigo_municipio' => '479',
                'codigo_departamento' => '18',
            ),
            93 => 
            array (
                'id' => 692,
                'nombre' => 'MORICHAL',
                'departamento' => 'GUAINÍA',
                'codigo_municipio' => '888',
                'codigo_departamento' => '94',
            ),
            94 => 
            array (
                'id' => 693,
                'nombre' => 'MORROA',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '473',
                'codigo_departamento' => '70',
            ),
            95 => 
            array (
                'id' => 694,
                'nombre' => 'MOSQUERA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '473',
                'codigo_departamento' => '25',
            ),
            96 => 
            array (
                'id' => 695,
                'nombre' => 'MOSQUERA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '473',
                'codigo_departamento' => '52',
            ),
            97 => 
            array (
                'id' => 696,
                'nombre' => 'MOTAVITA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '476',
                'codigo_departamento' => '15',
            ),
            98 => 
            array (
                'id' => 697,
                'nombre' => 'MURILLO',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '461',
                'codigo_departamento' => '73',
            ),
            99 => 
            array (
                'id' => 698,
                'nombre' => 'MURINDO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '475',
                'codigo_departamento' => '05',
            ),
            100 => 
            array (
                'id' => 699,
                'nombre' => 'MUTATA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '480',
                'codigo_departamento' => '05',
            ),
            101 => 
            array (
                'id' => 700,
                'nombre' => 'MUTISCUA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '480',
                'codigo_departamento' => '54',
            ),
            102 => 
            array (
                'id' => 701,
                'nombre' => 'MUZO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '480',
                'codigo_departamento' => '15',
            ),
            103 => 
            array (
                'id' => 702,
                'nombre' => 'NARIÑO',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '483',
                'codigo_departamento' => '25',
            ),
            104 => 
            array (
                'id' => 703,
                'nombre' => 'NARIÑO',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '480',
                'codigo_departamento' => '52',
            ),
            105 => 
            array (
                'id' => 704,
                'nombre' => 'NARIÑO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '483',
                'codigo_departamento' => '05',
            ),
            106 => 
            array (
                'id' => 705,
                'nombre' => 'NATAGA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '483',
                'codigo_departamento' => '41',
            ),
            107 => 
            array (
                'id' => 706,
                'nombre' => 'NATAGAIMA',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '483',
                'codigo_departamento' => '73',
            ),
            108 => 
            array (
                'id' => 707,
                'nombre' => 'NECHI',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '495',
                'codigo_departamento' => '05',
            ),
            109 => 
            array (
                'id' => 708,
                'nombre' => 'NECOCLI',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '490',
                'codigo_departamento' => '05',
            ),
            110 => 
            array (
                'id' => 709,
                'nombre' => 'NEIRA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '486',
                'codigo_departamento' => '17',
            ),
            111 => 
            array (
                'id' => 710,
                'nombre' => 'NEIVA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '001',
                'codigo_departamento' => '41',
            ),
            112 => 
            array (
                'id' => 711,
                'nombre' => 'NEMOCON',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '486',
                'codigo_departamento' => '25',
            ),
            113 => 
            array (
                'id' => 712,
                'nombre' => 'NILO',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '488',
                'codigo_departamento' => '25',
            ),
            114 => 
            array (
                'id' => 713,
                'nombre' => 'NIMAIMA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '489',
                'codigo_departamento' => '25',
            ),
            115 => 
            array (
                'id' => 714,
                'nombre' => 'NOBSA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '491',
                'codigo_departamento' => '15',
            ),
            116 => 
            array (
                'id' => 715,
                'nombre' => 'NOCAIMA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '491',
                'codigo_departamento' => '25',
            ),
            117 => 
            array (
                'id' => 716,
                'nombre' => 'NORCASIA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '495',
                'codigo_departamento' => '17',
            ),
            118 => 
            array (
                'id' => 718,
                'nombre' => 'NOVITA',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '491',
                'codigo_departamento' => '27',
            ),
            119 => 
            array (
                'id' => 719,
                'nombre' => 'NUEVA GRANADA',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '460',
                'codigo_departamento' => '47',
            ),
            120 => 
            array (
                'id' => 720,
                'nombre' => 'NUEVO COLON',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '494',
                'codigo_departamento' => '15',
            ),
            121 => 
            array (
                'id' => 721,
                'nombre' => 'NUNCHIA',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '225',
                'codigo_departamento' => '85',
            ),
            122 => 
            array (
                'id' => 722,
                'nombre' => 'NUQUI',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '495',
                'codigo_departamento' => '27',
            ),
            123 => 
            array (
                'id' => 723,
                'nombre' => 'OBANDO',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '497',
                'codigo_departamento' => '76',
            ),
            124 => 
            array (
                'id' => 724,
                'nombre' => 'OCAMONTE',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '498',
                'codigo_departamento' => '68',
            ),
            125 => 
            array (
                'id' => 725,
                'nombre' => 'OCAÑA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '498',
                'codigo_departamento' => '54',
            ),
            126 => 
            array (
                'id' => 726,
                'nombre' => 'OIBA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '500',
                'codigo_departamento' => '68',
            ),
            127 => 
            array (
                'id' => 727,
                'nombre' => 'OICATA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '500',
                'codigo_departamento' => '15',
            ),
            128 => 
            array (
                'id' => 728,
                'nombre' => 'OLAYA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '501',
                'codigo_departamento' => '05',
            ),
            129 => 
            array (
                'id' => 729,
                'nombre' => 'OLAYA HERRERA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '490',
                'codigo_departamento' => '52',
            ),
            130 => 
            array (
                'id' => 730,
                'nombre' => 'ONZAGA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '502',
                'codigo_departamento' => '68',
            ),
            131 => 
            array (
                'id' => 731,
                'nombre' => 'OPORAPA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '503',
                'codigo_departamento' => '41',
            ),
            132 => 
            array (
                'id' => 732,
                'nombre' => 'ORITO',
                'departamento' => 'PUTUMAYO',
                'codigo_municipio' => '320',
                'codigo_departamento' => '86',
            ),
            133 => 
            array (
                'id' => 733,
                'nombre' => 'OROCUE',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '230',
                'codigo_departamento' => '85',
            ),
            134 => 
            array (
                'id' => 734,
                'nombre' => 'ORTEGA',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '504',
                'codigo_departamento' => '73',
            ),
            135 => 
            array (
                'id' => 735,
                'nombre' => 'OSPINA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '506',
                'codigo_departamento' => '52',
            ),
            136 => 
            array (
                'id' => 736,
                'nombre' => 'OTANCHE',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '507',
                'codigo_departamento' => '15',
            ),
            137 => 
            array (
                'id' => 737,
                'nombre' => 'OVEJAS',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '508',
                'codigo_departamento' => '70',
            ),
            138 => 
            array (
                'id' => 738,
                'nombre' => 'PACHAVITA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '511',
                'codigo_departamento' => '15',
            ),
            139 => 
            array (
                'id' => 739,
                'nombre' => 'PACHO',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '513',
                'codigo_departamento' => '25',
            ),
            140 => 
            array (
                'id' => 740,
                'nombre' => 'PACOA',
                'departamento' => 'VAUPÉS',
                'codigo_municipio' => '511',
                'codigo_departamento' => '97',
            ),
            141 => 
            array (
                'id' => 741,
                'nombre' => 'PACORA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '513',
                'codigo_departamento' => '17',
            ),
            142 => 
            array (
                'id' => 742,
                'nombre' => 'PADILLA',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '513',
                'codigo_departamento' => '19',
            ),
            143 => 
            array (
                'id' => 743,
                'nombre' => 'PAEZ',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '517',
                'codigo_departamento' => '19',
            ),
            144 => 
            array (
                'id' => 744,
                'nombre' => 'PAEZ',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '514',
                'codigo_departamento' => '15',
            ),
            145 => 
            array (
                'id' => 745,
                'nombre' => 'PAICOL',
                'departamento' => 'HUILA',
                'codigo_municipio' => '518',
                'codigo_departamento' => '41',
            ),
            146 => 
            array (
                'id' => 746,
                'nombre' => 'PAILITAS',
                'departamento' => 'CESAR',
                'codigo_municipio' => '517',
                'codigo_departamento' => '20',
            ),
            147 => 
            array (
                'id' => 747,
                'nombre' => 'PAIME',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '518',
                'codigo_departamento' => '25',
            ),
            148 => 
            array (
                'id' => 748,
                'nombre' => 'PAIPA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '516',
                'codigo_departamento' => '15',
            ),
            149 => 
            array (
                'id' => 749,
                'nombre' => 'PAJARITO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '518',
                'codigo_departamento' => '15',
            ),
            150 => 
            array (
                'id' => 750,
                'nombre' => 'PALERMO',
                'departamento' => 'HUILA',
                'codigo_municipio' => '524',
                'codigo_departamento' => '41',
            ),
            151 => 
            array (
                'id' => 751,
                'nombre' => 'PALESTINA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '530',
                'codigo_departamento' => '41',
            ),
            152 => 
            array (
                'id' => 752,
                'nombre' => 'PALESTINA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '524',
                'codigo_departamento' => '17',
            ),
            153 => 
            array (
                'id' => 753,
                'nombre' => 'PALMAR',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '522',
                'codigo_departamento' => '68',
            ),
            154 => 
            array (
                'id' => 754,
                'nombre' => 'PALMAR DE VARELA',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '520',
                'codigo_departamento' => '08',
            ),
            155 => 
            array (
                'id' => 755,
                'nombre' => 'PALMAS DEL SOCORRO',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '524',
                'codigo_departamento' => '68',
            ),
            156 => 
            array (
                'id' => 756,
                'nombre' => 'PALMIRA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '520',
                'codigo_departamento' => '76',
            ),
            157 => 
            array (
                'id' => 757,
                'nombre' => 'PALMITO',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '523',
                'codigo_departamento' => '70',
            ),
            158 => 
            array (
                'id' => 758,
                'nombre' => 'PALOCABILDO',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '520',
                'codigo_departamento' => '73',
            ),
            159 => 
            array (
                'id' => 759,
                'nombre' => 'PAMPLONA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '518',
                'codigo_departamento' => '54',
            ),
            160 => 
            array (
                'id' => 760,
                'nombre' => 'PAMPLONITA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '520',
                'codigo_departamento' => '54',
            ),
            161 => 
            array (
                'id' => 761,
                'nombre' => 'PANA PANA',
                'departamento' => 'GUAINÍA',
                'codigo_municipio' => '887',
                'codigo_departamento' => '94',
            ),
            162 => 
            array (
                'id' => 762,
                'nombre' => 'PANDI',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '524',
                'codigo_departamento' => '25',
            ),
            163 => 
            array (
                'id' => 763,
                'nombre' => 'PANQUEBA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '522',
                'codigo_departamento' => '15',
            ),
            164 => 
            array (
                'id' => 764,
                'nombre' => 'PAPUNAUA',
                'departamento' => 'VAUPÉS',
                'codigo_municipio' => '777',
                'codigo_departamento' => '97',
            ),
            165 => 
            array (
                'id' => 765,
                'nombre' => 'PARAMO',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '533',
                'codigo_departamento' => '68',
            ),
            166 => 
            array (
                'id' => 766,
                'nombre' => 'PARATEBUENO',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '530',
                'codigo_departamento' => '25',
            ),
            167 => 
            array (
                'id' => 767,
                'nombre' => 'PASCA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '535',
                'codigo_departamento' => '25',
            ),
            168 => 
            array (
                'id' => 768,
                'nombre' => 'PASTO',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '001',
                'codigo_departamento' => '52',
            ),
            169 => 
            array (
                'id' => 769,
                'nombre' => 'PATIA',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '532',
                'codigo_departamento' => '19',
            ),
            170 => 
            array (
                'id' => 770,
                'nombre' => 'PAUNA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '531',
                'codigo_departamento' => '15',
            ),
            171 => 
            array (
                'id' => 771,
                'nombre' => 'PAYA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '533',
                'codigo_departamento' => '15',
            ),
            172 => 
            array (
                'id' => 772,
                'nombre' => 'PAZ DE ARIPORO',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '250',
                'codigo_departamento' => '85',
            ),
            173 => 
            array (
                'id' => 773,
                'nombre' => 'PAZ DE RIO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '537',
                'codigo_departamento' => '15',
            ),
            174 => 
            array (
                'id' => 774,
                'nombre' => 'PEDRAZA',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '541',
                'codigo_departamento' => '47',
            ),
            175 => 
            array (
                'id' => 775,
                'nombre' => 'PEÑOL',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '541',
                'codigo_departamento' => '05',
            ),
            176 => 
            array (
                'id' => 776,
                'nombre' => 'PELAYA',
                'departamento' => 'CESAR',
                'codigo_municipio' => '550',
                'codigo_departamento' => '20',
            ),
            177 => 
            array (
                'id' => 777,
                'nombre' => 'PENSILVANIA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '541',
                'codigo_departamento' => '17',
            ),
            178 => 
            array (
                'id' => 778,
                'nombre' => 'PEQUE',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '543',
                'codigo_departamento' => '05',
            ),
            179 => 
            array (
                'id' => 779,
                'nombre' => 'PESCA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '542',
                'codigo_departamento' => '15',
            ),
            180 => 
            array (
                'id' => 780,
                'nombre' => 'PIAMONTES',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '533',
                'codigo_departamento' => '19',
            ),
            181 => 
            array (
                'id' => 781,
                'nombre' => 'PIEDECUESTA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '547',
                'codigo_departamento' => '68',
            ),
            182 => 
            array (
                'id' => 782,
                'nombre' => 'PIEDRAS',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '547',
                'codigo_departamento' => '73',
            ),
            183 => 
            array (
                'id' => 783,
                'nombre' => 'PIENDAMO',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '548',
                'codigo_departamento' => '19',
            ),
            184 => 
            array (
                'id' => 784,
                'nombre' => 'PIJAO',
                'departamento' => 'QUINDIO',
                'codigo_municipio' => '548',
                'codigo_departamento' => '63',
            ),
            185 => 
            array (
                'id' => 785,
                'nombre' => 'PIJIÑO DEL CARMEN',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '545',
                'codigo_departamento' => '47',
            ),
            186 => 
            array (
                'id' => 786,
                'nombre' => 'PINCHOTE',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '549',
                'codigo_departamento' => '68',
            ),
            187 => 
            array (
                'id' => 787,
                'nombre' => 'PINILLOS',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '549',
                'codigo_departamento' => '13',
            ),
            188 => 
            array (
                'id' => 788,
                'nombre' => 'PIOJO',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '549',
                'codigo_departamento' => '08',
            ),
            189 => 
            array (
                'id' => 789,
                'nombre' => 'PISBA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '550',
                'codigo_departamento' => '15',
            ),
            190 => 
            array (
                'id' => 790,
                'nombre' => 'PITAL',
                'departamento' => 'HUILA',
                'codigo_municipio' => '548',
                'codigo_departamento' => '41',
            ),
            191 => 
            array (
                'id' => 791,
                'nombre' => 'PITALITO',
                'departamento' => 'HUILA',
                'codigo_municipio' => '551',
                'codigo_departamento' => '41',
            ),
            192 => 
            array (
                'id' => 792,
                'nombre' => 'PIVIJAY',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '551',
                'codigo_departamento' => '47',
            ),
            193 => 
            array (
                'id' => 793,
                'nombre' => 'PLANADAS',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '555',
                'codigo_departamento' => '73',
            ),
            194 => 
            array (
                'id' => 794,
                'nombre' => 'PLANETA RICA',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '555',
                'codigo_departamento' => '23',
            ),
            195 => 
            array (
                'id' => 795,
                'nombre' => 'PLATO',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '555',
                'codigo_departamento' => '47',
            ),
            196 => 
            array (
                'id' => 796,
                'nombre' => 'POLICARPA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '540',
                'codigo_departamento' => '52',
            ),
            197 => 
            array (
                'id' => 797,
                'nombre' => 'POLONUEVO',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '558',
                'codigo_departamento' => '08',
            ),
            198 => 
            array (
                'id' => 798,
                'nombre' => 'PONEDERA',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '560',
                'codigo_departamento' => '08',
            ),
            199 => 
            array (
                'id' => 799,
                'nombre' => 'POPAYAN',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '001',
                'codigo_departamento' => '19',
            ),
            200 => 
            array (
                'id' => 800,
                'nombre' => 'PORE',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '263',
                'codigo_departamento' => '85',
            ),
            201 => 
            array (
                'id' => 801,
                'nombre' => 'POTOSI',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '560',
                'codigo_departamento' => '52',
            ),
            202 => 
            array (
                'id' => 802,
                'nombre' => 'PRADERA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '563',
                'codigo_departamento' => '76',
            ),
            203 => 
            array (
                'id' => 803,
                'nombre' => 'PRADO',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '563',
                'codigo_departamento' => '73',
            ),
            204 => 
            array (
                'id' => 804,
                'nombre' => 'PROVIDENCIA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '565',
                'codigo_departamento' => '52',
            ),
            205 => 
            array (
                'id' => 805,
                'nombre' => 'PROVIDENCIA',
                'departamento' => 'SAN ANDRÉS Y PROVIDENCIA',
                'codigo_municipio' => '564',
                'codigo_departamento' => '88',
            ),
            206 => 
            array (
                'id' => 806,
                'nombre' => 'PUEBLO BELLO',
                'departamento' => 'CESAR',
                'codigo_municipio' => '570',
                'codigo_departamento' => '20',
            ),
            207 => 
            array (
                'id' => 807,
                'nombre' => 'PUEBLO NUEVO',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '570',
                'codigo_departamento' => '23',
            ),
            208 => 
            array (
                'id' => 808,
                'nombre' => 'PUEBLO RICO',
                'departamento' => 'RISARALDA',
                'codigo_municipio' => '572',
                'codigo_departamento' => '66',
            ),
            209 => 
            array (
                'id' => 809,
                'nombre' => 'PUEBLORRICO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '576',
                'codigo_departamento' => '05',
            ),
            210 => 
            array (
                'id' => 810,
                'nombre' => 'PUEBLOVIEJO',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '570',
                'codigo_departamento' => '47',
            ),
            211 => 
            array (
                'id' => 811,
                'nombre' => 'PUENTE NACIONAL',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '572',
                'codigo_departamento' => '68',
            ),
            212 => 
            array (
                'id' => 812,
                'nombre' => 'PUERRES',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '573',
                'codigo_departamento' => '52',
            ),
            213 => 
            array (
                'id' => 813,
                'nombre' => 'PUERTO ALEGRIA',
                'departamento' => 'AMAZONAS',
                'codigo_municipio' => '530',
                'codigo_departamento' => '91',
            ),
            214 => 
            array (
                'id' => 814,
                'nombre' => 'PUERTO ARICA',
                'departamento' => 'AMAZONAS',
                'codigo_municipio' => '536',
                'codigo_departamento' => '91',
            ),
            215 => 
            array (
                'id' => 815,
                'nombre' => 'PUERTO ASIS',
                'departamento' => 'PUTUMAYO',
                'codigo_municipio' => '568',
                'codigo_departamento' => '86',
            ),
            216 => 
            array (
                'id' => 816,
                'nombre' => 'PUERTO BERRIO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '579',
                'codigo_departamento' => '05',
            ),
            217 => 
            array (
                'id' => 817,
                'nombre' => 'PUERTO BOYACA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '572',
                'codigo_departamento' => '15',
            ),
            218 => 
            array (
                'id' => 818,
                'nombre' => 'PUERTO CAICEDO',
                'departamento' => 'PUTUMAYO',
                'codigo_municipio' => '569',
                'codigo_departamento' => '86',
            ),
            219 => 
            array (
                'id' => 819,
                'nombre' => 'PUERTO CARREÑO',
                'departamento' => 'VICHADA',
                'codigo_municipio' => '001',
                'codigo_departamento' => '99',
            ),
            220 => 
            array (
                'id' => 820,
                'nombre' => 'PUERTO COLOMBIA',
                'departamento' => 'GUAINÍA',
                'codigo_municipio' => '884',
                'codigo_departamento' => '94',
            ),
            221 => 
            array (
                'id' => 821,
                'nombre' => 'PUERTO COLOMBIA',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '573',
                'codigo_departamento' => '08',
            ),
            222 => 
            array (
                'id' => 822,
                'nombre' => 'PUERTO CONCORDIA',
                'departamento' => 'META',
                'codigo_municipio' => '450',
                'codigo_departamento' => '50',
            ),
            223 => 
            array (
                'id' => 823,
                'nombre' => 'PUERTO ESCONDIDO',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '574',
                'codigo_departamento' => '23',
            ),
            224 => 
            array (
                'id' => 824,
                'nombre' => 'PUERTO GAITAN',
                'departamento' => 'META',
                'codigo_municipio' => '568',
                'codigo_departamento' => '50',
            ),
            225 => 
            array (
                'id' => 825,
                'nombre' => 'PUERTO GUZMAN',
                'departamento' => 'PUTUMAYO',
                'codigo_municipio' => '571',
                'codigo_departamento' => '86',
            ),
            226 => 
            array (
                'id' => 826,
                'nombre' => 'PUERTO LIBERTADOR',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '580',
                'codigo_departamento' => '23',
            ),
            227 => 
            array (
                'id' => 827,
                'nombre' => 'PUERTO LLERAS',
                'departamento' => 'META',
                'codigo_municipio' => '577',
                'codigo_departamento' => '50',
            ),
            228 => 
            array (
                'id' => 828,
                'nombre' => 'PUERTO LOPEZ',
                'departamento' => 'META',
                'codigo_municipio' => '573',
                'codigo_departamento' => '50',
            ),
            229 => 
            array (
                'id' => 829,
                'nombre' => 'PUERTO NARE',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '585',
                'codigo_departamento' => '05',
            ),
            230 => 
            array (
                'id' => 830,
                'nombre' => 'PUERTO NARIÑO',
                'departamento' => 'AMAZONAS',
                'codigo_municipio' => '540',
                'codigo_departamento' => '91',
            ),
            231 => 
            array (
                'id' => 831,
                'nombre' => 'PUERTO PARRA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '573',
                'codigo_departamento' => '68',
            ),
            232 => 
            array (
                'id' => 832,
                'nombre' => 'PUERTO RICO',
                'departamento' => 'CAQUETÁ',
                'codigo_municipio' => '592',
                'codigo_departamento' => '18',
            ),
            233 => 
            array (
                'id' => 833,
                'nombre' => 'PUERTO RICO',
                'departamento' => 'META',
                'codigo_municipio' => '590',
                'codigo_departamento' => '50',
            ),
            234 => 
            array (
                'id' => 834,
                'nombre' => 'PUERTO RONDON',
                'departamento' => 'ARAUCA',
                'codigo_municipio' => '591',
                'codigo_departamento' => '81',
            ),
            235 => 
            array (
                'id' => 835,
                'nombre' => 'PUERTO SALGAR',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '572',
                'codigo_departamento' => '25',
            ),
            236 => 
            array (
                'id' => 836,
                'nombre' => 'PUERTO SANTANDER',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '553',
                'codigo_departamento' => '54',
            ),
            237 => 
            array (
                'id' => 837,
                'nombre' => 'PUERTO SANTANDER',
                'departamento' => 'AMAZONAS',
                'codigo_municipio' => '669',
                'codigo_departamento' => '91',
            ),
            238 => 
            array (
                'id' => 838,
                'nombre' => 'PUERTO TEJADA',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '573',
                'codigo_departamento' => '19',
            ),
            239 => 
            array (
                'id' => 839,
                'nombre' => 'PUERTO TRIUNFO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '591',
                'codigo_departamento' => '05',
            ),
            240 => 
            array (
                'id' => 840,
                'nombre' => 'PUERTO WILCHES',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '575',
                'codigo_departamento' => '68',
            ),
            241 => 
            array (
                'id' => 841,
                'nombre' => 'PULI',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '580',
                'codigo_departamento' => '25',
            ),
            242 => 
            array (
                'id' => 842,
                'nombre' => 'PUPIALES',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '585',
                'codigo_departamento' => '52',
            ),
            243 => 
            array (
                'id' => 843,
                'nombre' => 'PURACE',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '585',
                'codigo_departamento' => '19',
            ),
            244 => 
            array (
                'id' => 844,
                'nombre' => 'PURIFICACION',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '585',
                'codigo_departamento' => '73',
            ),
            245 => 
            array (
                'id' => 845,
                'nombre' => 'PURISIMA',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '586',
                'codigo_departamento' => '23',
            ),
            246 => 
            array (
                'id' => 846,
                'nombre' => 'QUEBRADANEGRA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '592',
                'codigo_departamento' => '25',
            ),
            247 => 
            array (
                'id' => 847,
                'nombre' => 'QUETAME',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '594',
                'codigo_departamento' => '25',
            ),
            248 => 
            array (
                'id' => 848,
                'nombre' => 'QUIBDO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '001',
                'codigo_departamento' => '27',
            ),
            249 => 
            array (
                'id' => 849,
                'nombre' => 'QUIMBAYA',
                'departamento' => 'QUINDIO',
                'codigo_municipio' => '594',
                'codigo_departamento' => '63',
            ),
            250 => 
            array (
                'id' => 850,
                'nombre' => 'QUINCHIA',
                'departamento' => 'RISARALDA',
                'codigo_municipio' => '594',
                'codigo_departamento' => '66',
            ),
            251 => 
            array (
                'id' => 851,
                'nombre' => 'QUIPAMA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '580',
                'codigo_departamento' => '15',
            ),
            252 => 
            array (
                'id' => 852,
                'nombre' => 'QUIPILE',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '596',
                'codigo_departamento' => '25',
            ),
            253 => 
            array (
                'id' => 853,
                'nombre' => 'RAGONVALIA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '599',
                'codigo_departamento' => '54',
            ),
            254 => 
            array (
                'id' => 854,
                'nombre' => 'RAMIRIQUI',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '599',
                'codigo_departamento' => '15',
            ),
            255 => 
            array (
                'id' => 855,
                'nombre' => 'RAQUIRA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '600',
                'codigo_departamento' => '15',
            ),
            256 => 
            array (
                'id' => 856,
                'nombre' => 'RECETOR',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '279',
                'codigo_departamento' => '85',
            ),
            257 => 
            array (
                'id' => 857,
                'nombre' => 'REGIDOR',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '580',
                'codigo_departamento' => '13',
            ),
            258 => 
            array (
                'id' => 858,
                'nombre' => 'REMEDIOS',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '604',
                'codigo_departamento' => '05',
            ),
            259 => 
            array (
                'id' => 859,
                'nombre' => 'REMOLINO',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '605',
                'codigo_departamento' => '47',
            ),
            260 => 
            array (
                'id' => 860,
                'nombre' => 'REPELON',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '606',
                'codigo_departamento' => '08',
            ),
            261 => 
            array (
                'id' => 861,
                'nombre' => 'RESTREPO',
                'departamento' => 'META',
                'codigo_municipio' => '606',
                'codigo_departamento' => '50',
            ),
            262 => 
            array (
                'id' => 862,
                'nombre' => 'RESTREPO',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '606',
                'codigo_departamento' => '76',
            ),
            263 => 
            array (
                'id' => 863,
                'nombre' => 'RETIRO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '607',
                'codigo_departamento' => '05',
            ),
            264 => 
            array (
                'id' => 864,
                'nombre' => 'RICAURTE',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '612',
                'codigo_departamento' => '25',
            ),
            265 => 
            array (
                'id' => 865,
                'nombre' => 'RICAURTE',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '612',
                'codigo_departamento' => '52',
            ),
            266 => 
            array (
                'id' => 866,
                'nombre' => 'RIO DE ORO',
                'departamento' => 'CESAR',
                'codigo_municipio' => '614',
                'codigo_departamento' => '20',
            ),
            267 => 
            array (
                'id' => 867,
                'nombre' => 'RIO IRO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '580',
                'codigo_departamento' => '27',
            ),
            268 => 
            array (
                'id' => 868,
                'nombre' => 'RIO QUITO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '600',
                'codigo_departamento' => '27',
            ),
            269 => 
            array (
                'id' => 869,
                'nombre' => 'RIO VIEJO',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '600',
                'codigo_departamento' => '13',
            ),
            270 => 
            array (
                'id' => 870,
                'nombre' => 'RIOBLANCO',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '616',
                'codigo_departamento' => '73',
            ),
            271 => 
            array (
                'id' => 871,
                'nombre' => 'RIOFRIO',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '616',
                'codigo_departamento' => '76',
            ),
            272 => 
            array (
                'id' => 872,
                'nombre' => 'RIOHACHA',
                'departamento' => 'LA GUAJIRA',
                'codigo_municipio' => '001',
                'codigo_departamento' => '44',
            ),
            273 => 
            array (
                'id' => 873,
                'nombre' => 'RIONEGRO',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '615',
                'codigo_departamento' => '68',
            ),
            274 => 
            array (
                'id' => 874,
                'nombre' => 'RIONEGRO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '615',
                'codigo_departamento' => '05',
            ),
            275 => 
            array (
                'id' => 875,
                'nombre' => 'RIOSUCIO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '6115',
                'codigo_departamento' => '27',
            ),
            276 => 
            array (
                'id' => 876,
                'nombre' => 'RIOSUCIO',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '614',
                'codigo_departamento' => '17',
            ),
            277 => 
            array (
                'id' => 877,
                'nombre' => 'RISARALDA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '616',
                'codigo_departamento' => '17',
            ),
            278 => 
            array (
                'id' => 878,
                'nombre' => 'RIVERA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '615',
                'codigo_departamento' => '41',
            ),
            279 => 
            array (
                'id' => 879,
                'nombre' => 'ROBERTO PAYAN',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '621',
                'codigo_departamento' => '52',
            ),
            280 => 
            array (
                'id' => 880,
                'nombre' => 'ROLDANILLO',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '622',
                'codigo_departamento' => '76',
            ),
            281 => 
            array (
                'id' => 881,
                'nombre' => 'RONCESVALLES',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '622',
                'codigo_departamento' => '73',
            ),
            282 => 
            array (
                'id' => 882,
                'nombre' => 'RONDON',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '621',
                'codigo_departamento' => '15',
            ),
            283 => 
            array (
                'id' => 883,
                'nombre' => 'ROSAS',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '622',
                'codigo_departamento' => '19',
            ),
            284 => 
            array (
                'id' => 884,
                'nombre' => 'ROVIRA',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '624',
                'codigo_departamento' => '73',
            ),
            285 => 
            array (
                'id' => 885,
                'nombre' => 'SABANA DE TORRES',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '655',
                'codigo_departamento' => '68',
            ),
            286 => 
            array (
                'id' => 886,
                'nombre' => 'SABANAGRANDE',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '634',
                'codigo_departamento' => '08',
            ),
            287 => 
            array (
                'id' => 887,
                'nombre' => 'SABANALARGA',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '300',
                'codigo_departamento' => '85',
            ),
            288 => 
            array (
                'id' => 888,
                'nombre' => 'SABANALARGA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '628',
                'codigo_departamento' => '05',
            ),
            289 => 
            array (
                'id' => 889,
                'nombre' => 'SABANALARGA',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '638',
                'codigo_departamento' => '08',
            ),
            290 => 
            array (
                'id' => 890,
                'nombre' => 'SABANAS DE SAN ANGEL',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '660',
                'codigo_departamento' => '47',
            ),
            291 => 
            array (
                'id' => 891,
                'nombre' => 'SABANETA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '631',
                'codigo_departamento' => '05',
            ),
            292 => 
            array (
                'id' => 892,
                'nombre' => 'SABOYA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '632',
                'codigo_departamento' => '15',
            ),
            293 => 
            array (
                'id' => 893,
                'nombre' => 'SACAMA',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '315',
                'codigo_departamento' => '85',
            ),
            294 => 
            array (
                'id' => 894,
                'nombre' => 'SACHICA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '638',
                'codigo_departamento' => '15',
            ),
            295 => 
            array (
                'id' => 895,
                'nombre' => 'SAHAGUN',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '660',
                'codigo_departamento' => '23',
            ),
            296 => 
            array (
                'id' => 896,
                'nombre' => 'SALADOBLANCO',
                'departamento' => 'HUILA',
                'codigo_municipio' => '660',
                'codigo_departamento' => '41',
            ),
            297 => 
            array (
                'id' => 897,
                'nombre' => 'SALAMINA',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '675',
                'codigo_departamento' => '47',
            ),
            298 => 
            array (
                'id' => 898,
                'nombre' => 'SALAMINA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '653',
                'codigo_departamento' => '17',
            ),
            299 => 
            array (
                'id' => 899,
                'nombre' => 'SALAZAR',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '660',
                'codigo_departamento' => '54',
            ),
            300 => 
            array (
                'id' => 900,
                'nombre' => 'SALDAÑA',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '671',
                'codigo_departamento' => '73',
            ),
            301 => 
            array (
                'id' => 901,
                'nombre' => 'SALENTO',
                'departamento' => 'QUINDIO',
                'codigo_municipio' => '690',
                'codigo_departamento' => '63',
            ),
            302 => 
            array (
                'id' => 902,
                'nombre' => 'SALGAR',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '642',
                'codigo_departamento' => '05',
            ),
            303 => 
            array (
                'id' => 903,
                'nombre' => 'SAMACA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '646',
                'codigo_departamento' => '15',
            ),
            304 => 
            array (
                'id' => 904,
                'nombre' => 'SAMANA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '662',
                'codigo_departamento' => '17',
            ),
            305 => 
            array (
                'id' => 905,
                'nombre' => 'SAMANIEGO',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '678',
                'codigo_departamento' => '52',
            ),
            306 => 
            array (
                'id' => 906,
                'nombre' => 'SAMPUES',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '670',
                'codigo_departamento' => '70',
            ),
            307 => 
            array (
                'id' => 907,
                'nombre' => 'SAN AGUSTIN',
                'departamento' => 'HUILA',
                'codigo_municipio' => '668',
                'codigo_departamento' => '41',
            ),
            308 => 
            array (
                'id' => 908,
                'nombre' => 'SAN ALBERTO',
                'departamento' => 'CESAR',
                'codigo_municipio' => '710',
                'codigo_departamento' => '20',
            ),
            309 => 
            array (
                'id' => 909,
                'nombre' => 'SAN ANDRES',
                'departamento' => 'SAN ANDRÉS Y PROVIDENCIA',
                'codigo_municipio' => '001',
                'codigo_departamento' => '88',
            ),
            310 => 
            array (
                'id' => 910,
                'nombre' => 'SAN ANDRES',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '669',
                'codigo_departamento' => '68',
            ),
            311 => 
            array (
                'id' => 911,
                'nombre' => 'SAN ANDRES DE CUERQUIA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '647',
                'codigo_departamento' => '05',
            ),
            312 => 
            array (
                'id' => 912,
                'nombre' => 'SAN ANDRES DE TUMACO',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '835',
                'codigo_departamento' => '52',
            ),
            313 => 
            array (
                'id' => 913,
                'nombre' => 'SAN ANDRES SOTAVENTO',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '670',
                'codigo_departamento' => '23',
            ),
            314 => 
            array (
                'id' => 914,
                'nombre' => 'SAN ANTERO',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '672',
                'codigo_departamento' => '23',
            ),
            315 => 
            array (
                'id' => 915,
                'nombre' => 'SAN ANTONIO',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '675',
                'codigo_departamento' => '73',
            ),
            316 => 
            array (
                'id' => 916,
                'nombre' => 'SAN ANTONIO DEL TEQUENDAMA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '645',
                'codigo_departamento' => '25',
            ),
            317 => 
            array (
                'id' => 917,
                'nombre' => 'SAN BENITO',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '673',
                'codigo_departamento' => '68',
            ),
            318 => 
            array (
                'id' => 918,
                'nombre' => 'SAN BENITO ABAD',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '678',
                'codigo_departamento' => '70',
            ),
            319 => 
            array (
                'id' => 919,
                'nombre' => 'SAN BERNARDO',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '649',
                'codigo_departamento' => '25',
            ),
            320 => 
            array (
                'id' => 920,
                'nombre' => 'SAN BERNARDO',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '685',
                'codigo_departamento' => '52',
            ),
            321 => 
            array (
                'id' => 921,
                'nombre' => 'SAN BERNARDO DEL VIENTO',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '675',
                'codigo_departamento' => '23',
            ),
            322 => 
            array (
                'id' => 922,
                'nombre' => 'SAN CALIXTO',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '670',
                'codigo_departamento' => '54',
            ),
            323 => 
            array (
                'id' => 923,
                'nombre' => 'SAN CARLOS',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '678',
                'codigo_departamento' => '23',
            ),
            324 => 
            array (
                'id' => 924,
                'nombre' => 'SAN CARLOS',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '649',
                'codigo_departamento' => '05',
            ),
            325 => 
            array (
                'id' => 925,
                'nombre' => 'SAN CARLOS DE GUAROA',
                'departamento' => 'META',
                'codigo_municipio' => '680',
                'codigo_departamento' => '50',
            ),
            326 => 
            array (
                'id' => 926,
                'nombre' => 'SAN CAYETANO',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '653',
                'codigo_departamento' => '25',
            ),
            327 => 
            array (
                'id' => 927,
                'nombre' => 'SAN CAYETANO',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '673',
                'codigo_departamento' => '54',
            ),
            328 => 
            array (
                'id' => 928,
                'nombre' => 'SAN CRISTOBAL',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '620',
                'codigo_departamento' => '13',
            ),
            329 => 
            array (
                'id' => 929,
                'nombre' => 'SAN DIEGO',
                'departamento' => 'CESAR',
                'codigo_municipio' => '750',
                'codigo_departamento' => '20',
            ),
            330 => 
            array (
                'id' => 930,
                'nombre' => 'SAN EDUARDO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '660',
                'codigo_departamento' => '15',
            ),
            331 => 
            array (
                'id' => 931,
                'nombre' => 'SAN ESTANISLAO',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '647',
                'codigo_departamento' => '13',
            ),
            332 => 
            array (
                'id' => 932,
                'nombre' => 'SAN FELIPE',
                'departamento' => 'GUAINÍA',
                'codigo_municipio' => '883',
                'codigo_departamento' => '94',
            ),
            333 => 
            array (
                'id' => 933,
                'nombre' => 'SAN FERNANDO',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '650',
                'codigo_departamento' => '13',
            ),
            334 => 
            array (
                'id' => 934,
                'nombre' => 'SAN FRANCISCO',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '658',
                'codigo_departamento' => '25',
            ),
            335 => 
            array (
                'id' => 935,
                'nombre' => 'SAN FRANCISCO',
                'departamento' => 'PUTUMAYO',
                'codigo_municipio' => '755',
                'codigo_departamento' => '86',
            ),
            336 => 
            array (
                'id' => 936,
                'nombre' => 'SAN FRANCISCO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '652',
                'codigo_departamento' => '05',
            ),
            337 => 
            array (
                'id' => 937,
                'nombre' => 'SAN GIL',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '679',
                'codigo_departamento' => '68',
            ),
            338 => 
            array (
                'id' => 938,
                'nombre' => 'SAN JACINTO',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '654',
                'codigo_departamento' => '13',
            ),
            339 => 
            array (
                'id' => 939,
                'nombre' => 'SAN JACINTO DEL CAUCA',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '655',
                'codigo_departamento' => '13',
            ),
            340 => 
            array (
                'id' => 940,
                'nombre' => 'SAN JERONIMO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '656',
                'codigo_departamento' => '05',
            ),
            341 => 
            array (
                'id' => 941,
                'nombre' => 'SAN JOAQUIN',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '682',
                'codigo_departamento' => '68',
            ),
            342 => 
            array (
                'id' => 942,
                'nombre' => 'SAN JOSE',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '665',
                'codigo_departamento' => '17',
            ),
            343 => 
            array (
                'id' => 943,
                'nombre' => 'SAN JOSE DE LA MONTAÑA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '658',
                'codigo_departamento' => '05',
            ),
            344 => 
            array (
                'id' => 944,
                'nombre' => 'SAN JOSE DE MIRANDA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '684',
                'codigo_departamento' => '68',
            ),
            345 => 
            array (
                'id' => 945,
                'nombre' => 'SAN JOSE DE PARE',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '664',
                'codigo_departamento' => '15',
            ),
            346 => 
            array (
                'id' => 946,
                'nombre' => 'SAN JOSE DEL FRAGUA',
                'departamento' => 'CAQUETÁ',
                'codigo_municipio' => '610',
                'codigo_departamento' => '18',
            ),
            347 => 
            array (
                'id' => 947,
                'nombre' => 'SAN JOSE DEL GUAVIARE',
                'departamento' => 'GUAVIARE',
                'codigo_municipio' => '001',
                'codigo_departamento' => '95',
            ),
            348 => 
            array (
                'id' => 948,
                'nombre' => 'SAN JOSE DEL PALMAR',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '660',
                'codigo_departamento' => '27',
            ),
            349 => 
            array (
                'id' => 949,
                'nombre' => 'SAN JUAN DE ARAMA',
                'departamento' => 'META',
                'codigo_municipio' => '683',
                'codigo_departamento' => '50',
            ),
            350 => 
            array (
                'id' => 950,
                'nombre' => 'SAN JUAN DE BETULIA',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '702',
                'codigo_departamento' => '70',
            ),
            351 => 
            array (
                'id' => 951,
                'nombre' => 'SAN JUAN DE RIO SECO',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '662',
                'codigo_departamento' => '25',
            ),
            352 => 
            array (
                'id' => 952,
                'nombre' => 'SAN JUAN DE URABA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '659',
                'codigo_departamento' => '05',
            ),
            353 => 
            array (
                'id' => 953,
                'nombre' => 'SAN JUAN DEL CESAR',
                'departamento' => 'LA GUAJIRA',
                'codigo_municipio' => '650',
                'codigo_departamento' => '44',
            ),
            354 => 
            array (
                'id' => 954,
                'nombre' => 'SAN JUAN NEPOMUCENO',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '657',
                'codigo_departamento' => '13',
            ),
            355 => 
            array (
                'id' => 955,
                'nombre' => 'SAN JUANITO',
                'departamento' => 'META',
                'codigo_municipio' => '686',
                'codigo_departamento' => '50',
            ),
            356 => 
            array (
                'id' => 956,
                'nombre' => 'SAN LORENZO',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '687',
                'codigo_departamento' => '52',
            ),
            357 => 
            array (
                'id' => 957,
                'nombre' => 'SAN LUIS',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '678',
                'codigo_departamento' => '73',
            ),
            358 => 
            array (
                'id' => 958,
                'nombre' => 'SAN LUIS',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '660',
                'codigo_departamento' => '05',
            ),
            359 => 
            array (
                'id' => 959,
                'nombre' => 'SAN LUIS DE GACENO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '667',
                'codigo_departamento' => '15',
            ),
            360 => 
            array (
                'id' => 960,
                'nombre' => 'SAN LUIS DE PALENQUE',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '325',
                'codigo_departamento' => '85',
            ),
            361 => 
            array (
                'id' => 961,
                'nombre' => 'SAN LUIS DE SINCE',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '742',
                'codigo_departamento' => '70',
            ),
            362 => 
            array (
                'id' => 962,
                'nombre' => 'SAN MARCOS',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '708',
                'codigo_departamento' => '70',
            ),
            363 => 
            array (
                'id' => 963,
                'nombre' => 'SAN MARTIN',
                'departamento' => 'CESAR',
                'codigo_municipio' => '770',
                'codigo_departamento' => '20',
            ),
            364 => 
            array (
                'id' => 964,
                'nombre' => 'SAN MARTIN',
                'departamento' => 'META',
                'codigo_municipio' => '689',
                'codigo_departamento' => '50',
            ),
            365 => 
            array (
                'id' => 965,
                'nombre' => 'SAN MARTIN DE LOBA',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '667',
                'codigo_departamento' => '13',
            ),
            366 => 
            array (
                'id' => 966,
                'nombre' => 'SAN MATEO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '673',
                'codigo_departamento' => '15',
            ),
            367 => 
            array (
                'id' => 967,
                'nombre' => 'SAN MIGUEL',
                'departamento' => 'PUTUMAYO',
                'codigo_municipio' => '757',
                'codigo_departamento' => '86',
            ),
            368 => 
            array (
                'id' => 968,
                'nombre' => 'SAN MIGUEL',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '686',
                'codigo_departamento' => '68',
            ),
            369 => 
            array (
                'id' => 969,
                'nombre' => 'SAN MIGUEL DE SEMA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '676',
                'codigo_departamento' => '15',
            ),
            370 => 
            array (
                'id' => 970,
                'nombre' => 'SAN ONOFRE',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '713',
                'codigo_departamento' => '70',
            ),
            371 => 
            array (
                'id' => 971,
                'nombre' => 'SAN PABLO',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '693',
                'codigo_departamento' => '52',
            ),
            372 => 
            array (
                'id' => 972,
                'nombre' => 'SAN PABLO',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '670',
                'codigo_departamento' => '13',
            ),
            373 => 
            array (
                'id' => 973,
                'nombre' => 'SAN PABLO DE BORBUR',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '681',
                'codigo_departamento' => '15',
            ),
            374 => 
            array (
                'id' => 974,
                'nombre' => 'SAN PEDRO',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '717',
                'codigo_departamento' => '70',
            ),
            375 => 
            array (
                'id' => 975,
                'nombre' => 'SAN PEDRO',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '670',
                'codigo_departamento' => '76',
            ),
            376 => 
            array (
                'id' => 976,
                'nombre' => 'SAN PEDRO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '664',
                'codigo_departamento' => '05',
            ),
            377 => 
            array (
                'id' => 977,
                'nombre' => 'SAN PEDRO DE CARTAGO',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '694',
                'codigo_departamento' => '52',
            ),
            378 => 
            array (
                'id' => 978,
                'nombre' => 'SAN PEDRO DE URABA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '665',
                'codigo_departamento' => '05',
            ),
            379 => 
            array (
                'id' => 979,
                'nombre' => 'SAN PELAYO',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '686',
                'codigo_departamento' => '23',
            ),
            380 => 
            array (
                'id' => 980,
                'nombre' => 'SAN RAFAEL',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '667',
                'codigo_departamento' => '05',
            ),
            381 => 
            array (
                'id' => 981,
                'nombre' => 'SAN ROQUE',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '670',
                'codigo_departamento' => '05',
            ),
            382 => 
            array (
                'id' => 982,
                'nombre' => 'SAN SEBASTIAN',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '693',
                'codigo_departamento' => '19',
            ),
            383 => 
            array (
                'id' => 983,
                'nombre' => 'SAN SEBASTIAN DE BUENAVISTA',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '692',
                'codigo_departamento' => '47',
            ),
            384 => 
            array (
                'id' => 984,
                'nombre' => 'SAN VICENTE',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '674',
                'codigo_departamento' => '05',
            ),
            385 => 
            array (
                'id' => 985,
                'nombre' => 'SAN VICENTE DE CHUCURI',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '689',
                'codigo_departamento' => '68',
            ),
            386 => 
            array (
                'id' => 986,
                'nombre' => 'SAN VICENTE DEL CAGUAN',
                'departamento' => 'CAQUETÁ',
                'codigo_municipio' => '753',
                'codigo_departamento' => '18',
            ),
            387 => 
            array (
                'id' => 987,
                'nombre' => 'SAN ZENON',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '703',
                'codigo_departamento' => '47',
            ),
            388 => 
            array (
                'id' => 988,
                'nombre' => 'SANDONA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '683',
                'codigo_departamento' => '52',
            ),
            389 => 
            array (
                'id' => 989,
                'nombre' => 'SANTA ANA',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '707',
                'codigo_departamento' => '47',
            ),
            390 => 
            array (
                'id' => 990,
                'nombre' => 'SANTA BARBARA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '696',
                'codigo_departamento' => '52',
            ),
            391 => 
            array (
                'id' => 991,
                'nombre' => 'SANTA BARBARA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '705',
                'codigo_departamento' => '68',
            ),
            392 => 
            array (
                'id' => 992,
                'nombre' => 'SANTA BARBARA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '679',
                'codigo_departamento' => '05',
            ),
            393 => 
            array (
                'id' => 993,
                'nombre' => 'SANTA BARBARA DE PINTO',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '720',
                'codigo_departamento' => '47',
            ),
            394 => 
            array (
                'id' => 994,
                'nombre' => 'SANTA CATALINA',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '673',
                'codigo_departamento' => '13',
            ),
            395 => 
            array (
                'id' => 995,
                'nombre' => 'SANTA HELENA DEL OPON',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '720',
                'codigo_departamento' => '68',
            ),
            396 => 
            array (
                'id' => 996,
                'nombre' => 'SANTA ISABEL',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '686',
                'codigo_departamento' => '73',
            ),
            397 => 
            array (
                'id' => 997,
                'nombre' => 'SANTA LUCIA',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '675',
                'codigo_departamento' => '08',
            ),
            398 => 
            array (
                'id' => 998,
                'nombre' => 'SANTA MARIA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '690',
                'codigo_departamento' => '15',
            ),
            399 => 
            array (
                'id' => 999,
                'nombre' => 'SANTA MARIA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '676',
                'codigo_departamento' => '41',
            ),
            400 => 
            array (
                'id' => 1000,
                'nombre' => 'SANTA MARTA',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '001',
                'codigo_departamento' => '47',
            ),
            401 => 
            array (
                'id' => 1001,
                'nombre' => 'SANTA ROSA',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '701',
                'codigo_departamento' => '19',
            ),
            402 => 
            array (
                'id' => 1002,
                'nombre' => 'SANTA ROSA',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '683',
                'codigo_departamento' => '13',
            ),
            403 => 
            array (
                'id' => 1003,
                'nombre' => 'SANTA ROSA DE CABAL',
                'departamento' => 'RISARALDA',
                'codigo_municipio' => '682',
                'codigo_departamento' => '66',
            ),
            404 => 
            array (
                'id' => 1004,
                'nombre' => 'SANTA ROSA DE OSOS',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '686',
                'codigo_departamento' => '05',
            ),
            405 => 
            array (
                'id' => 1005,
                'nombre' => 'SANTA ROSA DE VITERBO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '693',
                'codigo_departamento' => '15',
            ),
            406 => 
            array (
                'id' => 1006,
                'nombre' => 'SANTA ROSA DEL SUR',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '688',
                'codigo_departamento' => '13',
            ),
            407 => 
            array (
                'id' => 1007,
                'nombre' => 'SANTA ROSALIA',
                'departamento' => 'VICHADA',
                'codigo_municipio' => '624',
                'codigo_departamento' => '99',
            ),
            408 => 
            array (
                'id' => 1008,
                'nombre' => 'SANTA SOFIA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '696',
                'codigo_departamento' => '15',
            ),
            409 => 
            array (
                'id' => 1009,
                'nombre' => 'SANTACRUZ',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '699',
                'codigo_departamento' => '52',
            ),
            410 => 
            array (
                'id' => 1010,
                'nombre' => 'SANTAFE DE ANTIOQUIA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '042',
                'codigo_departamento' => '05',
            ),
            411 => 
            array (
                'id' => 1011,
                'nombre' => 'SANTANA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '686',
                'codigo_departamento' => '15',
            ),
            412 => 
            array (
                'id' => 1012,
                'nombre' => 'SANTANDER DE QUILICHAO',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '698',
                'codigo_departamento' => '19',
            ),
            413 => 
            array (
                'id' => 1013,
                'nombre' => 'SANTIAGO',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '680',
                'codigo_departamento' => '54',
            ),
            414 => 
            array (
                'id' => 1014,
                'nombre' => 'SANTIAGO',
                'departamento' => 'PUTUMAYO',
                'codigo_municipio' => '760',
                'codigo_departamento' => '86',
            ),
            415 => 
            array (
                'id' => 1015,
                'nombre' => 'SANTIAGO DE TOLU',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '820',
                'codigo_departamento' => '70',
            ),
            416 => 
            array (
                'id' => 1016,
                'nombre' => 'SANTO DOMINGO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '690',
                'codigo_departamento' => '05',
            ),
            417 => 
            array (
                'id' => 1017,
                'nombre' => 'SANTO TOMAS',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '685',
                'codigo_departamento' => '08',
            ),
            418 => 
            array (
                'id' => 1018,
                'nombre' => 'SANTUARIO',
                'departamento' => 'RISARALDA',
                'codigo_municipio' => '687',
                'codigo_departamento' => '66',
            ),
            419 => 
            array (
                'id' => 1019,
                'nombre' => 'SAPUYES',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '720',
                'codigo_departamento' => '52',
            ),
            420 => 
            array (
                'id' => 1020,
                'nombre' => 'SARAVENA',
                'departamento' => 'ARAUCA',
                'codigo_municipio' => '736',
                'codigo_departamento' => '81',
            ),
            421 => 
            array (
                'id' => 1021,
                'nombre' => 'SARDINATA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '720',
                'codigo_departamento' => '54',
            ),
            422 => 
            array (
                'id' => 1022,
                'nombre' => 'SASAIMA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '718',
                'codigo_departamento' => '25',
            ),
            423 => 
            array (
                'id' => 1023,
                'nombre' => 'SATIVANORTE',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '720',
                'codigo_departamento' => '15',
            ),
            424 => 
            array (
                'id' => 1024,
                'nombre' => 'SATIVASUR',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '723',
                'codigo_departamento' => '15',
            ),
            425 => 
            array (
                'id' => 1025,
                'nombre' => 'SEGOVIA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '736',
                'codigo_departamento' => '05',
            ),
            426 => 
            array (
                'id' => 1026,
                'nombre' => 'SESQUILE',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '736',
                'codigo_departamento' => '25',
            ),
            427 => 
            array (
                'id' => 1027,
                'nombre' => 'SEVILLA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '736',
                'codigo_departamento' => '76',
            ),
            428 => 
            array (
                'id' => 1028,
                'nombre' => 'SIACHOQUE',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '740',
                'codigo_departamento' => '15',
            ),
            429 => 
            array (
                'id' => 1029,
                'nombre' => 'SIBATE',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '740',
                'codigo_departamento' => '25',
            ),
            430 => 
            array (
                'id' => 1030,
                'nombre' => 'SIBUNDOY',
                'departamento' => 'PUTUMAYO',
                'codigo_municipio' => '749',
                'codigo_departamento' => '86',
            ),
            431 => 
            array (
                'id' => 1031,
                'nombre' => 'SILOS',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '743',
                'codigo_departamento' => '54',
            ),
            432 => 
            array (
                'id' => 1032,
                'nombre' => 'SILVANIA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '743',
                'codigo_departamento' => '25',
            ),
            433 => 
            array (
                'id' => 1033,
                'nombre' => 'SILVIA',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '743',
                'codigo_departamento' => '19',
            ),
            434 => 
            array (
                'id' => 1034,
                'nombre' => 'SIMACOTA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '745',
                'codigo_departamento' => '68',
            ),
            435 => 
            array (
                'id' => 1035,
                'nombre' => 'SIMIJACA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '745',
                'codigo_departamento' => '25',
            ),
            436 => 
            array (
                'id' => 1036,
                'nombre' => 'SIMITI',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '744',
                'codigo_departamento' => '13',
            ),
            437 => 
            array (
                'id' => 1037,
                'nombre' => 'SINCELEJO',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '001',
                'codigo_departamento' => '70',
            ),
            438 => 
            array (
                'id' => 1038,
                'nombre' => 'SIPI',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '745',
                'codigo_departamento' => '27',
            ),
            439 => 
            array (
                'id' => 1039,
                'nombre' => 'SITIONUEVO',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '745',
                'codigo_departamento' => '47',
            ),
            440 => 
            array (
                'id' => 1040,
                'nombre' => 'SOACHA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '754',
                'codigo_departamento' => '25',
            ),
            441 => 
            array (
                'id' => 1041,
                'nombre' => 'SOATA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '753',
                'codigo_departamento' => '15',
            ),
            442 => 
            array (
                'id' => 1042,
                'nombre' => 'SOCHA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '757',
                'codigo_departamento' => '15',
            ),
            443 => 
            array (
                'id' => 1043,
                'nombre' => 'SOCORRO',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '755',
                'codigo_departamento' => '68',
            ),
            444 => 
            array (
                'id' => 1044,
                'nombre' => 'SOCOTA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '755',
                'codigo_departamento' => '15',
            ),
            445 => 
            array (
                'id' => 1045,
                'nombre' => 'SOGAMOSO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '759',
                'codigo_departamento' => '15',
            ),
            446 => 
            array (
                'id' => 1046,
                'nombre' => 'SOLANO',
                'departamento' => 'CAQUETÁ',
                'codigo_municipio' => '756',
                'codigo_departamento' => '18',
            ),
            447 => 
            array (
                'id' => 1047,
                'nombre' => 'SOLEDAD',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '758',
                'codigo_departamento' => '08',
            ),
            448 => 
            array (
                'id' => 1048,
                'nombre' => 'SOLITA',
                'departamento' => 'CAQUETÁ',
                'codigo_municipio' => '785',
                'codigo_departamento' => '18',
            ),
            449 => 
            array (
                'id' => 1049,
                'nombre' => 'SOMONDOCO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '761',
                'codigo_departamento' => '15',
            ),
            450 => 
            array (
                'id' => 1050,
                'nombre' => 'SONSON',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '756',
                'codigo_departamento' => '05',
            ),
            451 => 
            array (
                'id' => 1051,
                'nombre' => 'SOPETRAN',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '761',
                'codigo_departamento' => '05',
            ),
            452 => 
            array (
                'id' => 1052,
                'nombre' => 'SOPLAVIENTO',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '760',
                'codigo_departamento' => '13',
            ),
            453 => 
            array (
                'id' => 1053,
                'nombre' => 'SOPO',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '758',
                'codigo_departamento' => '25',
            ),
            454 => 
            array (
                'id' => 1054,
                'nombre' => 'SORA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '762',
                'codigo_departamento' => '15',
            ),
            455 => 
            array (
                'id' => 1055,
                'nombre' => 'SORACA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '764',
                'codigo_departamento' => '15',
            ),
            456 => 
            array (
                'id' => 1056,
                'nombre' => 'SOTAQUIRA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '763',
                'codigo_departamento' => '15',
            ),
            457 => 
            array (
                'id' => 1057,
                'nombre' => 'SOTARA',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '760',
                'codigo_departamento' => '19',
            ),
            458 => 
            array (
                'id' => 1058,
                'nombre' => 'SUAITA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '770',
                'codigo_departamento' => '68',
            ),
            459 => 
            array (
                'id' => 1059,
                'nombre' => 'SUAN',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '770',
                'codigo_departamento' => '08',
            ),
            460 => 
            array (
                'id' => 1060,
                'nombre' => 'SUAREZ',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '780',
                'codigo_departamento' => '19',
            ),
            461 => 
            array (
                'id' => 1061,
                'nombre' => 'SUAREZ',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '770',
                'codigo_departamento' => '73',
            ),
            462 => 
            array (
                'id' => 1062,
                'nombre' => 'SUAZA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '770',
                'codigo_departamento' => '41',
            ),
            463 => 
            array (
                'id' => 1063,
                'nombre' => 'SUBACHOQUE',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '769',
                'codigo_departamento' => '25',
            ),
            464 => 
            array (
                'id' => 1064,
                'nombre' => 'SUCRE',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '785',
                'codigo_departamento' => '19',
            ),
            465 => 
            array (
                'id' => 1065,
                'nombre' => 'SUCRE',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '773',
                'codigo_departamento' => '68',
            ),
            466 => 
            array (
                'id' => 1066,
                'nombre' => 'SUCRE',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '771',
                'codigo_departamento' => '70',
            ),
            467 => 
            array (
                'id' => 1067,
                'nombre' => 'SUESCA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '772',
                'codigo_departamento' => '25',
            ),
            468 => 
            array (
                'id' => 1068,
                'nombre' => 'SUPATA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '777',
                'codigo_departamento' => '25',
            ),
            469 => 
            array (
                'id' => 1069,
                'nombre' => 'SUPIA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '777',
                'codigo_departamento' => '17',
            ),
            470 => 
            array (
                'id' => 1070,
                'nombre' => 'SURATA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '780',
                'codigo_departamento' => '68',
            ),
            471 => 
            array (
                'id' => 1071,
                'nombre' => 'SUSA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '779',
                'codigo_departamento' => '25',
            ),
            472 => 
            array (
                'id' => 1072,
                'nombre' => 'SUSACON',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '774',
                'codigo_departamento' => '15',
            ),
            473 => 
            array (
                'id' => 1073,
                'nombre' => 'SUTAMARCHAN',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '776',
                'codigo_departamento' => '15',
            ),
            474 => 
            array (
                'id' => 1074,
                'nombre' => 'SUTATAUSA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '781',
                'codigo_departamento' => '25',
            ),
            475 => 
            array (
                'id' => 1075,
                'nombre' => 'SUTATENZA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '778',
                'codigo_departamento' => '15',
            ),
            476 => 
            array (
                'id' => 1076,
                'nombre' => 'TABIO',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '785',
                'codigo_departamento' => '25',
            ),
            477 => 
            array (
                'id' => 1077,
                'nombre' => 'TADO',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '787',
                'codigo_departamento' => '27',
            ),
            478 => 
            array (
                'id' => 1078,
                'nombre' => 'TALAIGUA NUEVO',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '780',
                'codigo_departamento' => '13',
            ),
            479 => 
            array (
                'id' => 1079,
                'nombre' => 'TAMALAMEQUE',
                'departamento' => 'CESAR',
                'codigo_municipio' => '787',
                'codigo_departamento' => '20',
            ),
            480 => 
            array (
                'id' => 1080,
                'nombre' => 'TAMARA',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '400',
                'codigo_departamento' => '85',
            ),
            481 => 
            array (
                'id' => 1081,
                'nombre' => 'TAME',
                'departamento' => 'ARAUCA',
                'codigo_municipio' => '794',
                'codigo_departamento' => '81',
            ),
            482 => 
            array (
                'id' => 1082,
                'nombre' => 'TAMESIS',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '789',
                'codigo_departamento' => '05',
            ),
            483 => 
            array (
                'id' => 1083,
                'nombre' => 'TAMINANGO',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '786',
                'codigo_departamento' => '52',
            ),
            484 => 
            array (
                'id' => 1084,
                'nombre' => 'TANGUA',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '788',
                'codigo_departamento' => '52',
            ),
            485 => 
            array (
                'id' => 1085,
                'nombre' => 'TARAIRA',
                'departamento' => 'VAUPÉS',
                'codigo_municipio' => '666',
                'codigo_departamento' => '97',
            ),
            486 => 
            array (
                'id' => 1086,
                'nombre' => 'TARAPACA',
                'departamento' => 'AMAZONAS',
                'codigo_municipio' => '798',
                'codigo_departamento' => '91',
            ),
            487 => 
            array (
                'id' => 1087,
                'nombre' => 'TARAZA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '790',
                'codigo_departamento' => '05',
            ),
            488 => 
            array (
                'id' => 1088,
                'nombre' => 'TARQUI',
                'departamento' => 'HUILA',
                'codigo_municipio' => '791',
                'codigo_departamento' => '41',
            ),
            489 => 
            array (
                'id' => 1089,
                'nombre' => 'TARSO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '792',
                'codigo_departamento' => '05',
            ),
            490 => 
            array (
                'id' => 1090,
                'nombre' => 'TASCO',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '790',
                'codigo_departamento' => '15',
            ),
            491 => 
            array (
                'id' => 1091,
                'nombre' => 'TAURAMENA',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '410',
                'codigo_departamento' => '85',
            ),
            492 => 
            array (
                'id' => 1092,
                'nombre' => 'TAUSA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '793',
                'codigo_departamento' => '25',
            ),
            493 => 
            array (
                'id' => 1093,
                'nombre' => 'TELLO',
                'departamento' => 'HUILA',
                'codigo_municipio' => '799',
                'codigo_departamento' => '41',
            ),
            494 => 
            array (
                'id' => 1094,
                'nombre' => 'TENA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '797',
                'codigo_departamento' => '25',
            ),
            495 => 
            array (
                'id' => 1095,
                'nombre' => 'TENERIFE',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '798',
                'codigo_departamento' => '47',
            ),
            496 => 
            array (
                'id' => 1096,
                'nombre' => 'TENJO',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '799',
                'codigo_departamento' => '25',
            ),
            497 => 
            array (
                'id' => 1097,
                'nombre' => 'TENZA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '798',
                'codigo_departamento' => '15',
            ),
            498 => 
            array (
                'id' => 1098,
                'nombre' => 'TEORAMA',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '800',
                'codigo_departamento' => '54',
            ),
            499 => 
            array (
                'id' => 1099,
                'nombre' => 'TERUEL',
                'departamento' => 'HUILA',
                'codigo_municipio' => '801',
                'codigo_departamento' => '41',
            ),
        ));
        \DB::table('municipios')->insert(array (
            0 => 
            array (
                'id' => 1100,
                'nombre' => 'TESALIA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '797',
                'codigo_departamento' => '41',
            ),
            1 => 
            array (
                'id' => 1101,
                'nombre' => 'TIBACUY',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '805',
                'codigo_departamento' => '25',
            ),
            2 => 
            array (
                'id' => 1102,
                'nombre' => 'TIBANA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '804',
                'codigo_departamento' => '15',
            ),
            3 => 
            array (
                'id' => 1103,
                'nombre' => 'TIBASOSA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '806',
                'codigo_departamento' => '15',
            ),
            4 => 
            array (
                'id' => 1104,
                'nombre' => 'TIBIRITA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '807',
                'codigo_departamento' => '25',
            ),
            5 => 
            array (
                'id' => 1105,
                'nombre' => 'TIBU',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '810',
                'codigo_departamento' => '54',
            ),
            6 => 
            array (
                'id' => 1106,
                'nombre' => 'TIERRALTA',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '807',
                'codigo_departamento' => '23',
            ),
            7 => 
            array (
                'id' => 1107,
                'nombre' => 'TIMANA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '807',
                'codigo_departamento' => '41',
            ),
            8 => 
            array (
                'id' => 1108,
                'nombre' => 'TIMBIO',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '807',
                'codigo_departamento' => '19',
            ),
            9 => 
            array (
                'id' => 1109,
                'nombre' => 'TIMBIQUI',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '809',
                'codigo_departamento' => '19',
            ),
            10 => 
            array (
                'id' => 1110,
                'nombre' => 'TINJACA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '808',
                'codigo_departamento' => '15',
            ),
            11 => 
            array (
                'id' => 1111,
                'nombre' => 'TIPACOQUE',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '810',
                'codigo_departamento' => '15',
            ),
            12 => 
            array (
                'id' => 1112,
                'nombre' => 'TIQUISIO',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '810',
                'codigo_departamento' => '13',
            ),
            13 => 
            array (
                'id' => 1113,
                'nombre' => 'TITIRIBI',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '809',
                'codigo_departamento' => '05',
            ),
            14 => 
            array (
                'id' => 1114,
                'nombre' => 'TOCA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '814',
                'codigo_departamento' => '15',
            ),
            15 => 
            array (
                'id' => 1115,
                'nombre' => 'TOCAIMA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '815',
                'codigo_departamento' => '25',
            ),
            16 => 
            array (
                'id' => 1116,
                'nombre' => 'TOCANCIPA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '817',
                'codigo_departamento' => '25',
            ),
            17 => 
            array (
                'id' => 1117,
                'nombre' => 'TOGUI',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '816',
                'codigo_departamento' => '15',
            ),
            18 => 
            array (
                'id' => 1118,
                'nombre' => 'TOLEDO',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '820',
                'codigo_departamento' => '54',
            ),
            19 => 
            array (
                'id' => 1119,
                'nombre' => 'TOLEDO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '819',
                'codigo_departamento' => '05',
            ),
            20 => 
            array (
                'id' => 1120,
                'nombre' => 'TOLU VIEJO',
                'departamento' => 'SUCRE',
                'codigo_municipio' => '823',
                'codigo_departamento' => '70',
            ),
            21 => 
            array (
                'id' => 1121,
                'nombre' => 'TONA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '820',
                'codigo_departamento' => '68',
            ),
            22 => 
            array (
                'id' => 1122,
                'nombre' => 'TOPAGA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '820',
                'codigo_departamento' => '15',
            ),
            23 => 
            array (
                'id' => 1123,
                'nombre' => 'TOPAIPI',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '823',
                'codigo_departamento' => '25',
            ),
            24 => 
            array (
                'id' => 1124,
                'nombre' => 'TORIBIO',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '821',
                'codigo_departamento' => '19',
            ),
            25 => 
            array (
                'id' => 1125,
                'nombre' => 'TORO',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '823',
                'codigo_departamento' => '76',
            ),
            26 => 
            array (
                'id' => 1126,
                'nombre' => 'TOTA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '822',
                'codigo_departamento' => '15',
            ),
            27 => 
            array (
                'id' => 1127,
                'nombre' => 'TOTORO',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '824',
                'codigo_departamento' => '19',
            ),
            28 => 
            array (
                'id' => 1128,
                'nombre' => 'TRINIDAD',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '430',
                'codigo_departamento' => '85',
            ),
            29 => 
            array (
                'id' => 1129,
                'nombre' => 'TRUJILLO',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '828',
                'codigo_departamento' => '76',
            ),
            30 => 
            array (
                'id' => 1130,
                'nombre' => 'TUBARA',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '832',
                'codigo_departamento' => '08',
            ),
            31 => 
            array (
                'id' => 1131,
                'nombre' => 'TULUA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '834',
                'codigo_departamento' => '76',
            ),
            32 => 
            array (
                'id' => 1132,
                'nombre' => 'TUNJA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '001',
                'codigo_departamento' => '15',
            ),
            33 => 
            array (
                'id' => 1133,
                'nombre' => 'TUNUNGUA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '832',
                'codigo_departamento' => '15',
            ),
            34 => 
            array (
                'id' => 1134,
                'nombre' => 'TUQUERRES',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '838',
                'codigo_departamento' => '52',
            ),
            35 => 
            array (
                'id' => 1135,
                'nombre' => 'TURBACO',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '836',
                'codigo_departamento' => '13',
            ),
            36 => 
            array (
                'id' => 1136,
                'nombre' => 'TURBANA',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '838',
                'codigo_departamento' => '13',
            ),
            37 => 
            array (
                'id' => 1137,
                'nombre' => 'TURBO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '837',
                'codigo_departamento' => '05',
            ),
            38 => 
            array (
                'id' => 1138,
                'nombre' => 'TURMEQUE',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '835',
                'codigo_departamento' => '15',
            ),
            39 => 
            array (
                'id' => 1139,
                'nombre' => 'TUTA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '837',
                'codigo_departamento' => '15',
            ),
            40 => 
            array (
                'id' => 1140,
                'nombre' => 'TUTAZA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '839',
                'codigo_departamento' => '15',
            ),
            41 => 
            array (
                'id' => 1141,
                'nombre' => 'UBALA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '839',
                'codigo_departamento' => '25',
            ),
            42 => 
            array (
                'id' => 1142,
                'nombre' => 'UBAQUE',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '841',
                'codigo_departamento' => '25',
            ),
            43 => 
            array (
                'id' => 1143,
                'nombre' => 'ULLOA',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '845',
                'codigo_departamento' => '76',
            ),
            44 => 
            array (
                'id' => 1144,
                'nombre' => 'UMBITA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '842',
                'codigo_departamento' => '15',
            ),
            45 => 
            array (
                'id' => 1145,
                'nombre' => 'UNE',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '845',
                'codigo_departamento' => '25',
            ),
            46 => 
            array (
                'id' => 1146,
                'nombre' => 'UNGUIA',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '800',
                'codigo_departamento' => '27',
            ),
            47 => 
            array (
                'id' => 1147,
                'nombre' => 'UNION PANAMERICANA',
                'departamento' => 'CHOCÓ',
                'codigo_municipio' => '810',
                'codigo_departamento' => '27',
            ),
            48 => 
            array (
                'id' => 1148,
                'nombre' => 'URAMITA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '842',
                'codigo_departamento' => '05',
            ),
            49 => 
            array (
                'id' => 1149,
                'nombre' => 'URIBE',
                'departamento' => 'META',
                'codigo_municipio' => '350',
                'codigo_departamento' => '50',
            ),
            50 => 
            array (
                'id' => 1150,
                'nombre' => 'URIBIA',
                'departamento' => 'LA GUAJIRA',
                'codigo_municipio' => '847',
                'codigo_departamento' => '44',
            ),
            51 => 
            array (
                'id' => 1151,
                'nombre' => 'URRAO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '847',
                'codigo_departamento' => '05',
            ),
            52 => 
            array (
                'id' => 1152,
                'nombre' => 'URUMITA',
                'departamento' => 'LA GUAJIRA',
                'codigo_municipio' => '855',
                'codigo_departamento' => '44',
            ),
            53 => 
            array (
                'id' => 1153,
                'nombre' => 'USIACURI',
                'departamento' => 'ATLÁNTICO',
                'codigo_municipio' => '849',
                'codigo_departamento' => '08',
            ),
            54 => 
            array (
                'id' => 1154,
                'nombre' => 'UTICA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '851',
                'codigo_departamento' => '25',
            ),
            55 => 
            array (
                'id' => 1155,
                'nombre' => 'VALDIVIA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '854',
                'codigo_departamento' => '05',
            ),
            56 => 
            array (
                'id' => 1156,
                'nombre' => 'VALENCIA',
                'departamento' => 'CÓRDOBA',
                'codigo_municipio' => '855',
                'codigo_departamento' => '23',
            ),
            57 => 
            array (
                'id' => 1157,
                'nombre' => 'VALLE DE SAN JOSE',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '855',
                'codigo_departamento' => '68',
            ),
            58 => 
            array (
                'id' => 1158,
                'nombre' => 'VALLE DE SAN JUAN',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '854',
                'codigo_departamento' => '73',
            ),
            59 => 
            array (
                'id' => 1159,
                'nombre' => 'VALLE DEL GUAMUEZ',
                'departamento' => 'PUTUMAYO',
                'codigo_municipio' => '865',
                'codigo_departamento' => '86',
            ),
            60 => 
            array (
                'id' => 1160,
                'nombre' => 'VALPARAISO',
                'departamento' => 'CAQUETÁ',
                'codigo_municipio' => '860',
                'codigo_departamento' => '18',
            ),
            61 => 
            array (
                'id' => 1161,
                'nombre' => 'VALPARAISO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '856',
                'codigo_departamento' => '05',
            ),
            62 => 
            array (
                'id' => 1162,
                'nombre' => 'VEGACHI',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '858',
                'codigo_departamento' => '05',
            ),
            63 => 
            array (
                'id' => 1163,
                'nombre' => 'VELEZ',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '861',
                'codigo_departamento' => '68',
            ),
            64 => 
            array (
                'id' => 1164,
                'nombre' => 'VENADILLO',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '861',
                'codigo_departamento' => '73',
            ),
            65 => 
            array (
                'id' => 1165,
                'nombre' => 'VENECIA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '506',
                'codigo_departamento' => '25',
            ),
            66 => 
            array (
                'id' => 1166,
                'nombre' => 'VENECIA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '861',
                'codigo_departamento' => '05',
            ),
            67 => 
            array (
                'id' => 1167,
                'nombre' => 'VENTAQUEMADA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '861',
                'codigo_departamento' => '15',
            ),
            68 => 
            array (
                'id' => 1168,
                'nombre' => 'VERGARA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '862',
                'codigo_departamento' => '25',
            ),
            69 => 
            array (
                'id' => 1169,
                'nombre' => 'VERSALLES',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '863',
                'codigo_departamento' => '76',
            ),
            70 => 
            array (
                'id' => 1170,
                'nombre' => 'VETAS',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '867',
                'codigo_departamento' => '68',
            ),
            71 => 
            array (
                'id' => 1171,
                'nombre' => 'VIANI',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '867',
                'codigo_departamento' => '25',
            ),
            72 => 
            array (
                'id' => 1172,
                'nombre' => 'VICTORIA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '867',
                'codigo_departamento' => '17',
            ),
            73 => 
            array (
                'id' => 1173,
                'nombre' => 'VIGIA DEL FUERTE',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '873',
                'codigo_departamento' => '05',
            ),
            74 => 
            array (
                'id' => 1174,
                'nombre' => 'VIJES',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '869',
                'codigo_departamento' => '76',
            ),
            75 => 
            array (
                'id' => 1175,
                'nombre' => 'VILLA CARO',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '871',
                'codigo_departamento' => '54',
            ),
            76 => 
            array (
                'id' => 1176,
                'nombre' => 'VILLA DE LEYVA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '407',
                'codigo_departamento' => '15',
            ),
            77 => 
            array (
                'id' => 1177,
                'nombre' => 'VILLA DE SAN DIEGO DE UBATE',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '843',
                'codigo_departamento' => '25',
            ),
            78 => 
            array (
                'id' => 1178,
                'nombre' => 'VILLA DEL ROSARIO',
                'departamento' => 'NORTE DE SANTANDER',
                'codigo_municipio' => '874',
                'codigo_departamento' => '54',
            ),
            79 => 
            array (
                'id' => 1179,
                'nombre' => 'VILLA RICA',
                'departamento' => 'CAUCA',
                'codigo_municipio' => '845',
                'codigo_departamento' => '19',
            ),
            80 => 
            array (
                'id' => 1180,
                'nombre' => 'VILLAGARZON',
                'departamento' => 'PUTUMAYO',
                'codigo_municipio' => '885',
                'codigo_departamento' => '86',
            ),
            81 => 
            array (
                'id' => 1181,
                'nombre' => 'VILLAGOMEZ',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '871',
                'codigo_departamento' => '25',
            ),
            82 => 
            array (
                'id' => 1182,
                'nombre' => 'VILLAHERMOSA',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '870',
                'codigo_departamento' => '73',
            ),
            83 => 
            array (
                'id' => 1183,
                'nombre' => 'VILLAMARIA',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '873',
                'codigo_departamento' => '17',
            ),
            84 => 
            array (
                'id' => 1184,
                'nombre' => 'VILLANUEVA',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '440',
                'codigo_departamento' => '85',
            ),
            85 => 
            array (
                'id' => 1185,
                'nombre' => 'VILLANUEVA',
                'departamento' => 'LA GUAJIRA',
                'codigo_municipio' => '874',
                'codigo_departamento' => '44',
            ),
            86 => 
            array (
                'id' => 1186,
                'nombre' => 'VILLANUEVA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '872',
                'codigo_departamento' => '68',
            ),
            87 => 
            array (
                'id' => 1187,
                'nombre' => 'VILLANUEVA',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '873',
                'codigo_departamento' => '13',
            ),
            88 => 
            array (
                'id' => 1188,
                'nombre' => 'VILLAPINZON',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '873',
                'codigo_departamento' => '25',
            ),
            89 => 
            array (
                'id' => 1189,
                'nombre' => 'VILLARRICA',
                'departamento' => 'TOLIMA',
                'codigo_municipio' => '873',
                'codigo_departamento' => '73',
            ),
            90 => 
            array (
                'id' => 1190,
                'nombre' => 'VILLAVICENCIO',
                'departamento' => 'META',
                'codigo_municipio' => '001',
                'codigo_departamento' => '50',
            ),
            91 => 
            array (
                'id' => 1191,
                'nombre' => 'VILLAVIEJA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '872',
                'codigo_departamento' => '41',
            ),
            92 => 
            array (
                'id' => 1192,
                'nombre' => 'VILLETA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '875',
                'codigo_departamento' => '25',
            ),
            93 => 
            array (
                'id' => 1193,
                'nombre' => 'VIOTA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '878',
                'codigo_departamento' => '25',
            ),
            94 => 
            array (
                'id' => 1194,
                'nombre' => 'VIRACACHA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '879',
                'codigo_departamento' => '15',
            ),
            95 => 
            array (
                'id' => 1195,
                'nombre' => 'VISTAHERMOSA',
                'departamento' => 'META',
                'codigo_municipio' => '711',
                'codigo_departamento' => '50',
            ),
            96 => 
            array (
                'id' => 1196,
                'nombre' => 'VITERBO',
                'departamento' => 'CALDAS',
                'codigo_municipio' => '877',
                'codigo_departamento' => '17',
            ),
            97 => 
            array (
                'id' => 1197,
                'nombre' => 'YACOPI',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '885',
                'codigo_departamento' => '25',
            ),
            98 => 
            array (
                'id' => 1198,
                'nombre' => 'YACUANQUER',
                'departamento' => 'NARIÑO',
                'codigo_municipio' => '885',
                'codigo_departamento' => '52',
            ),
            99 => 
            array (
                'id' => 1199,
                'nombre' => 'YAGUARA',
                'departamento' => 'HUILA',
                'codigo_municipio' => '885',
                'codigo_departamento' => '41',
            ),
            100 => 
            array (
                'id' => 1200,
                'nombre' => 'YALI',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '885',
                'codigo_departamento' => '05',
            ),
            101 => 
            array (
                'id' => 1201,
                'nombre' => 'YARUMAL',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '887',
                'codigo_departamento' => '05',
            ),
            102 => 
            array (
                'id' => 1202,
                'nombre' => 'YAVARATE',
                'departamento' => 'VAUPÉS',
                'codigo_municipio' => '889',
                'codigo_departamento' => '97',
            ),
            103 => 
            array (
                'id' => 1203,
                'nombre' => 'YOLOMBO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '890',
                'codigo_departamento' => '05',
            ),
            104 => 
            array (
                'id' => 1204,
                'nombre' => 'YONDO',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '893',
                'codigo_departamento' => '05',
            ),
            105 => 
            array (
                'id' => 1205,
                'nombre' => 'YOPAL',
                'departamento' => 'CASANARE',
                'codigo_municipio' => '001',
                'codigo_departamento' => '85',
            ),
            106 => 
            array (
                'id' => 1206,
                'nombre' => 'YOTOCO',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '890',
                'codigo_departamento' => '76',
            ),
            107 => 
            array (
                'id' => 1207,
                'nombre' => 'YUMBO',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '892',
                'codigo_departamento' => '76',
            ),
            108 => 
            array (
                'id' => 1208,
                'nombre' => 'ZAMBRANOV',
                'departamento' => 'BOLÍVAR',
                'codigo_municipio' => '894',
                'codigo_departamento' => '13',
            ),
            109 => 
            array (
                'id' => 1209,
                'nombre' => 'ZAPATOCA',
                'departamento' => 'SANTANDER',
                'codigo_municipio' => '895',
                'codigo_departamento' => '68',
            ),
            110 => 
            array (
                'id' => 1210,
                'nombre' => 'ZAPAYAN',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '960',
                'codigo_departamento' => '47',
            ),
            111 => 
            array (
                'id' => 1211,
                'nombre' => 'ZARAGOZA',
                'departamento' => 'ANTIOQUIA',
                'codigo_municipio' => '895',
                'codigo_departamento' => '05',
            ),
            112 => 
            array (
                'id' => 1212,
                'nombre' => 'ZARZAL',
                'departamento' => 'VALLE DEL CAUCA',
                'codigo_municipio' => '895',
                'codigo_departamento' => '76',
            ),
            113 => 
            array (
                'id' => 1213,
                'nombre' => 'ZETAQUIRA',
                'departamento' => 'BOYACÁ',
                'codigo_municipio' => '897',
                'codigo_departamento' => '15',
            ),
            114 => 
            array (
                'id' => 1214,
                'nombre' => 'ZIPACON',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '898',
                'codigo_departamento' => '25',
            ),
            115 => 
            array (
                'id' => 1215,
                'nombre' => 'ZIPAQUIRA',
                'departamento' => 'CUNDINAMARCA',
                'codigo_municipio' => '899',
                'codigo_departamento' => '25',
            ),
            116 => 
            array (
                'id' => 1216,
                'nombre' => 'ZONA BANANERA',
                'departamento' => 'MAGDALENA',
                'codigo_municipio' => '980',
                'codigo_departamento' => '47',
            ),
        ));
        
        
    }
}
