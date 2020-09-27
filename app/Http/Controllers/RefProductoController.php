<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\RefProducto;
use Auth;
use DB;


class RefProductoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'pagar']);
    }


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
                            ->update(['estado' => 'Pagado','updated_by' => Auth::user()->id]);
                    }
                    else {
                        
                        return res(false,$valid,'Error en la validación.');
                    }
                }
            }

            \DB::commit();

            return res(true,'','Se cargo el pago exitosamente !!!');

        } catch (\Exception $e) {
            \DB::rollback();
            \Log::info($e);
            return res(false,$e,'Ocurrió un error: '.$e->getMessage());

        }
    }

    public function productoValidado($ref_producto)
    {   
        $ref_producto = RefProducto::find($ref_producto['id']);

        $id = ($ref_producto->solicitud->credito == null )
            ? 'S-'.$ref_producto->solicitud->id 
            : 'C-'.$ref_producto->solicitud->credito;

        $mensaje = [];
        $bandera = 0;

        if (! $ref_producto['nombre']) {
            array_push($mensaje, ["Se requiere el nombre del producto $id."]);
            $bandera = 1;
        }
        if (! $ref_producto['fecha_exp']) {
            array_push($mensaje, ["Se requiere la fecha de expedición $id."]);
            $bandera = 1;
        }
        if (! $ref_producto['costo']) {
            array_push($mensaje, ["Se requiere el costo del producto $id."]);
            $bandera = 1;
        }
        if (! $ref_producto['iva']) {
            array_push($mensaje, ["Se requiere el iva del producto $id."]);
            $bandera = 1;
        }
        if (! $ref_producto['num_fact']) {
            array_push($mensaje, ["Se requiere el número de factura del producto $id."]);
            $bandera = 1;
        }
        if (! $ref_producto['proveedor_id']) {
            array_push($mensaje, ["Se requiere el proveedor del rpoducto $id."]);
            $bandera = 1;
        }

        return [
            'mensaje' => $mensaje,
            'bandera' => $bandera
        ];
    }
}

