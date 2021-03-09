<?php

namespace App\Classes\Contabilidad\Reportes;
use Exception;

class ConsolidadoComprobantesPago
{
    public $clientes;
    public $reporte;
    public $factura;
    public $facturas_cliente;
    public $reporte_final = [];
    
    public function __construct($reporte)
    {
        $this->reporte = $reporte;
        $this->clientes = [];
    }

    public function make()
    {

        foreach ($this->reporte as $factura) {

            $this->factura = $factura;
            $doc = $this->factura['iden_tercero'];
            set_time_limit(400);
            
            if ( array_key_exists($doc, $this->clientes)) {
                
                $flat = false;

                for ($i=0; $i < count($this->clientes[$doc]); $i++) { 

                    if ( $this->clientes[$doc][$i]['cod_cuenta'] == $this->factura['cod_cuenta']) {

                        if ($this->clientes[$doc][$i]['debito'] && $this->factura['debito']) {
                            
                            $this->clientes[$doc][$i]['debito'] += $this->factura['debito'];
                            $this->clientes[$doc][$i]['descripcion'] = $this->factura['descripcion'];
                            $this->clientes[$doc][$i]['fecha_elab'] = $this->factura['fecha_elab'];
                            $flat = true;
                        } else if ($this->clientes[$doc][$i]['credito'] && $this->factura['credito']) {
                            
                            $this->clientes[$doc][$i]['credito'] += $this->factura['credito'];
                            $this->clientes[$doc][$i]['descripcion'] = $this->factura['descripcion'];
                            $this->clientes[$doc][$i]['fecha_elab'] = $this->factura['fecha_elab'];
                            $flat = true;
                        } 
                        // else {
                        //     throw new Exception('No existen coincidencias '.$this->factura['descripcion'],400);
                        // }
                    }
                }

                if (!$flat) {
                    $this->clientes[$doc][] = $this->factura;
                }
            } else {
                $this->clientes[$this->factura['iden_tercero']][] = $this->factura; 
            }
        }

        $count = 1;
        foreach ($this->clientes as $cliente) {

            for ($i=0; $i < count($cliente); $i++) { 
                $cliente[$i]['cons_comp'] = $count;
            }

            $count++;

            $this->reporte_final = array_merge($this->reporte_final, $cliente);
        }

        return $this->reporte_final;
    }

    public function buscarSimilares() 
    {

        for ($i=0; $i < count($this->factura_cliente); $i++) { 
            
            if ($this->factura_cliente[$i]['cod_cuenta'] == $this->factura['cod_cuenta']) {
                if ($this->factura_cliente[$i]['debito'] && $this->factura['debito']) {
                    $this->factura_cliente[$i]['debito'] += $this->factura['debito'];
                } else if ($this->factura_cliente[$i]['credito'] && $this->factura['credito']) {
                    $this->factura_cliente[$i]['credito'] += $this->factura['credito'];
                } else {
                    throw Exception('No existen coincidencias '.$this->factura['descripcion'],400);
                }
            }
        }
    }

}