<?php

namespace Src\Credito\Services;

use App\Repositories as Repo;

class ConsultarCreditoService
{
    public $data;
    public $credito;
    
    private function __construct($solicitudId)
    {
        $this->credito = $this->getCredito($solicitudId);

        $this->data = [
            'cliente' => $this->getCliente($solicitudId),
            'solicitud' => $this->getSolicitud($solicitudId),
            'ventas' => $this->getVentas($solicitudId),
            'meses' => ($this->credito) ? [] : $this->getMeses(),
            'anos' => ($this->credito) ? [] : $this->getAnos(),
            'credito' => $this->credito,
            'juridico' => $this->getJuridicos(),
            'prejuridico' => $this->getPrejuridicos(),
            'debe_pagos' => $this->getDebePagosParciales(),
            'total_pagos' => $this->getTotalPagosCredito(),
            'total_descuentos' => $this->getTotalDescuentosCredito(),
            'pagos_solicitud' => $this->getPagosSolicitud($solicitudId),
            'pagos_credito' => $this->getPagosCredito()
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
        $credito = Repo\CreditoRepository::findBySolicitud($solicitudId);
        return $credito;
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


    protected function getJuridicos()
    {
        if (!$this->credito) return [];

        $juridico = Repo\ExtrasRepository::getJuridicoDebeByCredito($this->credito->id);

        if (! $juridico) return ['total' => 0, 'debe' => 0];

        $pagoJuridico = Repo\ExtrasRepository::getPagosJuridicoDebe($this->credito->id);

        if ($pagoJuridico) return ['total' => $juridico->valor, 'debe' => $pagoJuridico->debe];

        return ['total' => $juridico->valor, 'debe' => $juridico->valor];
    }


    protected function getPrejuridicos()
    {
        if (!$this->credito) return [];

        $prejuridico = Repo\ExtrasRepository::getPrejuridicoDebeByCredito($this->credito->id);

        if (! $prejuridico) return ['total' => 0, 'debe' => 0];

        $pagoJuridico = Repo\ExtrasRepository::getPagosPrejuridicoDebe($this->credito->id);

        if ($pagoJuridico) return ['total' => $prejuridico->valor, 'debe' => $pagoJuridico->debe];

        return ['total' => $prejuridico->valor, 'debe' => $prejuridico->valor];
    }


    protected function getDebePagosParciales()
    {
        if (!$this->credito) return [];

        $pago = Repo\PagosCreditoRepository::cuotaParcialDebe($this->credito->id);

        return $pago ? $pago->debe : 0;
    }


    protected function getTotalPagosCredito()
    {
        if (!$this->credito) return [];

        $totalPagos = Repo\PagosCreditoRepository::totalPagosByCredito($this->credito->id);

        return $totalPagos ? $totalPagos : 0;
    }


    protected function getTotalDescuentosCredito()
    {
        if (!$this->credito) return [];

        $totalDescuentos = Repo\PagosCreditoRepository::totalDescuentosByCredito($this->credito->id);

        return $totalDescuentos ? $totalDescuentos : 0;
    }

    protected function getCliente($solicitudId)
    {
        $cliente = Repo\ClientesRepository::findBySolicitud($solicitudId);
        return $cliente;
    }


    protected function getPagosSolicitud($solicitudId)
    {    
        $pagos = Repo\PagosSolicitudRepository::getPagosBySolicitud($solicitudId);
        return $pagos;
    }


    protected function getPagosCredito()
    {
        $pagos = [];

        if ($this->credito) {
            $pagos = Repo\PagosCreditoRepository::pagosByCredito($this->credito->id);
        } 

        return $pagos;
    }
}