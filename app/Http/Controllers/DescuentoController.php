<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Classes\Descuentos;

class DescuentoController extends Controller
{
    public function store(Request $request)
    {
        try {
            Descuentos\ValidationRequest::make($request->all());
            return res(true, $request->all(), "Test");
        } catch (\Exception $e) {
            return res(false, json_decode($e->getMessage()), "Error de validación de datos.");
        }
    }
}
