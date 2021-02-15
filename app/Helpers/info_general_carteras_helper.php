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

function reporte_general_por_carteras( $fecha_1, $fecha_2 ,$cartera){
  

  $ini     = Carbon::create(ano($fecha_1),mes($fecha_1),dia($fecha_1),00,00,00);
  $fin     = Carbon::create(ano($fecha_2),mes($fecha_2),dia($fecha_2),23,59,59);
  $rango   = array('ini' => $ini->format('d-m-Y'), 'fin' => $fin->format('d-m-Y')); 


  $date               = $ini->toDateString(); //preguntar sobre esta fecha
  $estudio_tipico     = Variable::find(1)->vlr_estudio_tipico;    //valor del estudio de credito tipico
  $estudio_domicilio  = Variable::find(1)->vlr_estudio_domicilio;   //valor del estudio de credito a domicilio

  $estudio_tipico     = Variable::find(1)->vlr_estudio_tipico;    //valor del estudio de credito tipico
  $estudio_domicilio  = Variable::find(1)->vlr_estudio_domicilio;   //valor del estudio de credito a domicilio
  $cartera_id         = (int)$cartera;
            /*Ingresos Reporte Diario*/

  $cuotas = 
  DB::table('pagos')
      ->join('facturas','pagos.factura_id',           '=','facturas.id')
      ->join('users','facturas.user_create_id',       '=', 'users.id')
      ->join('creditos','facturas.credito_id',        '=','creditos.id')
      ->join('precreditos','creditos.precredito_id',  '=','precreditos.id')
      ->join('carteras','precreditos.cartera_id',     '=','carteras.id')
      ->join('clientes','precreditos.cliente_id',     '=','clientes.id')
      ->where('carteras.id','=',$cartera_id)
      ->where(function($query){
            $query->where('pagos.concepto','=','Cuota');
            $query->orWhere('pagos.concepto','=','Cuota Parcial');
      })
      ->whereBetween('facturas.created_at',[$ini, $fin])
      ->select(DB::raw('
                      clientes.nombre  as cliente,
                      clientes.num_doc as documento,
                      pagos.credito_id as credito_id, 
                      facturas.num_fact as num_fact,
                      users.name       as user_create,
                      sum(pagos.abono) as cuotas,
                      facturas.fecha   as fecha,
                      facturas.banco   as banco,
                      carteras.nombre  as cartera,
                      facturas.tipo    as tipo_pago,
                      facturas.created_at as created_at              
                      '))
      ->groupBy('facturas.id')
      ->get();

        $sanciones = 
         DB::table('pagos')
            ->join('facturas','pagos.factura_id',           '=','facturas.id')
            ->join('users','facturas.user_create_id',       '=', 'users.id')
            ->join('creditos','facturas.credito_id',        '=','creditos.id')
            ->join('precreditos','creditos.precredito_id',  '=','precreditos.id')
            ->join('carteras','precreditos.cartera_id',     '=','carteras.id')
            ->join('clientes','precreditos.cliente_id',     '=','clientes.id')
            ->where('carteras.id',   '=',$cartera_id)
            ->where('pagos.concepto','=','Mora')
            ->whereBetween('facturas.created_at',[$ini,$fin])
            ->select(DB::raw('
                            clientes.nombre  as cliente,
                            clientes.num_doc as documento,
                            pagos.credito_id as credito_id, 
                            facturas.num_fact as num_fact, 
                            users.name       as user_create,
                            sum(pagos.abono) as sanciones,
                            facturas.fecha   as fecha,
                            facturas.banco   as banco,
                            carteras.nombre  as cartera,
                            facturas.tipo    as tipo_pago,
                            facturas.created_at as created_at                           
                            '))
            ->groupBy('facturas.id')
            ->get();


          $juridicos =        
          DB::table('pagos')
              ->join('facturas','pagos.factura_id',             '=','facturas.id')
              ->join('users','facturas.user_create_id',         '=', 'users.id')
              ->join('creditos','facturas.credito_id',          '=','creditos.id')
              ->join('precreditos','creditos.precredito_id',    '=','precreditos.id')
              ->join('carteras','precreditos.cartera_id',       '=','carteras.id')
              ->join('clientes','precreditos.cliente_id',       '=','clientes.id')
              ->where('carteras.id','=',$cartera_id)
              ->where('pagos.concepto','=','Juridico')
              ->whereBetween('facturas.created_at',[$ini,$fin])
              ->select(DB::raw('
                              clientes.nombre  as cliente,
                              clientes.num_doc as documento,
                              pagos.credito_id as credito_id, 
                              facturas.num_fact as num_fact, 
                              users.name       as user_create,
                              sum(pagos.abono) as juridico,
                              facturas.fecha   as fecha,
                              facturas.banco   as banco,
                              carteras.nombre  as cartera,
                              facturas.tipo    as tipo_pago,
                              facturas.created_at as created_at                             
                              '))
              ->groupBy('facturas.id')
              ->get();    

          $prejuridicos =        
          DB::table('pagos')
              ->join('facturas','pagos.factura_id',         '=','facturas.id')
              ->join('users','facturas.user_create_id',     '=', 'users.id')
              ->join('creditos','facturas.credito_id',      '=','creditos.id')
              ->join('precreditos','creditos.precredito_id','=','precreditos.id')
              ->join('carteras','precreditos.cartera_id',   '=','carteras.id')
              ->join('clientes','precreditos.cliente_id',   '=','clientes.id')
              ->where('carteras.id','=',$cartera_id)
              ->where('pagos.concepto','=','Prejuridico')
              ->whereBetween('facturas.created_at',[$ini,$fin])
              ->select(DB::raw('
                              clientes.nombre  as cliente,
                              clientes.num_doc as documento,
                              pagos.credito_id as credito_id, 
                              facturas.num_fact as num_fact, 
                              users.name       as user_create,
                              sum(pagos.abono) as prejuridico,
                              facturas.fecha   as fecha,
                              facturas.banco   as banco,
                              carteras.nombre  as cartera,
                              facturas.tipo    as tipo_pago,
                              facturas.created_at as created_at                             
                              '))
              ->groupBy('facturas.id')
              ->get();    

          $saldos_favor =        
          DB::table('pagos')
              ->join('facturas','pagos.factura_id',             '=','facturas.id')
              ->join('users','facturas.user_create_id',         '=', 'users.id')
              ->join('creditos','facturas.credito_id',          '=','creditos.id')
              ->join('precreditos','creditos.precredito_id',    '=','precreditos.id')
              ->join('carteras','precreditos.cartera_id',       '=','carteras.id')
              ->join('clientes','precreditos.cliente_id',       '=','clientes.id')
              ->where('carteras.id','=',$cartera_id)
              ->where('pagos.concepto','=','Saldo a Favor')
              ->whereBetween('facturas.created_at',[$ini,$fin])
              ->select(DB::raw('
                              clientes.nombre  as cliente,
                              clientes.num_doc as documento,
                              pagos.credito_id as credito_id, 
                              facturas.num_fact as num_fact, 
                              users.name       as user_create,
                              sum(pagos.abono) as saldo_favor,
                              facturas.fecha   as fecha,
                              facturas.banco   as banco,
                              carteras.nombre  as cartera,
                              facturas.tipo    as tipo_pago,                            
                              facturas.created_at as created_at                             
                              '))
              ->groupBy('facturas.id')
              ->get();

          $estudios   = 
          DB::table('precreditos')
              ->join('carteras','precreditos.cartera_id',   '=','carteras.id')
              ->join('users','precreditos.user_create_id',  '=', 'users.id')
              ->join('clientes','precreditos.cliente_id',   '=','clientes.id')
              ->where('carteras.id','=',$cartera_id)
              ->where('precreditos.estudio','<>','Sin estudio')
              ->whereBetween('precreditos.created_at',[$ini,$fin])
              ->select(DB::raw('
                              null                    as credito_id,
                              clientes.nombre         as cliente,
                              clientes.num_doc        as documento,
                              precreditos.num_fact    as factura,
                              users.name              as user_create,
                              precreditos.fecha       as fecha,
                              carteras.nombre         as cartera,
                              precreditos.estudio     as estudio,
                              precreditos.created_at  as created_at
                              '))->get();  


                  $array_estudios = array();
                  foreach ($estudios as $credito) {

                      if     ($credito->estudio == 'Tipico'){ $valor_estudio = $estudio_tipico;   }
                      else if($credito->estudio == 'Domicilio'){ $valor_estudio = $estudio_domicilio;}

                      $temp = array(
                          'credito_id'    => $credito->credito_id,
                          'cliente'       => $credito->cliente,
                          'documento'     => $credito->documento,
                          'factura'       => $credito->factura,
                          'user_create'   => $credito->user_create,
                          'fecha'         => $credito->fecha,
                          'cartera'       => $credito->cartera,
                          'estudio'       => $credito->estudio,
                          'created_at'    => $credito->created_at,     
                          'valor_estudio' => $valor_estudio
                                  );
                      array_push($array_estudios,$temp);
                  }

                  

        $iniciales   = 
        DB::table('precreditos')
            ->join('fact_precreditos','precreditos.id','=','fact_precreditos.precredito_id')
            ->join('precred_pagos','fact_precreditos.id','=','precred_pagos.fact_precredito_id')
            ->leftjoin('creditos','precreditos.id','=','creditos.precredito_id')
            ->join('users','precreditos.user_create_id','=', 'users.id')
            ->join('carteras','precreditos.cartera_id','=','carteras.id')
            ->join('clientes','precreditos.cliente_id','=','clientes.id')
            ->where('carteras.id','=',$cartera_id)
            ->where('concepto_id',2)
            ->whereBetween('fact_precreditos.created_at',[$ini,$fin])
            ->select(DB::raw('
                            creditos.id                   as credito_id,
                            clientes.nombre               as cliente,
                            clientes.num_doc              as documento,
                            precreditos.num_fact          as factura,
                            precreditos.fecha             as fecha,
                            carteras.nombre               as cartera,
                            users.name                    as user_create,
                            fact_precreditos.total        as cta_inicial,
                            fact_precreditos.created_at   as created_at
                            '))->get();  


          $otros_pagos = 
          DB::table('otros_pagos')
              ->join('facturas','otros_pagos.factura_id','=','facturas.id')
              ->join('users','facturas.user_create_id',  '=', 'users.id')
              ->join('carteras','otros_pagos.cartera_id','=','carteras.id')
              ->where('carteras.id','=',$cartera_id)
              ->whereBetween('facturas.created_at',[$ini,$fin])
              ->select(DB::raw('
                            facturas.num_fact       as factura, 
                            users.name              as user_create,
                            facturas.tipo           as tipo, 
                            otros_pagos.subtotal    as subtotal,   
                            otros_pagos.concepto    as concepto, 
                            facturas.fecha          as fecha, 
                            carteras.nombre         as cartera, 
                            otros_pagos.created_at  as created_at'))
              ->get();


          $users = 

          DB::table('users')
          ->join('puntos','users.punto_id','=','puntos.id')
          ->leftJoin('facturas','users.id','=','facturas.user_create_id')
          ->join('creditos','facturas.credito_id','=','creditos.id')
          ->join('precreditos','creditos.precredito_id','=','precreditos.id')
          ->join('carteras','precreditos.cartera_id','=','carteras.id')
          ->select(DB::raw(
              'users.id as id,
               users.name as nombre,
               puntos.nombre as punto,
               SUM(facturas.total) as total
               '))
          ->where([['users.id','<>',1],['carteras.id','=',$cartera_id]])
          ->whereBetween('facturas.created_at',[$ini,$fin])
          ->groupBy('users.id')
          ->get();

            
    // EGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOS
    // EGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOSEGRESOS
     /* Egresos Reporte Diario */

    $gastos = Egreso::where('concepto','Gastos')->where('cartera_id',$cartera_id)->whereBetween('created_at',[$ini,$fin])->get();
    $compras = Egreso::where('concepto','Compras')->where('cartera_id',$cartera_id)->whereBetween('created_at',[$ini,$fin])->get();
    $prestamos = Egreso::where('concepto','Prestamos')->where('cartera_id',$cartera_id)->whereBetween('created_at',[$ini,$fin])->get();
    $pago_proveedores = Egreso::where('concepto','Pago a Proveedores')->where('cartera_id',$cartera_id)->whereBetween('created_at',[$ini,$fin])->get();

/* totales por cada concepto de egreso*/


    $total_gastos = 
    Egreso::where('concepto','Gastos')
        ->where('cartera_id',$cartera_id)
        ->whereBetween('created_at',[$ini,$fin])
        ->sum('valor');

    $total_compras = 
    Egreso::where('concepto','Compras')
        ->where('cartera_id',$cartera_id)
        ->whereBetween('created_at',[$ini,$fin])
        ->sum('valor');

    $total_prestamos = 
    Egreso::where('concepto','Prestamos')
        ->where('cartera_id',$cartera_id)
        ->whereBetween('created_at',[$ini,$fin])
        ->sum('valor');

    $total_pago_proveedores = 
    Egreso::where('concepto','Pago a Proveedores')
        ->where('cartera_id',$cartera_id)
        ->whereBetween('created_at',[$ini,$fin])
        ->sum('valor');


    $total_cuotas = 0;    
    foreach($cuotas as $cuota){ $total_cuotas = $total_cuotas + $cuota->cuotas; }

    $total_sanciones = 0;    
    foreach($sanciones as $sancion){ $total_sanciones = $total_sanciones + $sancion->sanciones; }

    $total_juridicos = 0;    
    foreach($juridicos as $juridico){ $total_juridicos = $total_juridicos + $juridico->juridico; }

    $total_prejuridicos = 0;    
    foreach($prejuridicos as $prejuridico){ $total_prejuridicos = $total_prejuridicos + $prejuridico->prejuridico; }

    $total_saldos = 0;    
    foreach($saldos_favor as $saldo){ $total_saldos = $total_saldos + $saldo->saldo_favor; }

    $total_estudios = 0;    
    foreach($array_estudios as $estudio){ $total_estudios = $total_estudios + $estudio['valor_estudio']; }

    $total_iniciales = 0;    
    foreach($iniciales as $inicial){ $total_iniciales = $total_iniciales + $inicial->cta_inicial; }

    $total_otros_ingresos = 0;
    foreach($otros_pagos as $otro_pago){ $total_otros_ingresos = $total_otros_ingresos + $otro_pago->subtotal; }

/*Total Ingresos pora cada una de las carteras*/

    $carteras           = DB::table('carteras')->select('id','nombre')->get();
    $array_carteras     = array();

    foreach($carteras as $cartera){ 
        $temp = array('id' => $cartera->id, 'nombre' => $cartera->nombre, 'ingreso' => 0 ,'egreso' => 0,'diferencia' => 0);
                array_push($array_carteras,$temp);
    }

    foreach($cuotas as $cuota){
        foreach($array_carteras as $key => $cartera){
            if($cartera['nombre'] == $cuota->cartera){
                $cartera['ingreso'] = $cartera['ingreso'] + $cuota->cuotas;
                break; 
            }}}
      
    for($i = 0; $i < count($cuotas); $i++){
        for($j = 0; $j < count($array_carteras); $j++){
            if($array_carteras[$j]['nombre'] == $cuotas[$i]->cartera){
                $array_carteras[$j]['ingreso'] = $array_carteras[$j]['ingreso'] + $cuotas[$i]->cuotas;  
                break;
            }}}  

    for($i = 0; $i < count($sanciones); $i++){
        for($j = 0; $j < count($array_carteras); $j++){
            if($array_carteras[$j]['nombre'] == $sanciones[$i]->cartera){
                $array_carteras[$j]['ingreso'] = $array_carteras[$j]['ingreso'] + $sanciones[$i]->sanciones;  
                break;
            }}}  

    for($i = 0; $i < count($juridicos); $i++){
        for($j = 0; $j < count($array_carteras); $j++){
            if($array_carteras[$j]['nombre'] == $juridicos[$i]->cartera){
                $array_carteras[$j]['ingreso'] = $array_carteras[$j]['ingreso'] + $juridicos[$i]->juridico;  
                break;
            }}}   

    for($i = 0; $i < count($prejuridicos); $i++){
        for($j = 0; $j < count($array_carteras); $j++){
            if($array_carteras[$j]['nombre'] == $prejuridicos[$i]->cartera){
                $array_carteras[$j]['ingreso'] = $array_carteras[$j]['ingreso'] + $prejuridicos[$i]->prejuridico;  
                break;
            }}}

    for($i = 0; $i < count($saldos_favor); $i++){
        for($j = 0; $j < count($array_carteras); $j++){
            if($array_carteras[$j]['nombre'] == $saldos_favor[$i]->cartera){
                $array_carteras[$j]['ingreso'] = $array_carteras[$j]['ingreso'] + $saldos_favor[$i]->saldo_favor;  
                break;
            }}}

    for($i = 0; $i < count($array_estudios); $i++){
        for($j = 0; $j < count($array_carteras); $j++){
            if($array_carteras[$j]['nombre'] == $array_estudios[$i]['cartera']){
                $array_carteras[$j]['ingreso'] = $array_carteras[$j]['ingreso'] + $array_estudios[$i]['valor_estudio'];  
                break;
            }}}

    for($i = 0; $i < count($iniciales); $i++){
        for($j = 0; $j < count($array_carteras); $j++){
            if($array_carteras[$j]['nombre'] == $iniciales[$i]->cartera){
                $array_carteras[$j]['ingreso'] = $array_carteras[$j]['ingreso'] + $iniciales[$i]->cta_inicial;  
                break;
            }}}

    for($i = 0; $i < count($otros_pagos); $i++){
      for($j = 0; $j < count($array_carteras); $j++){
          if($array_carteras[$j]['nombre'] == $otros_pagos[$i]->cartera){
              $array_carteras[$j]['ingreso'] = $array_carteras[$j]['ingreso'] + $otros_pagos[$i]->subtotal;  
              break;
          }}}          
/*Total Egresos pora cada una de las carteras*/

    for($i = 0; $i < count($gastos); $i++){
        for($j = 0; $j < count($array_carteras); $j++){
            if($array_carteras[$j]['nombre'] == $gastos[$i]->cartera->nombre){
                $array_carteras[$j]['egreso'] = $array_carteras[$j]['egreso'] + $gastos[$i]->valor;  
                break;
            }}}

    for($i = 0; $i < count($compras); $i++){
        for($j = 0; $j < count($array_carteras); $j++){
            if($array_carteras[$j]['nombre'] == $compras[$i]->cartera->nombre){
                $array_carteras[$j]['egreso'] = $array_carteras[$j]['egreso'] + $compras[$i]->valor;  
                break;
            }}}

    for($i = 0; $i < count($prestamos); $i++){
        for($j = 0; $j < count($array_carteras); $j++){
            if($array_carteras[$j]['nombre'] == $prestamos[$i]->cartera->nombre){
                $array_carteras[$j]['egreso'] = $array_carteras[$j]['egreso'] + $prestamos[$i]->valor;  
                break;
            }}} 

    for($i = 0; $i < count($pago_proveedores); $i++){
        for($j = 0; $j < count($array_carteras); $j++){
            if($array_carteras[$j]['nombre'] == $pago_proveedores[$i]->cartera->nombre){
                $array_carteras[$j]['egreso'] = $array_carteras[$j]['egreso'] + $pago_proveedores[$i]->valor;  
                break;
            }}}                 


    $total = array('ingresos' => 0, 'egresos' => 0,'diferencia' => 0);

    foreach($array_carteras as $array_cartera){
        $total['ingresos']  = $total['ingresos'] + $array_cartera['ingreso'];
        $total['egresos']   = $total['egresos']  + $array_cartera['egreso']; 
    }

    /**
     * calculo de la diferencia = ingresos -egresos, tanto para $array_carteras como $total
     */
    for($i = 0; $i < count($array_carteras); $i++){
        $array_carteras[$i]['diferencia'] = $array_carteras[$i]['ingreso'] - $array_carteras[$i]['egreso'];
    }

    $total['diferencia'] = $total['ingresos'] - $total['egresos'];

    $reporte = array(
                'cuotas' => $cuotas,
                'sanciones' => $sanciones,
                'juridicos' => $juridicos,
                'prejuridicos' => $prejuridicos,
                'saldos_favor' => $saldos_favor,
                'estudios' => $array_estudios,
                'iniciales' => $iniciales,
                'gastos' => $gastos,
                'compras' => $compras,
                'prestamos' => $prestamos,
                'pago_proveedores' => $pago_proveedores,
                'total_cuotas' => $total_cuotas,
                'total_sanciones' => $total_sanciones,
                'total_juridicos' => $total_juridicos,
                'total_prejuridicos' => $total_prejuridicos,
                'total_saldos' => $total_saldos,
                'total_estudios' => $total_estudios,
                'total_iniciales' => $total_iniciales,
                'total_gastos' => $total_gastos,
                'total_compras' => $total_compras,
                'total_prestamos' => $total_prestamos,
                'total_pago_proveedores' => $total_pago_proveedores,
                'carteras' => $array_carteras,
                'total' => $total,
                'otros_pagos' => $otros_pagos,
                'total_otros_ingresos' => $total_otros_ingresos,
                'rango' => $rango,
                'users' => $users
      );

  return $reporte;





}

?>