<?php

use Illuminate\Database\Seeder;

class RefProductosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ref_productos')->delete();
        
        \DB::table('ref_productos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'R.T.M',
                'expedido_a' => 'Cliente',
                'estado' => 'En proceso',
                'fecha_exp' => '2020-11-01',
                'costo' => 400000.0,
                'iva' => 1250.0,
                'num_fact' => '56454445',
                'otros' => 10000.0,
                'observaciones' => '',
                'qty' => 1,
                'vehiculo_id' => 1,
                'producto_id' => 1,
                'proveedor_id' => 45,
                'precredito_id' => 2,
                'created_by' => 2,
                'updated_by' => NULL,
                'created_at' => '2020-11-10 15:09:18',
                'updated_at' => '2020-11-10 15:09:18',
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'R.T.M',
                'expedido_a' => 'Cliente',
                'estado' => 'En proceso',
                'fecha_exp' => '2000-01-01',
                'costo' => 250000.0,
                'iva' => 12000.0,
                'num_fact' => '125454',
                'otros' => 5000.0,
                'observaciones' => '',
                'qty' => 1,
                'vehiculo_id' => 2,
                'producto_id' => 1,
                'proveedor_id' => 49,
                'precredito_id' => 3,
                'created_by' => 2,
                'updated_by' => NULL,
                'created_at' => '2020-11-10 15:12:30',
                'updated_at' => '2020-11-10 15:12:30',
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'SOAT',
                'expedido_a' => 'Gora',
                'estado' => 'En proceso',
                'fecha_exp' => '2020-11-10',
                'costo' => 260000.0,
                'iva' => 5000.0,
                'num_fact' => '21212114',
                'otros' => 10000.0,
                'observaciones' => '',
                'qty' => 1,
                'vehiculo_id' => 3,
                'producto_id' => 3,
                'proveedor_id' => 42,
                'precredito_id' => 4,
                'created_by' => 2,
                'updated_by' => NULL,
                'created_at' => '2020-11-10 15:15:17',
                'updated_at' => '2020-11-10 15:15:17',
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'R.T.M',
                'expedido_a' => 'Gora',
                'estado' => 'En proceso',
                'fecha_exp' => '2020-11-05',
                'costo' => 600000.0,
                'iva' => 6520.0,
                'num_fact' => '654544',
                'otros' => 10000.0,
                'observaciones' => '',
                'qty' => 1,
                'vehiculo_id' => 4,
                'producto_id' => 3,
                'proveedor_id' => 13,
                'precredito_id' => 4,
                'created_by' => 2,
                'updated_by' => NULL,
                'created_at' => '2020-11-10 15:15:17',
                'updated_at' => '2020-11-10 15:15:17',
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'R.T.M',
                'expedido_a' => 'Cliente',
                'estado' => 'En proceso',
                'fecha_exp' => '2020-11-01',
                'costo' => 300000.0,
                'iva' => 2630.0,
                'num_fact' => '32145454',
                'otros' => 10000.0,
                'observaciones' => '',
                'qty' => 1,
                'vehiculo_id' => 5,
                'producto_id' => 1,
                'proveedor_id' => 14,
                'precredito_id' => 5,
                'created_by' => 2,
                'updated_by' => NULL,
                'created_at' => '2020-11-10 15:25:39',
                'updated_at' => '2020-11-10 15:25:39',
            ),
        ));
        
        
    }
}
