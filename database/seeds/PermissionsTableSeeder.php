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
            'name' => 'listar_clientes',
            'display_name' => 'Listar Clientes',
            'description' => 'Permite listar todos los clientes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Clientes',
            'name' => 'ver_clientes',
            'display_name' => 'Ver Cliente',
            'description' => 'Permite ver todos los clientes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Clientes',
            'name' => 'crear_clientes',
            'display_name' => 'Crear Cliente',
            'description' => 'Permite crear clientes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Clientes',
            'name' => 'editar_clientes',
            'display_name' => 'Editar Cliente',
            'description' => 'Permite editar los clientes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Clientes',
            'name' => 'eliminar_clientes',
            'display_name' => 'eliminar Clientes',
            'description' => 'Permite eliminar los clientes',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Clientes',
            'name' => 'subir_documentos',
            'display_name' => 'Subir documentacion',
            'description' => 'Permite guardar documentos del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Clientes',
            'name' => 'borrar_documentos',
            'display_name' => 'Borrar documentacion',
            'description' => 'Permite borrar documentos del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // CONYUGE DEL CLIENTE

        \DB::table('permissions')->insert([
            'category' => 'Conyuge',
            'name' => 'crear_conyuges',
            'display_name' => 'Crear el conyuge del cliente',
            'description' => 'Permite crear el conyuge del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Conyuge',
            'name' => 'editar_conyuges',
            'display_name' => 'editar el conyuge del cliente',
            'description' => 'Permite editar el conyuge del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Conyuge',
            'name' => 'eliminar_conyuges',
            'display_name' => 'eliminar el conyuge del cliente',
            'description' => 'Permite eliminar el conyuge del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        // CLIENTE CODEUDOR

        \DB::table('permissions')->insert([
            'category' => 'Codeudores',
            'name' => 'edit_codeudores',
            'display_name' => 'Editar el codeudor del cliente',
            'description' => 'Permite editar el Codeudores del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Codeudores',
            'name' => 'crear_codeudores',
            'display_name' => 'Crea el codeudor del cliente',
            'description' => 'Permite crear el codeudor del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Codeudores',
            'name' => 'eliminar_codeudores',
            'display_name' => 'eliminar el codeudor del cliente',
            'description' => 'Permite eliminar el codeudor del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

     
        // CALL CENTER

        \DB::table('permissions')->insert([
            'category' => 'CallCenter',
            'name' => 'exportar_todo',
            'display_name' => 'Exportar Todo',
            'description' => 'Permite exportar todos los creditos y sucursales',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([ 
            'category' => 'CallCenter',
            'name' => 'exportar_soat',
            'display_name' => 'Exportar SOAT',
            'description' => 'Permite exportar todos los SOAT por sucursales',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'CallCenter',
            'name' => 'exportar_sucursal',
            'display_name' => 'Exportar por sucursal',
            'description' => 'Permite exportar todos los creditos por sucursal',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'CallCenter',
            'name' => 'listar',
            'display_name' => 'listar',
            'description' => 'Permite listar todos los creditos CallCenter',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'CallCenter',
            'name' => 'listar_morosos',
            'display_name' => 'Listar Morosos',
            'description' => 'Permite listar todos los creditos en estado mora CallCenter',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'CallCenter',
            'name' => 'listar_agendados',
            'display_name' => 'Listar Agendados',
            'description' => 'Permite listar todos los creditos agendados CallCenter',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'CallCenter',
            'name' => 'miscall',
            'display_name' => 'Mis Call',
            'description' => 'Permite ver toda la gestion pos asesor CallCenter',
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

        \DB::table('permissions')->insert([
            'category' => 'CallCenter',
            'name' => 'Informacion_creditos',
            'display_name' => 'Informacion del credito',
            'description' => 'Permite ver la informacion del credito CallCenter',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'CallCenter',
            'name' => 'llamar',
            'display_name' => 'llamar callcenter',
            'description' => 'Permite llamar CallCenter',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        // CREDITOS

        \DB::table('permissions')->insert([
            'category' => 'Creditos',
            'name' => 'crear_creditos',
            'display_name' => 'crear credito',
            'description' => 'Permite listar y crear los creditos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Creditos',
            'name' => 'ver_creditos',
            'display_name' => 'Ver credito',
            'description' => 'Permite listar y ver los creditos',
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
            'display_name' => 'refinanciar credito',
            'description' => 'Permite listar y refinanciar los creditos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Creditos',
            'name' => 'exportar_todos_creditos',
            'display_name' => 'Exportar todos los creditos',
            'description' => 'Permite exportar rodos los creditos xls',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*


        \DB::table('permissions')->insert([
            'category' => 'Creditos',
            'name' => 'exportar_vista',
            'display_name' => 'Exportar vista',
            'description' => 'Permite exportar la vista de los creditos en pantalla',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Creditos',
            'name' => 'listar_creditos',
            'display_name' => 'listar credito',
            'description' => 'Permite listar los creditos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Creditos',
            'name' => 'llamar_creditos',
            'display_name' => 'Llamar credito',
            'description' => 'Permite realizar llamda',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        // SOLICITUDES

        \DB::table('permissions')->insert([
            'category' => 'Solicitudes',
            'name' => 'exportar_solicitudes',
            'display_name' => 'Exportar',
            'description' => 'Permite exportar todas las solicitudes',
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
            'name' => 'ver_solicitudes',
            'display_name' => 'Ver solicitud',
            'description' => 'Permite ver la solicitud',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        \DB::table('permissions')->insert([
            'category' => 'Solicitudes',
            'name' => 'inicial_estudios',
            'display_name' => 'Iniciales y estudio',
            'description' => 'Permite realizar los pagos segun concepto para la solicitud',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

     
        \DB::table('permissions')->insert([
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
            'category' => 'sanciones',
            'name' => 'crear_sanciones',
            'display_name' => 'Crear Sanciones',
            'description' => 'Permite crear sanciones diarias',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'sanciones',
            'name' => 'exonerar_sanciones',
            'display_name' => 'Exonerar Sanciones',
            'description' => 'Permite exonerar sanciones diarias',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
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
            'category' => 'estudio',
            'name' => 'crear_estudios',
            'display_name' => 'Crear Estudio',
            'description' => 'Permite crear estudio del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*     
        
        \DB::table('permissions')->insert([
            'category' => 'estudio',
            'name' => 'consultar_estudio',
            'display_name' => 'Consultar Estudio',
            'description' => 'Permite consultar estudio del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*        

        \DB::table('permissions')->insert([
            'category' => 'estudio',
            'name' => 'editar_estudio',
            'display_name' => 'Editar Estudio',
            'description' => 'Permite editar estudio del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*  
        
        \DB::table('permissions')->insert([
            'category' => 'estudio',
            'name' => 'crear_referencias',
            'display_name' => 'Crear referencias',
            'description' => 'Permite crear referencias del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*      

        \DB::table('permissions')->insert([
            'category' => 'estudio',
            'name' => 'ver_referencias',
            'display_name' => 'Consultar Referencias',
            'description' => 'Permite consultar referencias del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*     

        \DB::table('permissions')->insert([
            'category' => 'estudio',
            'name' => 'editar_referencias',
            'display_name' => 'Editar Referencias',
            'description' => 'Permite editar referencias del cliente',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*      

        // OTROS INGRESOS

        \DB::table('permissions')->insert([
            'category' => 'Otros ingresos',
            'name' => 'hacer_otro_ingreso',
            'display_name' => 'Hacer otro ingreso',
            'description' => 'Permite hacer el pago de otros ingresos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Otros ingresos',
            'name' => 'registrar_otros_ingresos',
            'display_name' => 'Registrar otros ingresos',
            'description' => 'Permite agregar el pago o abono de otros ingresos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Otros ingresos',
            'name' => 'listar_otros_pagos',
            'display_name' => 'Listar otros ingresos',
            'description' => 'Permite listar otros pagos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        // PAGO A UN CREDITO
    
        \DB::table('permissions')->insert([
            'category' => 'Pago credito',
            'name' => 'crear_pago_credito',
            'display_name' => "Crear pago credito",
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
            'name' => 'editar_pago_credito',
            'display_name' => 'Edita recibo de pago de un credito',
            'description' => 'Permite editar el pago o abono de un credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Pago credito',
            'name' => 'anular_pago_credito',
            'display_name' => 'Anular pago de un credito',
            'description' => 'Permite anular el pago o abono de un credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Pago credito',
            'name' => 'listar_pago_credito',
            'display_name' => 'Listar pago credito',
            'description' => 'Permite listar el pago o abono de un credito',
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
            'name' => 'ver_egresos',
            'display_name' => 'Ver Egresos',
            'description' => 'Permite ver egresos',
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
            'name' => 'borrar_egresos',
            'display_name' => 'Borrar Egresos',
            'description' => 'Permite borrar egresos',
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
            'name' => 'ver_multas',
            'display_name' => 'Listar Pre/Juridicos',
            'description' => 'Permite listar Pre/Juridicos',
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
            'name' => 'ver_PreJuridicos',
            'display_name' => 'Ver Pre/Juridicos',
            'description' => 'Permite ver Pre/Juridicos',
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
            'display_name' => 'genera todos los reportes',
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
            'name' => 'exportar_caja',
            'display_name' => 'Caja',
            'description' => 'Permite generar reporte para caja',
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
            'name' => 'venta_credito',
            'display_name' => 'Venta de Credito',
            'description' => 'Permite generar reporte para Venta de Credito',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
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
            'category' => 'Cartera',
            'name' => 'ver_inf_carteras',
            'display_name' => 'Ver Informe por Carteras',
            'description' => 'Permite ver Informe por Carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        \DB::table('permissions')->insert([
            'category' => 'Cartera',
            'name' => 'escoger_carteras',
            'display_name' => 'Ver Escoger Cartera',
            'description' => 'Permite ver Escoger Cartera',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Cartera',
            'name' => 'ver_informes',
            'display_name' => 'Ver informe por carteras',
            'description' => 'Permite Ver informe por carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Cartera',
            'name' => 'ver_informe_total_puntos',
            'display_name' => 'Ver Informe Total por Puntos',
            'description' => 'Permite ver Informe Total por Puntos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Cartera',
            'name' => 'ver_informe_flujo_cajas',
            'display_name' => 'Ver Informe Flujo de Caja',
            'description' => 'Permite ver Informe Flujo de Caja',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
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
            'category' => 'Financiero',
            'name' => 'financiero',
            'display_name' => 'Consultar general',
            'description' => 'Permite consultar general',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        // NEGOCIOS

        \DB::table('permissions')->insert([
            'category' => 'Negocios',
            'name' => 'ver_negocios',
            'display_name' => 'Ver Negocios',
            'description' => 'Permite Ver Negocios',
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
            'name' => 'listar_carteras',
            'display_name' => 'listar carteras',
            'description' => 'Permite listar carteras',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //* 
        
        \DB::table('permissions')->insert([
            'category' => 'Carteras',
            'name' => 'ver_carteras',
            'display_name' => 'Ver carteras',
            'description' => 'Permite Ver carteras',
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
            'category' => 'users',
            'name' => 'ver_users',
            'display_name' => 'Ver users',
            'description' => 'Permite ver users',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'users',
            'name' => 'listar_users',
            'display_name' => 'listar users',
            'description' => 'Permite listar users',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'users',
            'name' => 'crear_users',
            'display_name' => 'Crear users',
            'description' => 'Permite crear users',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'users',
            'name' => 'editar_users',
            'display_name' => 'Editar users',
            'description' => 'Permite editar users',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'users',
            'name' => 'eliminar_users',
            'display_name' => 'Eliminar users',
            'description' => 'Permite eliminar users',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        // ROL/PERMISOS

        \DB::table('permissions')->insert([
            'category' => 'Rol/Permisos',
            'name' => 'crear_rol',
            'display_name' => 'Crear rol/permisos',
            'description' => 'Permite crear rol/permisos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        \DB::table('permissions')->insert([
            'category' => 'Rol/Permisos',
            'name' => 'ver_rol',
            'display_name' => 'Ver rol/permisos',
            'description' => 'Permite ver rol/permisos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
            'category' => 'Rol/Permisos',
            'name' => 'editar_rol',
            'display_name' => 'Editar rol/permisos',
            'description' => 'Permite editar rol/permisos',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        \DB::table('permissions')->insert([
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
            'name' => 'ver_puntos',
            'display_name' => 'Ver Puntos',
            'description' => 'Permite ver Puntos',
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


        // ZONAS
        
        \DB::table('permissions')->insert([
            'category' => 'Zonas',
            'name' => 'ver_zonas',
            'display_name' => 'Ver Zonas',
            'description' => 'Permite ver Zonas',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

       

        // ROL/PERMISOS

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
            'name' => 'ver_productos',
            'display_name' => 'Ver Productos',
            'description' => 'Permite ver Productos',
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

        \DB::table('permissions')->insert([
            'category' => 'Productos',
            'name' => 'listar_productos',
            'display_name' => 'Listar Productos',
            'description' => 'Permite listar Productos',
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
            'name' => 'ver_criteriocall',
            'display_name' => 'Ver Criterios de llamada',
            'description' => 'Permite ver Criterios de llamada',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Criterios de llamada',
            'name' => 'editar_criteriocall',
            'display_name' => 'Editar Criterios de llamada',
            'description' => 'Permite editar Criterios de llamada',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

        \DB::table('permissions')->insert([
            'category' => 'Criterios de llamada',
            'name' => 'eliminar_criteriocall',
            'display_name' => 'Eliminar Criterios de llamada',
            'description' => 'Permite eliminar Criterios de llamada',
            'created_by' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]); //*

    }
    
}
