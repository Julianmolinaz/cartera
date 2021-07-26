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
    }

    /**
     * @param boolean $header: true: con header, false: sin header
     */

    public function make($header)
    {      

        if ($header) 
            $this->reporte[] = $this->header();

        $terceros = $this->getTerceros();

        foreach ($terceros as $tercero) {

            $this->tercero = $tercero;

            
            $struct = $this->struct();
            
            $this->reporte[] = (array)$struct;
            
        }

        return $this->reporte;
    }

    public function getTerceros()
    {
        
        return DB::table('clientes')
            ->join('precreditos','clientes.id', '=', 'precreditos.cliente_id')
            ->join('municipios','clientes.municipio_id','=','municipios.id')
            ->whereBetween('precreditos.created_at',[$this->ini, $this->end])
            ->whereIn('precreditos.cartera_id', [6, 32])
            // ->whereIn('clientes.num_doc', $this->docTerceros()) // Terceros especificos para crear.
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
            'identificacion'                    =>  $this->tercero->num_doc,
            'digito_verificacion'               =>  '',
            'codigo_sucursal'                   =>  '',
            'tipo_identificacion'               =>  $this->tercero->tipo_doc,
            'tipo'                              =>  '',
            'razon_social'                      =>  '',
            'nombre_tercero'                    =>  $this->tercero->nombres,
            'apellidos_tercero'                 =>  $this->tercero->apellidos,
            'nombre_comercial'                  =>  '',
            'direccion'                         =>  $this->tercero->direccion,
            'codigo_pais'                       =>  'Co',
            'codigo_depto'                      =>  $this->tercero->codigo_departamento,
            'codigo_ciudad'                     =>  $this->tercero->codigo_municipio,
            'indicativo_tel_principal'          =>  '',    
            'tel_principal'                     =>  $this->tercero->movil,  
            'ext_tel_principal'                 =>  '',  
            'tipo_regimen_iva'                  =>  '',  
            'codigo_responsabilidad_fiscal'     =>  '',
            'codigo_postal'                     =>  '',  
            'nombre_contacto_principal'         =>  $this->tercero->nombres,  
            'apellidos_contacto_principal'      =>  $this->tercero->apellidos,  
            'indicativo_tel_contacto_principal' =>  '',  
            'tel_contacto_principal'            =>  $this->tercero->movil,  
            'ext_tel_contacto_principal'        =>  '',  
            'correo_contacto_principal'         =>  $this->tercero->email,  
            'identificacion_cobrador'           =>  '',  
            'identificacion_vendedor'           =>  '',  
            'otros'                             =>  '',  
            'clientes'                          =>  '',  
            'proveedor'                         =>  '',  
            'estado'                            =>  'Activo'
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

    public function docTerceros()
    {
        return [
	

        ];
    }
}