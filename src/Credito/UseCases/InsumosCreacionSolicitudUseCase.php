<?php

namespace Src\Credito\UseCases;

use Src\Credito\Services\InsumosVentasService;
use Src\Credito\Services\InsumosSolicitudService;
use Src\Credito\Services\InsumosCreditoService;

class InsumosCreacionSolicitudUseCase
{
    public function execute()
    {
            return [
                'insumosVenta' => $this->getInsumosVenta(),
                'insumosCredito' => $this->getInsumosCredito(),
                'insumosSolicitud' => $this->getInsumosSolicitud()
            ];
    }

    private function getInsumosVenta()
    {
        $service = new InsumosVentasService();
        $insumos = $service->execute();
        return $insumos;
    }

    private function getInsumosSolicitud()
    {
        $service = new InsumosSolicitudService();
        $insumos = $service->execute();
        return $insumos;
    }

    private function getInsumosCredito()
    {
        $service = new InsumosCreditoService();
        $insumos = $service->execute();
        return $insumos;
    }
}
