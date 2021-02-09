<?php

namespace App\Classes\Contabilidad\Reportes;
use \App\Http\Controllers as Ctrl;

use Exception;
use App as _;
use DB;

class FacturasProveedor
{
    protected $ini;                             
    protected $end;        
    protected $reporte = [];

    public function __construct($ini, $end)
    {
        $this->ini = $ini;
        $this->end = $end;

        $this->reporte[] = $this->header();
    }

    public function make()
    {        
        $proveedor = $this->getProveedores();
    }

    public function getProveedores()
    {
        return DB::table('ref_productos')
            ->join('productos','ref_productos.producto_id','=','productos.id')
            ->join('vehiculos','ref_productos.vehiculo_id','=','vehiculos.id')
            ->leftjoin('tipo_vehiculos','vehiculos.tipo_vehiculo_id','=','tipo_vehiculos.id')
            ->join('precreditos','ref_productos.precredito_id','=','precreditos.id')
            ->leftjoin('creditos','precreditos.id','=','creditos.precredito_id')
            ->join('clientes','precreditos.user_create_id','=','clientes.id')
            ->join('users','precreditos.cliente_id','=','users.id')
            ->join('terceros','ref_productos.proveedor_id','=','terceros.id')
            ->whereBetween('ref_productos.fecha_exp',[$this->ini, $this->end])
            ->where('precreditos.aprobado', 'Si')
            ->whereIn('precreditos.cartera_id', [6, 32])
            ->orderBy('ref_productos.fecha_exp')
            ->get();  
    }       

    public function struct()
    {
        return (object)[
            'solicitud'=>'',	
            'credito'=>'',	
            'centro de costos'=>'',	
            'valor cuota'=>'',	
            'cuota inicial'=>'',	
            'documento cliente'=>'',	
            'num_fact'=>'',	
            'producto'=>'',	
            'fecha_exp'=>'',	
            'costo'=>'',	
            'iva	otros'=>'',	
            'expedido_a'=>'',	
            'proveedor'=>'',	
            'placa'=>'',	
            'nombre'=>'',	
            'ejecutivo'=>'',	
            'observaciones'=>'',	
            'fecha solicitud'=>'',
        ];
    }


    public function header()
    {
        return [
            'solicitud',	
            'credito',	
            'centro de costos',	
            'valor cuota',	
            'cuota inicial',	
            'documento cliente',	
            'num_fact',	
            'producto',	
            'fecha_exp',	
            'costo',	
            'iva	otros',	
            'expedido_a',	
            'proveedor',	
            'placa',	
            'nombre',	
            'ejecutivo',	
            'observaciones',	
            'fecha solicitud',
        ];
    }
}