<?php

namespace Src\Credito\Services;

use App\Repositories\Contratos;
use DB;


class InsumosVentasService
{
    protected $repoTerceros;
    protected $repoTipoVehiculos;


    public function __construct(
        Contratos\ITerceros $repoTerceros,
        Contratos\ITipoVehiculos $repoTipoVehiculos
    ){
        $this->repoTerceros = $repoTerceros;
        $this->repoTipoVehiculos = $repoTipoVehiculos;
    }

    public function execute() 
    {
        return $this->struct();
    }

    private function struct()
    {
        return [ 
            'catalogo'                      => $this->getProductos(),
            'list_tipo_vehiculo'            => $this->getTipoVehiculo(),
            'list_expedido_a'               => $this->getExpedidoA(),
            'proveedores'                   => $this->getProveedores(),
        ];
    }

    private function getProductos()
    {
        $productos = DB::table('productos')
            // ->select('nombre', 'id', 'con_vehiculo')
            ->where('estado', 1)
            ->orderBy('nombre')
            ->get();
            
        return $productos;
    }

    private function getExpedidoA()
    {
        $list_expedido_a = getEnumValues2('ref_productos','expedido_a');

        return $list_expedido_a;
    }

    private function getProveedores()
    {
        return $this->repoTerceros->getProveedoresActivos();
    }

    private function getTipoVehiculo()
    {
        return $this->repoTipoVehiculos->getTipoVehiculosActivos();
    }
}