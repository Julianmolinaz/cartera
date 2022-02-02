<?php

namespace Src\Credito\Services;

use App\Repositories\SolicitudRepository as RepoSolicitud;
use App\Repositories\VentasRepository as RepoVenta;
use App\Repositories\VehiculosRepository as RepoVehiculo;
use App\Repositories\CreditoRepository as RepoCredito;

use DB;

class ActualizarSolicitudService
{
    public $data;
    public $errors = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function make()
    {
        $this->runValidations();

        DB::beginTransaction();

        try {
            $this->actualizarSolicitud();

            $this->actualizarVentas();

            $this->actualizarCredito();
            
            DB::commit();
            
            return $this->solicitud;
            
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    protected function runValidations()
    {
        /**
         * VALIDAR VENTAS
         */
        $validarVentas = ValidarVentasService::make($this->data['ventas']);

        if ($validarVentas->fails()) {
            $this->errors = array_merge($this->errors, $validarVentas->errors);
        }

        /**
         * VALIDAR SOLICITUD
         */

        $validarSolicitud = ValidarSolicitudService::make(
            $this->data['solicitud'],
            "Editar Solicitud"
        );

        if ($validarSolicitud->fails()) {
            $this->errors = array_merge($this->errors, $validarSolicitud->errors);
        } 

        /**
         * VALIDAR CRÉDITO
         */

        $validarCredito = ValidarCreditoService::make(
            $this->data['credito']
        );

        if ($validarSolicitud->fails()) {
            $this->errors = array_merge($this->errors, $validarCredito->errors);
        } 
        
        if ($this->errors) {
            throw new \Exception("**".json_encode($this->errors));
        }
    }


    protected function actualizarVentas()
    {
        foreach ($this->data['ventas'] as $venta) {
            $dataVenta = [
                'id' => $venta['id'],
                'producto_id' =>  $venta['producto']['producto_id'],
                'cantidad' => $venta['producto']['cantidad'],
                'precredito_id' => $this->solicitud->id
            ];

            if ($venta['producto']['con_vehiculo'] && $venta['vehiculo']) {
                if (isset($venta['vehiculo']['id'])) {
                    $vehiculo = $this->actualizarVehiculo($venta['vehiculo']);
                } else {
                    $vehiculo = $this->salvarVehiculo($venta['vehiculo']);
                }
                $dataVenta['vehiculo_id'] = $vehiculo->id;
            }

            $this->ventas[] = $this->actualizarVenta($dataVenta);
        }
    }

    protected function salvarVehiculo($vehiculo)
    {
        $vehiculo = RepoVehiculo::saveVehiculo($vehiculo);
        return $vehiculo;
    }

    protected function actualizarVehiculo($vehiculo)
    {
        if (RepoVehiculo::find($vehiculo['id'])) {
            $vehiculo_ = RepoVehiculo::updateVehiculo($vehiculo, $vehiculo['id']);
        } else {
            $vehiculo_ = RepoVehiculo::saveVehiculo($vehiculo);
        }

        return $vehiculo_;
    }

    protected function actualizarSolicitud()
    {
        $dataSolicitud = $this->data['solicitud'];

        $this->solicitud = RepoSolicitud::updateSolicitud($dataSolicitud, $dataSolicitud['id']);
    }

    protected function actualizarVenta($dataVenta)
    {
        if ($dataVenta['id']) {
            RepoVenta::updateVenta($dataVenta, $dataVenta['id']);
        } else {
            RepoVenta::saveVenta($dataVenta);
        }
    }

    protected function actualizarCredito()
    {
        if ($this->data['credito'] && $this->data['credito']['id']) {
            RepoCredito::updateCredito($this->data['credito'], $this->data['credito']['id']);
        }
    }
}