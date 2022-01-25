<?php

namespace Src\Credito\Services;

use Src\Credito\Services\SalvarSolicitudService;
use App\Http\Controllers as Ctrl;
use App\Repositories as Repo;
use Src\Utils\FechaDePago;  
use Src\Libs\Time;  
use Carbon\Carbon;
use DB;

class ActivarCreditoRefinanciadoService
{
    private $solicitud;
    private $cliente;
    private $credito;
    private $dataSolicitud;
    private $creditoRefinanciadoId;
    public $errors;

    public function __construct($dataSolicitud, $creditoRefinanciadoId)
    {
        $this->dataSolicitud = $dataSolicitud;
        $this->creditoRefinanciadoId = $creditoRefinanciadoId;
        $this->credito = Repo\CreditoRepository::find($creditoRefinanciadoId);
        $this->getSolicitud();
        $this->getCliente();
    }

    public function execute()
    {
        // VALIDACIONES

        if ($this->existeCreditoVigente()) {
            $this->errors[] = "Existen créditos vigentes para este cliente";
        }

        if ($this->solicitudesVigentes()) {
            $this->errors[] = "Existen solicitudes vigentes";
        }

        if ($this->errors) {
            throw new \Exception("**".json_encode($this->errors), 400);
        }

        DB::beginTransaction();

        try {

            $this->actualizarCreditoAntiguo();

            $nuevaSolicitud = $this->crearSolicitud();

            $nuevoCredito = $this->crearCredito($nuevaSolicitud);

            $this->crearLog($nuevoCredito->id);

            $this->generarFechaDePago($nuevoCredito->id);

            DB::commit();

            return $nuevaSolicitud;
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage(), 400);
        }
    }

    protected function getSolicitud()
    {
        $this->solicitud = Repo\SolicitudRepository::find($this->credito->precredito_id);
    }

    private function getCliente()
    {
        $this->cliente = Repo\ClientesRepository::find($this->solicitud->cliente_id);
    }

    protected function existeCreditoVigente()
    {
        $creditos = Repo\CreditoRepository::findByClienteExcept(
            $this->solicitud->cliente_id,
            $this->creditoRefinanciadoId
        );

        if ($creditos) return true;
        return false;
    }


    protected function solicitudesVigentes()
    {
        $solicitudes = Repo\SolicitudRepository::findSolicitudesActivasByCliente(
            $this->solicitud->cliente_id
        );
    }

    private function actualizarCreditoAntiguo()
    {
        $dataCredito = [
            'estado' => "Cancelado por refinanciacion"
        ];

        $this->credito = Repo\CreditoRepository::updateCredito(
            $dataCredito,
            $this->creditoRefinanciadoId
        );
    }

    private function crearSolicitud()
    {
        $this->dataSolicitud['solicitud']['aprobado'] = 'Si';

        $useCase = new SalvarSolicitudService($this->dataSolicitud);
        $solicitud = $useCase->make();

        return $solicitud;
    }

    private function crearCredito($nuevaSolicitud)
    {
        $dataComision = [
            'mes' => $this->credito->mes,
            'anio' => $this->credito->anio
        ];

        $nuevoCredito = Repo\CreditoRepository::saveCreditoRefinanciado(
            $nuevaSolicitud,
            $dataComision,
            $this->creditoRefinanciadoId
        );

        return $nuevoCredito;
    }

    private function generarFechaDePago($nuevoCreditoId)
    {
        $now = Time::now();

        $fecha = FechaDePago::calcular(
            $now->format('Y-m-d'),
            $this->solicitud->periodo,
            $this->solicitud->p_fecha,
            $this->solicitud->s_fecha,
        );

        $fechaCobro = Repo\FechaCobrosRepository::saveFechaCobro([
            'credito_id' => $nuevoCreditoId,
            'fecha_pago' => $fecha
        ]);
    }

    private function crearLog($nuevoCreditoId)
    {
        saveLog(
            1,
            'crear',
            'Se refinancia el crédito ' . $nuevoCreditoId,
            1,
            'App\\Credito',
            $nuevoCreditoId
        );
    }

}