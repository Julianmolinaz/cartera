<?php

namespace Src\Solicitud\Infrasctructure;

use Src\Solicitud\Contracts\ISolicitudRepository;
use Src\Solicitud\Domain\Entities\SolicitudEntity;
use App\Precredito;

class EloquentSolicitudRepository implements ISolicitudRepository
{
    public function save(SolicitudEntity $solicitudEntity)
    {
        $newSolicitud = new Precredito($solicitudEntity);
        $newSolicitud->user_create_id = 1;
        $newSolicitud->save();

        return $newSolicitud;
    }
}