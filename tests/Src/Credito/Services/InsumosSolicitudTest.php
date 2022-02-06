<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Credito\Services\InsumosSolicitudService;

class InsumosSolicitudTest extends TestCase
{
    public function testExcuteDeIsumosSolicitud()
    {
        $case = new InsumosSolicitudService();

        $this->assertInstanceOf(
            'Src\Credito\Services\InsumosSolicitudService', 
            $case
        );
        $insumos = $case->execute();
        
        $this->assertTrue(true);
    }
}
