<?php

namespace Src\Credito\UseCases;

use App\Repositories\CreditoRepository;

class ValidarProcesosPendientesdUseCase
{
    private $clienteId;
    private $repoCredito;

    public function __construct($cliente_id)
    {
        $this->clienteId = $cliente_id;
        $this->repoCredito = new CreditoRepository();
    }

    /**
     * true si tiene procesos pendientes
     * false si no tiene procesos pendientes
     */

    public function execute()
    {
        if (
            $this->creditosNoCancelados() || 
            $this->solicitudesAprobadasNoActivadas() || 
            $this->solicitudesEnEstudio() 
        ) {
            return true;
        } else {
            return false;
        }
    }

    protected function creditosNoCancelados()
    {
        $creditoNoCancelado = $this->repoCredito->creditoActivoByCliente($this->clienteId);
        
        return !!$creditoNoCancelado;
    }

    protected function solicitudesAprobadasNoActivadas()
    {
        $solicitudAprovadaNoActiva = $this->repoCredito->solicitudesAprobadasNoActivas($this->clienteId);

        return !!$solicitudAprovadaNoActiva;
    }

    protected function solicitudesEnEstudio()
    {
        $solicitudEnEstudio = $this->repoCredito->solicitudesEnEstudio($this->clienteId);

        return !!$solicitudEnEstudio;
    }
}