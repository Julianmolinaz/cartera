<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\OtrosPagos;
use App\FechaCobro;
use Appp\Cancelado;
use Carbon\Carbon;
use App\Variable;
use App\Sancion;
use App\Credito;
use App\Cartera;
use App\Cliente;
use App\Llamada;
use App\Factura;
use App\Egreso;
use App\Punto;
use App\Extra;
use App\User;
use App\Pago;

use Excel;
use Auth;
use DB;

    $errores_datacredito = array(); // array donde se guardan los errores generados en el proceso de generacion de reporte

    function conf()
    {
        return [ 
            'len_estado' => true, // true valida tamaño de los campos en el reporte, false deshabilita la validacion
            'tamano_linea' => 800  // tamaño exigido por datacredito por cada una de las fuilas del reporte
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | generar_listado_creditos
    |--------------------------------------------------------------------------
    |
    | Permite generar el listado de los creditos a reportar en el informe
    | @recibe una fecha de corte que corresponde al periodo que se va a reportar
    | @retorna un array con los ids de los créditos que deben ser reportados
    |
    */

    function generar_listado_creditos($fecha_corte)
    {
        $now    = Carbon::now();
        $now    = $now->subMonth()->modify('last day of this month');

        $dias_mora_para_reportar = 30;
        $ids_array = array();   
        DB::table('cancelados')->delete();
     
        $ids    = 
        DB::table('creditos')
            /*->where('creditos.id','=',1136)*/
            ->whereIn('creditos.estado', ['Al dia', 'Mora', 'Prejuridico','Juridico', 'Cancelado'])
            ->where([['creditos.end_datacredito','<>',1]]) //no marcados como finalizado
            ->whereNotIn('id',no_admitidos())
            ->select('creditos.id')
            ->get();

        foreach($ids as $id)
        {

            $credito        = Credito::find($id->id); 
            $bandera        = 0;
            $x              = $credito->precredito->fecha;
            $fecha_apertura = Carbon::create(ano($x),mes($x),dia($x));

            // Registrar creditos cancelados para luego marcar si el reporte es aprobado

            if($credito->estado == 'Cancelado' || $credito->saldo <= 0){
                $fecha_actual = Carbon::now();
                //se registran los creditos finalizados
                DB::table('cancelados')
                    ->insert([
                        'credito_id' => $credito->id,
                        'reporte'    => 'datacredito',
                        'created_at' => $fecha_actual->toDateTimeString()
                    ]);

            }

            if( $fecha_apertura->gt($fecha_corte) ){ 
                $bandera = 1; }

            //se descartan los créditos nuevos que no han hecho su primer pago    
            if( $credito->estado == 'Al dia' && count($credito->pagos) == 0 ){ 
                $bandera = 1; }

            //si los créditos marcados son bandera 0 se seleccionan
            if($bandera == 0){
                array_push($ids_array,$id->id);
            }  
        } // .foreach

        return $ids_array;

    }// .function




    /*
    |--------------------------------------------------------------------------
    | len_line
    |--------------------------------------------------------------------------
    |
    | recibe una posición  de array asociativo
    | retorna 
    | un mensaje de error dd() si la cantidad de caracteres es diferente de 800
    |
    */


    function len_line($array)
    {
        set_time_limit(0);
        $c = 0;
        $aud = '';
        
        $credito = $array['2.3-numero_obligacion'];

        foreach($array as $key => $valor){ 
            $c += strlen($valor);
        }

        if( $c <> conf()['tamano_linea'] && conf()['len_estado'])
        {
            if(strlen($array['2.1-tipo_identificacion'])  <>  1){ $aud .=  '2.1-tipo_identificacion ' ;}
            if(strlen($array['2.2-numero_identificacion']) <>11){ $aud .=  '2.2-numero_identificacion' ;}
            if(strlen($array['2.3-numero_obligacion'])     <>18){ $aud .=  '2.3-numero_obligacion' ;}
            if(strlen($array['2.4-nombre_completo'])       <>45){ $aud .=  '2.4-nombre_completo' ;}
            if(strlen($array['2.5-situacion_titular'])     <> 1){ $aud .=  '2.5-situacion_titular' ;}
            if(strlen($array['2.6-fecha_apertura'])        <> 8){ $aud .=  '2.6-fecha_apertura' ;}
            if(strlen($array['2.7-fecha_vencimiento'])     <> 8){ $aud .=  '2.7-fecha_vencimiento' ;}
            if(strlen($array['2.8-responsable'])           <> 2){ $aud .=  '2.8-responsable' ;}
            if(strlen($array['2.9-tipo_obligacion'])       <> 1){ $aud .=  '2.9-tipo_obligacion' ;}
            if(strlen($array['2.10-subcidio_hipotecario']) <> 1){ $aud .=  '2.10-subcidio_hipotecario' ;}
            if(strlen($array['2.11-fecha_subcidio'])       <> 8){ $aud .=  '2.11-fecha_subcidio' ;}
            if(strlen($array['2.12-termino_contrato'])     <> 1){ $aud .=  '2.12-termino_contrato' ;}
            if(strlen($array['2.13-forma_pago'])           <> 1){ $aud .=  '2.13-forma_pago' ;}
            if(strlen($array['2.14-periodicidad_pago'])    <> 1){ $aud .=  '2.14-periodicidad_pago' ;}
            if(strlen($array['2.15-novedad'])              <> 2){ $aud .=  '2.15-novedad' ;}
            if(strlen($array['2.16-estado_origen'])        <> 1){ $aud .=  '2.16-estado_origen' ;}
            if(strlen($array['2.17-fecha_estado_origen'])  <> 8){ $aud .=  '2.17-fecha_estado_origen' ;}
            if(strlen($array['2.18-estado_cuenta'])        <> 2){ $aud .=  '2.18-estado_cuenta' ;}
            if(strlen($array['2.19-fecha_estado_cuenta'])  <> 8){ $aud .=  '2.19-fecha_estado_cuenta' ;}
            if(strlen($array['2.20-estado_plastico'])      <> 1){ $aud .=  '2.20-estado_plastico' ;}
            if(strlen($array['2.21-fecha_estado_plastico'])<> 8){ $aud .=  '2.21-fecha_estado_plastico';}
            if(strlen($array['2.22-adjetivo'])             <> 1){ $aud .=  '2.22-adjetivo' ;}
            if(strlen($array['2.23-fecha_adjetivo'])       <> 8){ $aud .=  '2.23-fecha_adjetivo' ;}
            if(strlen($array['2.24-clase_tarjeta'])        <> 1){ $aud .=  '2.24-clase_tarjeta' ;}
            if(strlen($array['2.25-franquicia'])           <> 1){ $aud .=  '2.25-franquicia' ;}
            if(strlen($array['2.26-nombre_marca_privada']) <>30){ $aud .=  '2.26-nombre_marca_privada' ;}
            if(strlen($array['2.27-tipo_moneda'])          <> 1){ $aud .=  '2.27-tipo_moneda' ;}
            if(strlen($array['2.28-tipo_garantia'])        <> 1){ $aud .=  '2.28-tipo_garantia' ;}
            if(strlen($array['2.29-calificacion'])         <> 2){ $aud .=  '2.29-calificacion' ;}
            if(strlen($array['2.30-prob_incumplimiento'])  <> 3){ $aud .=  '2.30-prob_incumplimiento' ;}
            if(strlen($array['2.31-edad_mora'])            <> 3){ $aud .=  '2.31-edad_mora' ;}
            if(strlen($array['2.32-valor_inicial'])        <>11){ $aud .=  '2.32-valor_inicial' ;}
            if(strlen($array['2.33-saldo_deuda'])          <>11){ $aud .=  '2.33-saldo_deuda' ;}
            if(strlen($array['2.34-valor_disponible'])     <>11){ $aud .=  '2.34-valor_disponible' ;}
            if(strlen($array['2.35-vlr_cuota_mensual'])    <>11){ $aud .=  '2.35-vlr_cuota_mensual' ;}
            if(strlen($array['2.36-vlr_saldo_mora'])       <>11){ $aud .=  '2.36-vlr_saldo_mora' ;}
            if(strlen($array['2.37-total_cuotas'])         <> 3){ $aud .=  '2.37-total_cuotas' ;}
            if(strlen($array['2.38-cuotas_canceladas'])    <> 3){ $aud .=  '2.38-cuotas_canceladas' ;}
            if(strlen($array['2.39-cuotas_mora'])          <> 3){ $aud .=  '2.39-cuotas_mora' ;}
            if(strlen($array['2.40-clausula_permanencia']) <> 3){ $aud .=  '2.40-clausula_permanencia' ;}
            if(strlen($array['2.41-fecha_clausula_perman'])<> 8){ $aud .=  '2.41-fecha_clausula_perman';}
            if(strlen($array['2.42-fecha_limite_pago'])    <> 8){ $aud .=  '2.42-fecha_limite_pago' ;}
            if(strlen($array['2.43-fecha_pago'])           <> 8){ $aud .=  '2.43-fecha_pago' ;}
            if(strlen($array['2.44-oficina_radicacion'])   <>30){ $aud .=  '2.44-oficina_radicacion' ;}
            if(strlen($array['2.45-ciudad_radicacion'])    <>20){ $aud .=  '2.45-ciudad_radicacion' ;}
            if(strlen($array['2.46-codigo_dane_radica'])   <> 8){ $aud .=  '2.46-codigo_dane_radica' ;}
            if(strlen($array['2.47-ciudad_res_com'])       <>20){ $aud .=  '2.47-ciudad_res_com' ;}
            if(strlen($array['2.48-codigo_dane_res_com'])  <> 8){ $aud .=  '2.48-codigo_dane_res_com' ;}
            if(strlen($array['2.49-depto_res_com'])        <>20){ $aud .=  '2.49-depto_res_com' ;}
            if(strlen($array['2.50-dir_res_com'])          <>60){ $aud .=  '2.50-dir_res_com' ;}
            if(strlen($array['2.51-tel_res_com'])          <>12){ $aud .=  '2.51-tel_res_com' ;}
            if(strlen($array['2.52-ciudad_laboral'])       <>20){ $aud .=  '2.52-ciudad_laboral' ;}
            if(strlen($array['2.53-cod_dane_ciudad_lab'])  <> 8){ $aud .=  '2.53-cod_dane_ciudad_lab' ;}
            if(strlen($array['2.54-departamento_laboral']) <>20){ $aud .=  '2.54-departamento_laboral' ;}
            if(strlen($array['2.55-direccion_laboral'])    <>60){ $aud .=  '2.55-direccion_laboral' ;}
            if(strlen($array['2.56-tel_laboral'])          <>12){ $aud .=  '2.56-tel_laboral' ;}
            if(strlen($array['2.57-ciud_correspondencia']) <>20){ $aud .=  '2.57-ciud_correspondencia' ;}
            if(strlen($array['2.58-cod_dane_ciud_corresp'])<> 8){ $aud .=  '2.58-cod_dane_ciud_corresp';}
            if(strlen($array['2.59-depto_correspondencia'])<>20){ $aud .=  '2.59-depto_correspondencia';}
            if(strlen($array['2.60-dir_correspondencia'])  <>60){ $aud .=  '2.60-dir_correspondencia' ;}
            if(strlen($array['2.61-correo_electronico'])   <>60){ $aud .=  '2.61-correo_electronico' ;}
            if(strlen($array['2.62-celular'])              <>12){ $aud .=  '2.62-celular' ;}
            if(strlen($array['2.63-suscriptor_destino'])   <> 6){ $aud .=  '2.63-suscriptor_destino' ;}
            if(strlen($array['2.64-numero_tarjeta'])       <>18){ $aud .=  '2.64-numero_tarjeta' ;}
            if(strlen($array['2.65-detalle_garantia'])     <> 1){ $aud .=  '2.65-detalle_garantia' ;}
            if(strlen($array['2.66-espacio_blanco'])       <>18){ $aud .=  '2.66-espacio_blanco' ;}
        
            //dd('error de tamaño linea del crédito =:::=> '.$credito.'****'.$aud);
        }

    }

    /*
    |--------------------------------------------------------------------------
    | sanear_string
    |--------------------------------------------------------------------------
    |
    | recibe una cadena de caracteres (string)
    | retorna 
    | un string sin caracteres especiales
    |
    */

    function sanear_string($string)
    {
        $string = trim($string);
     
        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );
     
        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );
     
        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );
     
        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );
     
        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );
     
        $string = str_replace(
            array('ñ','ç', 'Ç'),
            array('Ñ','c', 'C',),
            $string
        );
     
        //Esta parte se encarga de eliminar cualquier caracter extraño
        $string = str_replace(
            array("\\", "¨", "º", "-", "~",
                 "@", "|", "!", "\"",
                 "·", "$", "%", "&", "/",
                 "(", ")", "?", "'", "¡",
                 "¿", "[", "^", "<code>", "]",
                 "+", "}", "{", "¨", "´",
                 ">", "< ", ";", ",", ":",
                 ".", " "),
            ' ',
            $string
        );

        $string = str_replace("#",'No ', $string);
     
        return $string;
    }//.sanear_string
    

/*
|--------------------------------------------------------------------------
| tipo_identificacion_datacredito
|--------------------------------------------------------------------------
|
| @recibe un Ttipo de documento
| @retorna un numero entre 1 y 4 para identificar el  tipo de documento documento
| 1-Cédulas de ciudadanía y NUIP 
| 2-Nit empresarial
| 3-Nit de extranjería
| 4-Cedulas de  extranjería
|
*/

function tipo_identificacion_datacredito($tipo_doc, $credito = null){

    if( $tipo_doc == 'Cedula Ciudadanía'                        ||
        $tipo_doc == 'CC'                                       ||
        $tipo_doc == 'Número único de Identificación Personal'  ||
        $tipo_doc == 'Tarjeta de Identidad'                     ||
        $tipo_doc == 'TI'){   
            return 1;   
        }
    else if( $tipo_doc == 'Nit'  || $tipo_doc == 'NIT' || $tipo_doc =='Rut'){  
        return 2; }

    else if( $tipo_doc == 'Nit de Extranjería'){
        return 3; }

    else if( $tipo_doc == 'Cedula de Extranjería'   ||
             $tipo_doc == 'Pasaporte'               ||
             $tipo_doc == 'Pase Diplomático'        ||
             $tipo_doc == 'Carnet Diplomático'){
        return 4;
    }
    else{
        if($credito && $credito->id)
            array_push($GLOBALS['errores_datacredito'],'Error en tipo de documento cliente: '.$credito->id);
        else
        array_push($GLOBALS['errores_datacredito'],'Error en tipo de documento cliente: ');
    }
    
}

function sanciones_vigentes($credito){
    $sanciones = array();
    foreach($credito->sanciones as $sancion){
        if( $sancion->estado == 'Debe' ){
            array_push($sanciones,$sancion->id);
        }
    }
    return $sanciones;
}

function fecha_limite_pago($credito, $corte)
{  
    if($credito->estado == 'Al dia' || $credito->estado == 'Cancelado'){

        if(count($credito->pagos) > 0){
            if(fecha_Ymd(inv_fech($credito->pagos->last()->pago_desde))){

                return fecha_Ymd(inv_fech($credito->pagos->last()->pago_desde));
            }
            else{
                return fecha_Ymd(inv_fech($credito->fecha_pago->fecha_pago));
            }
        }
        else{ 
            return fecha_Ymd(inv_fech($credito->fecha_pago->fecha_pago));
        }
        
    }
    else if($credito->estado == 'Mora'){
        return fecha_Ymd(inv_fech($credito->fecha_pago->fecha_pago));
    }
    else if($credito->estado == 'Prejuridico' ||
            $credito->estado == 'Juridico' ||
            $credito->estado == 'Cancelado por refinanciacion'){

        return fecha_Ymd(inv_fech($credito->fecha_pago->fecha_pago)) ;
    }

}


/*
|--------------------------------------------------------------------------
| fecha_plana_Ymd
|--------------------------------------------------------------------------
|
| recibe un objeto carbon
| retorn una fecha en formato yyyymmdd 
|
*/

function fecha_plana_Ymd($obj_date)
{ 
    $date = $obj_date->toDateString();
    $date = inv_fech(formatoFecha(dia($date),mes($date),ano($date)));
    $date = str_replace('-','',$date);
    $date = str_replace(' ','',$date);
    $date = str_replace(':','',$date);
    return $date;
}




/*
|--------------------------------------------------------------------------
| cast_number
|--------------------------------------------------------------------------
|
| recibe un string y un entero que indica el tamaño requerido
| retorna el valor alineado a la derecha con seros a la izquierda ejemplo
| cast('hola',10); .. retorna '000000hola'
|
*/

function cast_number($data, $len, $align)
{
    if($data == 'NULL'){
        $data = '';
    }
    if($align == 'right'){
        while(strlen($data) < $len){
            $data = '0'.$data;
        }
    }
    elseif($align == 'left'){
        while(strlen($data) < $len){
            $data = $data.'0';
        }
    }
    else{
        array_push($GLOBALS['errores_datacredito'],'Error al hacer cast credito: '.$data);
    }
    return $data;  
}


/*
|--------------------------------------------------------------------------
| cast_string
|--------------------------------------------------------------------------
|
| recibe un string y un entero que indica el tamaño requerido
| retorna un string alineado a la izquiereda completado con espacios a la derecha ejemplo
| cast('hola',10); .. retorna 'hola      '
|
*/
function cast_string($string, $len)
{
    if($string === 'NULL'){
        $string = '';
    } 
    //mb_strlen para contar carcateres como ~ y ' 
    while(strlen($string) < $len){
        $string = $string.' ';
    }
    if( strlen($string) > $len ){
        return substr($string,0,$len);
    }
    else{
        return $string;
    }
}

/*
|--------------------------------------------------------------------------
| fecha_Ymd
|--------------------------------------------------------------------------
|
| recibe un string con una fecha dd-mm-yyyy
| retorna una fecha en formato yyyymmdd
|
*/

function fecha_Ymd($str)
{
    $str = inv_fech($str);
    return str_replace('-','',$str);
}

/*
|--------------------------------------------------------------------------
| vence_credito
|--------------------------------------------------------------------------
|
| recibe un objeto credito
| retorna la fecha ideal en la que finaliza el crédito
| pago_hasta() esta en helpers.php
|
*/

function vence_credito($credito)
{

    $fecha_ini  = $credito->fecha_pago->fecha_pago;
    $periodo    = $credito->precredito->periodo;
    $num_cuotas = $credito->cuotas_faltantes;
    $p_fecha    = $credito->precredito->p_fecha;
    $s_fecha    = $credito->precredito->s_fecha;

    $vencimiento = pago_hasta($fecha_ini, $periodo, $num_cuotas,$p_fecha, $s_fecha);
    $vencimiento = fecha_Ymd($vencimiento);
    
    return $vencimiento;
}

/*
|--------------------------------------------------------------------------
| forma_pago
|--------------------------------------------------------------------------
|
| recibe un objeto credito
| retorna 0-No pagado vigente, 1-pago voluntario, 2-proceso ejecutivo
| 4-reestructuración / refinanciación
|
*/
function forma_pago($estado){

    $forma_pago = '';

    if( $estado == 'Cancelado'|| $estado  == 'Finalizado' ){
        $forma_pago = '1';
    }
    else if ( $estado == 'Cancelado por refinanciacion' ){
        $forma_pago = '4';
    }
    else{
        $forma_pago = '0';
    }

    return $forma_pago;

}

/*
|--------------------------------------------------------------------------
| periodicidad
|--------------------------------------------------------------------------
|
| recibe un objeto credito
| retorna 1 si es mensual el pago o 9 si es quincenal
|
*/


function periodicidad_datacredito($credito){
    $periodicidad = '';
    if($credito->precredito->periodo == 'Mensual'){
        $periodicidad = 1;
    }
    else if($credito->precredito->periodo == 'Quincenal'){
        $periodicidad = 9;
    }
    return $periodicidad;
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


function novedad($credito,$corte){

    $estado     = $credito->estado;
    $dias_mora  = dias_mora($credito, $corte);
    $novedad    = '';

    if($estado == 'Al dia' || ($estado == 'Mora' && $dias_mora < 30) )
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


/*
|--------------------------------------------------------------------------
| estado_origen
|--------------------------------------------------------------------------
|
| recibe un objeto credito
| retorna 0 => Normal-Creación por apertura
| retorna 2 => Refinanciación
|
|
*/

function estado_origen($credito){

    if( $credito->credito_refinanciado_id != NULL ){
        $fecha  = $credito->refinanciado->precredito->fecha;
        $estado = 2;
    }
    else{
        $fecha  = $credito->precredito->fecha;
        $estado = 0;
    }
    return ['estado' => $estado, 'fecha' => $fecha];
}



/*
|--------------------------------------------------------------------------
| estado_cuenta
|--------------------------------------------------------------------------
|
| recibe un objeto credito
| retorna el estado y la fecha del estado
| 
| Es el comportamiento que tuvo el manejo del crédito durante el curso de los días 
| comprendidos entre la fecha de corte del mes  anterior  y  la  fecha  de  corte  actual,  
| correspondiente  al  mes  en  que  se  toma  la  información  para  ser  enviada  a 
| DataCrédito y debe ser reportada codificada en 2 dígitos. 
|
*/

function estado_cuenta($credito,$fecha_corte)
{

    $estado_cuenta = '';
    $fecha = fecha_plana_Ymd($fecha_corte);

    if( $credito->estado == 'Al dia' || ($credito->estado == 'Mora' && dias_mora($credito,$fecha_corte) < 30)){
        $estado_cuenta = '01'; // Al día
    }
    if( $credito->estado == 'Mora' && dias_mora($credito,$fecha_corte) >= 30){
        $estado_cuenta = '02'; // En mora
    }
    if( $credito->estado == 'Juridico' || $credito->estado == 'Prejuridico')
    {
        $estado_cuenta = '02'; // En mora
    }
    if( $credito->estado == 'Cancelado por refinanciacion'){
        $fecha = fecha_plana_Ymd($credito->updated_at);
        $estado_cuenta = '12'; // Cancelada por reestructuración / refinanciación
    }
    if($credito->estado == 'Cancelado' || $credito->saldo == 0){
        $fecha = fecha_plana_Ymd($credito->updated_at);
        $estado_cuenta = '03'; // Pago total
    }

    return array('fecha' => $fecha,'estado_cuenta' => $estado_cuenta);
}


/*
|--------------------------------------------------------------------------
| adjetivo
|--------------------------------------------------------------------------
|
| recibe un objeto credito
| retorna el adjetivo y la fecha
| detalle mas específico de la obligación
|
*/

function adjetivo($credito){

    $adjetivo = '0';
    $fecha = '00000000';

    if($credito->estado == 'Prejuridico'){
        $adjetivo = '6';
        $fecha = fecha_plana_Ymd( $credito->updated_at );
    }
    else if($credito->estado == 'Juridico'){
        $adjetivo = '7';
        $fecha = fecha_plana_Ymd( $credito->updated_at );
    }
    return ['adjetivo' => $adjetivo,'fecha' => $fecha];
}

/*
|--------------------------------------------------------------------------
| saldo_deuda_capital
|--------------------------------------------------------------------------
|
| recibe un objeto credito y la fecha de corte
| retorna el saldo del vlr_credito (saldo del capital sin intereses)
|
*/


function saldo_deuda_capital($credito, $corte)
{

    if($credito->saldo == 0 || $credito->cuotas_faltantes == 0){ return 0; }

    $pagos = DB::table('pagos')
                ->where([['created_at','<=',inv_fech($corte)],['credito_id','=',$credito->id]])
                ->get();

    if($credito->precredito->cuotas != 0){
        $valor_real_cuota = $credito->precredito->vlr_fin / $credito->precredito->cuotas;
    }
    else{
        array_push($GLOBALS['errores_datacredito'], '2.33-División por 0 credito: '.$credito->id.' cuotas: '.$credito->precredito->cuotas);
        $valor_real_cuota = 0;
    }
    $sum_pagos = 0;
    $vlr_cuota = $credito->precredito->vlr_cuota;

    foreach($pagos as $pago){
        if($pago->concepto == 'Cuota'){
           $cuotas = $pago->abono / $credito->precredito->vlr_cuota; 
           $sum_pagos = $sum_pagos + ($valor_real_cuota * $cuotas); 
        }
        elseif($pago->concepto == 'Cuota Parcial'){
            $parcial_real = $pago->abono * $valor_real_cuota / $vlr_cuota ;
            $sum_pagos = $sum_pagos + $parcial_real;
        }
    }

    $deuda =  (int)($credito->precredito->vlr_fin - $sum_pagos) ;

    if($deuda < 0){
        return 0;
    } else {
        return $deuda;
    }
}

function fecha_pago($credito){
    $factura = ultima_factura($credito);
    if($factura){
        return $factura->fecha;
    }
    else{
        return '';
    }
}

$GLOBALS['errores_datacredito'] = array();

function cuotas_canceladas($credito){

    $cts            = $credito->precredito->cuotas;
    $cts_faltantes  = $credito->cuotas_faltantes;
    $cts_canceladas = 0;


    $cts_canceladas = $cts - $cts_faltantes;

    if ( $cts_canceladas < 0 || $cts_canceladas > $cts )
    {
        array_push($GLOBALS['errores_datacredito'], '2.38-EXISTE UN PROBLEMA CON LAS CUOTAS CANCELADAS EN EL CRÉDITO ' . $credito->id  . 
                ' : cuotas pactadas ('. $cts .') - cuotas faltantes ('.$cts_faltantes .') = '.$cts_canceladas);
    }

    return $cts_canceladas;
}


/*
|--------------------------------------------------------------------------
| saldo_en_mora
|--------------------------------------------------------------------------
|
| recibe un objeto credito y la fecha de corte
| retorna 
| detalle mas específico de la obligación
|
*/

function saldo_en_mora($credito,$corte){
    $sanciones_diarias  = 0;
    $cta_parcial        = 0;
    $cuotas             = 0;

    try
    {
        if( $credito->estado != 'Al dia' && dias_mora($credito,$corte) > 30 ){

            $sanciones_diarias = dias_mora($credito, $corte) * Variable::find(1)->vlr_dia_sancion;
            $cuotas = cuotas_mora($credito, $corte)['cts_mora'] * $credito->precredito->vlr_cuota;

            $cuota_parcial = DB::table('pagos')
                                ->where([['credito_id','=',$credito->id],
                                        ['concepto','=','Cuota Parcial'],
                                        ['estado','=','Debe'],
                                        ['created_at','<=',$corte]])
                                ->get();

            if($cuota_parcial){
                $cta_parcial = (int)$cuota_parcial[0]->debe;
            }
        }

        return (int)($sanciones_diarias + $cta_parcial + $cuotas);     
    }
    catch(\Exception $e){
        dd($e->getMessage() .' ' . $credito->id);
    }


    /*
    |--------------------------------------------------------------------------
    | cts_mora
    |--------------------------------------------------------------------------
    |
    | recibe un objeto credito y la fecha de corte
    | retorna 
    | numero de cuotas en mora
    |
    */


    function cts_mora($credito, $corte)
    {
        // a los Cancelados se les quita las cuotas en mora
        if( $credito->estado == 'Cancelado' || $credito->estado == 'Cancelado por refinanciacion' ){ 

            return array('cts_mora' => 0 , 'cts_mora_todas' => 0 );
        }

        //CALCULA LOS DIAS EN MORA
        $dias_mora = dias_mora($credito, $corte);

        if( $dias_mora > DIAS_PARA_REPORTAR )
        {
            //pago_hasta es la fecha limite de pago

            $pago_hasta     = FechaCobro::where('credito_id',$credito->id)->get();
            $pago_hasta     = $pago_hasta[0]->fecha_pago;
            $f_pago         = Carbon::create(ano($pago_hasta),mes($pago_hasta),dia($pago_hasta));

        }// .if


    }//.cts_mora

}
