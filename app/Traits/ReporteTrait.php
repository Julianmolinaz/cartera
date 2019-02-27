<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB; 

trait ReporteTrait
{
	public function tipo_reportes()
	{
          return array(
               array('value' => 'auditoria','vista' => 'Auditoria del Sistema','definición'=>'Muestra las transacciones de modificación en los registros'),
               array('value' => 'caja','vista' => 'Caja','definicion' => 'Muestra todas las cajas'),
               array('value' => 'castigada', 'vista' => 'Cartera Castigada'),
               array('value' => 'callcenter','vista' => 'Call Center'),
               array('value' => 'egresos','vista' => 'Egresos','definicion' => ''),
               array('value' => 'financiero','vista'=>'Financiero operativo','definicion' => 'Este reporte evalua el estado financiero de la empresa, partiendo de la base del valor solicitado en un crédito, esto permite clasificar los tipos de obligación como ideaales, promedio y 0-1 pago'),
               array('value' => 'general','vista' => 'General'),
               array('value' => 'general_por_carteras', 'vista' => 'General por Carteras'),
               array('value' => 'general_por_users', 'vista' => 'General por Funcionarios'), 
               array('value' => 'historial_ventas','vista' => 'Historial venta de creditos'),
               array('value' => 'morosos','vista' => 'Morosos'),
               array('value' => 'procredito','vista' => 'Reporte Procredito'),
               array('value' => 'datacredito','vista' => 'Reporte Datacredito'),
               array('value' => 'data-asis','vista' => 'Reporte Datacredito asistimotos'),
               array('value' => 'venta_creditos', 'vista' => 'Venta de Créditos'),
               array('value' => 'venta_creditos_por_asesor','vista' => 'Venta de Créditos por Asesor'));
	}

}