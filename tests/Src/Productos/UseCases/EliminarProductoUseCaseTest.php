<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Productos\UseCases\EliminarProductoUseCase as UseCase;

class EliminarProductoUseCaseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        \DB::table("productos")
            ->insert([
                'nombre' => 'producto de pruebas',
                'descripcion' => 'lorem ipsum dolor',
                'con_invoice' => 1,
                'con_vehiculo' => 1
            ]);

        $producto = \DB::table("productos")
            ->orderBy("id", "desc")
            ->first();

        $case = new UseCase($producto->id);
        $case->execute();
        $this->assertTrue(true);
    }
}
