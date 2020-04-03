<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->delete();

        \DB::table('roles')->insert([
            'id' => '1',
            'name' => 'superadmin',
            'display_name' => 'Super Administrador',
            'description' => 'Rol de administrador del sistema, solo para alguien con conocimiento técnico del software'
        ]);


        \DB::table('roles')->insert([
            'id' => '2',
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'Rol de administrador empresarial para labores de gestion'
        ]);
        

        \DB::table('roles')->insert([
            'id' => '3',
            'name' => 'asesor',
            'display_name' => 'Asesor',
            'description' => 'Rol de ejecutivos de cuenta'
        ]);
    }
}
