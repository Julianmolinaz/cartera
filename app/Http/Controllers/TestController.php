<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MyService\Payments\Payment;


class TestController extends Controller
{
    public function make()
    {
        $pay = new Payment(17630, 210000);
        return $pay->make();

    }
}
