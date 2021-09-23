<?php

namespace App\Traits\Creditos;
use App\Exceptions\Handler;
use Exception;
use App as _;


trait VehiculoTrait
{
    /**
     * @param $producto = array
     * @return $vehiculo object
     */

    public function saveVehiculoFromProductoTr($producto) 
    {
        try {

            $vehiculo = new _\Vehiculo();
            $vehiculo->placa = $producto['_placa'];
            $vehiculo->tipo_vehiculo_id = $producto['_tipo_vehiculo_id'];
            $vehiculo->vencimiento_soat = $producto['_vencimiento_soat'];
            $vehiculo->vencimiento_rtm  = $producto['_vencimiento_rtm'];
            $vehiculo->save();

            return $vehiculo;

        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }

    /**
     * @param $producto = array
     */

    public function editVehiculoFromProductoTr($producto) 
    {
        try {
            $vehiculo = _\Vehiculo::find($producto['_vehiculo_id']);
            $vehiculo->placa = $producto['_placa'];
            $vehiculo->tipo_vehiculo_id = $producto['_tipo_vehiculo_id'];
            $vehiculo->vencimiento_soat = $producto['_vencimiento_soat'];
            $vehiculo->vencimiento_rtm  = $producto['_vencimiento_rtm'];
            
            if ($vehiculo->isDirty()) {
                $vehiculo->save();
                return true;
            }

            return false;

        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}