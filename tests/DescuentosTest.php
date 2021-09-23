<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Classes\Descuentos\ValidationRequest;

class DescuentosTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testValidationRequest()
    {
        $data = [
            'credito_id' => 123,
            'monto' => 100000,
            'descripcion' => '',

        ];
        $validation = ValidationRequest::make($data);
        
        $this->assertTrue($validation);
    }
}
