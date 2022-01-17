<?php

namespace Src\Credito\Services;

use App\Repositories as Repo;

class ConsultarCreditoService
{
    public $data;
    
    private function __construct($solicitudId)
    {
        $credito = $this->getCredito($solicitudId);

        $this->data = [
            'solicitud' => $this->getSolicitud($solicitudId),
            'ventas' => $this->getVentas($solicitudId),
            'credito' => $credito,
            'meses' => ($credito) ? [] : $this->getMeses(),
            'anos' => ($credito) ? [] : $this->getAnos(),
        ];
    }

    public static function make($solicitudId)
    {
        return new self($solicitudId);
    }

    protected function getSolicitud($solicitudId) 
    {
        $solicitud = Repo\SolicitudRepository::findTotal($solicitudId);
        return $solicitud;
    }

    protected function getCredito($solicitudId)
    {
        return [];
    }

    /**
     * Retorna la venta con producto y vehiculo
     */
    protected function getVentas($solicitudId) {
        $ventas = Repo\VentasRepository::findBySolicitud($solicitudId);
        return $ventas;
    }

    protected function getMeses()
    {
        $currentMonth = currentMonth();

        $meses = [
            [
                'order' => "01",
                'nombre' => 'Enero',
                'checked' => ($currentMonth == "01") ? true : false
            ], [
                'order' => "02",
                'nombre' => 'Febrero',
                'checked' => ($currentMonth == "02") ? true : false
            ], [
                'order' => "03",
                'nombre' => 'Marzo',
                'checked' => ($currentMonth == "03") ? true : false
            ], [
                'order' => "04",
                'nombre' => 'Abril',
                'checked' => ($currentMonth == "04") ? true : false
            ], [
                'order' => "05",
                'nombre' => 'Mayo',
                'checked' => ($currentMonth == "05") ? true : false
            ], [
                'order' => "06",
                'nombre' => 'Junio',
                'checked' => ($currentMonth == "06") ? true : false
            ], [
                'order' => "07",
                'nombre' => 'Julio',
                'checked' => ($currentMonth == "07") ? true : false
            ], [
                'order' => "08",
                'nombre' => 'Agosto',
                'checked' => ($currentMonth == "08") ? true : false
            ], [
                'order' => "09",
                'nombre' => 'Septiembre',
                'checked' => ($currentMonth == "09") ? true : false
            ], [
                'order' => 10,
                'nombre' => 'Octubre',
                'checked' => ($currentMonth == "10") ? true : false
            ], [
                'order' => 11,
                'nombre' => 'Noviembre',
                'checked' => ($currentMonth == "11") ? true : false
            ], [
                'order' => 12,
                'nombre' => 'Diciembre',
                'checked' => ($currentMonth == "12") ? true : false
            ]
        ];

        return $meses;
    }

    protected function getAnos()
    {
        $currentYear = currentYear();

        return [
            [
                'nombre' => $currentYear - 1,
                'checked' => false
            ],[
                'nombre' => intval($currentYear),
                'checked' => true
            ]
        ];
    }
}