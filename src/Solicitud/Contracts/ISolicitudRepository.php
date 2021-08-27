<?php

namespace Src\Solicitud\Contracs;

use Src\Domain\SolicitudEntity;

interface ISolicitudRepository
{
    public function save(SolicitudEntity $solicitudEntity);
}