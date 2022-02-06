<?php

namespace Src\Credito\Services;
use Validator;

class ValidarInvoiceService
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
        return [
            'expedido_a'    => 'required',
            'proveedor_id'  => 'required',
            'costo'         => 'required',
            'num_fact'      => 'required|alpha_num',
            'fecha_exp'     => 'required',
            'iva'           => 'required',
            'otros'         => 'required',
            'estado'        => 'required'
        ];
    }

    protected function messages()
    {
        return [
            'expedido_a'    => 'El campo expedido a es requerido', 
            'proveedor_id'  => 'El proveedor es requerido',
            'costo'         => 'El costo es requerido',
            'num_fact'      => 'El numero de factura es requerido',
            'fecha_exp'     => 'La fecha de expedición es requerida',
            'iva'           => 'El IVA es requerido',
            'otros'         => 'El campo otros es requerido',
            'estado'        => 'El estado es requerido'
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
}