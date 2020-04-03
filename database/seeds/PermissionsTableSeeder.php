<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert([
            'id' => 1,
            'name' => 'solicitud_edit',
            'display_name' => 'Editar Solicitud',
            'description' => 'Permite editar una solicitud en su totalidad'
        ]);
    }
}
