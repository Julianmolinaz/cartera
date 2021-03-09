<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Proceso;
use Auth;

class ProcesoController extends Controller
{
    public function store(Request $request)
    {
        try {
            $proceso = new Proceso($request->all());
            $proceso->user_create_id = Auth::user()->id;
            $proceso->save();

            return response()->json([
                'error' => false,
                'dat'   => $proceso,
                'message' => 'Proceso creado exitosamente !!!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $proceso_id)
    {
        try {
            $proceso = Proceso::find($proceso_id);
            $proceso->fill($request->all());
            $proceso->user_update_id = Auth::user()->id;
            $proceso->save();

            return response()->json([
                'error' => false,
                'dat'   => $proceso,
                'message' => 'Proceso actualizado exitosamente !!!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => false,
                'message' => $e->getMessage()
            ]);
        }
    }    
}
