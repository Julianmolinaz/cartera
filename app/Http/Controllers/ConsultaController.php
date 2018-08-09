<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Cliente;
use App\Credito;

class ConsultaController extends Controller
{
    public function cuenta($cedula){
        $cliente = Cliente::where('num_doc',$cedula)->get();
        
        if(count($cliente) > 0){ // si existe el cliente
            
            $solicitudes = $cliente[0]->precreditos;
            $temp = 0;
            
            foreach($solicitudes as $solicitud){ // iterar sobre las solicitudes
                if(isset($solicitud->credito)){ // si la solicitud tiene un credito creado
                    
                    if($temp < $solicitud->credito->id){ // se escoge el credito con mayor id
                        $temp = $solicitud->credito->id;
                    }
                }
            }  
    
            if($temp <> 0){
                $credito = Credito::find($temp);
                $data = [
                    'nombre' => $credito->precredito->cliente->nombre,
                    'estado' => $credito->estado,
                    'vlr_cuota' => $credito->precredito->vlr_cuota,
                    'saldo'  => $credito->saldo,
                    'f_pago' => inv_fech($credito->fecha_pago->fecha_pago)
                ];

                return response()->json([
                    'error' => false,
                    'data'  => $data
                ]);
            }
            else{
                return response()->json([
                    'error' => true,
                    'data'  => ''
                ]);
            }

        }
        else{
            return response()->json([
                'error' => true,
                'data'  => ''
            ]);
        }

    }
}
