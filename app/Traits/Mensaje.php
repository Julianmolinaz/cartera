<?php

namespace App\Traits;
use GuzzleHttp\Client; 
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

trait Mensaje
{
	//array con llave y atributos: estado (1 para activo, 0 para inactivo) y contenido del mensaje a enviar

	public function tipo_mensaje()
	{
		$list = [
			'MSS111' => 
			[
				'estado'	=> '0',
				'contenido' => '.'
				/*'contenido' => 'Su solicitud de financiación ha sido aprobada'*/
			],
			'MSS222' =>
			[
				'estado'	=> '0', 
				'contenido' => 'Usted presenta 5 días de mora'
			],
			'MSS333' =>
			[
				'estado'	=> '0',
				'contenido' => 'Usted presenta 20 días de mora'
			],
			'MSS444' =>
			[
				'estado'	=> '0',
				'contenido' => '..'
				/*'contenido' => 'Su obligación ha pasado a cobro prejurídico'*/
			],
			'MSS555' =>
			[
				'estado'	=> '0',
				'contenido' => '...'
				/*'contenido' => 'Su obligación ha pasado a cobro jurídico'*/
			],
			'MSS666' =>
			[
				'estado'	=> '0',
				'contenido' => 'Gora te desea un feliz cumpleaños'
			],
		];

		return $list;
	}

	public function get_tipo_mensaje($key)
	{
		return $this->tipo_mensaje()[$key];
	}


	public function send_message($telefonos,$key)
	{
		$tipo_msm = $this->get_tipo_mensaje($key);

		if($tipo_msm['estado'])
		{
			$tel = $this->array_to_string($telefonos);

			$result = $this->api_hablame($tel,$key);


			$this->log(serialize($result), 'seguimiento/mensajes_de_texto', 'seguimiento/errores');

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




