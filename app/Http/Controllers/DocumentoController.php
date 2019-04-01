<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\DocumentoTrait;
use App\Http\Requests;
use App\Documento;
use Auth;
use DB;

class DocumentoController extends Controller
{
    use DocumentoTrait;


    public function set_documento(Request $request, $objeto_relacionado)
    {
        $this->create_documento($request,$objeto_relacionado);

        flash()->success('Se guardó el documento exitosamente!!!');
        if($objeto_relacionado == 'cliente'){
            return redirect()->route('start.clientes.show',$request->cliente_id);
        }
    }

    public function get_documento($documento_id,$nombre)
    {
        $doc = Documento::find($documento_id);

        $file= storage_path(). '/app/doc_clientes/'.$doc->ruta; 
        $headers = [ 
            'Content-Type' => 'application/pdf', 
        ]; 

        return response()->file($file); 
    }

    public function destroy($documento_id)
    {
        try{
            $doc = Documento::find($documento_id);
            
            $cliente = $doc->cliente;
            $nombre  = $doc->nombre;
            $ruta    = $doc->ruta;
            $doc->delete();
            
            // elimina archivo
            
            //$ruta    = storage_path().'/app/doc_clientes/'.$ruta;
            //unlink($ruta);
            
            flash()->success("El documento $nombre se eliminó Exitosamente!");
            return redirect()->route('start.clientes.show', $cliente->id);

        } catch(\Exception $e) {
            dd($e->getMessage());
        }

    }
}

