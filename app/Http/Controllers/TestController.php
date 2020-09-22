<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MyService\GeneradorPagos;


class TestController extends Controller
{
    public function testPagos()
    {
        $pago = new GeneradorPagos(5000000, 11629);
        $pago->make();
    }
}
