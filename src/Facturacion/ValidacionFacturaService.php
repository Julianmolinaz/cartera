<?php

namespace Src\Facturacion;

use Validator;
use App\Repositories\FacturasRepository;

class ValidacionFacturaService
{
    public $data;
    public $errors = [];
    private $validator;

    public function __construct($data)
    {
        $this->data = $data;
        $this->execute();
    }

    public static function make($data) 
    {
        return new self($data);
    }

    protected function execute()
    {
        $this->validator = Validator::make(
            $this->data,
            $this->rules(),
            $this->messages()
        );

        if ($this->validator->fails()) {
            $this->errors = array_merge(
                $this->errors,
                castErrors($this->validator->errors())
            );
        }

        if ($this->existFactura()) {
            $this->errors[] = "Ya existe este número de factura asignado.";
        }
    }

    private function rules()
    {
        $rules = [
            'estado' => 'required',
            'fecha_exp' => 'required',
            'costo' => 'required|numeric',
            'iva' => '',
            'num_fact' => 'required',
            'otros' => '',
            'expedido_a' => 'required',
            'observaciones' => '',
            'venta_id' => 'required',
            'proveedor_id' => 'required',
            'precredito_id' => 'required',
        ];

        return $rules;
    }

    private function messages()
    {
        $messages = [
            'estado.required' => 'El estado de la factura es requerido',
            'fecha_exp.required' => 'La fecha de expedición de la factura es requerido',
            'costo.required' => 'El costo de la factura es requerido',
            'costo.numeric' => 'El costo debe ser un valor numérico',
            'num_fact.required' => 'El número de factura es requerido',
            'expedido_a.required' => 'El expedido a es requerido en la factura',
            'venta_id.required' => 'El identificador de la venta es requerido en la factura',
            'proveedor_id.required' => 'El identificador del proveedor es requerido en la factura',
            'precredito_id.required' => 'El identificador de la solicitud es requerido en la factura',
        ];

        return $messages;
    }

    private function existFactura()
    {
        if (isset($this->data['id'])) {
            $factura = FacturasRepository::findByNumFacturaWithId(
                $this->data['num_fact'], $this->data['id']
            );
        } else {
            $factura = FacturasRepository::findByNumFactura(
                $this->data['num_fact']
            );
        }

        if ($factura) return true;

        return false;
    }

    public function fails()
    {
        if ($this->errors) return true;
        return false;
    }
}