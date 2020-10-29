<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_user')->delete();
        
        \DB::table('role_user')->insert(array (
            0 => 
            array (
                'user_id' => 1,
                'role_id' => 1,
            ),
            1 => 
            array (
                'user_id' => 2,
                'role_id' => 1,
            ),
            2 => 
            array (
                'user_id' => 98,
                'role_id' => 1,
            ),
            3 => 
            array (
                'user_id' => 2,
                'role_id' => 2,
            ),
            4 => 
            array (
                'user_id' => 8,
                'role_id' => 2,
            ),
            5 => 
            array (
                'user_id' => 10,
                'role_id' => 2,
            ),
            6 => 
            array (
                'user_id' => 101,
                'role_id' => 2,
            ),
            7 => 
            array (
                'user_id' => 104,
                'role_id' => 2,
            ),
            8 => 
            array (
                'user_id' => 150,
                'role_id' => 2,
            ),
            9 => 
            array (
                'user_id' => 202,
                'role_id' => 2,
            ),
            10 => 
            array (
                'user_id' => 228,
                'role_id' => 2,
            ),
            11 => 
            array (
                'user_id' => 17,
                'role_id' => 3,
            ),
            12 => 
            array (
                'user_id' => 20,
                'role_id' => 3,
            ),
            13 => 
            array (
                'user_id' => 33,
                'role_id' => 3,
            ),
            14 => 
            array (
                'user_id' => 63,
                'role_id' => 3,
            ),
            15 => 
            array (
                'user_id' => 68,
                'role_id' => 3,
            ),
            16 => 
            array (
                'user_id' => 73,
                'role_id' => 3,
            ),
            17 => 
            array (
                'user_id' => 74,
                'role_id' => 3,
            ),
            18 => 
            array (
                'user_id' => 77,
                'role_id' => 3,
            ),
            19 => 
            array (
                'user_id' => 87,
                'role_id' => 3,
            ),
            20 => 
            array (
                'user_id' => 88,
                'role_id' => 3,
            ),
            21 => 
            array (
                'user_id' => 89,
                'role_id' => 3,
            ),
            22 => 
            array (
                'user_id' => 90,
                'role_id' => 3,
            ),
            23 => 
            array (
                'user_id' => 121,
                'role_id' => 3,
            ),
            24 => 
            array (
                'user_id' => 122,
                'role_id' => 3,
            ),
            25 => 
            array (
                'user_id' => 133,
                'role_id' => 3,
            ),
            26 => 
            array (
                'user_id' => 138,
                'role_id' => 3,
            ),
            27 => 
            array (
                'user_id' => 139,
                'role_id' => 3,
            ),
            28 => 
            array (
                'user_id' => 147,
                'role_id' => 3,
            ),
            29 => 
            array (
                'user_id' => 152,
                'role_id' => 3,
            ),
            30 => 
            array (
                'user_id' => 153,
                'role_id' => 3,
            ),
            31 => 
            array (
                'user_id' => 155,
                'role_id' => 3,
            ),
            32 => 
            array (
                'user_id' => 156,
                'role_id' => 3,
            ),
            33 => 
            array (
                'user_id' => 159,
                'role_id' => 3,
            ),
            34 => 
            array (
                'user_id' => 160,
                'role_id' => 3,
            ),
            35 => 
            array (
                'user_id' => 163,
                'role_id' => 3,
            ),
            36 => 
            array (
                'user_id' => 166,
                'role_id' => 3,
            ),
            37 => 
            array (
                'user_id' => 167,
                'role_id' => 3,
            ),
            38 => 
            array (
                'user_id' => 172,
                'role_id' => 3,
            ),
            39 => 
            array (
                'user_id' => 177,
                'role_id' => 3,
            ),
            40 => 
            array (
                'user_id' => 180,
                'role_id' => 3,
            ),
            41 => 
            array (
                'user_id' => 188,
                'role_id' => 3,
            ),
            42 => 
            array (
                'user_id' => 189,
                'role_id' => 3,
            ),
            43 => 
            array (
                'user_id' => 191,
                'role_id' => 3,
            ),
            44 => 
            array (
                'user_id' => 194,
                'role_id' => 3,
            ),
            45 => 
            array (
                'user_id' => 196,
                'role_id' => 3,
            ),
            46 => 
            array (
                'user_id' => 198,
                'role_id' => 3,
            ),
            47 => 
            array (
                'user_id' => 200,
                'role_id' => 3,
            ),
            48 => 
            array (
                'user_id' => 201,
                'role_id' => 3,
            ),
            49 => 
            array (
                'user_id' => 203,
                'role_id' => 3,
            ),
            50 => 
            array (
                'user_id' => 204,
                'role_id' => 3,
            ),
            51 => 
            array (
                'user_id' => 205,
                'role_id' => 3,
            ),
            52 => 
            array (
                'user_id' => 206,
                'role_id' => 3,
            ),
            53 => 
            array (
                'user_id' => 207,
                'role_id' => 3,
            ),
            54 => 
            array (
                'user_id' => 208,
                'role_id' => 3,
            ),
            55 => 
            array (
                'user_id' => 209,
                'role_id' => 3,
            ),
            56 => 
            array (
                'user_id' => 210,
                'role_id' => 3,
            ),
            57 => 
            array (
                'user_id' => 211,
                'role_id' => 3,
            ),
            58 => 
            array (
                'user_id' => 212,
                'role_id' => 3,
            ),
            59 => 
            array (
                'user_id' => 213,
                'role_id' => 3,
            ),
            60 => 
            array (
                'user_id' => 215,
                'role_id' => 3,
            ),
            61 => 
            array (
                'user_id' => 216,
                'role_id' => 3,
            ),
            62 => 
            array (
                'user_id' => 217,
                'role_id' => 3,
            ),
            63 => 
            array (
                'user_id' => 218,
                'role_id' => 3,
            ),
            64 => 
            array (
                'user_id' => 219,
                'role_id' => 3,
            ),
            65 => 
            array (
                'user_id' => 220,
                'role_id' => 3,
            ),
            66 => 
            array (
                'user_id' => 221,
                'role_id' => 3,
            ),
            67 => 
            array (
                'user_id' => 222,
                'role_id' => 3,
            ),
            68 => 
            array (
                'user_id' => 223,
                'role_id' => 3,
            ),
            69 => 
            array (
                'user_id' => 224,
                'role_id' => 3,
            ),
            70 => 
            array (
                'user_id' => 225,
                'role_id' => 3,
            ),
            71 => 
            array (
                'user_id' => 229,
                'role_id' => 3,
            ),
            72 => 
            array (
                'user_id' => 230,
                'role_id' => 3,
            ),
            73 => 
            array (
                'user_id' => 231,
                'role_id' => 3,
            ),
            74 => 
            array (
                'user_id' => 232,
                'role_id' => 3,
            ),
            75 => 
            array (
                'user_id' => 233,
                'role_id' => 3,
            ),
            76 => 
            array (
                'user_id' => 234,
                'role_id' => 3,
            ),
            77 => 
            array (
                'user_id' => 235,
                'role_id' => 3,
            ),
            78 => 
            array (
                'user_id' => 238,
                'role_id' => 3,
            ),
            79 => 
            array (
                'user_id' => 239,
                'role_id' => 3,
            ),
            80 => 
            array (
                'user_id' => 240,
                'role_id' => 3,
            ),
            81 => 
            array (
                'user_id' => 241,
                'role_id' => 3,
            ),
            82 => 
            array (
                'user_id' => 242,
                'role_id' => 3,
            ),
            83 => 
            array (
                'user_id' => 243,
                'role_id' => 3,
            ),
            84 => 
            array (
                'user_id' => 244,
                'role_id' => 3,
            ),
            85 => 
            array (
                'user_id' => 245,
                'role_id' => 3,
            ),
            86 => 
            array (
                'user_id' => 246,
                'role_id' => 3,
            ),
            87 => 
            array (
                'user_id' => 247,
                'role_id' => 3,
            ),
            88 => 
            array (
                'user_id' => 97,
                'role_id' => 4,
            ),
            89 => 
            array (
                'user_id' => 214,
                'role_id' => 4,
            ),
            90 => 
            array (
                'user_id' => 168,
                'role_id' => 5,
            ),
            91 => 
            array (
                'user_id' => 226,
                'role_id' => 6,
            ),
            92 => 
            array (
                'user_id' => 34,
                'role_id' => 7,
            ),
            93 => 
            array (
                'user_id' => 190,
                'role_id' => 7,
            ),
            94 => 
            array (
                'user_id' => 236,
                'role_id' => 7,
            ),
            95 => 
            array (
                'user_id' => 70,
                'role_id' => 9,
            ),
            96 => 
            array (
                'user_id' => 227,
                'role_id' => 10,
            ),
            97 => 
            array (
                'user_id' => 118,
                'role_id' => 11,
            ),
            98 => 
            array (
                'user_id' => 237,
                'role_id' => 11,
            ),
        ));
        
        
    }
}
