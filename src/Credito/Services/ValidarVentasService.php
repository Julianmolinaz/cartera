<?php

namespace Src\Credito\Services;
use Validator;

class ValidarVentasService
{
    protected $ventas;
    public $errors = [];

    private function __construct($ventas)
    {
        $this->ventas = $ventas;

        $counter = 1;

        foreach ($this->ventas as $venta) {
            $this->validarProducto(
                $venta['producto'], $counter
            );

            if ($venta['producto']['con_vehiculo']) {
                $this->validarVehiculo($venta['vehiculo'], $counter);
            }
        
            $counter++;
        }
    }

    public static function make($ventas)
    {
        return new self($ventas);
    }

    public function fails()
    {
        if ($this->errors) return true;
        
        return false;
    }

    protected function validarProducto($producto, $counter)
    {
        $validator = Validator::make($producto, [
            'producto_id' => 'required',
            'cantidad' => 'required'
        ], [
            'producto_id.required' => "El producto id es requerido para el producto " . $counter ,
            'cantidad.required' => "La cantidad es requerida para el producto " . $counter
        ]);

        if ($validator->fails()) 
            $this->errors = array_merge($this->errors, castErrors($validator->errors()));
    }

    protected function validarVehiculo($vehiculo, $counter)
    {
        $validator = Validator::make($vehiculo, [
            'tipo_vehiculo_id' => "required",
            'placa' => 'required',
            'vencimiento_soat' => 'required',
            'vencimiento_rtm' => 'required',
            'modelo' => 'required',
            'cilindraje' => 'required',
        ], [
            'tipo_vehiculo_id.required' => "El tipo de vehículo es requerido para el producto $counter",
            'placa.required' => "La placa es requerida para el vehiculo $counter",
            'vencimiento_soat.required' => "El vencimiento del SOAT es requerido para el producto $counter",
            'vencimiento_rtm.required' => "El vencimiento del RTM es requerido para el producto $counter",
            'modelo.required' => "El modelo es requerido para el producto $counter",
            'cilindraje.required' => "El cilindraje es requerido para el producto $counter",
        ]);

        if ($validator->fails())
            $this->errors = array_merge($this->errors, castErrors($validator->errors()));
    }
}