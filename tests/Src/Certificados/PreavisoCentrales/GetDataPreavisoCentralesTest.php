<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Certificados\PreavisoCentrales\GetDataPreavisoCentralesService;

class GetDataPreavisoCentralesTest extends TestCase
{
    
    public function testExample()
    {
        $useCase = GetDataPreavisoCentralesService::make(25012, 'cliente');

        // dd($useCase->data);

        $this->assertTrue(true);
    }
}
