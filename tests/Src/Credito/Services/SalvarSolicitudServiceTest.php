<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Credito\Services\SalvarSolicitudService;
use DB;

class SalvarSolicitudServiceTest extends TestCase
{
    public function testExample()
    {
        DB::beginTransaction();

        try {
            $data = $this->mock();

            // $case = new SalvarSolicitudService($data);

            // $solicitud = $case->make();

            $this->assertTrue(true);

            // $this->delete($solicitud->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function delete($solicitudId)
    {

        $ventas = DB::table('ventas')->where('precredito_id', $solicitudId)->get();

        foreach ($ventas as $venta) {
            DB::table('vehiculos')->where('id', $venta->vehiculo_id)->delete();
        }

        DB::table('ventas')->where('precredito_id', $solicitudId)->delete();

        DB::table('precreditos')->where('id', $solicitudId)->delete();

    }

    public function mock() 
    {
        return array (
            'ventas' => 
            array (
                0 => 
                array (
                'id' => '',
                'producto' => 
                array (
                    'nombre' => 'SOAT',
                    'cantidad' => 1,
                    'producto_id' => 2,
                    'con_vehiculo' => 1,
                ),
                'precredito_id' => '',
                'vehiculo' => 
                array (
                    'id' => '',
                    'tipo_vehiculo_id' => 2,
                    'placa' => 'DKZ82E',
                    'vencimiento_soat' => '2023-03-16',
                    'vencimiento_rtm' => '2023-04-13',
                    'modelo' => '2016',
                    'cilindraje' => '150',
                    'observaciones' => '',
                ),
                ),
                1 => 
                array (
                'id' => '',
                'producto' => 
                array (
                    'nombre' => 'R.T.M',
                    'cantidad' => 1,
                    'producto_id' => 1,
                    'con_vehiculo' => 1,
                ),
                'precredito_id' => '',
                'vehiculo' => 
                array (
                    'id' => '',
                    'tipo_vehiculo_id' => 2,
                    'placa' => 'DKZ82E',
                    'vencimiento_soat' => '2023-03-16',
                    'vencimiento_rtm' => '2023-04-13',
                    'modelo' => '2016',
                    'cilindraje' => '150',
                    'observaciones' => '',
                ),
                ),
            ),
            'solicitud' => 
            array (
                'id' => '',
                'num_fact' => '999999999',
                'fecha' => '2022-01-13',
                'cartera_id' => 18,
                'funcionario_id' => 250,
                'cliente_id' => 11011,
                'vlr_fin' => '1000000',
                'periodo' => 'Mensual',
                'meses' => 10,
                'cuotas' => 10,
                'vlr_cuota' => '150000',
                'vlr_asistencia' => '12000',
                'p_fecha' => 9,
                's_fecha' => '',
                'estudio' => 'Tipico',
                'cuota_inicial' => '0',
                'aprobado' => 'En estudio',
                'observaciones' => 'lorem ipsum dolor',
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
}
