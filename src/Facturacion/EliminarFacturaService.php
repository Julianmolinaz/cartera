<?php

namespace Src\Facturacion;

use App\Repositories as Repo;

class EliminarFacturaService
{

    protected $facturaId;
    public $factura;

    public function __construct($facturaId)
    {
        $this->facturaId = $facturaId;
        $this->getFactura();
    }

    public function execute()
    {
        $this->validaciones();
        $this->eliminarFactura();
    }

    protected function validaciones()
    {
        if ($this->factura->estado === 'Aprobado') {
            throw new \Exception("No es posible eliminar la factura, se encuentra aprobada", 400);
        }
        if ($this->factura->estado === 'Pagado') {
            throw new \Exception("No es posible eliminar la factura, se encuentra pagada", 400);
        }
    }

    protected function getFactura()
    {
        $factura = Repo\FacturasRepository::find($this->facturaId);

        if ($factura)
            $this->factura = $factura;
        else 
            throw new \Exception("No se encontró la factura a eliminar", 400);
            
    }

    protected function eliminarFactura()
    {
        Repo\FacturasRepository::destroy($this->facturaId);
    }
}