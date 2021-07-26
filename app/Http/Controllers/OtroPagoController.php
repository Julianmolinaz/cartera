<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use App as _;
use Auth;
use DB;

class OtroPagoController extends Controller
{
    public function imprimir($factura_id)
    {
        $factura = _\Factura::find($factura_id);
        $now     = Carbon::now();
        $variable = _\Variable::all()[0];

        $str_otros_pagos = '';

        foreach($factura->otro_pago as $pago){
			$str_otros_pagos .= 
			'<div id="otros_pagos">
				<p id="concepto">Concepto : '.$pago->concepto.'</p>
                <p id="Sub-Total">Subtotal : $ '.number_format($pago->subtotal,0,",",".").'</p><br>'
                ;

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
						<h3 style="margin-top: -5px;">'. $variable->razon_social .'</h3>
						<p>Nit: '. $variable->nit .'</p>
						<p>Sucursal: '.$factura->user_create->punto->nombre.'
						<p>Dir: '.$factura->user_create->punto->direccion.'</p>
						<p>Tel: '. $factura->user_create->punto->telefono .'</p>
					</div>
					<div id="datos_asesor" class="contenido">
						<br>
						<p>Fecha: '. $now->format('d-m-Y H:i') .'</p>
						<p id="asesor">Asesor: '. ucwords(strtolower($factura->user_create->name)) .'</p>
					</div>	
					<br>
					<div id="factura" class="contenido">
						<h4>Recibo OI: '. $factura->num_fact.'</h4><br>'.	
						$str_otros_pagos.
						'<br>
						<div>
							<p id="abono">Total: $ '. number_format($factura->total,0,",",".") .'</p>
						</div>			
					</div>		
					<div>
						<br>
						<p class="center">www.financiamossoat.com</p>
					</div>
				</div>
			</body>

		</html>';
    }
}
