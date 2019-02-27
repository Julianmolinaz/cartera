<?php

namespace App\Traits;

use App\Helpers\helper;

trait DataAsisTrait
{
    public function get_estructura()
    {
        foreach( $this->data as $d ){

            $this->content[] = [
                '2.1-tipo_identificacion'   => $this->cast_number($this->tipo_identificacion_datacredito($d->tipo_doc),1,'right'),
                '2.2-numero_identificacion' => '',
                '2.3-numero_obligacion'     => '',
                '2.4-nombre_completo'       => '',
                '2.5-situacion_titular'     => '0',
                '2.6-fecha_apertura'        => '',
                '2.7-fecha_vencimiento'     => '',
                '2.8-responsable'           => '00',
                '2.9-tipo_obligacion'       => '1',
                '2.10-subcidio_hipotecario' => '00',
                '2.11-fecha_subcidio'       => '00000000',
                '2.12-termino_contrato'     => '2',
                '2.13-forma_pago'           => '',
                '2.14-periodicidad_pago'    => '',
                '2.15-novedad'              => '',
                '2.16-estado_origen'        => '0',
                '2.17-fecha_estado_origen'  => '',
                '2.18-estado_cuenta'        => '',
                '2.19-fecha_estado_cuenta'  => '',
                '2.20-estado_plastico'      => '0',
                '2.21-fecha_estado_plastico'=> '00000000',
                '2.22-adjetivo'             => '',
                '2.23-fecha_adjetivo'       => '',
                '2.24-clase_tarjeta'        => '0',
                '2.25-franquicia'           => '0',
                '2.26-nombre_marca_privada' => '',// N/A
                '2.27-tipo_moneda'          => '1',
                '2.28-tipo_garantia'        => '2',
                '2.29-calificacion'         => '',// N/A
                '2.30-prob_incumplimiento'  => '',
                '2.31-edad_mora'            => '',
                '2.32-valor_inicial'        => '',// N/A
                '2.33-saldo_deuda'          => '',
                '2.34-valor_disponible'     => '',
                '2.35-vlr_cuota_mensual'    => '',
                '2.36-vlr_saldo_mora'       => '',
                '2.37-total_cuotas'         => '',
                '2.38-cuotas_canceladas'    => '',
                '2.39-cuotas_mora'          => '',
                '2.40-clausula_permanencia' => '',
                '2.41-fecha_clausula_perman'=> '',
                '2.42-fecha_limite_pago'    => '',
                '2.43-fecha_pago'           => '',
                '2.44-oficina_radicacion'   => '',
                '2.45-ciudad_radicacion'    => '',
                '2.46-codigo_dane_radica'   => '',
                '2.47-ciudad_res_com'       => '',
                '2.48-codigo_dane_res_com'  => '',
                '2.49-depto_res_com'        => '',
                '2.50-dir_res_com'          => '',
                '2.51-tel_res_com'          => '',
                '2.52-ciudad_laboral'       => '',
                '2.53-cod_dane_ciudad_lab'  => '',
                '2.54-departamento_laboral' => '',
                '2.55-direccion_laboral'    => '',
                '2.56-tel_laboral'          => '',
                '2.57-ciud_correspondencia' => '',
                '2.58-cod_dane_ciud_corresp'=> '',
                '2.59-depto_correspondencia'=> '',
                '2.60-dir_correspondencia'  => '',
                '2.61-correo_electronico'   => '',
                '2.62-celular'              => '',
                '2.63-suscriptor_destino'   => '',
                '2.64-numero_tarjeta'       => '',
                '2.65-detalle_garantia'     => '',
                '2.66-espacio_blanco'       => ''
            ];
        }
    }

}