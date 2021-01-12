<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'superadmin',
                'display_name' => 'superadmin',
                'description' => 'Rol de administrador del sistema, solo para alguien con conocimiento tcnico del software',
                'created_at' => NULL,
                'updated_at' => '2020-09-28 10:31:34',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'administrador',
                'display_name' => 'administrador',
                'description' => 'Rol de administrador empresarial para labores de gestion',
                'created_at' => NULL,
                'updated_at' => '2020-09-28 09:58:05',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'asesor',
                'display_name' => 'asesor',
                'description' => 'Rol de ejecutivos de cuenta',
                'created_at' => NULL,
                'updated_at' => '2020-09-28 08:40:48',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'analista',
                'display_name' => 'analista',
                'description' => 'Rol de analistas de aprobaciones',
                'created_at' => NULL,
                'updated_at' => '2020-09-28 08:12:12',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'callcenter',
                'display_name' => 'callcenter',
                'description' => 'Rol de call center',
                'created_at' => NULL,
                'updated_at' => '2020-09-28 09:06:55',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'cartera',
                'display_name' => 'cartera',
                'description' => 'Rol de cartera',
                'created_at' => NULL,
                'updated_at' => '2020-09-28 09:39:00',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'coordinador',
                'display_name' => 'coordinador',
                'description' => 'Rol de coordinador',
                'created_at' => NULL,
                'updated_at' => '2020-10-07 12:05:08',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Freelance',
                'display_name' => 'Freelance',
                'description' => 'Asesor externo',
                'created_at' => '2020-09-27 21:05:51',
                'updated_at' => '2020-09-27 21:05:51',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Invitado',
                'display_name' => 'Invitado',
                'description' => 'Rol para personas que solo consultan',
                'created_at' => '2020-09-28 08:29:52',
                'updated_at' => '2020-09-28 08:29:52',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Auxiliar_contable',
                'display_name' => 'Auxiliar_contable',
                'description' => 'Rol de Auxiliar contable',
                'created_at' => '2020-09-28 13:45:36',
                'updated_at' => '2020-09-28 14:10:49',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Director_Cartera',
                'display_name' => 'Director_Cartera',
                'description' => 'Funciones administrativas de Cartera',
                'created_at' => '2020-10-03 10:41:51',
                'updated_at' => '2020-10-03 11:57:02',
            ),
        ));
        
        
    }
}
