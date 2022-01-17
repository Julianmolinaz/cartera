<?php

namespace Src\Credito;

class ActivarCredito
{
    public $solicitudId;

    private function __construct($solicitudId)
    {
        $this->solicitudId = $solicitudId;
        $this->execute();    
    }

    public static function make($solicitudId)
    {
        return new self($solicitudId);
    }

    protected function execute()
    {
        // validaciones
            // Validación pago de estudio

            // Validación pago de cuota inicial

            // Validación de crédito vigentes

            // Validación de solicitud aprobada

            // Validación de solicitudes vigentes

        // activación
            // Crear crédito
    }

    public function requierePagosPorEstudio()
    {

    }
}