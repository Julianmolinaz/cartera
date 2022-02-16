<?php

namespace Src\Credito\Services;

use App\Repositories as Repo;

class SolicitudesPendientesService
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function execute()
    {
        $pendientes = $this->solicitudesPendientes();

        for ($i=0; $i < count($pendientes); $i++) { 
            if (! $this->tieneFacturas($pendientes[$i]->id)) {
                $pendientes[$i]->facturado = false;
            } else {
                $pendientes[$i]->facturado = true;
            }
        }

        return $pendientes;
    }

    public function solicitudesPendientes()
    {
        $pendientes = Repo\SolicitudRepository::pendientes(
            $this->userId
        );

        return $pendientes;
    }

    protected function tieneFacturas($solicitudId)
    {
        $facturas = Repo\FacturasRepository::facturasBySolicitud(
            $solicitudId
        );

        if ($facturas) return true;
        else return false;
    }
}