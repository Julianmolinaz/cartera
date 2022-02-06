<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HelperTest extends TestCase
{
    public function testGetEnumValues2()
    {
        $aprobado = getEnumValues2('precreditos', 'aprobado');
        $this->assertInternalType('array', $aprobado);
    }
}
