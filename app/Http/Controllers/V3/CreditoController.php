<?php

namespace App\Http\Controllers\V3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class CreditoController extends Controller
{
    public function __construct()
    {
        // 
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function update(Request $request)
    {
        return resHp(true, $request->all(),'ok');
    }
}
