<?php

namespace Src\Certificados\PazySalvo;

use Src\Libs\Time;
use App\Repositories as Repo;

class GetDataPazySalvoService
{
    public $data;
    public $credito;
    public $solicitud;
    public $cliente;
    public $fecha;

    public function __construct($creditoId, $tipo)
    {
        $this->execute($creditoId, $tipo);
    }

    public static function make($creditoId, $tipo)
    {
        return new self($creditoId, $tipo);
    }

    protected function execute($creditoId, $tipo)
    {
        $this->fecha = Time::now()->format("d-m-Y");
        $this->credito = Repo\CreditoRepository::find($creditoId);
        
        $this->solicitud = Repo\SolicitudRepository::find($this->credito->precredito_id);
        $this->cliente = Repo\ClientesRepository::find($this->solicitud->cliente_id);
        
        
        if ($tipo === 'cliente') {
            $this->data = $this->getDataCliente();
        } else {
            $this->data = $this->getDataCodeudor();
        }

        return $this->data;
    }

    protected function getDataCliente()
    {
        return (object)[
            'fecha' => $this->fecha,
            'nombre' => $this->cliente->nombre,
            'tipo_documento' => $this->cliente->tipo_doc,
            'numero_documento' => $this->cliente->num_doc,
            'credito_id' => $this->credito->id
        ];
    }

    protected function getDataCodeudor()
    {
        $codeudor = Repo\CodeudoresRepository::findByCliente($this->cliente->id);

        return (object)[
            'fecha' => $this->fecha,
            'nombre' => $codeudor->nombre,
            'tipo_documento' => $codeudor->tipo_doc,
            'numero_documento' => $codeudor->num_doc,
            'credito_id' => $this->credito->id
        ];
    }

}