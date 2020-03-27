<?php

use Illuminate\Database\Seeder;

class ZonasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('zonas')->delete();
        
        \DB::table('zonas')->insert(array (
            0 => 
            array (
                'id' => 0,
                'nombre' => 'Pereira',
                'descripcion' => '',
                'user_create_id' => 2,
                'user_update_id' => NULL,
                'created_at' => '2019-07-24 16:26:32',
                'updated_at' => '2019-07-24 16:26:32',
            ),
        ));
        
        
    }
}
