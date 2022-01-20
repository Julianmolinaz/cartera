<?php

namespace Src\Facturacion;

use Validator;

class ValidacionFacturaService
{

    public $factura;

    public function __construct($factura)
    {
        $this->factura = $factura;
    }

    public function execute()
    {
        
    }
}