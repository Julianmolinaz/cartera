<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Precredito;
use App\Codeudor;
use App\Cliente;
use App\Credito;

class ConsultaController extends Controller
{
    public function cuenta($cedula)
    {
        $cliente = Cliente::where('num_doc',$cedula)->get();
        
        if(count($cliente) > 0){ // si existe el cliente

            return $this->consultar_cliente($cliente[0]);
            
        }
        else{
            //codeudor
            $codeudor = Codeudor::where('num_docc',$cedula)->get();

            if(count($codeudor) > 0){
                return $this->consultar_codeudor($codeudor[0]);
                
            }
            else{
                //si no es codeudor

                return response()->json([
                    'error' => true,
                    'data'  => ''
                ]);
            }
        }

    }//.cuenta

    public function consultar_cliente($cliente)
    {
        $solicitudes = $cliente->precreditos;
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

            if( $credito->estado == 'Cancelado' || $credito->saldo <= 0 ){
                $estado = 'Cancelado';
                $saldo  = 0;
                $f_pago = '';
            }
            else{
                $estado = $credito->estado;
                $saldo  = $credito->saldo;
                $f_pago = inv_fech($credito->fecha_pago->fecha_pago);   
            }

            $data = [
                'nombre' => $credito->precredito->cliente->nombre,
                'estado' => $estado,
                'vlr_cuota' => $credito->precredito->vlr_cuota,
                'saldo'  => $saldo,
                'f_pago' => $f_pago
            ];

            return response()->json([
                'error' => false,
                'data'  => $data
            ]);
        }//.if
        else{
            return response()->json([
                'error' => true,
                'data'  => ''
            ]);
        }//.else
    }//.consultar_cliente()

    public function consultar_codeudor($codeudor)
    {
        $solicitudes = $codeudor->clientes[0]->precreditos;
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

            if( $credito->estado == 'Cancelado' || $credito->saldo <= 0 ){
                $estado = 'Cancelado';
                $saldo  = 0;
                $f_pago = '';
            }
            else{
                $estado = $credito->estado;
                $saldo  = $credito->saldo;
                $f_pago = inv_fech($credito->fecha_pago->fecha_pago);   
            }

            $data = [
                'nombre' => $credito->precredito->cliente->codeudor->nombrec,
                'estado' => $estado,
                'vlr_cuota' => $credito->precredito->vlr_cuota,
                'saldo'  => $saldo,
                'f_pago' => $f_pago
            ];

            return response()->json([
                'error' => false,
                'data'  => $data
            ]);
        }//.if
        else{
            return response()->json([
                'error' => true,
                'data'  => ''
            ]);
        }//.else
    }//.consultar_cliente()

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
