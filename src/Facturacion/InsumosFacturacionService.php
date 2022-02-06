<?php

namespace Src\Facturacion;

use App\Repositories\TercerosQueryBuilderRepository;

class InsumosFacturacionService
{
    public $insumos;

    public function __construct() {
        $insumos = [
            "estados" => $this->getEstados(),
            "expedidoA" => $this->getExpedidoA(),
            "proveedores" => $this->getProveedores()
        ];

        $this->insumos = $insumos;
    }

    public static function make()
    {   
        return new self();
    }

    protected function getEstados() 
    {
        return getEnumValues2("invoices", "estado");
    }

    protected function getExpedidoA() 
    {
        return getEnumValues2("invoices", "expedido_a");
    }

    protected function getProveedores() 
    {
        $repo = new TercerosQueryBuilderRepository();
        return $repo->getProveedoresActivos();
    }
}