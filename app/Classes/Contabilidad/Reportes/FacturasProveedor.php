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

    public function __construct($ini, $end)
    {
        $this->ini = $ini;
        $this->end = $end;

        $this->reporte[] = $this->header();
    }

    public function make()
    {    
        $ids_precreditos = $this->getPrecreditos();   

        foreach ($ids_precreditos as $id_precredito) {
            
            $this->precredito = _\Precredito::find($id_precredito->id);
            
            foreach ($this->precredito->ref_productos as $factura) {
                
                $this->factura = $factura;
                
                if ($this->factura) {

                    $this->reporFactura = [];
                    
                    $struct = $this->struct();
                    $this->reporFactura[] = (array)$struct;
                    dd($struct);
                }
            }  
        }
        // dd($this->reporte);
        return $this->reporte;
    }

    public function getPrecreditos()
    {
        return DB::table('ref_productos')
            ->join('precreditos','ref_productos.precredito_id','=','precreditos.id')
            ->whereBetween('ref_productos.fecha_exp',[$this->ini, $this->end])
            ->whereIn('precreditos.cartera_id', [6, 32])
            ->where('precreditos.aprobado', 'Si')
            ->select('ref_productos.precredito_id as id')
            ->groupBy('precreditos.id')
            ->orderBy('ref_productos.fecha_exp')
            ->get(); 
    }       

    public function struct()
    {
        return (object)[
            'solicitud'=>$this->precredito->id,	
            'credito'=>'',
            'centro_costos'=>$this->precredito->vlr_fin,	
            'valor_cuota'=>$this->precredito->vlr_cuota,	
            'cuota_inicial'=>$this->precredito->cuota_inicial,	
            'num_fact'=>$this->factura->num_fact,
            'producto'=>'',	
            'fecha_exp'=>$this->factura->fecha_exp,	
            'costo'=>$this->factura->costo,	
            'iva'=>$this->factura->iva,	
            'otros'=>$this->factura->otros,	
            'expedido_a'=>$this->factura->expedido_a,	
            'proveedor'=>'',	
            'doc_proveedor'=>'',	
            'placa'=>'',	
            'nombre_cliente'=>'',	
            'doc_cliente'=>'',	
            'ejecutivo'=>'',	
            'observaciones'=>'',	
            'fecha solicitud'=>$this->precredito->created_at,
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