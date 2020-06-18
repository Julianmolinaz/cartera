<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
            'category' => 'Solicitud',
            'name' => 'solicitud_edit',
            'display_name' => 'Editar solicitud',
            'description' => 'Permite editar una solicitud en su totalidad',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 2,
            'category' => 'Solicitud',
            'name' => 'solicitud_index',
            'display_name' => 'Listar Solicitudes',
            'description' => 'Permite consultar el listado de  solicitudes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 3,
            'category' => 'Credito',
            'name' => 'credito_create',
            'display_name' => 'Crear credito',
            'description' => 'Permite crear una credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
