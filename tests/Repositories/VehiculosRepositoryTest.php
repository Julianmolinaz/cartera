<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repositories\VehiculosRepository;

class VehiculosRepositoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testlistVehiculosByClient()
    {
        $clientes = VehiculosRepository::listVehiculosByClient('FTH68C');
        dd($clientes);
        $this->assertTrue(true);
    }
}
