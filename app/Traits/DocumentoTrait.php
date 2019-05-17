<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Documento;
use CArbon\Carbon;
use Auth;
use DB;


trait DocumentoTrait
{
    public function create_documento(Request $request, $objeto_relacionado ) 
    {
        $this->validate($request, [
            'file' => 'required'
        ],[
            'file.required' => 'Se requiere adjuntar un archivo'
        ]);
        $ruta = Carbon::now()->timestamp.'-'.
                $request->file('file')->getClientOriginalName();
        $ruta = str_replace('-','_',str_replace(' ','_',$ruta) );

        Storage::disk('local')->put('doc_clientes/'.$ruta, file_get_contents($request->file('file')->getRealPath()) );

        if($objeto_relacionado == 'credito'){
            $obj = 'credito_id';
            $value = $request->credito_id;
        } else if($objeto_relacionado == 'precredito') {
            $obj = 'precredito_id';
            $value = $request->precredito_id;
        } else if($objeto_relacionado == 'cliente') {
            $obj = 'cliente_id';
            $value = $request->cliente_id;
        }

        $documento = Documento::create([
            'nombre'        => $request->file('file')->getClientOriginalName(),
            'ruta'          => $ruta,
             $obj           => $value,
            'user_create_id'=> Auth::user()->id
        ]);
        
    }
}