<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Credito\Services\InsumosVentasService;
use App\Repositories as Repo;


class InsumosVentasTest extends TestCase
{
    public function testExcuteDeIsumosCredito()
    {
        $case = new InsumosVentasService(
            new Repo\TercerosQueryBuilderRepository(),
            new Repo\TipoVehiculosQueryBuilderRepository()
        );

        $this->assertInstanceOf(
            'Src\Credito\Services\InsumosVentasService', 
            $case
        );
        $insumos = $case->execute();
        
        $this->assertTrue(true);
    }
}
