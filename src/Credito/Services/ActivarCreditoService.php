<?php

namespace Src\Credito\Services;

use Carbon\Carbon;
use DB;

use App\Repositories as Repo;
use App\Http\Controllers as Ctrl;


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

    public static function make($solicitudId)
    {
        return new self($solicitudId);
    }

    protected function execute()
    {
        $this->getSolicitud();

        // VALIDACIONES

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
            $this->errors[] = "La solicitud aun no ha sido aprovada";
        }

        if ($this->solicitudesVigentes()) {
            $this->errors[] = "Existen solicitudes vigentes";
        }

        if ($this->errors) {
            throw new \Exception("**".json_encode($this->errors), 400);
        }

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

    protected function getSolicitud()
    {
        $this->solicitud = Repo\SolicitudRepository::find($this->solicitudId);
    }

    protected function validarPagoPorEstudio()
    {
        if (! $this->solicitud->estudio) return true;
        
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

    protected function generarFechaDePago()
    {
        $fecha_pago = Ctrl\calcularFecha(
            $this->solicitud->fecha,
            $this->solicitud->periodo, 
            1, 
            $this->solicitud->p_fecha, 
            $this->solicitud->s_fecha, 
            true
        );

        $ini = new Carbon($fecha_pago['fecha_ini']);
        $hoy = Carbon::now();

        if ($ini->diffInDays($hoy) > 7) {
            $fecha = $ini->format('Y-m-d');
        } else {
            $fecha = Ctrl\inv_fech($fecha_pago['fecha_fin']);
        }

        $fechaCobro = Repo\FechaCobrosRepository::saveFechaCobro([
            'credito_id' => $this->credito->id,
            'fecha_pago' => $fecha
        ]);
    }

}