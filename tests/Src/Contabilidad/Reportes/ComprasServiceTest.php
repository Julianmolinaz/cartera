<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Contabilidad\Reportes\ComprasService;

class ComprasServiceTest extends TestCase
{
    public function testExample()
    {
        $useCase = new ComprasService("2022-02-15", "2022-02-16", 1);
        $useCase->execute(false);
        dd($useCase->reporte);
        $this->assertTrue(true);
    }
}
