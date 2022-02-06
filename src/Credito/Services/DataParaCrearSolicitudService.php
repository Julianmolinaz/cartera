<?php

namespace Src\Credito\Services;

use Src\Credito\Services\InsumosVentasService;
use Src\Credito\Services\InsumosSolicitudService;
use Src\Credito\Services\InsumosCreditoService;

use App\Repositories as Repo;

class DataParaCrearSolicitudService
{

    protected $cliente_id;
    protected $credito_refinanciado_id;

    public function __construct($clienteId, $creditoRefinanciadoId = null)
    {
        $this->cliente_id = $clienteId;
        $this->credito_refinanciado_id = $creditoRefinanciadoId;
    }

    public function execute()
    {
        $info = (object)[
            'insumosVenta' => $this->getInsumosVentas(),
            'insumosSolicitud' => $this->getInsumosSolicitud(),
            'insumosCredito' => $this->getInsumosCredito(),
            'cliente' => $this->getCliente()
        ];

        return $info;
    }

    public function getInsumosVentas()
    {
        $insumos = new InsumosVentasService(
            new Repo\TercerosQueryBuilderRepository(),
            new Repo\TipoVehiculosQueryBuilderRepository()
        );

        return $insumos->execute();
    }

    public function getInsumosSolicitud()
    {
        $insumos = new InsumosSolicitudService();
        return  $insumos->execute();
    }

    public function getInsumosCredito()
    {
        $insumos = new InsumosCreditoService(
            $this->credito_refinanciado_id
        );
        return $insumos->execute();
    }

    public function getCliente()
    {
        $cliente = Repo\ClientesRepository::find($this->cliente_id);
        return $cliente;
    }
}