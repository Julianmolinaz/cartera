<?php

namespace Src\Vehiculo;

use Src\Vehiculo\ValidarVehiculo;
use App\Repositories as Repo;

class ActualizarVehiculo
{
    public $dataVehiculo;
    public $index;

    public function __construct($data, $index)
    {
        $this->dataVehiculo = $data;
        $this->index = $index;
    }

    public function execute()
    {
        $this->validation();
        $vehiculo = $this->updateVehiculo($this->dataVehiculo, $this->dataVehiculo['id']);

        return $vehiculo;
    }

    protected function validation()
    {
        new ValidarVehiculo($this->dataVehiculo, $this->index);
    }

    protected function updateVehiculo()
    {
        $vehiculo = Repo\VehiculosRepository::updateVehiculo(
            $this->dataVehiculo,
            $this->dataVehiculo['id']
        );

        return $vehiculo;
    }
}