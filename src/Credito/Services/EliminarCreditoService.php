<?php

namespace Src\Credito\Services;

use App\Repositories as Repo;
use DB;

class EliminarCreditoService
{
    protected $creditoId;

    public function __construct($creditoId)
    {
        $this->creditoId = $creditoId;
    }

    public function execute()
    {
        DB::beginTransaction();

        try {
            $this->eliminarFechaPagos();
            $this->eliminarCredito();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage(), 400);
        } 
    }

    protected function eliminarCredito()
    {
        Repo\CreditoRepository::delete($this->creditoId);
    }

    protected function eliminarFechaPagos()
    {
        Repo\FechaCobrosRepository::deleteByCredito($this->creditoId);
    }
}