<?php

namespace App\Traits\Creditos;
use App\Exceptions\Handler;
use App as _;
use Exception;


trait RefProductoTrait
{
    public function saveRefProductoFromProductoTr($producto, $vehiculo, $solicitud)
    {
        try {
            $ref_producto = new _\RefProducto();
            $ref_producto->fill($producto);
            $ref_producto->vehiculo_id = $vehiculo->id;
            $ref_producto->precredito_id = $solicitud->id;
            $ref_producto->created_by  = \Auth::user()->id;
            $ref_producto->save();

            return $ref_producto;

        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }

    public function editRefProductoFromProductoTr($producto)
    {
        try {
            $ref_producto = _\RefProducto::find($producto['ref_producto_id']);
            $ref_producto->fill($producto);
            
            if ($ref_producto->isDirty()) {
                $ref_producto->updated_by  = \Auth::user()->id;
                $ref_producto->save();

                return true;
            }

            return false;

        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}