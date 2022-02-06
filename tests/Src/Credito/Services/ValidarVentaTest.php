<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Credito\Services\ValidarVentaService;

class ValidarVentaTest extends TestCase
{
    public function testMakeValidarVenta()
    {
        $data = $this->mockVenta();
        $validator = ValidarVentaService::make($data, 'create');

        $this->assertInstanceOf(
            'Src\Credito\Services\ValidarVentaService', 
            $validator
        );

        if ($validator->fails()) {
            dd($validator->errors());
        } 
        
        $this->assertTrue(true);
    }

    public function mockVenta()
    {
        return [
            "id"            => "",
            "nombre"        => "R.T.M",
            "cantidad"      => 1,
            "producto_id"   => 1,
            "precredito_id" => "",
            "vehiculo_id"   => "" 
        ];
    }
}
