<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Credito\Services\ActivarCreditoRefinanciadoService;

class ActivarCreditoRefinanciadoServiceTest extends TestCase
{
    public function testExample()
    {
        $creditoId = 25015;

        $useCase = new ActivarCreditoRefinanciadoService(
            $this->mock(),
            $creditoId
        );

        // $useCase->execute();
        
        $this->assertTrue(true);
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
                        'nombre' => 'CASCO',
                        'cantidad' => 1,
                        'producto_id' => 5,
                        'con_vehiculo' => false,
                    ),
                    'precredito_id' => '',
                    'vehiculo' => '',
                    ),
                ),
            'solicitud' => 
            array (
                'id' => '',
                'num_fact' => '343343',
                'fecha' => '2022-01-24',
                'cartera_id' => 18,
                'funcionario_id' => 250,
                'cliente_id' => 11011,
                'vlr_fin' => '120000',
                'periodo' => 'Quincenal',
                'meses' => 5,
                'cuotas' => 10,
                'vlr_cuota' => '100000',
                'vlr_asistencia' => '0',
                'p_fecha' => 1,
                's_fecha' => 16,
                'estudio' => 'Tipico',
                'cuota_inicial' => '0',
                'aprobado' => 'En estudio',
                'observaciones' => '',
            ),
            'credito' => NULL,
        );
    }
}
