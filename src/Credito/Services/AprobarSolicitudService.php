<?php

namespace Src\Credito\Services;
use App\Repositories as Repo;

class AprobarSolicitudService
{
    public $opcion;
    public $solicitudId;

    public function __construct($opcion, $solicitudId)
    {
        $this->opcion = $opcion;
        $this->getSolicitud($solicitudId);
    }

    public function execute()
    {
        $this->validarOpcion();
        $this->validarSiExistenCreditoAsociado();


        $solicitud = Repo\SolicitudRepository::updateAprobacion(
            $this->opcion, $this->solicitud->id
        );

        return $solicitud;
    }

    public function validarOpcion()
    {
        $enumValues = getEnumValues2('precreditos', 'aprobado');
        $flag = false;

        foreach($enumValues as $value) {
            if ($value === $this->opcion) {
                $flag = true;
            }
        }

        if (!$flag) {
            throw new \Exception("No existe una opción para editar el estado de aprobación", 500); 
        }
    }

    public function getSolicitud($solicitudId)
    {
        $this->solicitud = Repo\SolicitudRepository::find($solicitudId);
    }

    public function validarSiExistenCreditoAsociado()
    {
        $credito = Repo\CreditoRepository::findBySolicitud($this->solicitud->id);

        if ($credito) {
            throw new \Exception(
                "No se puede editar el estado de aprobación, para editarlo debe hacerlo desde el boton de editar solicitud.", 
                400
            );
        }
    }
}