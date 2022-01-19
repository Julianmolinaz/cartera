<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Credito\Services\ConsultarCreditoService;

class ConsultarCreditoServiceTest extends TestCase
{
    public function testExample()
    {
        $case = ConsultarCreditoService::make(34760);

        dd($case->data);
        $this->assertTrue(true);
    }
}
