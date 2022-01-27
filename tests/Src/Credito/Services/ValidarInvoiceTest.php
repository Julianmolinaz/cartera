<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Credito\Services\ValidarInvoiceService;

class ValidarInvoiceTest extends TestCase
{
    public function testMakeValidarInvoice()
    {
        $data = $this->mockInvoice();
        $validator = ValidarInvoiceService::make($data, 'create');

        $this->assertInstanceOf(
            'Src\Credito\Services\ValidarInvoiceService', 
            $validator
        );

        if ($validator->fails()) {
            dd($validator->errors());
        } 
        
        $this->assertTrue(true);
    }

    public function mockInvoice()
    {
        return [
            "id"            => "",
            "nombre"        => "",
            "estado"        => "En proceso",
            "fecha_exp"     => "2021-11-18",
            "costo"         => "4000",
            "iva"           => "17250",
            "num_fact"      => "321654",
            "otros"         => "10000",
            "expedido_a"    => "Cliente",
            "observaciones" => "prueba",
            "venta_id"      => "",
            "proveedor_id"  => 48,
            "precredito_id" => ""
        ];
    }
}
