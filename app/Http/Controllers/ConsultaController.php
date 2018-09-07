<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Cliente;
use App\Credito;
use App\Precredito;

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

    }//.cuenta

    public function solicitud($id)
    {
        $precredito = Precredito::find($id);


        if(!isset($precredito->credito)){

            $pago = $this->pagos($precredito);

            if( ( $pago['inicial'] == 0 ) && $precredito->cuota_incial){
                echo $precredito->inicial;
            }
            // if( ( $pago['estudio']) ){

            // }


            //validar si tiene pagos por estudio o inicial



            // if($precredito->cuota_incial){
            //     $inicial = $precredito->cuota_incial;
            // }
            // if($precredito->estudio != 'Sin estudio'){
            //     if( $precredito->estudio == 'Tipico' ){
            //         $estudio = 
            //     }
            // }
        }
        return response()->json($id);
    }

    private function pagos($precredito)
    {
        $bandera_estudio_tradicional = 0;
        $bandera_estudio_domicilio = 0;
        $bandera_inicial = 0;


        return [
                'estudio_tradicional' => $bandera_estudio_tradicional, 
                'estudio_tradicional' => $bandera_estudio_tradicional, 
                'inicial' => $bandera_inicial
            ];
    }
}
