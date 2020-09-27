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
                'display_name' => 'Super Administrador',
                'description' => 'Rol de administrador del sistema, solo para alguien con conocimiento técnico del software',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'administrador',
                'display_name' => 'administrador',
                'description' => 'Rol de administrador empresarial para labores de gestion',
                'created_at' => NULL,
                'updated_at' => '2020-09-10 18:08:42',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'asesor',
                'display_name' => 'asesor',
                'description' => 'Rol de ejecutivos de cuenta',
                'created_at' => NULL,
                'updated_at' => '2020-09-11 09:14:38',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'analista',
                'display_name' => 'Analista',
                'description' => 'Rol de analistas de cartera',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'callcenter',
                'display_name' => 'callcenter',
                'description' => 'Rol de call center',
                'created_at' => NULL,
                'updated_at' => '2020-09-11 10:10:30',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'cartera',
                'display_name' => 'Cartera',
                'description' => 'Rol de cartera',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'coordinador',
                'display_name' => 'Coordinador',
                'description' => 'Rol de coordinador',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
