<?php

namespace Src\Credito\Services;

use App\Repositories\SolicitudRepository as RepoSolicitud;
use Validator;

class ValidarSolicitudService
{
    protected $data;
    protected $validator;
    public $errors = [];
    protected $mode;
    
    private function __construct($data, $mode)
    {
        $this->data = $data;
        $this->mode = $mode;
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

        $this->errors = array_merge(
            $this->errors, 
            castErrors($this->validator->errors())
        );

        $this->validateUniqueElements();
    }

    protected function validateUniqueElements()
    {
        $solicitudes = [];

        if ($this->mode === 'Crear Solicitud') {
            $solicitudes = RepoSolicitud::findByNumFact($this->data['num_fact']);
        } else if ($this->mode === 'Editar Solicitud') {
            $solicitudes = RepoSolicitud::findByNumFactDiffId(
                $this->data['num_fact'], $this->data['id']
            );
        }
            
        if ($solicitudes) 
            $this->errors[] = "El consecutivo ya existe";
    }

    protected function rules()
    {
        return [
            'fecha'             => 'required',
            'num_fact'          => 'required|alpha_num',
            'cartera_id'        => 'required',
            'aprobado'          => '',
            'vlr_fin'           => 'required',
            'funcionario_id'    => 'required',
            'cuota_inicial'     => 'required',
            'meses'             => 'required',
            'periodo'           => 'required',
            'cuotas'            => 'required',
            'vlr_cuota'         => 'required',
            'p_fecha'           => 'required',
            's_fecha'           => '',
            'estudio'           => 'required',
            'observaciones'     => '',
            'vlr_asistencia'    => ''
        ];
    }

    protected function messages()
    {
        return [
            'fecha.required'            => 'La Fecha de solicitud es requerida',
            'num_fact.required'         => 'El Número de Factura es requerido',
            'num_fact.unique'           => 'El Número de factura ya existe',
            'cartera.required'          => 'La cartera es requerida',
            'vlr_fin.required'          => 'El Costo del crédito es requerido',
            'meses.required'            => 'El # de Meses es requerido',
            'periodo.required'          => 'El Periodo es requerido',
            'estudio.required'          => 'El tipo de estudio es requerido',
            'vlr_cuota.required'        => 'El Valor de la Cuota es requerido',
            'p_fecha.required'          => 'La Fecha 1 es requerida',
            's_fecha.between'           => 'La Fecha 1 debe ser menor que la Fecha 2',
            'funcionario_id.required'   => 'El Vendedor es requerido',
        ];
    } 
    
    public function fails()
    {
        if ($this->errors) return true;
        return false;
    }
}