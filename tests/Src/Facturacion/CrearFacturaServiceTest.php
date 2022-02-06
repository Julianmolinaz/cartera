<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Facturacion\CrearFacturaService;

class CrearFacturaServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $data  = $this->mockFactura();
        $useCase = new CrearFacturaService($data);
        $factura = $useCase->execute();

        \DB::table('invoices')->where('id', $factura->id)->delete();

        $this->assertTrue(true);
    }

    public function mockFactura()
    {
        return array (
            'estado' => 'En proceso',
            'fecha_exp' => '2022-01-20',
            'costo' => '42352342',
            'iva' => '24352435',
            'num_fact' => '4352435',
            'otros' => '43252342',
            'expedido_a' => 'Cliente',
            'observaciones' => 'dsagffdfdg',
            'venta_id' => 43,
            'proveedor_id' => 48,
            'precredito_id' => 34760,
        );
    }
}
