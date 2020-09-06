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
            'name' => 'administrador',
            'display_name' => 'Administrador',
            'description' => 'Rol de administrador empresarial para labores de gestion'
        ]);
        

        \DB::table('roles')->insert([
            'id' => '3',
            'name' => 'asesor',
            'display_name' => 'Asesor',
            'description' => 'Rol de ejecutivos de cuenta'
        ]);
        

        \DB::table('roles')->insert([
            'id' => '4',
            'name' => 'analista',
            'display_name' => 'Analista',
            'description' => 'Rol de analistas de cartera'
        ]);

        \DB::table('roles')->insert([
            'id' => '5',
            'name' => 'callcenter',
            'display_name' => 'Call Center',
            'description' => 'Rol de call center'
        ]);

        \DB::table('roles')->insert([
            'id' => '6',
            'name' => 'cartera',
            'display_name' => 'Cartera',
            'description' => 'Rol de cartera'
        ]);

        \DB::table('roles')->insert([
            'id' => '7',
            'name' => 'coordinador',
            'display_name' => 'Coordinador',
            'description' => 'Rol de coordinador'
        ]);
    }
}
