<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Src\Certificados\PazySalvo\GetDataPazySalvoService;

class GetDataPazySalvoTest extends TestCase
{
    public function testExample()
    {
        $useCase = GetDataPazySalvoService::make(25012, 'cliente');

        // dd($useCase->data);

        $this->assertTrue(true);
    }
}
