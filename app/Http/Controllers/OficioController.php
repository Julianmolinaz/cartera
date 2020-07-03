<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App as _;
use Validator;

class OficioController extends Controller
{
    public function store(Request $request) 
    {
        try {
  
            $oficio_existe = \DB::table('oficios')->where('nombre', $request->nombre)->count();
    
            if ($oficio_existe) {
                return res(true,'', 'El oficio ya existe');
            }
    
            $oficio = \DB::table('oficios')->insert([
                'nombre' => ucwords(strtolower($request->nombre))
            ]);
    
            return res(false, $oficio, 'Se creó el oficio exitosamente');

        } catch (\Exception $e) {

            \Log::error($e);

            return res(true, '', 'ERRoR: '.$e->getMessage());
        }
    }

    public function getOficios()
    {
        $oficios = _\Oficio::orderBy('nombre')->get();

        return res(false, $oficios,'');
    }

    public function update(Request $request) 
    {

        $validator = Validator::make($request->all(),[
            'nombre' => 'required|unique:oficios,nombre,'.$request->id
        ],[
            'nombre.required' => 'El nombre es requerido.',
            'nombre.unique'  => 'El oficio ya existe.'
        ]);

        if ($validator->fails()) {
            return res(true,$validator->errors(),'Error en la validacion');
        }

        \DB::table('oficios')
            ->where('id',$request->id)
            ->update([
                'nombre' => ucwords(strtolower($request->nombre))
            ]);

        return res(false,'','Oficio actualizado exitosamente.');
    }

    public function destroy($oficio_id)
    {
        try {
            \DB::table('oficios')->where('id',$oficio_id)->delete();

            return res(false, '', 'El oficio fue borrado exitosamente');

        } catch (\Exception $e) {
            return res(true, $e,'ERRoR: '.$e->getMessage());
        }
    }
}
