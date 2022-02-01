<?php

namespace Src\Credito\Services;
use App\Repositories as Repo;
use Validator;

class ActualizarObservacionesService
{
    public $observaciones;
    public $solicitudId;

    public function __construct($observaciones, $solicitudId)
    {
        $this->observaciones = $observaciones;
        $this->solicitudId = $solicitudId;    
    }

    public function execute()
    {
        $solicitud = Repo\SolicitudRepository::updateSolicitud(
            ['observaciones' => $this->observaciones], 
            $this->solicitudId
        );

        return $solicitud;
    }
}