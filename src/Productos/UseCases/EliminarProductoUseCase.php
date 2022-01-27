<?php

namespace Src\Productos\UseCases;

use App\Repositories\ProductoRepository;

class EliminarProductoUseCase 
{
    protected $repoProducto;
    protected $productoId;

    public function __construct($productoId)
    {
        $this->repoProducto = new ProductoRepository();
        $this->productoId = $productoId;
    }

    public function execute()
    {
        if ($this->existeVentasAsociadas() || $this->existenSolicitudesAsociadas()) {
            throw new \Exception(
                "No se puede eliminar el producto, existen ventas asociadas ",
                400
            ); 
        } 
        $this->destroyProducto();
    }

    private function existeVentasAsociadas()
    {
        return $this->repoProducto->seUtilizoEsteProducto($this->productoId);
    }

    private function existenSolicitudesAsociadas()
    {
        return $this->repoProducto->existenSolicitudesAsociadas($this->productoId);
    }

    private function destroyProducto()
    {
        $this->repoProducto->destroy($this->productoId);
    }
}