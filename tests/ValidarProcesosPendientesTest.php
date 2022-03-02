<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Src\Credito\UseCases\ValidarProcesosPendientesdUseCase;

class ValidarProcesosPendientesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testValidarProcesosPendientes()
    {
        // $data = [
        //     'clienteId' => 33333331
        // ];
        
        // $validation = new ValidarProcesosPendientesdUseCase($data['clienteId']);
        // $validation->execute();
        
        $this->assertTrue(true);

    }
}
