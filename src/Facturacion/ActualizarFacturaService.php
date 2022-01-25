<?php

namespace Src\Facturacion;

use Src\Facturacion\ValidacionFacturaService;
use App\Repositories\FacturasRepository;

class ActualizarFacturaService
{
    public $factura;

    public function __construct($factura)
    {
        $this->factura = $factura;
    }

    public function execute()
    {
        $this->validarDataFactura();
        
        return $this->salvarCambios();
    }

    protected function validarDataFactura()
    {
        $validator = ValidacionFacturaService::make($this->factura);
        
        if ($validator->fails()) {
            throw new \Exception('**' . json_encode($validator->errors), 400);
        }
    }

    protected function salvarCambios()
    {
        $factura = FacturasRepository::actualizarFactura($this->factura);
        return $factura;
    }
}