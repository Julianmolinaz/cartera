<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pago;
use App\Credito;
use App\Variable;
use App\Egreso;
use App\Cartera;
use DB;
use Carbon\Carbon;
use App\Factura;
use App\OtrosPagos;
use Auth;
use App\Llamada;
use App\User;

function reporte_general_por_funcionarios( $fecha_1, $fecha_2){
  

  $ini     = Carbon::create(ano($fecha_1),mes($fecha_1),dia($fecha_1),00,00,00);
  $fin     = Carbon::create(ano($fecha_2),mes($fecha_2),dia($fecha_2),23,59,59);
  $rango   = array('ini' => $ini->format('d-m-Y'), 'fin' => $fin->format('d-m-Y')); 


  $date               = $ini->toDateString(); 
  $estudio_tipico     = Variable::find(1)->vlr_estudio_tipico;    //valor del estudio de credito tipico
  $estudio_domicilio  = Variable::find(1)->vlr_estudio_domicilio;   //valor del estudio de credito a domicilio


  $pagos = 
  DB::table('users')
    ->join('puntos','users.punto_id','=','puntos.id')
    ->join('facturas','users.id','=','facturas.user_create_id')
    ->join('creditos','facturas.credito_id','=','creditos.id')
    ->join('precreditos','creditos.precredito_id','=','precreditos.id')
    ->join('carteras','precreditos.cartera_id','=','carteras.id')
    ->select(
        'users.id as funcionario_id',
        'users.name as nombre',
        'facturas.total as valor',
        'facturas.num_fact as factura',
        'facturas.created_at as create',
        'facturas.tipo as tipo_pago',
        'carteras.nombre as cartera',
        'puntos.nombre as punto',
        'creditos.id as credito'
        )
    ->where([['users.id','<>',1]])
    ->whereBetween('facturas.created_at',[$ini,$fin])
    ->orderBy('users.id')
    ->get();


  $estudios =
  DB::table('precreditos')
    ->join('users','precreditos.user_create_id','=','users.id')
    ->join('puntos','users.punto_id','=','puntos.id')
    ->join('carteras','precreditos.cartera_id','=','carteras.id')
    ->select(
        'users.id as funcionario_id',
        'users.name as nombre',
        'precreditos.estudio as estudio',
        'precreditos.num_fact as factura',
        'precreditos.created_at as create',
        'carteras.nombre as cartera',
        'puntos.nombre as punto',
        'precreditos.id as solicitud')
    ->where([['users.id','<>',1]])
    ->whereBetween('precreditos.created_at',[$ini,$fin])
    ->orderBy('users.id')
    ->get();  


  $iniciales  = 
  DB::table('creditos')
    ->join('users','creditos.user_create_id','=','users.id')
    ->join('precreditos','creditos.precredito_id','=','precreditos.id')
    ->join('puntos','users.punto_id','=','puntos.id')
    ->join('carteras','precreditos.cartera_id','=','carteras.id') 
    ->select(
        'users.id as funcionario_id',
        'users.name as nombre',
        'precreditos.cuota_inicial as inicial',
        'precreditos.num_fact as factura',
        'creditos.created_at as create',
        'carteras.nombre as cartera',
        'puntos.nombre as punto',
        'creditos.id as credito')
    ->where([['users.id','<>',1],['precreditos.cuota_inicial','>',0]])
    ->whereBetween('creditos.created_at',[$ini,$fin])
    ->orderBy('users.id')
    ->get(); 

 
  $otros_ingresos = 
  DB::table('otros_pagos')
    ->join('facturas','otros_pagos.factura_id','=','facturas.id')
    ->join('users','facturas.user_create_id','=','users.id')
    ->join('puntos','users.punto_id','=','puntos.id')
    ->join('carteras','otros_pagos.cartera_id','=','carteras.id') 
    ->select(
        'users.id as funcionario_id',
        'users.name as nombre',
        'otros_pagos.subtotal as valor',
        'facturas.num_fact as factura',
        'facturas.created_at as create',
        'carteras.nombre as cartera',
        'puntos.nombre as punto')
    ->where([['users.id','<>',1]])
    ->whereBetween('facturas.created_at',[$ini,$fin])
    ->orderBy('users.id')
    ->get(); 

  $reporte = array();

  $funcionarios = User::where('id','<>','1')->orderBy('name')->get();
  $funcionarios_array = array();
  $totales = array();

  foreach($funcionarios as $funcionario){

    $temp = array(
      'id'    => $funcionario->id,
      'nombre'=> $funcionario->name,
      'punto' => $funcionario->punto->nombre,
      'total' => 0
      );
    array_push($funcionarios_array, $temp);
  }

// Se convierte cada uno de los conceptos en un elemento del array reporte
// Los conceptos son pagos (todos las facturas de los pagos por credito)
// iniciales que son las cuotas iniciales registradas en las solicitadas
// cabe recordar que el valor a recaudar se hace efectivo cuando se aprueba 
// y se crea el crédito,otros ingresos que son valores diferentes a los creditos.  


foreach($funcionarios_array as $funcionario){

  $total = 0;

  foreach($pagos as $pago){
     if($pago->funcionario_id == $funcionario['id']){

      $total = $total + $pago->valor;

      $temp = array(
        'funcionario' => $pago->nombre,
        'valor'       => $pago->valor,
        'tipo_pago'   => $pago->tipo_pago,
        'factura'     => $pago->factura,
        'concepto'    => 'Pago',
        'fecha'       => $pago->create,
        'cartera'     => $pago->cartera,
        'punto'       => $pago->punto,
        'credito'     => $pago->credito,
        'solicitud'   => null
        );

      array_push($reporte, $temp);

     }
    }//end foreach pagos

  foreach($estudios as $estudio){
    if($estudio->funcionario_id == $funcionario['id']){

      if($estudio->estudio == 'Tipico'){

        $total = $total + $estudio_tipico;
        
        $temp = array(
          'funcionario' => $estudio->nombre,
          'factura'     => $estudio->factura,
          'valor'       => $estudio_tipico,
          'tipo_pago'   => '',
          'concepto'    => 'Estudio',
          'fecha'       => $estudio->create,
          'cartera'     => $estudio->cartera,
          'punto'       => $estudio->punto,
          'credito'     => null,
          'solicitud'   => $estudio->solicitud
        );
        array_push($reporte, $temp);
      } 
      else if($estudio->estudio == 'Domicilio'){

        $total = $total + $estudio_domicilio;

        $temp = array(
          'funcionario' => $estudio->nombre,
          'factura'     => $estudio->factura,
          'valor'       => $estudio_domicilio,
          'tipo_pago'   => '',
          'concepto'    => 'Estudio',
          'fecha'       => $estudio->create,
          'cartera'     => $estudio->cartera,
          'punto'       => $estudio->punto,
          'credito'     => null,
          'solicitud'   => $estudio->solicitud
        );
        array_push($reporte, $temp);
        
      }        
    }
  }//end foreach estudios

  foreach($iniciales as $inicial){

    
    if($inicial->funcionario_id == $funcionario['id']){

      $total = $total + $inicial->inicial;

      $temp = array(
          'funcionario' => $inicial->nombre,
          'factura'     => $inicial->factura,
          'valor'       => $inicial->inicial,
          'tipo_pago'   => '',
          'concepto'    => 'Cuota Inicial',
          'fecha'       => $inicial->create,
          'cartera'     => $inicial->cartera,
          'punto'       => $inicial->punto,
          'credito'     => $inicial->credito,
          'solicitud'   => null
        );
        array_push($reporte, $temp);

    }
  }// end foreach iniciales

  foreach($otros_ingresos as $otro_ingreso){
    
    if($otro_ingreso->funcionario_id == $funcionario['id']){


      $total = $total + $otro_ingreso->valor;

        $temp = array(
          'funcionario' => $otro_ingreso->nombre,
          'factura'     => $otro_ingreso->factura,
          'valor'       => $otro_ingreso->valor,
          'tipo_pago'   => '',
          'concepto'    => 'Otros Ingresos',
          'fecha'       => $otro_ingreso->create,
          'cartera'     => $otro_ingreso->cartera,
          'punto'       => $otro_ingreso->punto,
          'credito'     => null,
          'solicitud'   => null,
          
        );
        array_push($reporte, $temp);

    }
  }//end foreach otros ingresos

  if($total > 0){
    $temp_totales = array(
      'funcionario'  => $funcionario['nombre'],
      'punto'        => $funcionario['punto'],
      'total'        => $total
    );
    array_push($totales, $temp_totales);
  }

  
  
} // end creacion array reporte con los especificaciones de los ingresos

//  totales


return array(
  'reporte'   => $reporte, 
  'totales'   => $totales
  );

}

?>