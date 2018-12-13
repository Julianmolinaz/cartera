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
				<p id="concepto">Concepto: '.$pago->concepto.'</p>';

			if($pago->pago_hasta){
				$str_pagos .=
					'<p id="p_hasta">Pago Hasta: '. $pago->pago_hasta .'</p>';

			}
			$str_pagos .=	
					'<p id="subtotal">Subtotal: $ '. number_format($pago->abono,0,",",".") .'</p>
				</div>';
		}

		return 
		'<html>
			<head>
				<style>
					.cuerpo{
						width:45mm;
						margin-top:0px;
						/*border: 1px solid;*/
						font-size: 11px;
						padding: 5px 5px;
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
						<h3>'. $variable->razon_social .'</h3>
						<p>Nit: '. $variable->nit .'</p>
						<p>Dir: '.Auth::user()->punto->direccion.'</p>
						<p>Tel: '. $variable->telefono_1 .'</p>
					</div>
					<div id="datos_cliente" class="contenido">
						<br>
						<p>Fecha: '. $now->format('d-m-Y H:i') .'</p>
						<p id="asesor">Asesor: '. Auth::user()->name .'</p>
						<p id="cliente">Cliente: '. $factura->credito->precredito->cliente->nombre .'</p>
						<p>Doc: '. $factura->credito->precredito->cliente->num_doc .'</p>
					</div>	
					<br>
					<div id="factura" class="contenido">
						<h4>Referencia # '. $factura->num_fact .' - '. $factura->credito->id .'</h4><br>'.
						$str_pagos.
						'<br>
						<div>
							<p id="abono">Total: $ '. number_format($factura->total,0,",",".") .'</p>
							<br>
							<p id="saldo">Saldo: $ '. number_format($factura->credito->saldo,0,",",".") .'</p>'.
							$prox.
							
						'</div>			
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