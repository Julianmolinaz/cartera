<?php

namespace Src\Credito\Services;
use Validator;

class ValidarCreditoService
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
            "id"                => "",
            "estado"            => "required",
            "valor_credito"     => "required",
            "saldo"             => "required",
            "cuotas_faltantes"  => "required",
            "rendimiento"       => "required",
            "saldo_favor"       => "required",
            "castigada"         => "",
            "fecha_pago"        => "required",
            "mes"               => "required",
            "anio"              => "required",
            "recordatorio"      => ""
        ];
    }

    protected function messages()
    {
        return [
            "id"                         => "",
            "estado.required"            => "El estado es requerido",
            "valor_credito.required"     => "El valor del creditos es requerido",
            "saldo.required"             => "Elsaldo es requerido",
            "cuotas_faltantes.required"  => "Las cuotas faltantes son requeridas",
            "rendimiento.required"       => "El rendimiento es requerido",
            "saldo_favor.required"       => "El saldo a favor es requerido",
            "castigada.required"         => "",
            "fecha_pago.required"        => "La fecha de pago es requerida",
            "mes.required"               => "El mes de referencia es requerido",
            "anio.required"              => "El año de referencia es requerido",
            "recordatorio.required"      => ""
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

