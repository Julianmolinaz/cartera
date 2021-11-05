<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Credito\Services\InsumosCreditoService;

class InsumosCreditoTest extends TestCase
{
    public function testExcuteDeIsumosCredito()
    {
        $case = new InsumosCreditoService();

        $this->assertInstanceOf(
            'Src\Credito\Services\InsumosCreditoService', 
            $case
        );
        $insumos = $case->execute();
        
        $this->assertTrue(true);
    }
}
