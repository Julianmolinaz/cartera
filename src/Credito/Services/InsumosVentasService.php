<?php

namespace Src\Credito\Services;
use DB;


class InsumosVentasService
{
    public function __construct()
    {

    }

    public function execute() 
    {
        return $this->struct();
    }

    private function struct()
    {
        return [ 
            'catalogo'                      => $this->getProductos(),
            'list_estados_ref_productos'    => $this->getEstadosInvoice(),
            'list_tipo_vehiculo'            => $this->getTipoVehiculo(),
            'list_expedido_a'               => $this->getExpedidoA(),
            'proveedores'                   => $this->getProveedores(),
        ];
    }

    private function getProductos()
    {
        $productos = DB::table('productos')
            ->select('nombre', 'id', 'con_invoice', 'con_vehiculo')
            ->where('estado',1)
            ->orderBy('nombre')
            ->get();
            
        return $productos;
    }

    private function getEstadosInvoice()
    {
        $list_estados_ref_productos = getEnumValues2('ref_productos','estado');

        return $list_estados_ref_productos;
    }

    private function getExpedidoA()
    {
        $list_expedido_a = getEnumValues2('ref_productos','expedido_a');

        return $list_expedido_a;
    }

    private function getProveedores()
    {
        $proveedores = DB::table('terceros')
            ->join('municipios','terceros.mun_id','=','municipios.id')
            ->select('terceros.id', 'razon_social as nombre','municipios.nombre as municipio')
            ->where('terceros.estado', 'Activo')
            ->orderBy('terceros.razon_social')
            ->get();

        return $proveedores;
    }

    private function getTipoVehiculo()
    {
        $list_tipo_vehiculo = DB::table('tipo_vehiculos')
            ->select('id', 'nombre')
            ->where('estado','Activo')
            ->orderBy('nombre')
            ->get();

        return $list_tipo_vehiculo;
    }
}