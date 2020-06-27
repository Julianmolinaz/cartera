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
            'id' => 1,
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
            'id' => 5,
            'category' => 'Clientes',
            'name' => 'listar_clientes',
            'display_name' => 'Listar Clientes',
            'description' => 'Permite listar todos los clientes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 2,
            'category' => 'Clientes',
            'name' => 'ver_clientes',
            'display_name' => 'Ver Clientes',
            'description' => 'Permite ver todos los clientes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 3,
            'category' => 'Clientes',
            'name' => 'crear_clientes',
            'display_name' => 'Crear Cliente',
            'description' => 'Permite crear clientes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 6,
            'category' => 'Clientes',
            'name' => 'editar_clientes',
            'display_name' => 'Editar Clientes',
            'description' => 'Permite editar los clientes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 7,
            'category' => 'Clientes',
            'name' => 'eliminar_clientes',
            'display_name' => 'eliminar Clientes',
            'description' => 'Permite eliminar los clientes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 4,
            'category' => 'Clientes',
            'name' => 'subir_documentos',
            'display_name' => 'Subir documentacion',
            'description' => 'Permite guardar documentos del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
     
        // CALL CENTER

        \DB::table('permissions')->insert([
            'id' => 8,
            'category' => 'CallCenter',
            'name' => 'exportar_todo',
            'display_name' => 'Exportar Todo',
            'description' => 'Permite exportar todos los créditos y sucursales',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 9, 
            'category' => 'CallCenter',
            'name' => 'exportar_soat',
            'display_name' => 'Exportar SOAT',
            'description' => 'Permite exportar todos los SOAT por sucursales',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 10,
            'category' => 'CallCenter',
            'name' => 'exportar_sucursal',
            'display_name' => 'Exportar por sucursal',
            'description' => 'Permite exportar todos los créditos por sucursal',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 11,
            'category' => 'CallCenter',
            'name' => 'listar',
            'display_name' => 'listar',
            'description' => 'Permite listar todos los créditos CallCenter',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 12,
            'category' => 'CallCenter',
            'name' => 'listar_morosos',
            'display_name' => 'Listar Morosos',
            'description' => 'Permite listar todos los creditos en estado mora CallCenter',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 13,
            'category' => 'CallCenter',
            'name' => 'listar_agendados',
            'display_name' => 'Listar Agendados',
            'description' => 'Permite listar todos los creditos agendados CallCenter',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 14,
            'category' => 'CallCenter',
            'name' => 'miscall',
            'display_name' => 'Mis Call',
            'description' => 'Permite ver toda la gestion pos asesor CallCenter',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 15,
            'category' => 'CallCenter',
            'name' => 'registro_llamada',
            'display_name' => 'Registro de llamada',
            'description' => 'Permite registrar llamadas CallCenter',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 16,
            'category' => 'CallCenter',
            'name' => 'Informacion_creditos',
            'display_name' => 'Informacion del crédito',
            'description' => 'Permite ver la informacion del crédito CallCenter',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // CREDITOS

        \DB::table('permissions')->insert([
            'id' => 42,
            'category' => 'Créditos',
            'name' => 'crear_creditos',
            'display_name' => 'crear crédito',
            'description' => 'Permite listar y crear los créditos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 17,
            'category' => 'Créditos',
            'name' => 'ver_creditos',
            'display_name' => 'Ver crédito',
            'description' => 'Permite listar y ver los créditos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 18,
            'category' => 'Créditos',
            'name' => 'editar_creditos',
            'display_name' => 'Editar crédito',
            'description' => 'Permite editar la informacion del crédito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 19,
            'category' => 'Créditos',
            'name' => 'eliminar_credito',
            'display_name' => 'Eliminar crédito',
            'description' => 'Permite eliminar el crédito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 101,
            'category' => 'Créditos',
            'name' => 'refinanciar_creditos',
            'display_name' => 'refinanciar crédito',
            'description' => 'Permite listar y refinanciar los créditos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 20,
            'category' => 'Créditos',
            'name' => 'exportar_todos_creditos',
            'display_name' => 'Exportar todos los créditos',
            'description' => 'Permite exportar rodos los créditos xls',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        \DB::table('permissions')->insert([
            'id' => 21,
            'category' => 'Créditos',
            'name' => 'exportar_vista',
            'display_name' => 'Exportar vista',
            'description' => 'Permite exportar la vista de los créditos en pantalla',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 22,
            'category' => 'Créditos',
            'name' => 'listar_creditos',
            'display_name' => 'listar credito',
            'description' => 'Permite listar los créditos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 23,
            'category' => 'Créditos',
            'name' => 'llamar_creditos',
            'display_name' => 'Llamar crédito',
            'description' => 'Permite realizar llamda',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // SOLICITUDES

     
        \DB::table('permissions')->insert([
            'id' => 24,
            'category' => 'Solicitudes',
            'name' => 'exportar_solicitudes',
            'display_name' => 'Exportar',
            'description' => 'Permite exportar todas las solicitudes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 25,
            'category' => 'Solicitudes',
            'name' => 'crear_solicitudes',
            'display_name' => 'Crear solicitud',
            'description' => 'Permite crear varias solicitudes a un mismo cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 26,
            'category' => 'Solicitudes',
            'name' => 'editar_solicitudes',
            'display_name' => 'Editar solicitud',
            'description' => 'Permite editar la solicitud',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 27,
            'category' => 'Solicitudes',
            'name' => 'ver_solicitudes',
            'display_name' => 'Ver solicitud',
            'description' => 'Permite ver la solicitud',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        \DB::table('permissions')->insert([
            'id' => 28,
            'category' => 'Solicitudes',
            'name' => 'inicial_estudios',
            'display_name' => 'Iniciales y estudio',
            'description' => 'Permite realizar los pagos segun concepto para la solicitud',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

     
        \DB::table('permissions')->insert([
            'id' => 29,
            'category' => 'Solicitudes',
            'name' => 'listar_solicitudes',
            'display_name' => 'Listar solicitudes',
            'description' => 'Permite listar las solicitudes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // CANCELADOS

        \DB::table('permissions')->insert([
            'id' => 30,
            'category' => 'Cancelados',
            'name' => 'listar_cancelados',
            'display_name' => 'listar cancelados',
            'description' => 'Permite listar los credito dentros cancelados',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

     

        

        // SANCIONES

        \DB::table('permissions')->insert([
            'id' => 31,
            'category' => 'sanciones',
            'name' => 'crear_sanciones',
            'display_name' => 'Crear Sanciones',
            'description' => 'Permite crear sanciones diarias',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 32,
            'category' => 'sanciones',
            'name' => 'exonerar_sanciones',
            'display_name' => 'Exonerar Sanciones',
            'description' => 'Permite exonerar sanciones diarias',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 33,
            'category' => 'sanciones',
            'name' => 'consultar_sanciones',
            'display_name' => 'Consultar Sanciones',
            'description' => 'Permite consultar sanciones diarias',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // ESTUDIOS

        \DB::table('permissions')->insert([
            'id' => 34,
            'category' => 'estudio',
            'name' => 'crear_estudios',
            'display_name' => 'Crear Estudio',
            'description' => 'Permite crear estudio del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);     
        
        \DB::table('permissions')->insert([
            'id' => 35,
            'category' => 'estudio',
            'name' => 'consultar_estudio',
            'display_name' => 'Consultar Estudio',
            'description' => 'Permite consultar estudio del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);        

        \DB::table('permissions')->insert([
            'id' => 36,
            'category' => 'estudio',
            'name' => 'editar_estudio',
            'display_name' => 'Editar Estudio',
            'description' => 'Permite editar estudio del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);  
        
        \DB::table('permissions')->insert([
            'id' => 37,
            'category' => 'estudio',
            'name' => 'crear_referencias',
            'display_name' => 'Crear referencias',
            'description' => 'Permite crear referencias del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);      

        \DB::table('permissions')->insert([
            'id' => 38,
            'category' => 'estudio',
            'name' => 'ver_referencias',
            'display_name' => 'Consultar Referencias',
            'description' => 'Permite consultar referencias del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);     

        \DB::table('permissions')->insert([
            'id' => 39,
            'category' => 'estudio',
            'name' => 'editar_referencias',
            'display_name' => 'Editar Referencias',
            'description' => 'Permite editar referencias del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);      

        // PAGOS

        \DB::table('permissions')->insert([
            'id' => 40,
            'category' => 'Pagos',
            'name' => 'agregar_pagos',
            'display_name' => 'Agregar pago',
            'description' => 'Permite agregar el pago o abono de un credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 41,
            'category' => 'Pagos',
            'name' => 'ver_pagos',
            'display_name' => 'consultar pago',
            'description' => 'Permite ver el pago o abono de un credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 43,
            'category' => 'Pagos',
            'name' => 'crear_pagos',
            'display_name' => 'crear pago',
            'description' => 'Permite crear el pago o abono de un credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        \DB::table('permissions')->insert([
            'id' => 44,
            'category' => 'Pagos',
            'name' => 'ver_recibos',
            'display_name' => 'Consultar recibo',
            'description' => 'Permite ver la recibo de pago o abono de un credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 45,
            'category' => 'Pagos',
            'name' => 'imprimir_recibos',
            'display_name' => 'Imprimir recibo',
            'description' => 'Permite ver la recibo de pago o abono de un credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 46,
            'category' => 'Pagos',
            'name' => 'anular_recibos',
            'display_name' => 'Anular recibo',
            'description' => 'Permite anular la recibo de un credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 47,
            'category' => 'Pagos',
            'name' => 'exportar_recibos',
            'display_name' => 'Exportar recibo',
            'description' => 'Permite exportar las recibos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 48,
            'category' => 'Pagos',
            'name' => 'listar_recibos',
            'display_name' => 'Listar recibo',
            'description' => 'Permite listar las recibos anuladas',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 49,
            'category' => 'Otros Ingresos',
            'name' => 'ver_ingresos',
            'display_name' => 'Ver Otros ingresos',
            'description' => 'Permite ver otros ingresos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 50,
            'category' => 'Otros Ingresos',
            'name' => 'listar_ingresos',
            'display_name' => 'Listar Otros Ingresos',
            'description' => 'Permite listar otros ingresos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        /**
         * ADMINISTRATIVO
         */

        // EGRESOSOS

        \DB::table('permissions')->insert([
            'id' => 51,
            'category' => 'Egresos',
            'name' => 'ver_egresos',
            'display_name' => 'Ver Egresos',
            'description' => 'Permite ver egresos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 52,
            'category' => 'Egresos',
            'name' => 'crear_egresos',
            'display_name' => 'Crear Egresos',
            'description' => 'Permite crear egresos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 53,
            'category' => 'Egresos',
            'name' => 'borrar_egresos',
            'display_name' => 'Borrar Egresos',
            'description' => 'Permite borrar egresos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 54,
            'category' => 'Egresos',
            'name' => 'eliminar_egresos',
            'display_name' => 'Eliminar Egresos',
            'description' => 'Permite eliminar egresos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 55,
            'category' => 'Egresos',
            'name' => 'exportar_egresos',
            'display_name' => 'Exportar Egresos',
            'description' => 'Permite exportar egresos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 56,
            'category' => 'Egresos',
            'name' => 'crear_proveedor',
            'display_name' => 'Crear Proveedor',
            'description' => 'Permite crear proveedor',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        \DB::table('permissions')->insert([
            'id' => 57,
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
            'id' => 58,
            'category' => 'Pre/Juridicos',
            'name' => 'listar_PreJuridicos',
            'display_name' => 'Listar Pre/Juridicos',
            'description' => 'Permite listar Pre/Juridicos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 59,
            'category' => 'Pre/Juridicos',
            'name' => 'exportar_PreJuridicos',
            'display_name' => 'Exportar Pre/Juridicos',
            'description' => 'Permite exportar Pre/Juridicos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        \DB::table('permissions')->insert([
            'id' => 60,
            'category' => 'Pre/Juridicos',
            'name' => 'ver_PreJuridicos',
            'display_name' => 'Ver Pre/Juridicos',
            'description' => 'Permite ver Pre/Juridicos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 61,
            'category' => 'Pre/Juridicos',
            'name' => 'editar_PreJuridicos',
            'display_name' => 'Editar Pre/Juridicos',
            'description' => 'Permite editar Pre/Juridicos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 62,
            'category' => 'Pre/Juridicos',
            'name' => 'crear_PreJuridicos',
            'display_name' => 'Crear Pre/Juridicos',
            'description' => 'Permite crear Pre/Juridicos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // REPORTES

        \DB::table('permissions')->insert([
            'id' => 63,
            'category' => 'Reportes',
            'name' => 'auditoria_sistema',
            'display_name' => 'Auditoria del Sistema',
            'description' => 'Permite generar reporte para Auditoria del Sistema',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 64,
            'category' => 'Reportes',
            'name' => 'ver_caja',
            'display_name' => 'Ver Caja',
            'description' => 'Permite ver caja',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 126,
            'category' => 'Reportes',
            'name' => 'exportar_caja',
            'display_name' => 'Caja',
            'description' => 'Permite generar reporte para caja',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 65,
            'category' => 'Reportes',
            'name' => 'cartera_castigada',
            'display_name' => 'Cartera Castigada',
            'description' => 'Permite generar reporte para Cartera Castigada',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 66,
            'category' => 'Reportes',
            'name' => 'call_center',
            'display_name' => 'Call Center',
            'description' => 'Permite generar reporte para Call Center',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 67,
            'category' => 'Reportes',
            'name' => 'egresos',
            'display_name' => 'Egresos',
            'description' => 'Permite generar reporte para Egresos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 68,
            'category' => 'Reportes',
            'name' => 'financiero_operativo',
            'display_name' => 'Financiero operativo',
            'description' => 'Permite generar reporte para Financiero operativo',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 69,
            'category' => 'Reportes',
            'name' => 'general',
            'display_name' => 'General',
            'description' => 'Permite generar reporte para General',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 70,
            'category' => 'Reportes',
            'name' => 'general_carteras',
            'display_name' => 'General por Carteras',
            'description' => 'Permite generar reporte para General por Carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 71,
            'category' => 'Reportes',
            'name' => 'general_funcionario',
            'display_name' => 'General por Funcionario',
            'description' => 'Permite generar reporte para General por Funcionario',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 72,
            'category' => 'Reportes',
            'name' => 'historial_venta_creditos',
            'display_name' => 'Historial Venta de Creditos',
            'description' => 'Permite generar reporte para Historial Venta de Creditos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 73,
            'category' => 'Reportes',
            'name' => 'informe_cartera',
            'display_name' => 'Informe Cartera',
            'description' => 'Permite generar reporte para Informe Cartera',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 74,
            'category' => 'Reportes',
            'name' => 'morosos',
            'display_name' => 'Morosos',
            'description' => 'Permite generar reporte para Morosos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 75,
            'category' => 'Reportes',
            'name' => 'reporte_datacredito',
            'display_name' => 'Reporte Datacredito',
            'description' => 'Permite generar reporte para Reporte Datacredito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 76,
            'category' => 'Reportes',
            'name' => 'reporte_procredito',
            'display_name' => 'Reporte Procredito',
            'description' => 'Permite generar reporte para Reporte Procredito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 77,
            'category' => 'Reportes',
            'name' => 'reporte_datacredito_asistimotos',
            'display_name' => 'Reporte Datacredito Asistimotos',
            'description' => 'Permite generar reporte para Reporte Datacredito Asistimotos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 78,
            'category' => 'Reportes',
            'name' => 'reporte datacredito',
            'display_name' => 'Reporte Datacredito',
            'description' => 'Permite generar reporte para Reporte Datacredito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 79,
            'category' => 'Reportes',
            'name' => 'venta_credito',
            'display_name' => 'Venta de Credito',
            'description' => 'Permite generar reporte para Venta de Credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 80,
            'category' => 'Reportes',
            'name' => 'venta_credito_asesor',
            'display_name' => 'Venta de Credito por Asesor',
            'description' => 'Permite generar reporte para Venta de Credito por Asesor',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // INFORMES DE CARTERA

        \DB::table('permissions')->insert([
            'id' => 81,
            'category' => 'Cartera',
            'name' => 'ver_inf_carteras',
            'display_name' => 'Ver Informe por Carteras',
            'description' => 'Permite ver Informe por Carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        \DB::table('permissions')->insert([
            'id' => 82,
            'category' => 'Cartera',
            'name' => 'escoger_carteras',
            'display_name' => 'Ver Escoger Cartera',
            'description' => 'Permite ver Escoger Cartera',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 83,
            'category' => 'Cartera',
            'name' => 'generar_informes',
            'display_name' => 'Ver Escoger Cartera',
            'description' => 'Permite ver Escoger Cartera',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 84,
            'category' => 'Cartera',
            'name' => 'ver_informe_total_puntos',
            'display_name' => 'Ver Informe Total por Puntos',
            'description' => 'Permite ver Informe Total por Puntos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 85,
            'category' => 'Cartera',
            'name' => 'ver_informe_flujo_cajas',
            'display_name' => 'Ver Informe Flujo de Caja',
            'description' => 'Permite ver Informe Flujo de Caja',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 86,
            'category' => 'Cartera',
            'name' => 'flujo_cajas',
            'display_name' => 'Ver Consultar Flujo de Caja',
            'description' => 'Permite ver Consultar Flujo de Caja',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // FINANCIERO

        \DB::table('permissions')->insert([
            'id' => 87,
            'category' => 'Financiero',
            'name' => 'ver_general',
            'display_name' => 'Consultar general',
            'description' => 'Permite consultar general',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 88,
            'category' => 'Financiero',
            'name' => 'ver_sucursales',
            'display_name' => 'Consultar sucursales',
            'description' => 'Permite consultar sucursales',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 89,
            'category' => 'Financiero',
            'name' => 'ver_comparativa_anual',
            'display_name' => 'consultar comparativa anual',
            'description' => 'Permite consultar comparativa anual',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // NEGOCIOS

        \DB::table('permissions')->insert([
            'id' => 90,
            'category' => 'Negocios',
            'name' => 'ver_negocios',
            'display_name' => 'Ver Negocios',
            'description' => 'Permite Ver Negocios',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 91,
            'category' => 'Negocios',
            'name' => 'crear_negocios',
            'display_name' => 'Crear Negocios',
            'description' => 'Permite crear Negocios',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 92,
            'category' => 'Negocios',
            'name' => 'editar_negocios',
            'display_name' => 'Editar Negocios',
            'description' => 'Permite editar Negocios',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 93,
            'category' => 'Negocios',
            'name' => 'eliminar_negocios',
            'display_name' => 'Eliminar Negocios',
            'description' => 'Permite eliminar Negocios',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // CARTERAS

        \DB::table('permissions')->insert([
            'id' => 127,
            'category' => 'Carteras',
            'name' => 'listar_carteras',
            'display_name' => 'listar carteras',
            'description' => 'Permite listar carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        \DB::table('permissions')->insert([
            'id' => 94,
            'category' => 'Carteras',
            'name' => 'ver_carteras',
            'display_name' => 'Ver carteras',
            'description' => 'Permite Ver carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 95,
            'category' => 'Carteras',
            'name' => 'crear_carteras',
            'display_name' => 'Crear carteras',
            'description' => 'Permite crear carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 96,
            'category' => 'Carteras',
            'name' => 'editar_carteras',
            'display_name' => 'Editar carteras',
            'description' => 'Permite editar carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 97,
            'category' => 'Carteras',
            'name' => 'eliminar_carteras',
            'display_name' => 'Eliminar carteras',
            'description' => 'Permite eliminar carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); 

        // USUARIOS 

        \DB::table('permissions')->insert([
            'id' => 98,
            'category' => 'Usuarios',
            'name' => 'ver_usuarios',
            'display_name' => 'Ver usuarios',
            'description' => 'Permite ver usuarios',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 99,
            'category' => 'Usuarios',
            'name' => 'listar_usuarios',
            'display_name' => 'listar usuarios',
            'description' => 'Permite listar usuarios',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 100,
            'category' => 'Usuarios',
            'name' => 'crear_usuarios',
            'display_name' => 'Crear usuarios',
            'description' => 'Permite crear usuarios',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 102,
            'category' => 'Usuarios',
            'name' => 'editar_usuarios',
            'display_name' => 'Editar usuarios',
            'description' => 'Permite editar usuarios',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 103,
            'category' => 'Usuarios',
            'name' => 'eliminar_usuarios',
            'display_name' => 'Eliminar usuarios',
            'description' => 'Permite eliminar usuarios',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // ROL/PERMISOS

        \DB::table('permissions')->insert([
            'id' => 104,
            'category' => 'Rol/Permisos',
            'name' => 'crear_rol',
            'display_name' => 'Crear rol/permisos',
            'description' => 'Permite crear rol/permisos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        \DB::table('permissions')->insert([
            'id' => 105,
            'category' => 'Rol/Permisos',
            'name' => 'ver_rol',
            'display_name' => 'Ver rol/permisos',
            'description' => 'Permite ver rol/permisos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 106,
            'category' => 'Rol/Permisos',
            'name' => 'editar_rol',
            'display_name' => 'Editar rol/permisos',
            'description' => 'Permite editar rol/permisos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 107,
            'category' => 'Rol/Permisos',
            'name' => 'eliminar_rol',
            'display_name' => 'Eliminar rol/permisos',
            'description' => 'Permite eliminar rol/permisos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // PUNTOS

        \DB::table('permissions')->insert([
            'id' => 108,
            'category' => 'Puntos',
            'name' => 'crear_puntos',
            'display_name' => 'Crear Puntos',
            'description' => 'Permite crear Puntos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        \DB::table('permissions')->insert([
            'id' => 109,
            'category' => 'Puntos',
            'name' => 'ver_puntos',
            'display_name' => 'Ver Puntos',
            'description' => 'Permite ver Puntos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 110,
            'category' => 'Puntos',
            'name' => 'editar_puntos',
            'display_name' => 'Editar Puntos',
            'description' => 'Permite editar Puntos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 111,
            'category' => 'Puntos',
            'name' => 'eliminar_puntos',
            'display_name' => 'Eliminar Puntos',
            'description' => 'Permite eliminar Puntos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        // ZONAS

        \DB::table('permissions')->insert([
            'id' => 112,
            'category' => 'Zonas',
            'name' => 'crear_zonas',
            'display_name' => 'Crear Zonas',
            'description' => 'Permite crear Zonas',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        \DB::table('permissions')->insert([
            'id' => 113,
            'category' => 'Zonas',
            'name' => 'ver_zonas',
            'display_name' => 'Ver Zonas',
            'description' => 'Permite ver Zonas',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 114,
            'category' => 'Zonas',
            'name' => 'editar_zonas',
            'display_name' => 'Editar Zonas',
            'description' => 'Permite editar Zonas',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 115,
            'category' => 'Zonas',
            'name' => 'eliminar_zonas',
            'display_name' => 'Eliminar Zonas',
            'description' => 'Permite eliminar Zonas',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        // ROL/PERMISOS

        \DB::table('permissions')->insert([
            'id' => 116,
            'category' => 'Productos',
            'name' => 'crear_producto',
            'display_name' => 'Crear Productos',
            'description' => 'Permite crear Productos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        \DB::table('permissions')->insert([
            'id' => 117,
            'category' => 'Productos',
            'name' => 'ver_productos',
            'display_name' => 'Ver Productos',
            'description' => 'Permite ver Productos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 118,
            'category' => 'Productos',
            'name' => 'editar_productos',
            'display_name' => 'Editar Productos',
            'description' => 'Permite editar Productos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 119,
            'category' => 'Productos',
            'name' => 'listar_productos',
            'display_name' => 'Listar Productos',
            'description' => 'Permite listar Productos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        // ROL/PERMISOS

        \DB::table('permissions')->insert([
            'id' => 120,
            'category' => 'Variables',
            'name' => 'ver_variables',
            'display_name' => 'Ver Variables',
            'description' => 'Permite ver Variables',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        \DB::table('permissions')->insert([
            'id' => 121,
            'category' => 'Variables',
            'name' => 'editar_variables',
            'display_name' => 'Editar Variables',
            'description' => 'Permite editar Variables',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

       
        // CRITERIOS DE LLAMADA

        \DB::table('permissions')->insert([
            'id' => 122,
            'category' => 'Criterios de llamada',
            'name' => 'crear_criterios',
            'display_name' => 'Crear Criterios de llamada',
            'description' => 'Permite crear Criterios de llamada',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        \DB::table('permissions')->insert([
            'id' => 123,
            'category' => 'Criterios de llamada',
            'name' => 'ver_criterios',
            'display_name' => 'Ver Criterios de llamada',
            'description' => 'Permite ver Criterios de llamada',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 124,
            'category' => 'Criterios de llamada',
            'name' => 'editar_criterios',
            'display_name' => 'Editar Criterios de llamada',
            'description' => 'Permite editar Criterios de llamada',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'id' => 125,
            'category' => 'Criterios de llamada',
            'name' => 'eliminar_criterios',
            'display_name' => 'Eliminar Criterios de llamada',
            'description' => 'Permite eliminar Criterios de llamada',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // CONTABILIDAD seguir con 128

    }
    
}
