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
        
        return DB::table('clientes')
            ->join('precreditos','clientes.id', '=', 'precreditos.cliente_id')
            ->join('municipios','clientes.municipio_id','=','municipios.id')
            // ->whereBetween('precreditos.created_at',[$this->ini, $this->end])
            ->whereIn('precreditos.cartera_id', [6, 32])
            ->whereIn('clientes.num_doc', $this->docTerceros()) // Terceros especificos para crear.
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

    public function docTerceros()
    {
        return [
            7712926,
            10117638,
            10182699,
            11224013,
            11313372,
            11383739,
            11383739,
            12205256,
            12205256,
            13218134,
            14012490,
            14231394,
            14575588,
            14884463,
            14896876,
            16926520,
            16934611,
            17339720,
            17339720,
            17673180,
            17673180,
            26428595,
            28057422,
            28057422,
            28678567,
            28678567,
            30385876,
            30415685,
            30415685,
            30521354,
            30521354,
            36152151,
            36152151,
            36181061,
            36181082,
            52190348,
            52190348,
            52887406,
            52887406,
            65829665,
            65829665,
            79222934,
            79306345,
            79532834,
            79808209,
            86081253,
            86081253,
            93134850,
            93350696,
            93366259,
            93395044,
            93395044,
            93413557,
            94389530,
            1000214408,
            1000214408,
            1003812289,
            1003812289,
            1006490660,
            1007353697,
            1007353697,
            1007599775,
            1007599775,
            1007808353,
            1007808353,
            1007849888,
            1016034124,
            1016034124,
            1060591060,
            1069722095,
            1069734839,
            1070596969,
            1070596969,
            1075215582,
            1075233628,
            1075233628,
            1075239524,
            1075253456,
            1075280431,
            1075306975,
            1077144885,
            1077144885,
            1083912828,
            1088245933,
            1088260854,
            1088282571,
            1094893692,
            1094893692,
            1094912549,
            1094912549,
            1095839446,
            1100950363,
            1100950363,
            1104184979,
            1106394652,
            1106785260,
            1106785260,
            1110061681,
            1110061681,
            1110234798,
            1110234798,
            1110579438,
            1110579438,
            1110593157,
            1110593157,
            1113041266,
            1113041266,
            1115090040,
            1115090040,
            1115090040,
            1115090040,
            1116156104,
            1116156104,
            1116156972,
            1116236106,
            1118201632,
            1121873406,
            1121918485,
            1121918485,
            1234641633	

        ];
    }
}