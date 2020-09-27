<?php

use Illuminate\Database\Seeder;

class MensajesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // CONFIGURACION

        \DB::table('mensajes')->delete();
        
        \DB::table('mensajes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'MSS111',
                'estado' => '1',
                'mensaje' => 'INVERSIONES GORA SAS le informa que el crédito solicitado por usted ha sido aprobado. Cualquier inquietud comunicarse al Tel: 3104442464',
                'user_create_id' => 1,
                'user_update_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'MSS222',
                'estado' => '',
            'mensaje' => 'INVERSIONES GORA SAS le informa que su crédito presenta una mora de cinco (5) dias, lo invitamos a que pueda normalizar su obligación. Cualquier inquietud comunicarse al Tel: 3104450956 o visitenos a www.inversionesgora.com',
                'user_create_id' => 1,
                'user_update_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'MSS333',
                'estado' => '',
            'mensaje' => 'INVERSIONES GORA SAS le informa que su crédito presenta una mora de veinte (20) dias, lo invitamos a que pueda normalizar su obligación y evite reportes negativos en las centrales de riesgo. Cualquier inquietud comunicarse al Tel: 3104450956',
                'user_create_id' => 1,
                'user_update_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'MSS444',
                'estado' => '1',
                'mensaje' => 'INVERSIONES GORA SAS le informa que su crédito pasó a estado prejurídico, lo invitamos a que se presenta al punto mas cercano y pueda normalizar su obligación, evite costos jurídicos. Cualquier inquietud comunicarse al Tel: 3104450956',
                'user_create_id' => 1,
                'user_update_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'MSS555',
                'estado' => '1',
                'mensaje' => 'INVERSIONES GORA SAS le informa que su crédito pasó a estado Jurídico, lo invitamos a que de manera URGENTE se presenta al punto mas cercano, pregunte por el estado de su cuenta y evite costos jurídicos. Cualquier inquietud comunicarse al Tel: 3104450956',
                'user_create_id' => 1,
                'user_update_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'MSS666',
                'estado' => '1',
                'mensaje' => 'INVERSIONES GORA SAS le desea un feliz cumpleaños terminar.....',
                'user_create_id' => 1,
                'user_update_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
