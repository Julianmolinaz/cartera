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


        \DB::table('permissions')->insert([
            'id' => 2,
            'name' => 'cliente_show',
            'display_name' => 'Ver cliente',
            'description' => 'Permite ver la información del cliente y su conyuge'
        ]);


        \DB::table('permissions')->insert([
            'id' => 2,
            'name' => 'cliente_create',
            'display_name' => 'Craer cliente',
            'description' => 'Permite crear un cliente y su respectivo conyuge'
        ]);


        \DB::table('permissions')->insert([
            'id' => 2,
            'name' => 'cliente_update',
            'display_name' => 'Craer cliente',
            'description' => 'Permite actualizar la información del cliente y/o el conyuge'
        ]);
        

        \DB::table('permissions')->insert([
            'id' => 2,
            'name' => 'cliente_delete',
            'display_name' => 'Borrar cliente',
            'description' => 'Permite borrar la información del cliente y/o el conyuge'
        ]);
        
    }
}
