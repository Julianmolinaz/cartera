<?php

namespace App\Classes\Reportes;
use \App\Http\Controllers as Ctrl;

use Carbon\Carbon;
use App\Cliente;
use Exception;
use App as _;
use DB;

class ReferenciaBancolombia
{
    
    protected $reporte = [];
    protected $fecha_vencimiento;
    protected $empresa;
    protected $nit_empresa;
    protected $codigo_convenio;
    protected $secuencia_envio;
    protected $contingencia;

    public function __construct()
    {
        $this->fecha_vencimiento = '20251231';

        $this->empresa = 'INVERSIONES GORA SAS';
        $this->nit_empresa = 900975741;
        $this->codigo_convenio = 88686;
	$this->contingencia = '123456789';
        $this->secuencia_envio = 'A'; // cambiar secuencia de envio si se corrige o reemplaza el archivo enviado
    }

    public function make()
    {
        $clientes = $this->getClientes();

        $this->reporte[] = $this->registroControl();
        $this->reporte[] = $this->contingencia();

        foreach ($clientes as $cliente) {
   
            $estructura = $this->structRegistroDetalle();
            
            $estructura->tipo_registro                  = Ctrl\cast_number(6, 1,'right');
            $estructura->nit_pagador                    = Ctrl\cast_number($cliente->num_doc, 13,'right');
            $estructura->nombre_pagador                 = Ctrl\cast_string(strtoupper(CTRL\sanear_string($cliente->nombre)), 20);
            $estructura->banco_cuenta_pagador           = Ctrl\cast_number(0, 9,'right');
            $estructura->numero_cuenta_debitar          = Ctrl\cast_number(0, 17,'right');
            $estructura->tipo_transaccion               = Ctrl\cast_number(0, 2,'right');
            $estructura->valor_transacción              = Ctrl\cast_number(0, 17,'right');
            $estructura->indicador_validación_nit       = Ctrl\cast_string('N', 1);
            $estructura->referencia1                    = Ctrl\cast_string(Ctrl\cast_number($cliente->num_doc, 13,'right'), 30);
            $estructura->referencia2                    = Ctrl\cast_string('', 30,'right');
            $estructura->fecha_vencimiento_aplicación   = Ctrl\cast_string($this->fecha_vencimiento, 8,'right');
            $estructura->periodos_facturados            = Ctrl\cast_number(0, 2,'right');
            $estructura->ciclo                          = Ctrl\cast_string('', 3);
            $estructura->reservado                      = Ctrl\cast_string('', 17);
            
            $this->reporte[] =  $estructura;
        }
        
        $this->reporte[0]['numero_registros'] = Ctrl\cast_number(count($this->reporte) - 1, 8,'right');
	return $this->reporte;

    }

    public function registroControl() 
    {
        $now = Carbon::now()->toDateString();
        $now = str_replace('-','',$now);
    
        return [
            'tipo_registro'                 => 1,
            'nit_entidad_recaudadora'       => Ctrl\cast_number($this->nit_empresa, 13,'right'),
            'nombre_entidad_recaudadora'    => Ctrl\cast_string($this->empresa, 20),
            'codigo_convenio'               => Ctrl\cast_number($this->codigo_convenio, 15,'right'),
            'fecha_transmision_archivo'     => $now,
            'secuencia_envio'               => $this->secuencia_envio,
            'fecha_aplicación_vencimiento'  => $this->fecha_vencimiento,//validar fehca
            'numero_registros'              => Ctrl\cast_number(1, 8,'right'),
            'valor_total_transacciones'     => Ctrl\cast_number(0, 17,'right'),
            'reservado'                     => Ctrl\cast_string('', 79),
        ];
    }

    function contingencia()
    {
        $estructura = $this->structRegistroDetalle();

        $estructura->tipo_registro                  = Ctrl\cast_number(6, 1,'right');
        $estructura->nit_pagador                    = Ctrl\cast_number($this->contingencia, 13,'right');
        $estructura->nombre_pagador                 = Ctrl\cast_string('CONTINGENCIA', 20);
        $estructura->banco_cuenta_pagador           = Ctrl\cast_number(0, 9,'right');
        $estructura->numero_cuenta_debitar          = Ctrl\cast_number(0, 17,'right');
        $estructura->tipo_transaccion               = Ctrl\cast_number(0, 2,'right');
        $estructura->valor_transacción              = Ctrl\cast_number(0, 17,'right');
        $estructura->indicador_validación_nit       = Ctrl\cast_string('N', 1);
        $estructura->referencia1                    = Ctrl\cast_string(Ctrl\cast_number($this->contingencia, 13,'right'), 30);
        $estructura->referencia2                    = Ctrl\cast_string('', 30,'right');
        $estructura->fecha_vencimiento_aplicación   = Ctrl\cast_string($this->fecha_vencimiento, 8,'right');
        $estructura->periodos_facturados            = Ctrl\cast_number(0, 2,'right');
        $estructura->ciclo                          = Ctrl\cast_string('', 3);
        $estructura->reservado                      = Ctrl\cast_string('', 17);

        return $estructura;
    }

    function structRegistroDetalle()
    {
        return (object) [
            'tipo_registro'                 => '',
            'nit_pagador'                   => '',
            'nombre_pagador'                => '',
            'banco_cuenta_pagador'          => '',
            'numero_cuenta_debitar'         => '',
            'tipo_transaccion'              => '',
            'valor_transacción'             => '',
            'indicador_validación_nit'      => '',
            'referencia1'                   => '',
            'referencia2'                   => '',
            'fecha_vencimiento_aplicación'  => '',
            'periodos_facturados'           => '',
            'ciclo'                         => '',
            'reservado'                     => '',
        ];
    }

    public function getClientes()
    {
        $clientes = DB::table('clientes')
            ->join('precreditos','clientes.id', '=', 'precreditos.cliente_id')
            ->join('creditos','precreditos.id', '=', 'creditos.precredito_id')
            ->whereIn('creditos.estado', ['Al dia','Mora','Prejuridico','Juridico'])
            ->groupBy('clientes.id')
            ->get();

        return $clientes;
    }
}
