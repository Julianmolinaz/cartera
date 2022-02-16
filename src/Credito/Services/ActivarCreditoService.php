<?php

namespace Src\Credito\Services;

use Carbon\Carbon;
use DB;

use App\Repositories as Repo;
use App\Http\Controllers as Ctrl;
use Src\Utils\FechaDePago;  


class ActivarCreditoService
{
    public $solicitudId;
    public $dataComision;
    public $solicitud;
    public $errors = [];
    public $credito;

    private function __construct($dataComision)
    {
        $this->solicitudId = $dataComision['solicitudId'];
        $this->dataComision = $dataComision;
        $this->execute();
    }

    public static function make($dataComision)
    {
        return new self($dataComision);
    }

    protected function execute()
    {
        $this->getSolicitud();
        
        $this->validaciones();
        
        DB::beginTransaction();

        try {
            $this->activarCredito();
            $this->crearLog();
            $this->incrementarElNumeroDeCreditosDelCliente();
            $this->generarFechaDePago();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage(), 500);
        }
    }

    public function validaciones()
    {
        if (! $this->validarPagoPorEstudio() ) {
            $this->errors[] = "Se requiere el pago de estudio de crédito";
        }

        if (! $this->validarPagoPorCuotaInicial()) {
            $this->errors[] = "Se requiere el pago de cuota inicial";
        }

        if ($this->existeCreditoVigente()) {
            $this->errors[] = "Existen créditos vigentes para este cliente";
        }

        if ($this->solicitudNoAprobada()) {
            $this->errors[] = "La solicitud aun no ha sido aprobada";
        }

        if ($this->solicitudesVigentes()) {
            $this->errors[] = "Existen solicitudes vigentes";
        }

        if (!$this->facturacionExistente()) {
            $this->errors[] = "No existen facturas registradas para esta solicitud";
        }

        if ($this->errors) {
            throw new \Exception("**".json_encode($this->errors), 400);
        }
    }

    protected function getSolicitud()
    {
        $this->solicitud = Repo\SolicitudRepository::find($this->solicitudId);
    }

    protected function validarPagoPorEstudio()
    {
        if ($this->solicitud->estudio == 'Sin estudio') return true;
        
        $pagos = Repo\PagosSolicitudRepository::getPagosEstudioSolicitud($this->solicitudId);
            
        if (!$pagos) return false;
        
        return true;
    
    }

    protected function validarPagoPorCuotaInicial()
    {
        if (! $this->solicitud->cuota_inicial) return true;
        
        $pagos = Repo\PagosSolicitudRepository::getPagosInicialSolicitud($this->solicitudId);
            
        if (!$pagos) return false;
        
        return true;
    
    }

    protected function existeCreditoVigente()
    {
        $credito = Repo\CreditoRepository::findBySolicitud($this->solicitudId);

        return ($credito) ? true : false;
    }

    protected function solicitudNoAprobada()
    {
        if ($this->solicitud->aprobado == 'Si') return false;

        return true;
    }

    protected function solicitudesVigentes()
    {
        $solicitudes = Repo\SolicitudRepository::findSolicitudesActivasByCliente(
            $this->solicitud->cliente_id
        );

        return (count($solicitudes) > 1) ? true : false;
    }

    protected function activarCredito()
    {
        $this->credito = Repo\CreditoRepository::saveCredito($this->solicitud, $this->dataComision);
    }

    protected function crearLog()
    {
        saveLog(1,'crear','Se activa el crédito en cartera',1,'App\\Credito',$this->credito['id']);
    }

    protected function incrementarElNumeroDeCreditosDelCliente()
    {
        Repo\ClientesRepository::incrementarNumeroDeCreditos($this->solicitud->cliente_id);
    }

    /**
     * Se utiliza la fecha de la primera factura como pivote
     * para generar la fecha de pago inicial
     */

    protected function generarFechaDePago()
    {
        $fecha = $this->getFechaExpedicionPrimeraFactura();
        
        $fecha_ = FechaDePago::calcular(
            $fecha,
            $this->solicitud->periodo, 
            $this->solicitud->p_fecha,
            $this->solicitud->s_fecha
        );

        $fechaCobro = Repo\FechaCobrosRepository::saveFechaCobro([
            'credito_id' => $this->credito->id,
            'fecha_pago' => $fecha_
        ]);
    }

    protected function getFechaExpedicionPrimeraFactura()
    {
        $factura = Repo\FacturasRepository::firstBySolicitud(
            $this->solicitudId
        );
        return $factura->fecha_exp;
    }


    protected function facturacionExistente()
    {
        $facturas = Repo\FacturasRepository::facturasBySolicitud($this->solicitud->id);
    
        if ($facturas) return true;
        return false;
    }
}