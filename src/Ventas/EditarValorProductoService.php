<?php

namespace Src\Ventas;
use App\Repositories as Repo;

class EditarValorProductoService 
{
    public $valor;
    public $ventaId;

    public function __construct($valor, $ventaId)
    {
        $this->valor = $valor;
        $this->ventaId = $ventaId;
    }

    public function execute()
    {
        $this->validate();
        $this->updateValor();

    }

    protected function validate()
    {
        if (! $this->valor) {
            throw new \Exception("El valor del producto es requerido", 400);
        }
    }

    protected function updateValor()
    {
        Repo\VentasRepository::updateVenta(
            ["valor" => $this->valor],
            $this->ventaId
        );
    }
}