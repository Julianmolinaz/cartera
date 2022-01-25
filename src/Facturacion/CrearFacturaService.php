<?php

namespace Src\Facturacion;

use Src\Facturacion\ValidacionFacturaService;

use App\Repositories\FacturasRepository;

class CrearFacturaService
{
    public $factura;

    public function __construct($factura)
    {
        $this->factura = $factura;
    }

    public function execute()
    {
        $this->validarDataFactura();
        
        return $this->salvarFactura();
    }

    protected function validarDataFactura()
    {
        $validator = ValidacionFacturaService::make($this->factura);
        
        if ($validator->fails()) {
            throw new \Exception('**' . json_encode($validator->errors), 400);
        }
    }

    protected function salvarFactura()
    {
        $factura = FacturasRepository::saveFactura($this->factura);

        return $factura;
    }
}