<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

// use Src\Certificados\PazySalvo\GetDataPazySalvoService;
// use DB;

class GetDataPazySalvoTest extends TestCase
{
    public function testExample()
    {
        // $credito = DB::table('creditos')
        //     ->orderBy('creditos.id', 'desc')
        //     ->limit(1)
        //     ->first();

        // $useCase = GetDataPazySalvoService::make($credito->id, 'cliente');

        // dd($useCase->data);

        $this->assertTrue(true);
    }
}
