<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Zona;
use Validator;
use Auth;
use DB;

class ZonaController extends Controller
{
    public function index()
    {
        return view('admin.zonas.index');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'nombre' => 'required|unique:zonas'
            ]);
            if ( $validator->fails() ) {
                $res = ['error' => true, 'message' => $validator];
                return response()->json($res);
            }
            $zona = new Zona($request->all());
            $zona->user_create_id = Auth::user()->id;
            $zona->save();

            return response()->json([
                'error' => false,
                'message' => 'Se creó el registro exitosamente !!!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
        return response()->json($request->all());
    }

    public function getZonas()
    {
        try {
            $zonas = Zona::orderBy('updated_at','DESC')->get();

            return response()->json([
                'error' => false,
                'dat'   => $zonas
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'dat'   => $e->getMessage()
            ]);    
        }

        
    }
}
