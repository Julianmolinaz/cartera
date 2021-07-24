<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Sistema',
                'estado' => 'Activo',
                'rol' => 'Administrador',
                'rol_id' => 1,
                'email' => 'sistema@mail.com',
                'password' => '123',
                'punto_id' => 1,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'num_cuenta' => NULL,
                'banco_id' => NULL,
            ],
            [
                'id' => 2,
                'name' => 'PABLO ADRIAN GONZALEZ SALAZAR',
                'estado' => 'Activo',
                'rol' => 'Administrador',
                'rol_id' => 1,
                'email' => 'etereosum@gmail.com',
                'password' => '$2y$10$VEgiD/5dwKBKia0KT2jTsuB0kTuQSEtG6KflLSfC6gOPeOZ.6TJru',
                'punto_id' => 1,
                'remember_token' => 'uErIt3aU3Cf6FfWOgyhF6aBPRzlIMTocIl27GpeJaRszlzpbqVudEe0ITZqa',
                'created_at' => '2017-04-06 04:01:27',
                'updated_at' => '2020-10-26 10:34:13',
                'num_cuenta' => '',
                'banco_id' => NULL,
            ]
        ]);
    }

}