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

        $facturas = DB::table('ref_productos')
            ->join('precreditos','ref_productos.precredito_id','=','precreditos.id')
            ->join('productos','ref_productos.producto_id','=','productos.id')
            ->join('vehiculos','ref_productos.vehiculo_id','=','vehiculos.id')
            ->join('tipo_vehiculos','vehiculos.tipo_vehiculo_id','=','tipo_vehiculos.id')
            ->leftjoin('creditos','precreditos.id','=','creditos.precredito_id')
            ->join('clientes','precreditos.cliente_id','=','clientes.id')
            ->join('users','precreditos.user_create_id','=','users.id')
            ->join('terceros','ref_productos.proveedor_id','=','terceros.id')
            ->whereBetween('ref_productos.fecha_exp',[$ini, $end])
            ->whereIn('precreditos.cartera_id', [6, 32])
            ->where('precreditos.aprobado', 'Si')
            ->groupBy('precreditos.id')
            ->orderBy('ref_productos.fecha_exp')
            ->select(
                'precreditos.id as solicitud',
                'creditos.id as credito',
                'precreditos.vlr_fin as centro_costos',
                'precreditos.cuota_inicial as cuota_inicial',
                'ref_productos.num_fact',
                'ref_productos.nombre as producto',
                'ref_productos.fecha_exp',
                'ref_productos.costo',
                'ref_productos.iva',
                'ref_productos.otros',
                'ref_productos.expedido_a',
                'terceros.razon_social as proveedor',
                'terceros.num_doc as doc_proveedor',
                'vehiculos.placa',
                'clientes.nombre',
                'clientes.num_doc',
                'users.name',
                'ref_productos.observaciones',
                'precreditos.created_at',
                'creditos.valor_credito',

                )
            ->get();  

        return $facturas;
    }       

    public static function header()
    {
        return [
            'solicitud',	
            'credito',	
            'centro_costos',	
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
            'valor_credito',	
        ];
    }
}