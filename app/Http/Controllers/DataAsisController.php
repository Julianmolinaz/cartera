<?php

namespace App\Http\Controllers;

use App\Traits\DataAsisTrait;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use Excel;
use File;


class DataAsisController extends Controller
{
    // use DataAsisTrait;

    public $data;
    public $content;
    public $now;

    public function __construct()
    {
        $this->now = Carbon::now();
    }

    public function upload_excel( Request $request )
    {
        $this->validate($request, ['fileToUpload'=>'required']);

        if( $request->hasFile('fileToUpload') ) 
        {
            $extension = File::extension($request->fileToUpload->getClientOriginalName());

            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") 
            {
                $path = $request->fileToUpload->getRealPath();
                
                $this->data = Excel::load($path, function($reader) {
                })->get();

                if(!empty($this->data) && $this->data->count()) {
                     $this->get_estructura();
                     return $this->content;
                   } else {
                    dd('El archivo no corresponde al formato');
                }
            }
        }
    }//upload_excel

    public function get_estructura()
    {
        foreach( $this->data as $d ){

            $this->content[] = [
                '2.1-tipo_identificacion'   => cast_number(tipo_identificacion_datacredito($d->tipo_doc),1,'right'),
                '2.2-numero_identificacion' => cast_number($d->num_doc,11,'right'),
                '2.3-numero_obligacion'     => cast_number('7770'.$d->afil_id,18,'right'),
                '2.4-nombre_completo'       => cast_string(strtoupper(sanear_string($d->nombre)),45),
                '2.5-situacion_titular'     => '0',
                '2.6-fecha_apertura'        => fecha_Ymd($d->f_apertura),
                '2.7-fecha_vencimiento'     => fecha_Ymd($this->vencimiento($d->f_apertura) ),
                '2.8-responsable'           => '00',
                '2.9-tipo_obligacion'       => '1',
                '2.10-subcidio_hipotecario' => '00',
                '2.11-fecha_subcidio'       => '00000000',
                '2.12-termino_contrato'     => '1',
                '2.13-forma_pago'           => forma_pago($d->estado),
                '2.14-periodicidad_pago'    => '1',
                '2.15-novedad'              => '',
                '2.16-estado_origen'        => '0',
                '2.17-fecha_estado_origen'  => '',
                '2.18-estado_cuenta'        => $this->get_dias_mora($d->pago_hasta),
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
                '2.47-ciudad_res_com'       => cast_string($d->mun_reside_nombre,20),//ciudad de residencia del usuario
                '2.48-codigo_dane_res_com'  => cast_number($d->mun_reside,8, 'right'),// codigo dane de la ciudad de residencia del usuario
                '2.49-depto_res_com'        => cast_string($d->depto_reside,20),//depto ubicación residencia o comercial
                '2.50-dir_res_com'          => cast_string(sanear_string($d->dir_reside.' '.$d->barrio_reside),60), // direccion residencia o comercial 
                '2.51-tel_res_com'          => cast_number($d->telefono,12, 'right'),
                '2.52-ciudad_laboral'       => cast_string($d->mun_cobro_nombre,20),
                '2.53-cod_dane_ciudad_lab'  => cast_number($d->mun_cobro,8,'right'),
                '2.54-departamento_laboral' => cast_string($d->depto_cobro,20),
                '2.55-direccion_laboral'    => cast_string($d->dir_cobro,60),
                '2.56-tel_laboral'          => cast_number($d->telefono,12,'right'),
                '2.57-ciud_correspondencia' => cast_string($d->mun_reside_nombre,20),
                '2.58-cod_dane_ciud_corresp'=> cast_number($d->mun_reside,8,'right'),
                '2.59-depto_correspondencia'=> cast_string($d->depto_reside,20),
                '2.60-dir_correspondencia'  => cast_string(sanear_string($d->dir_reside.' '.$d->barrio_reside),60),   
                '2.61-correo_electronico'   => cast_string($d->email,60),
                '2.62-celular'              => cast_number($d->movil,12,'right'),
                '2.63-suscriptor_destino'   => cast_number('',6,'right'),
                '2.64-numero_tarjeta'       => cast_number('',18,'right'),
                '2.65-detalle_garantia'     => cast_string('',1),
                '2.66-espacio_blanco'       => cast_string('',18)
            ];
        }
    }//get_estructura

    public function vencimiento($f_apertura){
        $fecha = new Carbon($f_apertura);
        return $fecha->addYear();
    }

    public function get_dias_mora($pago_hasta){
        $fecha = new Carbon($pago_hasta);
        return $this->now->diffInDays($fecha);
    }

    /*
    |--------------------------------------------------------------------------
    | novedad
    |--------------------------------------------------------------------------
    |
    | recibe un objeto credito
    | retorna lla novedad que puede ser: AL DIA,PAGO TOTAL,MORA DE 30 DIAS,
    | MORA DE 60 DIAS,MORA DE 90 DIAS,MORA DE 120 DIAS O MAS.$_COOKIE
    |
    | Importante: cuando el credito esta Canelado y el saldo en 0 para no volver 
    | a enviarlo en el proximo reporte se coloca en '1' el campo end_datacredito 
    | en la tabla creditos y así queda marcado.
    |
    */


    function get_novedad($pago_hasta, $estado){

        $corte = Carbon::now();
        $corte->subMonth()->modify('last day of this month');

        $estado     = $credito->estado;
        $dias_mora  = $this->get_dias_mora($credito, $corte);
        $novedad    = '';

        if($estado == 'Activo' || ($estado == 'Mora' && $dias_mora < 30) )
        {
            $novedad = '01'; // al día
        }
        if( ($estado == 'Mora' && $dias_mora >= 30) || $estado == 'Prejuridico' || $estado == 'Juridico')
        {        
            if($dias_mora >= 30 && $dias_mora <= 59){
                $novedad = '06';
            }
            else if($dias_mora >= 60 && $dias_mora <= 89){
                $novedad = '07';
            }
            else if($dias_mora >= 90 && $dias_mora <= 119){
                $novedad = '08';
            }
            else if($dias_mora >=120){
                $novedad = '09';
            }
        }
        if( $estado == 'Cancelado' || $credito->saldo == 0){
            $novedad = '05';
        }
        if( ( $credito->castigada == 'Si' && 
            ($estado == 'Mora' || $estado == 'Prejuridico' || $estado == 'Juridico') && 
            $dias_mora >= 30 && 
            $credito->saldo > 0 ) ){
            $novedad = '13'; // cartera castigada
        }

        if( ( $credito->castigada == 'Si' && 
            ($estado == 'Mora' || $estado == 'Prejuridico' || $estado == 'Juridico') && 
            $dias_mora >= 30 && 
            $credito->saldo <= 0 ) ){
            $novedad = '14'; // cartera recuperada
        }

        return $novedad;
    }

}
