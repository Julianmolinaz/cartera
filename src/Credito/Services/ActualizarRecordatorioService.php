<?php

namespace Src\Credito\Services;
use App\Repositories as Repo;
use Validator;

class ActualizarRecordatorioService
{
    public $recordatorio;
    public $creditoId;

    public function __construct($recordatorio, $creditoId)
    {
        $this->recordatorio = $recordatorio;
        $this->creditoId = $creditoId;    
    }

    public function execute()
    {
        $credito = Repo\CreditoRepository::updateCredito(
            ['recordatorio' => $this->recordatorio], 
            $this->creditoId
        );

        return $credito;
    }
}