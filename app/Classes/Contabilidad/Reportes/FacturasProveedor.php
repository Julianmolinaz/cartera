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
    protected $factura = [];      
    protected $facturas = [];      
    protected $reporte = [];
    protected $reporFactura;
    protected $precredito;

    public static function getFacturas($ini, $end)
    {
        return DB::table('ref_productos')
            ->join('precreditos','ref_productos.precredito_id','=','precreditos.id')
            ->join('productos','ref_productos.producto_id','=','productos.id')
            ->join('vehiculos','ref_productos.vehiculo_id','=','vehiculos.id')
            ->join('tipo_vehiculos','vehiculos.tipo_vehiculo_id','=','tipo_vehiculos.id')
            ->leftjoin('creditos','precreditos.id','=','creditos.precredito_id')
            ->join('clientes','precreditos.cliente_id','=','clientes.id')
            ->join('users','precreditos.user_create_id','=','users.id')
            ->leftjoin('terceros','ref_productos.proveedor_id','=','terceros.id')
            ->whereBetween('ref_productos.fecha_exp',[$ini, $end])
            ->whereIn('precreditos.cartera_id', [6, 32])
            ->where('precreditos.aprobado', 'Si')
            ->groupBy('precreditos.id')
            ->orderBy('ref_productos.fecha_exp')
            ->select('ref_productos.id',
                    'ref_productos.estado',
                    'ref_productos.fecha_exp',
                    'ref_productos.num_fact',
                    'ref_productos.costo',
                    'ref_productos.iva',
                    'ref_productos.otros',
                    'ref_productos.expedido_a',
                    'ref_productos.observaciones',
                    'creditos.id as credito',
                    'precreditos.id as solicitud',
                    'precreditos.vlr_fin',
                    'precreditos.cuota_inicial',
                    'precreditos.created_at',
                    'terceros.razon_social',
                    'terceros.num_doc as doc',
                    'productos.nombre as producto',
                    'vehiculos.placa',
                    'tipo_vehiculos.nombre',
                    'clientes.num_doc',
                    'clientes.nombre',
                    'users.id',
                    'users.name')
            ->get();  
    }       

    public function struct()
    {
        return (object)[
            'solicitud'=>$this->factura->precredito_id,	
            'credito'=>'',
            'centro_costos'=>'',	
            'valor_cuota'=>'',	
            'cuota_inicial'=>'',	
            'num_fact'=>'',
            'producto'=>'',	
            'fecha_exp'=>'',	
            'costo'=>'',	
            'iva'=>'',	
            'otros'=>'',	
            'expedido_a'=>'',	
            'proveedor'=>'',	
            'doc_proveedor'=>'',	
            'placa'=>'',	
            'nombre_cliente'=>'',	
            'doc_cliente'=>'',	
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
            'centro_costos',	
            'valor_cuota',	
            'cuota_inicial',	
            'num_fact',	
            'producto',	
            'fecha_exp',	
            'costo',	
            'iva',	
            'otros',	
            'expedido_a',	
            'proveedor',
            'doc_proveedor',
            'placa',	
            'nombre_cliente',	
            'doc_cliente',	
            'ejecutivo',	
            'observaciones',	
            'fecha_solicitud',
        ];
    }
}