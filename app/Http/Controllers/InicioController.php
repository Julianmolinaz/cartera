<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Codeudor;
use App\Cliente;
use App\Credito;
use App\Precredito;
use App\Factura;
use DB;

class InicioController extends Controller
{
    function index(){
        return view('start.inicio.index');
    }

    function buscar($string){

        $respuesta = "";
        
        if(substr($string,0,1) == "="){

            $string = substr($string,1);
            $_creditos      = DB::table('creditos')->where('id','like','%'.$string.'%')->get();

            $_precreditos   = DB::table('precreditos')
                                ->where('id','like','%'.$string.'%')
                                ->orWhere('num_fact','like','%'.$string.'%')
                                ->get();

            if(count($_creditos) > 0){
                foreach($_creditos as $credito){
                    $credito     = Credito::find($credito->id);
                    $respuesta .= "<strong>Crédito: </strong>".
                                    "<a href=".route('start.precreditos.ver',$credito->precredito->id).">".
                                    $credito->id.", estado: ".
                                    $credito->estado.", cliente: ".
                                    $credito->precredito->cliente->nombre." - ".
                                    $credito->precredito->cliente->tipo_doc.": ".
                                    $credito->precredito->cliente->num_doc.", ver factura: ".
                                    $credito->precredito->num_fact." </a>".
                                    "<a href=".route('call.index_unique',$credito->id).">Llamar</a><br>";
                }
            }
            if(count($_precreditos) > 0){
                foreach($_precreditos as $precredito){
                    $precredito     = Precredito::find($precredito->id);
                    $respuesta .= "<p><strong>Solicitud: </strong>".
                                    "<a href=".route('start.precreditos.ver',$precredito->id).">".
                                    $precredito->id.", ¿Aprobado?: ".
                                    $precredito->aprobado.", cliente: ".
                                    $precredito->cliente->nombre." - ".
                                    $precredito->cliente->tipo_doc.": ".
                                    $precredito->cliente->num_doc.", ver factura: ".
                                    $precredito->num_fact."</p></a>";
                }
            }
        }
        else if(substr($string,0,1) == "*"){
            $string = substr($string,1);

            $facturas        = DB::table('facturas')
                                    ->where('num_fact','like','%'.$string.'%')
                                    ->get();

            if(count($facturas) > 0){
                foreach($facturas as $factura){
                    //$factura       = Factura::where($factura->id);
                    $respuesta .= "<p><strong>Factura: </strong>".
                                    "<a href=".route('start.facturas.show',$factura->id)."> Número de factura: ".
                                    $factura->num_fact.", crédito id: ".
                                    $factura->credito_id.", fecha: ".
                                    $factura->fecha." total: ".
                                    $factura->total."</a></p>";
                }
            }

            $fact_precreditos   = DB::table('fact_precreditos')
                                    ->where('num_fact','like','%'.$string.'%')
                                    ->get();

            if(count($fact_precreditos) > 0){
                foreach($fact_precreditos as $factura){
                    $respuesta .= "<p><strong>Factura solicitudes: </strong>".
                                    $factura->num_fact.", solicitud id: ".
                                    $factura->precredito_id.", fecha: ".
                                    $factura->fecha." total: ".
                                    $factura->total."</p>";
                }
            }



            $anuladas  = DB::table('anuladas')
                        ->where('num_fact','like','%'.$string.'%')
                        ->get();

            if(count($anuladas) > 0){
                foreach($anuladas as $anulada){
                    $respuesta .= "<p><strong>Anulada: </strong>".
                                    $anulada->num_fact.", crédito id: ".
                                    $anulada->credito_id.", fecha: ".
                                    $anulada->created_at." total: ".
                                    $anulada->total."</p>";
                }
            }
        }

        else if(substr($string,0,1) == "+"){
            $string = substr($string,1);

            $clientes    = DB::table('clientes')->where('placa','like','%'.$string.'%')->get();
            $codeudores  = DB::table('codeudores')->where('placac','like','%'.$string.'%')->get();

            if(count($clientes) > 0){
                foreach($clientes as $cliente){  
                    $respuesta .=   "<p><strong>Placa cliente: </strong>".
                                    "<a href=".route('start.clientes.show',$cliente->id).">".
                                    $cliente->placa." : ".
                                    $cliente->nombre." - ".
                                    $cliente->tipo_doc.": ".
                                    $cliente->num_doc." </p></a>";  
                }   
            }
            if(count($codeudores) > 0){
                foreach($codeudores as $codeudor){  
                    $clientes = Cliente::where('codeudor_id',$codeudor->id)->get();
                    
                    foreach($clientes as $cliente){
                        $cliente = Cliente::find($cliente->id);
                        $respuesta .=   "<p><strong>Placa codeudor: </strong>".
                                        "<a href=".route('start.clientes.show',$cliente->id).">".
                                        $cliente->codeudor->placac." : ".
                                        $cliente->codeudor->nombrec." - ".
                                        $cliente->codeudor->tipo_docc.": ".
                                        $cliente->codeudor->num_docc." </p></a>";  
                    }
                }
            }
        }        
        else{
            $nombre_clientes    = DB::table('clientes')->where('nombre','like','%'.$string.'%')->get();
            $doc_clientes       = DB::table('clientes')->where('num_doc','like','%'.$string.'%')->get();
            $nombre_codeudores  = DB::table('codeudores')->where('nombrec','like','%'.$string.'%')->get();
            $doc_codeudores     = DB::table('codeudores')->where('num_docc','like','%'.$string.'%')->get();

            if(count($nombre_clientes) > 0){
                foreach($nombre_clientes as $cliente){  
                    $respuesta .=   "<p><strong>Cliente: </strong>".
                                    "<a href=".route('start.clientes.show',$cliente->id).">".
                                    $cliente->nombre." - ".
                                    $cliente->tipo_doc.": ".
                                    $cliente->num_doc."</p></a>";  
                }   
            }
            if(count($doc_clientes) > 0){
                foreach($doc_clientes as $cliente){  
                    $respuesta .= "<p><strong>Cliente: </strong>".
                                    "<a href=".route('start.clientes.show',$cliente->id).">".
                                    $cliente->nombre." - ".
                                    $cliente->tipo_doc.": ".
                                    $cliente->num_doc."</p></a>";  
                }
            }
            if(count($nombre_codeudores) > 0){
                foreach($nombre_codeudores as $codeudor){  
                    $clientes = Cliente::where('codeudor_id',$codeudor->id)->get();
                    
                    foreach($clientes as $cliente){
                        $cliente = Cliente::find($cliente->id);
                        $respuesta .= "<p><strong>Codeudor: </strong>".
                                        "<a href=".route('start.clientes.show',$cliente->id).">".
                                        $cliente->codeudor->nombrec." - ".
                                        $cliente->codeudor->tipo_docc.": ".
                                        $cliente->codeudor->num_docc." sirve de codeudor al cliente: ".
                                        $cliente->nombre." - ".
                                        $cliente->tipo_doc.": ".
                                        $cliente->num_doc."</p></a>";  
                    }
                }
            }
            if(count($doc_codeudores) > 0){
                foreach($doc_codeudores as $codeudor){  
                    $clientes = Cliente::where('codeudor_id',$codeudor->id)->get();
                    
                    foreach($clientes as $cliente){
                        $cliente = Cliente::find($cliente->id);
                        $respuesta .= "<p><strong>Codeudor: </strong>".
                                        "<a href=".route('start.clientes.show',$cliente->id).">".
                                        $cliente->codeudor->nombrec." - ".
                                        $cliente->codeudor->tipo_docc.": ".
                                        $cliente->codeudor->num_docc." sirve de codeudor al cliente: ".
                                        $cliente->nombre." - ".
                                        $cliente->tipo_doc.": ".
                                        $cliente->num_doc."</p></a>";  
                    }    
                }
            }
        }
        $respuesta .= "";
        return response()->json($respuesta);
    }
}
