<?php

namespace App\Traits;
use GuzzleHttp\Client; 
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

trait Mensaje
{
	//array con yave y atributos: estado (1 para activo, 0 para inactivo) y contenido del mensaje a enviar

	public function tipo_mensaje()
	{
		$list = [
			'MSS111' => 
			[
				'estado'	=> '1',
				'contenido' => 'Su solicitud de financiación ha sido aprobada'
			],
			'MSS222' =>
			[
				'estado'	=> '1', 
				'contenido' => 'Usted presenta 5 días de mora'
			],
			'MSS333' =>
			[
				'estado'	=> '1',
				'contenido' => 'Usted presenta 20 días de mora'
			],
			'MSS444' =>
			[
				'estado'	=> '1',
				'contenido' => 'Su obligación ha pasado a cobro prejurídico'
			],
			'MSS555' =>
			[
				'estado'	=> '1',
				'contenido' => 'Su obligación ha pasado a cobro jurídico'
			],
			'MSS666' =>
			[
				'estado'	=> '1',
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
		$tel = $this->array_to_string($telefonos);

		$result = $this->api_hablame($tel,$key);

		$this->log($result, 'seguimiento/mensajes_de_texto', 'seguimiento/errores');

		if ($result["resultado"]===0) {
			print 'Se ha enviado el SMS exitosamente';
		} 
		else {
			print 'ha ocurrido un error!!';
		}

		dd(1);

		$this->log($result);

	}

	public function log($mensaje, $ruta_registro, $ruta_error)
	{
		$now = Carbon::now();

		try
		{
			if(Storage::disk('local')->exists($ruta_registro)){

				$txt = Storage::disk('local')->get($ruta_registro);
				$txt = $now->toDateTimeString().' ==> '.$mensaje. "\n".$txt;
			}
			else{

				Storage::disk('local')->put($ruta_registro,'CREACIÓN');	
				$txt = $now->toDateTimeString().' ==> '.$mensaje;
			}

			Storage::disk('local')->put($ruta_registro,$txt);

			return true;
			
		}
		catch(\Exception $e)
		{
			Storage::disk('local')->put($ruta_error,$e->getMessage());
			Log::error('FUNCTION LOG() - ERROR EN GUARDADO DE SEGUIMIENTO'.$e->getMessage());

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
		$mdt = $this->get_tipo_mensaje($key);

		$url = 'https://api.hablame.co/sms/envio/';

		$data = array(
			'cliente' 	=> 10012723, //Numero de cliente
			'api' 		=> 'XcCBHyhMMbtGQ9dVk2LuqYOHgRy07k', //Clave API suministrada
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




