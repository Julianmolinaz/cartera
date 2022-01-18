<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Credito\Services\ActivarCreditoService;

class ActivarCreditoServiceTest extends TestCase
{
    public function testExample()
    {
        $data = $this->mock();
        $case = ActivarCreditoService::make($data);
        $this->assertTrue(true);
    }

    public function mock()
    {
        return array (
            "mes" => "Enero",
            "anio" => "2022",
            "solicitudId" => "34760"
        );
    }
}
