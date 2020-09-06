<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->delete();

        // SIMULADOR

        \DB::table('permissions')->insert([
            'category' => 'Simulador',
            'name' => 'simular',
            'display_name' => 'Simulador',
            'description' => 'Permite calcular el valor de la cuota',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // CLIENTES

        \DB::table('permissions')->insert([
            'category' => 'Clientes',
            'name' => 'consultar_clientes',
            'display_name' => 'Consultar clientes',
            'description' => 'Permite listar y ver la información detallada de los clientes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Clientes',
            'name' => 'crear_clientes',
            'display_name' => 'Crear cliente',
            'description' => 'Permite crear clientes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Clientes',
            'name' => 'editar_clientes',
            'display_name' => 'Editar cliente',
            'description' => 'Permite editar los clientes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Clientes',
            'name' => 'eliminar_clientes',
            'display_name' => 'Eliminar clientes',
            'description' => 'Permite eliminar los clientes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Oficios

        \DB::table('permissions')->insert([
            'category' => 'Oficios',
            'name' => 'crear_editar_oficios',
            'display_name' => 'Crear y editar oficios',
            'description' => 'Permite crear y editar los oficios que se asignan a los clientes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Oficios',
            'name' => 'eliminar_oficios',
            'display_name' => 'Eliminar oficios',
            'description' => 'Permite eliminar un oficio',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Documentos

        \DB::table('permissions')->insert([
            'category' => 'Clientes',
            'name' => 'borrar_documentos',
            'display_name' => 'Borrar documentacion',
            'description' => 'Permite borrar documentos del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

     
        // CALL CENTER

        \DB::table('permissions')->insert([
            'category' => 'CallCenter',
            'name' => 'exportar_todo',
            'display_name' => 'Exportar todos clientes',
            'description' => 'Permite exportar todos los archivos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*


        \DB::table('permissions')->insert([
            'category' => 'CallCenter',
            'name' => 'exportar_sucursal',
            'display_name' => 'Exportar clientes por sucursal',
            'description' => 'Permite exportar todos los creditos por sucursal',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'CallCenter',
            'name' => 'consultar',
            'display_name' => 'Consultar todos los listados',
            'description' => 'Permite listar todos los creditos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'CallCenter',
            'name' => 'registro_llamada',
            'display_name' => 'Registro de llamada',
            'description' => 'Permite registrar llamadas CallCenter',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        // CREDITOS

        \DB::table('permissions')->insert([
            'category' => 'Creditos',
            'name' => 'consultar_creditos',
            'display_name' => 'Consultar creditos',
            'description' => 'Permite listar y ver los creditos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Creditos',
            'name' => 'crear_creditos',
            'display_name' => 'Crear crédito',
            'description' => 'Permite crear créditos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        //
        \DB::table('permissions')->insert([
            'category' => 'Pre/Juridicos',
            'name' => 'ver_seguimiento_proceso_prejuridico',
            'display_name' => 'Consultar el seguimeinto a un proceso pre/jurídico',
            'description' => 'Permite consultar el seguimeinto a un proceso pre/jurídico',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

         \DB::table('permissions')->insert([
            'category' => 'Pre/Juridicos',
            'name' => 'crear_seguimiento_proceso_prejuridico',
            'display_name' => 'Crear el seguimeinto a un proceso pre/jurídico',
            'description' => 'Permite crear el seguimeinto a un proceso pre/jurídico',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*


        \DB::table('permissions')->insert([
            'category' => 'Creditos',
            'name' => 'editar_creditos',
            'display_name' => 'Editar credito',
            'description' => 'Permite editar la informacion del credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Creditos',
            'name' => 'eliminar_credito',
            'display_name' => 'Eliminar credito',
            'description' => 'Permite eliminar el credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Creditos',
            'name' => 'refinanciar_creditos',
            'display_name' => 'Refinanciar credito',
            'description' => 'Permite listar y refinanciar los creditos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Creditos',
            'name' => 'exportar_creditos',
            'display_name' => 'Exportar todos los creditos',
            'description' => 'Permite exportar rodos los creditos xls',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*


        \DB::table('permissions')->insert([
            'category' => 'Creditos',
            'name' => 'llamar_creditos',
            'display_name' => 'Llamar credito',
            'description' => 'Permite registrar llamada al cliente relacionado al crédito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        // SOLICITUDES

        \DB::table('permissions')->insert([
            'category' => 'Solicitudes',
            'name' => 'consultar_solicitudes',
            'display_name' => 'Consultar solicitud',
            'description' => 'Permite listar y ver solicitudes de crédito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        \DB::table('permissions')->insert([
            'category' => 'Solicitudes',
            'name' => 'crear_solicitudes',
            'display_name' => 'Crear solicitud',
            'description' => 'Permite crear varias solicitudes a un mismo cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Solicitudes',
            'name' => 'editar_solicitudes',
            'display_name' => 'Editar solicitud',
            'description' => 'Permite editar la solicitud',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Solicitudes',
            'name' => 'aprobar_solicitudes',
            'display_name' => 'Aprobar solicitudes',
            'description' => 'Permite cambiar el estado de la solicitud a aprobado, negado, cliente  desistió, etc',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        \DB::table('permissions')->insert([
            'category' => 'Solicitudes',
            'name' => 'valores_iniciales',
            'display_name' => 'Registrar pago a solicitud',
            'description' => 'Permite realizar los pagos a una solicitud de crédito como iniciales y estudios',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // 

        \DB::table('permissions')->insert([
            'category' => 'Solicitudes',
            'name' => 'anular_pago_solicitud',
            'display_name' => 'Anular pago de Solicitud',
            'description' => 'Permite anular el pago realizado a una Solicitud',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

     
        \DB::table('permissions')->insert([
            'category' => 'Solicitudes',
            'name' => 'exportar_solicitudes',
            'display_name' => 'Exportar',
            'description' => 'Permite exportar todas las solicitudes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        

        // CANCELADOS

        \DB::table('permissions')->insert([
            'category' => 'Cancelados',
            'name' => 'consultar_cancelados',
            'display_name' => 'Consultar créditos cancelados',
            'description' => 'Permite listar y consultar los créditos cancelados',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    

        // SANCIONES

        \DB::table('permissions')->insert([
            'category' => 'Sanciones',
            'name' => 'consultar_sanciones',
            'display_name' => 'Consultar Sanciones',
            'description' => 'Permite consultar sanciones diarias',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Sanciones',
            'name' => 'gestionar_sanciones',
            'display_name' => 'Gestionar Sanciones',
            'description' => 'Permite crear y exonerar sanciones diarias',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // ESTUDIOS

        \DB::table('permissions')->insert([
            'category' => 'Estudio',
            'name' => 'consultar_estudio',
            'display_name' => 'Consultar Estudio',
            'description' => 'Permite consultar estudio del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*        


        \DB::table('permissions')->insert([
            'category' => 'estudio',
            'name' => 'crear_estudios',
            'display_name' => 'Crear Estudio',
            'description' => 'Permite crear y editar un estudio de crédito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*     
        
        \DB::table('permissions')->insert([
            'category' => 'estudio',
            'name' => 'crear_referencias',
            'display_name' => 'Crear referencias',
            'description' => 'Permite crear y editar referencias del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*      
 

        // OTROS INGRESOS

        \DB::table('permissions')->insert([
            'category' => 'Otros ingresos',
            'name' => 'registrar_otros_ingresos',
            'display_name' => 'Registrar otros ingresos',
            'description' => 'Permite agregar el pago o abono de otros ingresos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        // PAGO A UN CREDITO

        \DB::table('permissions')->insert([
            'category' => 'Pago credito',
            'name' => 'hacer_pago',
            'display_name' => "Hacer pago de credito",
            'description' => 'Permite crear el pago o abono de un credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        
        \DB::table('permissions')->insert([
            'category' => 'Pago credito',
            'name' => 'ver_pagos_credito',
            'display_name' => 'Consultar el pago de un recibo',
            'description' => 'Permite ver el pago o abono de un credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Pago credito',
            'name' => 'imprimir_pago_credito',
            'display_name' => 'Imprimir recibo de pago de un credito',
            'description' => 'Permite imprimir pago o abono de un credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Pago credito',
            'name' => 'anular_pago_credito',
            'display_name' => 'Anular pago de un credito',
            'description' => 'Permite anular el recibo de un pago o abono de un credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Pago credito',
            'name' => 'listar_pagos_anulados',
            'display_name' => 'Listar pago creditos anulados',
            'description' => 'Permite listar el pago o abono de un credito anulado',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        /**
         * ADMINISTRATIVO
         */

        // EGRESOSOS

        \DB::table('permissions')->insert([
            'category' => 'Egresos',
            'name' => 'consultar_egresos',
            'display_name' => 'Consultar Egresos',
            'description' => 'Permite consultar egresos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Egresos',
            'name' => 'crear_egresos',
            'display_name' => 'Crear Egresos',
            'description' => 'Permite crear egresos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Egresos',
            'name' => 'eliminar_egresos',
            'display_name' => 'Eliminar Egresos',
            'description' => 'Permite eliminar egresos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Egresos',
            'name' => 'exportar_egresos',
            'display_name' => 'Exportar Egresos',
            'description' => 'Permite exportar egresos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // PROVEEDORES

        \DB::table('permissions')->insert([
            'category' => 'Egresos',
            'name' => 'ver_proveedores',
            'display_name' => 'Ver Proveedores',
            'description' => 'Permite ver proveedores',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Egresos',
            'name' => 'crear_proveedor',
            'display_name' => 'Crear Proveedor',
            'description' => 'Permite crear proveedor',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        \DB::table('permissions')->insert([
            'category' => 'Egresos',
            'name' => 'editar_proveedor',
            'display_name' => 'Editar Proveedor',
            'description' => 'Permite editar proveedor',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // MULTAS

        \DB::table('permissions')->insert([
            'category' => 'Pre/Juridicos',
            'name' => 'consultar_multas',
            'display_name' => 'Consultar Pre/Juridicos',
            'description' => 'Permite consultar y listar multas por Prejurídicos y Juridicos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Pre/Juridicos',
            'name' => 'exportar_PreJuridicos',
            'display_name' => 'Exportar Pre/Juridicos',
            'description' => 'Permite exportar Pre/Juridicos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*
        

        \DB::table('permissions')->insert([
            'category' => 'Pre/Juridicos',
            'name' => 'editar_PreJuridicos',
            'display_name' => 'Editar Pre/Juridicos',
            'description' => 'Permite editar Pre/Juridicos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Pre/Juridicos',
            'name' => 'crear_PreJuridicos',
            'display_name' => 'Crear Pre/Juridicos',
            'description' => 'Permite crear Pre/Juridicos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        // REPORTES

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'generar_reporte',
            'display_name' => 'Genera todos los reportes',
            'description' => 'Permite generar todos los reportes administrativos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'auditoria_sistema',
            'display_name' => 'Auditoria del Sistema',
            'description' => 'Permite generar reporte para Auditoria del Sistema',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'ver_caja',
            'display_name' => 'Ver Caja',
            'description' => 'Permite ver caja',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'cartera_castigada',
            'display_name' => 'Cartera Castigada',
            'description' => 'Permite generar reporte para Cartera Castigada',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'call_center',
            'display_name' => 'Call Center',
            'description' => 'Permite generar reporte para Call Center',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'egresos',
            'display_name' => 'Egresos',
            'description' => 'Permite generar reporte para Egresos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'financiero_operativo',
            'display_name' => 'Financiero operativo',
            'description' => 'Permite generar reporte para Financiero operativo',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'general',
            'display_name' => 'General',
            'description' => 'Permite generar reporte para General',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'general_carteras',
            'display_name' => 'General por Carteras',
            'description' => 'Permite generar reporte para General por Carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'general_funcionario',
            'display_name' => 'General por Funcionario',
            'description' => 'Permite generar reporte para General por Funcionario',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'historial_venta_creditos',
            'display_name' => 'Historial Venta de Creditos',
            'description' => 'Permite generar reporte para Historial Venta de Creditos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'informe_carteras',
            'display_name' => 'Informe Cartera',
            'description' => 'Permite generar reporte para Informe Cartera',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'morosos',
            'display_name' => 'Morosos',
            'description' => 'Permite generar reporte para Morosos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'reporte_datacredito',
            'display_name' => 'Reporte Datacredito',
            'description' => 'Permite generar reporte para Reporte Datacredito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'marcar_cancelados',
            'display_name' => 'Reporte Procredito',
            'description' => 'Permite generar reporte para Reporte Procredito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'reporte_datacredito_asistimotos',
            'display_name' => 'Reporte Datacredito Asistimotos',
            'description' => 'Permite generar reporte para Reporte Datacredito Asistimotos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'reporte datacredito',
            'display_name' => 'Reporte Datacredito',
            'description' => 'Permite generar reporte para Reporte Datacredito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'venta_creditos',
            'display_name' => 'Venta de Creditos',
            'description' => 'Permite generar reporte para Venta de Creditos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Reportes',
            'name' => 'venta_credito_asesor',
            'display_name' => 'Venta de Creditos por Asesor',
            'description' => 'Permite generar reporte para Venta de Creditos por Asesor',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // INFORMES DE CARTERA

        \DB::table('permissions')->insert([
            'category' => 'Cartera',
            'name' => 'informes_cartera',
            'display_name' => 'Pantalla informes cartera',
            'description' => 'Permite entrar a la pantalla de Informes por Carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Cartera',
            'name' => 'repote_por_carteras',
            'display_name' => 'Reporte por carteras',
            'description' => 'Permite ver los saldos de cartera',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Cartera',
            'name' => 'informe_total_por_puntos',
            'display_name' => 'Informe total por puntos',
            'description' => 'Permite ver Informe Total por Puntos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Cartera',
            'name' => 'flujo_cajas',
            'display_name' => 'Flujo de Caja',
            'description' => 'Muestra el flujo de caja segun un rango de fechas y la cartera',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // FINANCIERO

        \DB::table('permissions')->insert([
            'category' => 'Financiero',
            'name' => 'financiero',
            'display_name' => 'Informe financiero por carteras o negocios',
            'description' => 'Permite consultar el estado financiero de una cartera o varias carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        // NEGOCIOS

        \DB::table('permissions')->insert([
            'category' => 'Negocios',
            'name' => 'consultar_negocios',
            'display_name' => 'Consultar  Negocios',
            'description' => 'Permite ver o listar negocios (agrupación de carteras)',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Negocios',
            'name' => 'crear_negocios',
            'display_name' => 'Crear Negocios',
            'description' => 'Permite crear Negocios',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Negocios',
            'name' => 'editar_negocios',
            'display_name' => 'Editar Negocios',
            'description' => 'Permite editar Negocios',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Negocios',
            'name' => 'eliminar_negocios',
            'display_name' => 'Eliminar Negocios',
            'description' => 'Permite eliminar Negocios',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        // CARTERAS

        \DB::table('permissions')->insert([
            'category' => 'Carteras',
            'name' => 'consultar_carteras',
            'display_name' => 'Consultar carteras',
            'description' => 'Permite listar y consultar carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //* 
        

        \DB::table('permissions')->insert([
            'category' => 'Carteras',
            'name' => 'crear_carteras',
            'display_name' => 'Crear carteras',
            'description' => 'Permite crear carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Carteras',
            'name' => 'editar_carteras',
            'display_name' => 'Editar carteras',
            'description' => 'Permite editar carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Carteras',
            'name' => 'eliminar_carteras',
            'display_name' => 'Eliminar carteras',
            'description' => 'Permite eliminar carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //* 

        // users 

        \DB::table('permissions')->insert([
            'category' => 'Users',
            'name' => 'consultar_users',
            'display_name' => 'Consultar usuarios del sistema',
            'description' => 'Permite listar y ver los usuarios del sistema',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Users',
            'name' => 'crear_users',
            'display_name' => 'Crear usuario del sistema',
            'description' => 'Permite crear usuario del sistema',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Users',
            'name' => 'editar_users',
            'display_name' => 'Editar usuario del sistema',
            'description' => 'Permite editar usuarios del sistema',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Users',
            'name' => 'eliminar_users',
            'display_name' => 'Eliminar usuarios del sistema',
            'description' => 'Permite eliminar usuarios del sistema',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        // ROL/PERMISOS


        \DB::table('permissions')->insert([
            'category' => 'Rol/Permisos',
            'name' => 'consultar_permisos',
            'display_name' => 'Consultar roles y permisos',
            'description' => 'Permite consultar los roles y permisos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Rol/Permisos',
            'name' => 'modificar_permisos',
            'display_name' => 'Crear y modificar roles y permisos',
            'description' => 'Permite, modificar y eliminar roles y permisos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    

        // PUNTOS

        \DB::table('permissions')->insert([
            'category' => 'Puntos',
            'name' => 'consultar_puntos',
            'display_name' => 'Consultar puntos',
            'description' => 'Permite consultar y listar puntos o sucursales',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Puntos',
            'name' => 'crear_puntos',
            'display_name' => 'Crear Puntos',
            'description' => 'Permite crear Puntos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Puntos',
            'name' => 'editar_puntos',
            'display_name' => 'Editar Puntos',
            'description' => 'Permite editar Puntos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Puntos',
            'name' => 'eliminar_puntos',
            'display_name' => 'Eliminar Puntos',
            'description' => 'Permite eliminar Puntos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*      

        //PRODUCTOS

        \DB::table('permissions')->insert([
            'category' => 'Productos',
            'name' => 'crear_producto',
            'display_name' => 'Crear Productos',
            'description' => 'Permite crear Productos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*
        
        \DB::table('permissions')->insert([
            'category' => 'Productos',
            'name' => 'consultar_productos',
            'display_name' => 'Consultar y listar productos',
            'description' => 'Permite consultar y listar productos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Productos',
            'name' => 'editar_productos',
            'display_name' => 'Editar Productos',
            'description' => 'Permite editar Productos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*


        // VARIABLES DEL SISTEMA

        \DB::table('permissions')->insert([
            'category' => 'Variables',
            'name' => 'ver_variables',
            'display_name' => 'Ver Variables',
            'description' => 'Permite ver Variables',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*
        
        \DB::table('permissions')->insert([
            'category' => 'Variables',
            'name' => 'editar_variables',
            'display_name' => 'Editar Variables',
            'description' => 'Permite editar Variables',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

       
        // CRITERIOS DE LLAMADA

        \DB::table('permissions')->insert([
            'category' => 'Criterios de llamada',
            'name' => 'crear_criteriocall',
            'display_name' => 'Crear Criterios de llamada',
            'description' => 'Permite crear Criterios de llamada',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*
        
        \DB::table('permissions')->insert([
            'category' => 'Criterios de llamada',
            'name' => 'consultar_criteriocall',
            'display_name' => 'Consultar Criterios de llamada',
            'description' => 'Permite consultar criterios de llamada',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Criterios de llamada',
            'name' => 'editar_criteriocall',
            'display_name' => 'Editar Criterios de llamada',
            'description' => 'Permite editar criterios de llamada',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Criterios de llamada',
            'name' => 'eliminar_criteriocall',
            'display_name' => 'Eliminar criterios de llamada',
            'description' => 'Permite eliminar criterios de llamada',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*


        // ZONAS    

        \DB::table('permissions')->insert([
            'category' => 'Zonas',
            'name' => 'consultar_zonas',
            'display_name' => 'Consultar las zonas',
            'description' => 'Permiste consultar las todas zonas',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Zonas',
            'name' => 'crear_zonas',
            'display_name' => 'Crea una zona',
            'description' => 'Permiste crear una zona',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

    }
    
}
