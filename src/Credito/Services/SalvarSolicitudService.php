<?php

namespace Src\Credito\Services;
use Src\Credito\Services\ValidarVentasService;
use Src\Credito\Services\SalvarSolicitudService;
use App\Repositories\SolicitudRepository as RepoSolicitud;
use App\Repositories\VentasRepository as RepoVenta;
use App\Repositories\VehiculosRepository as RepoVehiculo;

use DB;

class SalvarSolicitudService
{
    public $data;
    protected $ventas;
    protected $solicitud;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function make()
    {
        $errors = [];

        $validarVentas = ValidarVentasService::make($this->data['ventas']);
        if ($validarVentas->fails()) $errors = array_merge($errors, $validarVentas->errors);

        $validarSolicitud = ValidarSolicitudService::make($this->data['solicitud'], "Crear Solicitud");
        if ($validarSolicitud->fails()) $errors = array_merge($errors, $validarSolicitud->errors);

        if ($errors) throw new \Exception('**'.json_encode($errors));

        DB::beginTransaction();

        try {
            $this->salvarSolicitud();
            $this->salvarVentas();
            
            DB::commit();
            
            return $this->solicitud;
            
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    protected function salvarVentas()
    {
        foreach ($this->data['ventas'] as $venta) {

            $dataVenta = [
                'producto_id' =>  $venta['producto']['producto_id'],
                'cantidad' => $venta['producto']['cantidad'],
                'precredito_id' => $this->solicitud->id,
                'created_by' => 1 // pendiente
            ];

            if ($venta['producto']['con_vehiculo']) {
                $vehiculo = RepoVehiculo::saveVehiculo($venta['vehiculo']);
                $dataVenta['vehiculo_id'] = $vehiculo->id;
            }

            $this->ventas[] = RepoVenta::saveVenta($dataVenta);
        }
    }

    protected function salvarSolicitud()
    {
        $dataSolicitud = $this->data['solicitud'];
        $dataSolicitud['user_create_id'] = 1; // pendiente
        $dataSolicitud['version'] = 3;

        $this->solicitud = RepoSolicitud::saveSolicitud($dataSolicitud);
    }
}