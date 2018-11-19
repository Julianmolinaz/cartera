<?php

namespace App\Traits;
use GuzzleHttp\Client; 
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| trait Mensaje
|--------------------------------------------------------------------------
|	trait que permite enviar mensajes de texto a una api
| 
*/

trait Mensaje
{
	//array con llave y atributos: estado (1 para activo, 0 para inactivo) y contenido del mensaje a enviar

	/*
    |--------------------------------------------------------------------------
    | tipo_mensaje
    |--------------------------------------------------------------------------
    |
    | listado de mensajes de texto a enviar.
    | "estado" => puede ser 0 (Inactivo), (1) (Activo)
    | "contenido" => texto a ser enviado
    | retorna el listado de mensajes
    */


	public function tipo_mensaje()
	{
		$list = [
			//aprobación
			'MSS111' => 
			[
				'estado'	=> '0',
				'contenido' => 'INVERSIONES GORA SAS le informa que el crédito solicitado por usted ha sido aprobado. Cualquier inquietud comunicarse al Tel: 3104442464'
			],
			//5 dias de mora
			'MSS222' =>
			[
				'estado'	=> '0', 
				'contenido' => 'INVERSIONES GORA SAS le informa que su crédito presenta una mora de cinco (5) dias, lo invitamos a que pueda normalizar su obligación. Cualquier inquietud comunicarse al Tel: 3104450956 o visitenos a www.inversionesgora.com'
			],
			//20 dias de mora
			'MSS333' =>
			[
				'estado'	=> '0',
				'contenido' => 'INVERSIONES GORA SAS le informa que su crédito presenta una mora de veinte (20) dias, lo invitamos a que pueda normalizar su obligación y evite reportes negativos en las centrales de riesgo. Cualquier inquietud comunicarse al Tel: 3104450956'
			],
			//estado prejuridico
			'MSS444' =>
			[
				'estado'	=> '0',
				'contenido' => 'INVERSIONES GORA SAS le informa que su crédito pasó a estado prejurídico, lo invitamos a que se presenta al punto mas cercano y pueda normalizar su obligación, evite costos jurídicos. Cualquier inquietud comunicarse al Tel: 3104450956'
			],
			//estado juridico
			'MSS555' =>
			[
				'estado'	=> '0',
				'contenido' => 'INVERSIONES GORA SAS le informa que su crédito pasó a estado Jurídico, lo invitamos a que de manera URGENTE se presenta al punto mas cercano, pregunte por el estado de su cuenta y evite costos jurídicos. Cualquier inquietud comunicarse al Tel: 3104450956'
			],
			//cumpleaños
			'MSS666' =>
			[
				'estado'	=> '0',
				'contenido' => 'INVERSIONES GORA SAS le desea un feliz cumpleaños terminar.....'
			],
		];

		return $list;
	}

	/*
    |--------------------------------------------------------------------------
    | get_tipo
    |--------------------------------------------------------------------------
    |
    | recibe una llave ejemplo: "MSS111"
    | retorna el elemento del listado de tipos de mensaje (function tipo_mensaje())
    |
    */

	public function get_tipo_mensaje($key)
	{
		return $this->tipo_mensaje()[$key];
	}

	/*
    |--------------------------------------------------------------------------
    | send_message
    |--------------------------------------------------------------------------
    |
    | recibe un telefono celular y una llave ("key")
    | gestiona todo el envío de mensaje utilizando otros metodos
    | para generar el envio a la api de Hablame y un registro en un log de actividades 
    |
    */


	public function send_message($telefonos,$key)
	{
		$tipo_msm = $this->get_tipo_mensaje($key);

		if($tipo_msm['estado'])
		{
			$tel = $this->array_to_string($telefonos);

			$result = $this->api_hablame($tel,$key);


			$this->log(serialize($result), 
					   'seguimiento/mensajes_de_texto', 
					   'seguimiento/errores');

			if ($result["resultado"] === 0) {
				print 'Se ha enviado el SMS exitosamente';
			} 
			else {
				print 'ha ocurrido un error!!';
			}
			
		}	
		else{
			print 'la opcion se encuentra deshabilitada';
			$this->log('la opcion se encuentra deshabilitada '.$key,'seguimiento/mensajes_de_texto', 'seguimiento/errores');
		}

	}
	/*
    |--------------------------------------------------------------------------
    | log
    |--------------------------------------------------------------------------
    |
    | Registra el estado del envio del mensaje, si fue enviado o no
    | entradas: 
    | $mensaje : teto a guardar en el log; $ruta_registro: ruta del log donde se va a registrar
    | $ruta_error: ruta del log de error
    |
    */

	public function log($mensaje, $ruta_registro, $ruta_error)
	{
		$now = Carbon::now();

		try
		{
			if(Storage::disk('local')->exists($ruta_registro)){

				$txt = Storage::disk('local')->get($ruta_registro);
				$txt = '#########'.$now->toDateTimeString().' ==> '.$mensaje. "\n".$txt."\n";
			}
			else{

				Storage::disk('local')->put($ruta_registro,'CREACIÓN');	
				$txt = $now->toDateTimeString().' ==> '.$mensaje."\n";
			}

			Storage::disk('local')->put($ruta_registro,$txt."\n\n");

			return true;
			
		}
		catch(\Exception $e)
		{
			Storage::disk('local')->put($ruta_error,$e);
			return false;
		}
	}//.log


	/**
	 *  api_hablame
	 *  @input $telefonos: string de telefonos separados por comas
	 *  @input $mensaje: string de mensaje a enviar
	 *  @input $key: string con el código de mensaje
	 */

	public function api_hablame($telefonos, $key)
	{
		$client = 10012808;
		$clave_api = 'bHoHiZWU96RC1yctSJoK3fSTXhUah7';

		$mdt = $this->get_tipo_mensaje($key);

		$url = 'https://api.hablame.co/sms/envio/';

		$data = array(
			'cliente' 	=> $client, //Numero de cliente
			'api' 		=> $clave_api, //Clave API suministrada
			'numero' 	=> $telefonos, //numero o numeros telefonicos a enviar el SMS (separados por una coma ,)
			'sms' 		=> $mdt['contenido'], //Mensaje de texto a enviar
			'fecha' 	=> '', //(campo opcional) Fecha de envio, si se envia vacio se envia inmediatamente (Ejemplo: 2017-12-31 23:59:59)
			'referencia'=> $key, //(campo opcional) Numero de referencio ó nombre de campaña
		);

		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($data)
		    )
		);
		$context  = stream_context_create($options);
		$result = json_decode((file_get_contents($url, false, $context)), true);

		return $result;

	}

	/*
    |--------------------------------------------------------------------------
    | array_to_string
    |--------------------------------------------------------------------------
    |
    | Convierte un array en un string
    | entrada $array = array con telefonos
    | retorna $temp = string de telefonos separados por comas
    |
    */

	public function array_to_string($array)
	{
		$temp = '';
		
		if(count($array) == 0){
			return 'array_vacio';
		}

		for ($i=0; $i < count($array) ; $i++) { 

			if($i == count($array) - 1){
				$temp = $temp . $array[$i];
			}
			else{
				$temp = $temp . $array[$i]	. ',';
			}
		}

		return $temp;
	}

}




