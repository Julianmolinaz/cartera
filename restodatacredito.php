                // if( $credito->precredito->cliente->codeudor->id != '100' ){

                //     $registro_info_clientes = array(
                //         '2.1-tipo_identificacion'   => cast_number(tipo_identificacion_datacredito($credito->precredito->cliente->codeudor->tipo_docc),1),
                //         '2.2-numero_identificacion' => cast_number($credito->precredito->cliente->codeudor->num_docc,11),
                //         '2.3-numero_obligacion'     => cast_string($credito->id,18),
                //         '2.4-nombre_completo'       => cast_string($credito->precredito->cliente->codeudor->nombrec,45),
                //         '2.5-situacion_titular'     => '0',
                //         '2.6-fecha_apertura'        => fecha_Ymd($credito->precredito->fecha),
                //         '2.7-fecha_vencimiento'     => vence_credito($credito),
                //         '2.8-responsable'           => '01',
                //         '2.9-tipo_obligacion'       => '1',
                //         '2.10-subcidio_hipotecario' => '0',
                //         '2.11-fecha_subcidio'       => '00000000',
                //         '2.12-termino_contrato'     => '2',
                //         '2.13-forma_pago'           => cast_number(forma_pago($credito),1),
                //         '2.14-periodicidad_pago'    => periodicidad_datacredito($credito),
                //         '2.15-novedad'              => cast_number(novedad($credito,$fecha_corte),2), // cual es la novedad para refinanciacion?
                //         '2.16-estado_origen'        => estado_origen($credito)['estado'],
                //         '2.17-fecha_estado_origen'  => fecha_Ymd(estado_origen($credito)['fecha']),
                //         '2.18-estado_cuenta'        => estado_cuenta($credito,$fecha_corte)['estado_cuenta'],
                //         '2.19-fecha_estado_cuenta'  => estado_cuenta($credito,$fecha_corte)['fecha'],
                //         '2.20-estado_plastico'      => '0',  
                //         '2.21-fecha_estado_plastico'=> '00000000',
                //         '2.22-adjetivo'             => adjetivo($credito)['adjetivo'],
                //         '2.23-fecha_adjetivo'       => adjetivo($credito)['fecha'],
                //         '2.24-clase_tarjeta'        => 0,
                //         '2.25-franquicia'           => 0,
                //         '2.26-nombre_marca_privada' => cast_string('',30),
                //         '2.27-tipo_moneda'          => 1,
                //         '2.28-tipo_garantia'        => 2,
                //         '2.29-calificacion'         => cast_string('',2),
                //         '2.30-prob_incumplimiento'  => cast_number('',3),
                //         '2.31-edad_mora'            => cast_number(dias_mora($credito,$fecha_corte),3),
                //         '2.32-valor_inicial'        => cast_number( (int)$credito->precredito->vlr_fin,11),
                //         '2.33-saldo_deuda'          => cast_number(saldo_deuda_capital($credito,$fecha_corte),11),
                //         '2.34-valor_disponible'     => cast_number('',11),
                //         '2.35-vlr_cuota_mensual'    => cast_number((int)$credito->precredito->vlr_cuota,11),
                //         '2.36-vlr_saldo_mora'       => cast_number(saldo_en_mora($credito,$fecha_corte),11),//????????????????por hacer
                //         '2.37-total_cuotas'         => cast_number($credito->precredito->cuotas,3),
                //         '2.38-cuotas_canceladas'    => cast_number(cuotas_canceladas($credito),3),
                //         '2.39-cuotas_mora'          => cast_number(cuotas_mora( $credito ,$fecha_corte)['cts_mora_todas'],3),
                //         '2.40-clausula_permanencia' => cast_number('',3),
                //         '2.41-fecha_clausula_perman'=> cast_number('',8),
                //         '2.42-fecha_limite_pago'    => fecha_limite_pago($credito,$fecha_corte),
                //         '2.43-fecha_pago'           => cast_string(fecha_Ymd(inv_fech(fecha_pago($credito))),8),
                //         '2.44-oficina_radicacion'   => cast_string($punto->nombre,30),
                //         '2.45-ciudad_radicacion'    => cast_string($punto->municipio->nombre,20),
                //         '2.46-codigo_date_radica'   => cast_number($punto->municipio->codigo_municipio,8),
                //         '2.47-ciudad_res_com'       => cast_string($credito->precredito->cliente->codeudor->municipio->nombre,20),
                //         '2.48-codigo_dane_res_com'  => cast_number($credito->precredito->cliente->codeudor->municipio->codigo_municipio,8),
                //         '2.49-depto_res_com'        => cast_string($credito->precredito->cliente->codeudor->municipio->departamento,20),
                //         '2.50-dir_res_com'          => cast_string($credito->precredito->cliente->codeudor->direccion,60),
                //         '2.51-tel_res_com'          => cast_number($credito->precredito->cliente->codeudor->telefono,12),
                //         '2.52-ciudad_laboral'       => cast_string('',20),
                //         '2.53-cod_dane_ciudad_lab'  => cast_number('',8),
                //         '2.54-departamento_laboral' => cast_string('',20),
                //         '2.55-direccion_laboral'    => cast_string('',60),
                //         '2.56-tel_laboral'          => cast_number('',12),
                //         '2.57-ciud_correspondencia' => cast_string($credito->precredito->cliente->codeudor->municipio->nombre,20),
                //         '2.58-cod_dane_ciud_corresp'=> cast_number($credito->precredito->cliente->codeudor->municipio->codigo_municipio,8),
                //         '2.59-depto_correspondencia'=> cast_string($credito->precredito->cliente->codeudor->municipio->departamento,20),
                //         '2.60-dir_correspondencia'  => cast_string($credito->precredito->cliente->codeudor->direccionc,60),
                //         '2.61-correo_electronico'   => cast_string($credito->precredito->cliente->codeudor->emailc,60),
                //         '2.62-celular'              => cast_number($credito->precredito->cliente->codeudor->movilc,12),
                //         '2.63-suscriptor_destino'   => cast_number('',6),
                //         '2.64-numero_tarjeta'       => cast_number('',18),
                //         '2.65-detalle_garantia'     => cast_string('',1),
                //         '2.66-espacio_blanco'       => cast_string('',18));
            
                //         array_push($info_clientes_array,$registro_info_clientes);
                // }