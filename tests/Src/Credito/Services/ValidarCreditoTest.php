<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Credito\Services\ValidarCreditoService;

class ValidarCreditoTest extends TestCase
{
    public function testMakeValidarCredito()
    {
        $data = $this->mockCredito();
        $validator = ValidarCreditoService::make($data, 'create');

        $this->assertInstanceOf(
            'Src\Credito\Services\ValidarCreditoService', 
            $validator
        );

        if ($validator->fails()) {
            dd($validator->errors());
        } 
        
        $this->assertTrue(true);
    }

    public function mockCredito()
    {
        return [
            "id"                => "",
            "estado"            => "Al dia",
            "valor_credito"     => "4500",
            "saldo"             => "4500",
            "cuotas_faltantes"  => "2",
            "rendimiento"       => "500",
            "saldo_favor"       => "0",
            "castigada"         => "",
            "fecha_pago"        => "2021-11-18",
            "mes"               => "Noviembre",
            "anio"              => 2021,
            "recordatorio"      => ""
        ];
    }
}
