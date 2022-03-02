<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Contabilidad\Reportes\ComprobanteVentasService;

class ComprobanteVentasServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $useCase = new ComprobanteVentasService("2022-02-15", "2022-02-16", 1);
        $useCase->execute();
        $this->assertTrue(true);
    }
}
