<?php

namespace Src\Credito\Services;
use App\Repositories as Repo;

class ReglasPreviasCreacionSolicitudService
{
    public $clienteId;
    public $errors = [];
    
    public function __construct($clienteId)
    {
        $this->clienteId = $clienteId;
        $this->execute();
    }

    public static function make($clienteId)
    {
        return new self($clienteId);
    }

    private function execute()
    {
        if ($this->existenSolicitudesActivas()) {
            $this->errors[] = "Existen solicitudes vigentes.";
        } 

        if ($this->existenCreditosActivos()) {
            $this->errors[] = "Existen créditos vigentes.";
        }

        if ($this->errors) {
            throw new \Exception("**" . json_encode($this->errors), 400);
        }
    }

    private function existenSolicitudesActivas()
    {
        $solicitudes = Repo\SolicitudRepository::findSolicitudesActivasByCliente(
            $this->clienteId
        );

        return ($solicitudes) ? true : false;
    }

    private function existenCreditosActivos()
    {
        $repoCredito = new Repo\CreditoRepository();
        $creditos = $repoCredito->creditoActivoByCliente($this->clienteId);

        return ($creditos) ? true : false;
    }

}