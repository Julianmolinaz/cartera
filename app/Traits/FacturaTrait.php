<?php

namespace App\Traits;

use App\Factura;

trait FacturaTrait
{
	public function generate_content_to_print($factura_id)
	{
		$factura = Factura::find($factura_id);
	}
}