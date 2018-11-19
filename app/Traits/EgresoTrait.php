<?php

namespace App\Traits;

use App\Egreso;
use DB;


trait EgresoTrait
{
	function get_egresos($ini, $fin)
	{
		$egresos = DB::table('egresos')
			->whereBetween('fecha',[ $ini->format('d-m-Y'),$fin->format('d-m-Y')])
			->get();

		return $egresos;
	}


 
}