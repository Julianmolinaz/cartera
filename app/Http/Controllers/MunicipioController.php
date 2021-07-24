<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Municipio;

class MunicipioController extends Controller
{
    public function index()
    {
        try {
            $municipios = Municipio::where('id', '!=', 100)
                ->orderBy('departamento','asc')->get();

            return response()->json([
                'success' => true,
                'dat'     => $municipios
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage()
            ]);
        }

    

    }    
}
