<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MyService\FormatDate;


class TestController extends Controller
{
    public function make()
    {
       $format = new FormatDate('12-08-2012');
    //    return $format->getDay();
    //    return $format->getMonth();
    //    return $format->getYear();
        return $format->carbon();
    }
}
