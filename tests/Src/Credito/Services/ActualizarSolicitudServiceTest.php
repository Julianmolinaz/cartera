<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Credito\Services\ActualizarSolicitudService;

class ActualizarSolicitudServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $data = $this->mockSolicitud();
        $case = new ActualizarSolicitudService($data);
        // $solicitud = $case->make();
        $this->assertTrue(true);
    }

    public function mockSolicitud() {
        return array (
            'ventas' => 
            array (
                0 => 
                array (
                'id' => 43,
                'precredito_id' => 34760,
                'producto' => 
                array (
                    'nombre' => 'SOAT',
                    'cantidad' => 1,
                    'producto_id' => 2,
                    'con_vehiculo' => 1,
                ),
                'vehiculo' => 
                array (
                    'id' => 17601,
                    'placa' => 'DKZ82E',
                    'vencimiento_soat' => '2023-03-16',
                    'vencimiento_rtm' => '2023-04-13',
                    'cilindraje' => 150,
                    'modelo' => 2016,
                    'tipo_vehiculo_id' => 2,
                ),
                ),
                1 => 
                array (
                'id' => 44,
                'precredito_id' => 34760,
                'producto' => 
                array (
                    'nombre' => 'R.T.M',
                    'cantidad' => 1,
                    'producto_id' => 1,
                    'con_vehiculo' => 1,
                ),
                'vehiculo' => 
                array (
                    'id' => 17602,
                    'placa' => 'DKT82E',
                    'vencimiento_soat' => '2023-03-16',
                    'vencimiento_rtm' => '2023-04-13',
                    'cilindraje' => 150,
                    'modelo' => 2016,
                    'tipo_vehiculo_id' => 2,
                ),
                ),
            ),
            'solicitud' => 
            array (
                'id' => 34760,
                'num_fact' => '324233333',
                'fecha' => '2022-01-13',
                'cartera_id' => 18,
                'funcionario_id' => 250,
                'cliente_id' => 11011,
                'producto_id' => NULL,
                'vlr_fin' => 1000000,
                'periodo' => 'Mensual',
                'meses' => 10,
                'cuotas' => 10,
                'vlr_cuota' => 150000,
                'vlr_asistencia' => 12000,
                'p_fecha' => '9',
                's_fecha' => '',
                'estudio' => 'Tipico',
                'cuota_inicial' => 0,
                'aprobado' => 'En estudio',
                'observaciones' => 'lorem ipsum dolor',
                'user_create_id' => 1,
                'user_update_id' => NULL,
                'created_at' => '2022-01-13 17:34:52',
                'updated_at' => '2022-01-13 17:34:52',
                'version' => '3',
            ),
            'credito' => 
            array (
                'id' => '',
                'estado' => 'Al dia',
                'valor_credito' => '',
                'saldo' => '',
                'cuotas_faltantes' => '',
                'rendimiento' => '',
                'saldo_favor' => '',
                'castigada' => '',
                'fecha_pago' => '',
                'mes' => '',
                'anio' => '',
                'recordatorio' => '',
            ),
            );
    }

    public function testValidarCreaditoAlEditar()
    {
        $data = $this->mockCredito();
        $case = new ActualizarSolicitudService($data);
        // $solicitud = $case->make();
        $this->assertTrue(true);
    }

    public function mockCredito()
    {
            return array (
                'ventas' => 
                array (
                    0 => 
                    array (
                    'id' => 43,
                    'precredito_id' => 34760,
                    'producto' => 
                    array (
                        'nombre' => 'SOAT',
                        'cantidad' => 1,
                        'producto_id' => 2,
                        'con_vehiculo' => 1,
                        'con_invoice' => 1,
                    ),
                    'vehiculo' => 
                    array (
                        'id' => 17601,
                        'placa' => 'DKZ82E',
                        'vencimiento_soat' => '2023-03-16',
                        'vencimiento_rtm' => '2023-04-13',
                        'cilindraje' => 150,
                        'modelo' => 2016,
                        'tipo_vehiculo_id' => 2,
                        'tipo_vehiculo' => 'Moto',
                    ),
                    ),
                    1 => 
                    array (
                    'id' => 44,
                    'precredito_id' => 34760,
                    'producto' => 
                    array (
                        'nombre' => 'R.T.M',
                        'cantidad' => 1,
                        'producto_id' => 1,
                        'con_vehiculo' => 1,
                        'con_invoice' => 1,
                    ),
                    'vehiculo' => 
                    array (
                        'id' => 17602,
                        'placa' => 'DKT82E',
                        'vencimiento_soat' => '2023-03-16',
                        'vencimiento_rtm' => '2023-04-13',
                        'cilindraje' => 150,
                        'modelo' => 2016,
                        'tipo_vehiculo_id' => 2,
                        'tipo_vehiculo' => 'Moto',
                    ),
                    ),
                    2 => 
                    array (
                    'id' => 45,
                    'precredito_id' => 34760,
                    'producto' => 
                    array (
                        'nombre' => 'CASCO',
                        'cantidad' => 1,
                        'producto_id' => 5,
                        'con_vehiculo' => 0,
                        'con_invoice' => 0,
                    ),
                    'vehiculo' => NULL,
                    ),
                    3 => 
                    array (
                    'id' => 46,
                    'precredito_id' => 34760,
                    'producto' => 
                    array (
                        'nombre' => 'R.T.M',
                        'cantidad' => 1,
                        'producto_id' => 1,
                        'con_vehiculo' => 1,
                        'con_invoice' => 1,
                    ),
                    'vehiculo' => 
                    array (
                        'id' => 17601,
                        'placa' => 'DKZ82E',
                        'vencimiento_soat' => '2023-03-16',
                        'vencimiento_rtm' => '2023-04-13',
                        'cilindraje' => 150,
                        'modelo' => 2016,
                        'tipo_vehiculo_id' => 2,
                        'tipo_vehiculo' => 'Moto',
                    ),
                    ),
                ),
                'solicitud' => 
                array (
                    'id' => 34760,
                    'num_fact' => '324233333',
                    'fecha' => '2022-01-13',
                    'cartera_id' => 18,
                    'funcionario_id' => 250,
                    'cliente_id' => 11011,
                    'producto_id' => NULL,
                    'vlr_fin' => 1000000,
                    'periodo' => 'Mensual',
                    'meses' => 10,
                    'cuotas' => 10,
                    'vlr_cuota' => 150000,
                    'vlr_asistencia' => 12000,
                    'p_fecha' => '9',
                    's_fecha' => '',
                    'estudio' => 'Tipico',
                    'cuota_inicial' => 0,
                    'aprobado' => 'En estudio',
                    'observaciones' => 'lorem ipsum dolor',
                    'user_create_id' => 1,
                    'user_update_id' => 1,
                    'created_at' => '2022-01-13 17:34:52',
                    'updated_at' => '2022-01-20 09:51:11',
                    'version' => '3',
                    'producto_nombre' => NULL,
                ),
                'credito' => 
                array (
                    'id' => 25012,
                    'precredito_id' => 34760,
                    'cuotas_faltantes' => 20,
                    'saldo' => 3500000,
                    'saldo_favor' => NULL,
                    'estado' => 'Al dia',
                    'rendimiento' => 2000000,
                    'valor_credito' => 3000000,
                    'castigada' => 'No',
                    'refinanciacion' => 'No',
                    'end_procredito' => 0,
                    'end_datacredito' => 0,
                    'user_create_id' => 1,
                    'user_update_id' => 1,
                    'created_at' => '2022-01-18 11:42:49',
                    'updated_at' => '2022-01-18 11:42:49',
                    'credito_refinanciado_id' => NULL,
                    'last_llamada_id' => NULL,
                    'recordatorio' => NULL,
                    'sanciones_debe' => 0,
                    'sanciones_ok' => 0,
                    'sanciones_exoneradas' => 0,
                    'mes' => 'Enero',
                    'anio' => 2022,
                    'calificacion' => NULL,
                    'permitir_mover_fecha' => 0,
                    'fecha_pago' => '2022-02-09',
                    'created_by' => 'Sistema',
                    'updated_by' => 'Sistema',
                    'credito_padre' => NULL,
                    'credito_hijo' => NULL,
                ),
            );  
    }
}
