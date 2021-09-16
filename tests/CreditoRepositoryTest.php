<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Repositories\CreditoRepository;

class CreditoRepositoryTest extends TestCase
{
    private $repo;

    public function __construct()
    {
        $this->repo = new CreditoRepository();
    }

    public function testExample()
    {
        $creditos = $this->repo->creditoActivoByCliente(4448);
        $this->assertTrue(true);
    }
}
