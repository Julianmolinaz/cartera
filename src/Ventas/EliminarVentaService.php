<?php

namespace Src\Ventas;

use App\Repositories as Repo;
use Exception;
use DB;

class EliminarVentaService
{
    private $ventaId;
    private $venta;

    public function __construct($ventaId)
    {
        $this->ventaId = $ventaId;
    }

    public function execute()
    {
        $this->getVenta();

        if (!$this->venta) throw new Exception("No existe la venta a eliminar", 400);

        if ($this->venta->factura_id) {
            throw new Exception("No se puede eliminar la venta, existen facturación registrada.", 400);
        }

        DB::beginTransaction();

        try {
            if ($this->venta->vehiculo_id) $this->destroyVehiculo();
        
            $this->destroyVenta();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception($e->getMessage().'.', 400);
        }
        
    }

    public function getVenta()
    {
        $this->venta = Repo\VentasRepository::findFull($this->ventaId);
    }

    public function destroyVehiculo()
    {
        Repo\VehiculosRepository::destroyVehiculo($this->venta->vehiculo_id);
    }

    public function destroyVenta()
    {
        Repo\VentasRepository::destroyVenta($this->ventaId);
    }
}