<?php

namespace Src\Credito\Services;
use App\Repositories as Repo;
use Validator;

class ActualizarFechaPagoService
{
    public $fechaPago;
    public $creditoId;

    public function __construct($request)
    {
        $this->setData($request);
    }

    protected function setData($request) 
    {
        $validator = $this->validacion($request);

        if ($validator->fails()) {
            throw new \Exception(
                '**' . json_encode(castErrors($validator->errors())),
                400
            );
        }

        $this->fechaPago = $request['fechaPago'];
        $this->creditoId = $request['creditoId'];
    }

    public function validacion($request)
    {
        $validator = Validator::make($request, [
            'fechaPago' => 'required',
            'creditoId' => 'required'
        ], [
            'fechaPago.required' => 'La fecha de pago es requerida',
            'creditoId.required' => 'El id del crédito es requerido'
        ]);

        return $validator;
    }

    public function execute()
    {
        $fechaCobro = Repo\FechaCobrosRepository::updateByCredito(
            $this->fechaPago, 
            $this->creditoId
        );

        return $fechaCobro;
    }
}