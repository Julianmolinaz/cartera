<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class PagoProveedorController extends Controller
{
    public function index()
    {
        $proveedores_en_debe = $this->getProveedoresALosQueSeLesDebe();
        $proveedores = \App\MyService\Proveedor::getProveedores();

        return view('contabilidad.pago_proveedores.index')
            ->with('proveedores_en_debe',$proveedores)
            ->with('proveedores',$proveedores);
    }


    public function getProveedoresALosQueSeLesDebe()
    {
        $proveedores_en_debe = DB::table('terceros')
            ->join('ref_productos','terceros.id','=','ref_productos.proveedor_id')
            ->select('terceros.*')
            ->where('ref_productos.estado','=','En proceso')
            ->groupBy('ref_productos.proveedor_id')
            ->get();

        $proveedores = [];
        
        foreach ($proveedores_en_debe as $proveedor) {
            $debe = DB::table('ref_productos')
                ->where('proveedor_id',$proveedor->id)
                ->where('estado','=','En proceso')
                ->sum('costo');

            $proveedor->debe = $debe;
            $proveedores[] = $proveedor;
        }


        return $proveedores;

    }


    public function list($proveedor_id, $type){
        if ($type == 'debe') {

            $productos = DB::table('ref_productos')
                ->join('terceros','ref_productos.proveedor_id','=','terceros.id')
                ->join('productos','ref_productos.producto_id','=','productos.id')
                ->join('precreditos','ref_productos.precredito_id','=','precreditos.id')
                ->leftJoin('creditos','precreditos.id','=','creditos.precredito_id')
                ->select('ref_productos.*',
                         'productos.nombre as producto_solicitud',
                         'precreditos.id as precredito_id',
                         'creditos.id as credito_id',
                         'terceros.razon_social as razon_social')
                ->where('ref_productos.proveedor_id',$proveedor_id)
                ->where('ref_productos.estado','=','En proceso')
                ->get();

            $productos_ = [];

            foreach( $productos as $producto) {
                $producto->checked = false;
                $productos_[] = $producto;
            }

            return res(true,$productos_, '');
        }
    }
}