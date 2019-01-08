<?php

namespace App\Traits;
use GuzzleHttp\Client; 
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Mensaje;

/*
|--------------------------------------------------------------------------
| trait Mensaje
|--------------------------------------------------------------------------
|	trait que permite enviar mensajes de texto a una api
| 
*/

trait MensajeTrait
{
	//array con llave y atributos: estado (1 para activo, 0 para inactivo) y contenido del mensaje a enviar



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
		$tipo_msm = Mensaje::where('nombre',$key)->get()[0];
		
		if($tipo_msm->estado)
		{
			$tel = collect($telefonos)->unique();
			
			$tel = $tel->implode(',');

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
				$txt = '######## '.$now->toDateTimeString().' ==> '.$mensaje. "\n".$txt."\n";
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
		$client = 10012723;
		$clave_api = 'VoNlXgXie6M8OgOJ37j8A0tkKmLy1s';

		$mdt = Mensaje::where('nombre',$key)->get()[0];

		$url = 'https://api.hablame.co/sms/envio/';

		$data = array(
			'cliente' 	=> $client, //Numero de cliente
			'api' 		=> $clave_api, //Clave API suministrada
			'numero' 	=> $telefonos, //numero o numeros telefonicos a enviar el SMS (separados por una coma ,)
			'sms' 		=> $mdt->mensaje, //Mensaje de texto a enviar
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


}




