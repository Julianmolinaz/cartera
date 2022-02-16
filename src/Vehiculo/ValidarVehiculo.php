<?php

namespace Src\Vehiculo;
use Validator;

class ValidarVehiculo
{
    public $validator;
    protected $counter;

    public function __construct($dataVehiculo, $counter)
    {
        $this->counter = $counter;
        $this->validation($dataVehiculo);
    }

    protected function validation($dataVehiculo)
    {
        $this->validator = Validator::make(
            $dataVehiculo,
            $this->rules(),
            $this->messages($this->counter)
        );

        if ($this->validator->fails()) {
            throw new \Exception(
                "**" .json_encode(castErrors($this->validator->errors())), 
                400
            );            
        }
    }

    protected function rules()
    {
        $rules = [
            'tipo_vehiculo_id' => "required",
            'placa' => 'required',
            'vencimiento_soat' => 'required',
            'vencimiento_rtm' => 'required',
            'modelo' => 'required',
            'cilindraje' => 'required',
        ];

        return $rules;

    }

    protected function messages($counter)
    {
        $messages = [
            'tipo_vehiculo_id.required' => "El tipo de vehículo es requerido para el producto $counter",
            'placa.required' => "La placa es requerida para el vehiculo del producto $counter",
            'vencimiento_soat.required' => "El vencimiento del SOAT es requerido para el producto $counter",
            'vencimiento_rtm.required' => "El vencimiento del RTM es requerido para el producto $counter",
            'modelo.required' => "El modelo es requerido para el producto $counter",
            'cilindraje.required' => "El cilindraje es requerido para el producto $counter",
        ];

        return $messages;
    }
}