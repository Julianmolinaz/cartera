<?php

namespace Src\Credito\Services;
use Validator;

class ValidarVentaService
{
    protected $data;
    protected $validator;

    /**
     * @param $status: 'create' || 'edit'
     * @param $mode: 
     */
    
    private function __construct($data, $mode)
    {
        $this->data = $data;
        $this->validate();
    }

    public static function make($data, $mode) 
    {
        return new self($data, $mode);
    } 
    
    protected function validate()
    {
        $this->validator = Validator::make(
            $this->data, 
            $this->rules(), 
            $this->messages()
        );
    }

    protected function rules()
    {
        $vehiculo_is_required = '';

        if ($this->vehiculoIsRequired()) {
            $vehiculo_is_required = 'required';
        }

        return [
            'cantidad'      => 'required',
            'producto_id'   => 'required',
            'vehiculo_id'   => $vehiculo_is_required  
        ];
    }

    protected function messages()
    {
        return [
            'cantidad'      => 'La cantidad es requerida',
            'producto_id'   => 'El producto es requerido',
            'vehiculo_id'   => 'El vehiculo es requerido'  
        ];
    }

    public function errors()
    {
        return $this->validator->errors();
    }

    public function fails()
    {
        return $this->validator->fails();
    }

    public function vehiculoIsRequired()
    {
        $productoId = $this->data['producto_id'];
        $producto = \DB::table('vehiculos')->where('id', $productoId)->first();

        if ($producto) {
            return $producto->con_vehiculo;
        }

        return false;
    }
}