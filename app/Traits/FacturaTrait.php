<?php

namespace App\Traits;

use DB;
use Auth;
use App\Factura;
use App\Variable;
use Carbon\Carbon;

trait FacturaTrait
{

    /*
    |--------------------------------------------------------------------------
    | generate_content_to_print 
    |--------------------------------------------------------------------------
    |
    | funcion que genera el html a imprimir con toda la información del pago
    | recibe $factura_id = el id de la factura
    | retorna un html con toda la info
    |
    */	


	public function generate_content_to_print($factura_id)
	{
		$factura = Factura::find($factura_id);
		$now     = Carbon::now();
		$saldo   = $factura->credito->saldo;
		$prox    = ''; //html con el saldo
		$variable = Variable::all()[0];

		//evalua si el saldo es mayor de 0 (no cancelado, aun vigente)

		if($saldo > 0){
			$prox = '<p id="prox_fech_pago">Próxima fecha de pago: '. $factura->credito->fecha_pago->fecha_pago .'</p>';
		}
		else{
			$prox = '';
		}

		$str_pagos   = "";

		//generador html para pagos

		foreach($factura->pagos as $pago){
			$str_pagos .= 
			'<div id="pagos">
				<p id="concepto">'.$pago->concepto.' : $'.number_format($pago->abono,0,",",".").'</p>';

		}

		return 
		'<html>
			<head>
				<style>
					.cuerpo{
						width:45mm;
						margin-top:0px;
	    				        font-size: 11px;
						padding: 0px 5px;
					}
					.center{
						text-align: center;
					}
					.contenido{
						margin:0px 5px;
					}
					p{
						margin: 0px 0px 0px 0px;
					}
					h1,h2,h3,h4,h5{
						margin: 0px 0px 0px 0px;
					}
					#abono{
						text-align: right;
						font-size: 16px;
					}
					#subtotal, #saldo{
						text-align: right;
					}
					#concepto{
						font-weight: bold;
					}
					#prox_fech_pago, #saldo{
						text-align: center;
					}
					#cliente,#asesor{
						font-size: 10px;
					}
				</style>
			</head>
			<body>
				<div class="cuerpo">
					<div class="center" id="encabezado">
						<img src="{{ asset(\'images/gora_logo_mini.png\') }}">
						<h3 style="margin-top: -5px;">'. $variable->razon_social .'</h3>
						<p>Nit: '. $variable->nit .'</p>
						<p>Dir: '.$factura->user_create->punto->direccion.'</p>
						<p>Tel: '. $variable->telefono_1 .'</p>
					</div>
					<div id="datos_cliente" class="contenido">
						<br>
						<p>Fecha: '. $now->format('d-m-Y H:i') .'</p>
						<p id="asesor">Asesor: '. $factura->user_create->name .'</p>
						<p id="cliente">Cliente: '. $factura->credito->precredito->cliente->nombre .'</p>
						<p>Doc: '. $factura->credito->precredito->cliente->num_doc .'</p>
					</div>	
					<br>
					<div id="factura" class="contenido">
						<h4>Factura # '. $factura->num_fact .'-'. $factura->credito->id .'</h4><br>
						PAGOS:<br>'.
						$str_pagos.
						'<br>
						<div>
							<p id="abono">Total: $ '. number_format($factura->total,0,",",".") .'</p>
							<br>
							<p id="saldo">Saldo: $ '. number_format($factura->credito->saldo,0,",",".") .'</p>
							<p id="prox_fech_pago">Próxima fecha de pago: </p><br><br>
							<p>_____________________________</p>
							
						</div>			
					</div>		
					<div>
						<br>
						<p class="center">www.financiamossoat.com</p>
					</div>
				</div>
			</body>

		</html>';
	}//.generate_content_to_print
}
