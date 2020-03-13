<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\RefProducto;
use Auth;
use DB;


class RefProductoController extends Controller
{
    public function store(Request $request)
    {
        try {

            $ref_producto = \App\RefProducto::find($request->id);
            $ref_producto->fill($request->all());

            if(!$ref_producto->isDirty()){
                return  res(false,'','Ningun cambio en registro !!!');
            }

            $ref_producto->updated_by = \Auth::user()->id;
            $ref_producto->save();

            return res(true,$ref_producto,'El producto fue actualizado exitosamente !!!');

        } catch (\Exception $e) {

            return res(false,$e,'Ocurrió un error: '.$e->getMessage());

        }

    }

    public function pagar(Request $request)
    {
        $sumatoria = 0;

        \DB::beginTransaction();

        try {
            $productos = $request->all();

            foreach($productos as $producto){
                if($producto['checked']){

                    $valid = $this->productoValidado($producto);

                    if ($valid['bandera'] == 0) {

                        $sumatoria += $producto['costo'];
                        DB::table('ref_productos')
                        ->where('id',$producto['id'])
                        ->update(['estado' => 'Pagado']);
                    }
                    else {
                        
                        return res(false,$valid,'');
                    }
                }
            }

            // \DB::commit();

            return res(true,'','Se cargo el pago exitosamente !!!');

        } catch (\Exception $e) {
            \DB::rollback();

            return res(false,$e,'Ocurrió un error: '.$e->getMessage());

        }


        
        return res(true,'','Todo bien');
    }

    public function productoValidado($producto)
    {

        \Log::error($producto);
        $mensaje = [];
        $bandera = 0;

        if (! $producto['nombre']) {
            array_push($mensaje, ['Se requiere el nombre del producto.']);
            $bandera = 1;
        }
        if (! $producto['fecha_exp']) {
            array_push($mensaje, ['Se requiere la fecha de expedición.']);
            $bandera = 1;
        }
        if (! $producto['costo']) {
            array_push($mensaje, ['Se requiere el costo del producto']);
            $bandera = 1;
        }
        if (! $producto['iva']) {
            array_push($mensaje, ['Se requiere el iva del producto']);
            $bandera = 1;
        }
        if (! $producto['num_fact']) {
            array_push($mensaje, ['Se requiere el número de factura del producto.']);
            $bandera = 1;
        }
        if (! $producto['proveedor_id']) {
            array_push($mensaje, ['Se requiere el proveedor del rpoducto']);
            $bandera = 1;
        }

        return [
            'mensaje' => $mensaje,
            'bandera' => $bandera
        ];
    }
}

