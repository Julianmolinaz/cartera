<?php

namespace App\Classes\Contabilidad\Reportes;
use \App\Http\Controllers as Ctrl;

use Carbon\Carbon;
use Exception;
use App as _;
use DB;

class Terceros
{
    protected $ini;                             
    protected $end;
    protected $tercero;
    protected $reporte = [];

    public function __construct($ini, $end)
    {
        $this->ini = $ini;
        $this->end = $end;

        $this->reporte[] = $this->header();
    }

    public function make()
    {      
        
        $terceros = $this->getTerceros();

        foreach ($terceros as $tercero) {

            $this->tercero = $tercero;

            
            $struct = $this->struct();
            
            $this->reporte[] = (array)$struct;
            
        }
        // dd($this->reporte);
        return $this->reporte;
    }

    public function getTerceros()
    {
        
        return DB::table('precreditos')
            ->join('clientes','precreditos.cliente_id','=','clientes.id')
            ->join('creditos','precreditos.id','=','creditos.precredito_id')
            ->join('municipios','clientes.municipio_id','=','municipios.id')
            ->whereBetween('precreditos.created_at',[$this->ini, $this->end])
            ->whereIn('precreditos.cartera_id', [6, 32])
            ->select(
                    DB::raw('CONCAT(clientes.primer_nombre," ",clientes.segundo_nombre) as nombres'),
                    DB::raw('CONCAT(clientes.primer_apellido," ",clientes.segundo_apellido) as apellidos'),
                    'clientes.*',
                    'municipios.codigo_municipio','municipios.codigo_departamento'
                    )        
            ->get();  

    }

    public function struct()
    {
        return (object)[
            'Identificación'                            =>  $this->tercero->num_doc,
            'Dígito de verificación'                    =>  '',
            'Código Sucursal'                           =>  '',
            'Tipo identificación'                       =>  $this->tercero->tipo_doc,
            'Tipo'                                      =>  '',
            'Razón social'                              =>  '',
            'Nombres del tercero'                       =>  $this->tercero->nombres,
            'Apellidos del tercero'                     =>  $this->tercero->apellidos,
            'Nombre comercial'                          =>  '',
            'Dirección'                                 =>  $this->tercero->direccion,
            'Código pais'                               =>  'Co',
            'Código departamento/estado'                =>  $this->tercero->codigo_departamento,
            'Código ciudad'                             =>  $this->tercero->codigo_municipio,
            'Indicativo teléfono principal'             =>  '',    
            'Teléfono principal'                        =>  $this->tercero->movil,  
            'Extensión teléfono principal'              =>  '',  
            'Tipo de regimen IVA'                       =>  '',  
            'Código Responsabilidad fiscal'             =>  '',
            'Código Postal'                             =>  '',  
            'Nombre contacto principal'                 =>  $this->tercero->nombres,  
            'Apellidos contacto principal'              =>  $this->tercero->apellidos,  
            'Indicativo teléfono contacto principal'    =>  '',  
            'Teléfono contacto principal'               =>  $this->tercero->movil,  
            'Extensión teléfono contacto principal'     =>  '',  
            'Correo electrónico contacto principal'     =>  $this->tercero->email,  
            'Identificación del cobrador'               =>  '',  
            'Identificación del vendedor'               =>  '',  
            'Otros'                                     =>  '',  
            'Clientes'                                  =>  '',  
            'Proveedor'                                 =>  '',  
            'Estado'                                    =>  'Activo'
        ];
    }

    public function header() 
    {
        return [
            'Identificación',
            'Dígito de verificación',
            'Código Sucursal',
            'Tipo identificación',
            'Tipo',
            'Razón social',
            'Nombres del tercero',
            'Apellidos del tercero',
            'Nombre comercial',
            'Dirección',
            'Código pais',
            'Código departamento/estado',
            'Código ciudad',
            'Indicativo teléfono principal',
            'Teléfono principal',  
            'Extensión teléfono principal',  
            'Tipo de regimen IVA',  
            'Código Responsabilidad fiscal',  
            'Código Postal',  
            'Nombre contacto principal',  
            'Apellidos contacto principal',  
            'Indicativo teléfono contacto principal',  
            'Teléfono contacto principal',  
            'Extensión teléfono contacto principal',  
            'Correo electrónico contacto principal',  
            'Identificación del cobrador',  
            'Identificación del vendedor',  
            'Otros',  
            'Clientes',  
            'Proveedor',  
            'Teñéfono',  
        ];
    }
}