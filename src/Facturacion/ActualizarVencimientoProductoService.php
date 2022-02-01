<?php

namespace Src\Facturacion;

use App\Repositories as Repo;
use Src\Libs\Time;

class ActualizarVencimientoProductoService
{

    protected $facturaId;
    protected $factura;
    protected $venta;
    protected $listaVentas;

    public function __construct($facturaId)
    {
        $this->facturaId = $facturaId;
    }

    public function execute()
    {
        $this->factura = $this->getFactura();

        if (!$this->factura) throw new \Exception("No existe la factura", 400);

        $this->venta = $this->getVenta();

        if (!$this->venta) throw new \Exception("No existe ventas asociadas", 400);

        $this->listaVentas = $this->getVentas();

        $this->actualizarVencimientos();
    }

    protected function actualizarVencimientos()
    {
        if ($this->venta->producto_con_vehiculo && $this->venta->vehiculo_id) {

            foreach ($this->listaVentas as $itemVenta) {

                if ($itemVenta->vehiculo_placa == $this->venta->vehiculo_placa) {

                    $date = Time::create($this->factura->fecha_exp)
                        ->addYear()
                        ->format("Y-m-d");

                    if ($this->venta->producto_id == 1) {
                        Repo\VehiculosRepository::updateVehiculo(
                            [ 'vencimiento_rtm' => $date ], 
                            $itemVenta->vehiculo_id
                        );
                    } else if ($this->venta->producto_id == 2) {
                        Repo\VehiculosRepository::updateVehiculo(
                            [ 'vencimiento_soat' => $date ],
                            $itemVenta->vehiculo_id
                        );
                    }
                }
            }
        }
    }

    protected function getFactura()
    {
        $factura = Repo\FacturasRepository::find($this->facturaId);
        return $factura;
    }

    protected function getVenta()
    {
        $venta = Repo\VentasRepository::findFull($this->factura->venta_id);

        return $venta;
    }

    protected function getVentas()
    {
        $listaVentas = Repo\VentasRepository::listFullBySolicitud($this->factura->precredito_id);
        return $listaVentas;
    }
}