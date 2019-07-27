<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Credito;
use App\Anotacion;
use App\Proceso;
use Auth;
use DB;

class AnotacionController extends Controller
{
    public function index($credito_id)
    {
        $credito = credito::find($credito_id);
        $credito->precredito->cliente;
        $credito->proceso;
        
        return view('admin.anotaciones.index')
            ->with('credito',$credito);
    }

    public function list($proceso_id)
    {
        try{    
            $anotaciones = 
            Anotacion::where('proceso_id', $proceso_id)
                ->orderBy('created_at','DESC')
                ->get();

            if ($anotaciones) {
                $anotaciones->map(function($anotacion){
                    $anotacion->user_update;
                    $anotacion->user_create;
                });
            } 

            return response()->json([
                'error' => false,
                'dat'   => $anotaciones
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

    }


    public function store(Request $request)
    {
        try {
            $anotacion = new Anotacion();
            $anotacion->fill( $request->all() );
    
            if($request->notificar){
                $anotacion->notificado = 'Espera';
            } else {
                $anotacion->notificado = 'No';
            }

            $anotacion->user_create_id = Auth::user()->id;
            $anotacion->save();

            return response()->json([
                'error' => false,
                'dat'   => $anotacion,
                'message' => 'Anotación creada exitosamente !!!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $anotacion_id)
    {
        try {
            $anotacion = Anotacion::find($anotacion_id);
            $anotacion->fill($request->all());

            if($anotacion->notificado == 'No' && $request->notificar ){
                $anotacion->notificado = 'Espera';
            } else {
                $anotacion->notificado = 'No';
            }

            $anotacion->user_update_id = Auth::user()->id;
            $anotacion->save();

            return response()->json([
                'error' => false,
                'dat'   => $anotacion,
                'message' => 'Anotación actualizada exitosamente !!!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

}
