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


// Genera Reporte de Vent de creditos, ingresa el rango de fecha 1 a fecha 2 (d,m,y)

function reporte_venta_creditos( $fecha_1, $fecha_2 ){        

  $ini     = Carbon::create(ano($fecha_1),mes($fecha_1),dia($fecha_1),00,00,00);
  $fin     = Carbon::create(ano($fecha_2),mes($fecha_2),dia($fecha_2),23,59,59);
  $rango   = array('ini' => $ini->format('d-m-Y'), 'fin' => $fin->format('d-m-Y')); 

  $date = $ini->toDateString(); 
  $estudio_tipico = Variable::find(1)->vlr_estudio_tipico;    //valor del estudio de credito tipico
  $estudio_domicilio = Variable::find(1)->vlr_estudio_domicilio;   //valor del estudio de credito a domicilio

  $creditos = 
  DB::table('creditos')
    ->join('precreditos','creditos.precredito_id','=','precreditos.id')
    ->join('clientes','precreditos.cliente_id','=','clientes.id')
    ->join('carteras','precreditos.cartera_id','=','carteras.id')
    ->join('productos','precreditos.producto_id','=','productos.id')
    ->leftJoin('fecha_cobros','creditos.id','=','fecha_cobros.credito_id')
    //->where([['creditos.estado','<>','Refinanciacion']]) // Cancelado por refinanciacion
    ->whereBetween('creditos.created_at',[$ini,$fin])
    ->select(
        'creditos.id as id',
        'creditos.castigada as castigada',
        'creditos.saldo as saldo',
        'creditos.refinanciacion as refinanciado',
        'creditos.credito_refinanciado_id as credito_refinanciado_id',
        'clientes.nombre as cliente',
        'clientes.num_doc as documento',
        'precreditos.vlr_fin as vlr_fin',
        'precreditos.cuotas as cuotas',
        'precreditos.vlr_cuota as vlr_cuota',
        'precreditos.num_fact as factura',
        'precreditos.cuota_inicial as cuota_inicial',
        'carteras.nombre as cartera',
        'creditos.created_at as created_at',
        'creditos.rendimiento as rendimiento',
        'precreditos.periodo as periodo',
        'productos.nombre as producto',
        'fecha_cobros.fecha_pago as fecha_pago',
        DB::raw('precreditos.vlr_cuota * precreditos.cuotas as vlr_credito'))
    ->get();

    $total_vlr_fin = 0;
    foreach($creditos as $credito){ $total_vlr_fin = $total_vlr_fin + $credito->vlr_fin; }

    $total_vlr_credito = 0;
    foreach($creditos as $credito){ $total_vlr_credito = $total_vlr_credito + $credito->vlr_credito; }


    // Si el credito esta como cartera castigada no se suma el saldo a los totales.

    $total_saldo = 0;
    foreach($creditos as $credito){ 
        if($credito->castigada == 'No' && $credito->refinanciado == 'No'){
            $total_saldo = $total_saldo + $credito->saldo; 
        }
    }


    $carteras           = DB::table('carteras')->select('id','nombre')->get();
    $array_carteras     = array();

    // array carteras

    foreach($carteras as $cartera){ 

        $temp = array(
            'id'            => $cartera->id, 
            'nombre'        => $cartera->nombre, 
            'saldo'         => 0,
            'vlr_fin'       => 0,
            'vlr_credito'   => 0, 
            'rendimiento'   => 0);

        array_push($array_carteras,$temp);
    }

    for($i = 0; $i < count($creditos); $i++){
        for($j = 0; $j < count($array_carteras); $j++){

            if($array_carteras[$j]['nombre'] == $creditos[$i]->cartera){

                if($creditos[$i]->castigada == 'No'){

                    $array_carteras[$j]['saldo']    =     $array_carteras[$j]['saldo']
                                                        + $creditos[$i]->saldo;
                }

                $array_carteras[$j]['vlr_fin']      =     $array_carteras[$j]['vlr_fin'] 
                                                        + $creditos[$i]->vlr_fin;

                $array_carteras[$j]['vlr_credito']  =     $array_carteras[$j]['vlr_credito'] 
                                                        + $creditos[$i]->vlr_credito;

                $array_carteras[$j]['rendimiento']  =     $array_carteras[$j]['rendimiento'] 
                                                        + $creditos[$i]->rendimiento;  
                break;
            }}}


    $total = array('vlr_fin' => 0, 'vlr_credito' => 0, 'rendimiento' => 0,'saldo' => 0);

    foreach($array_carteras as $array_cartera){
        $total['saldo']         = $total['saldo']        + $array_cartera['saldo'];
        $total['vlr_fin']       = $total['vlr_fin']      + $array_cartera['vlr_fin'];
        $total['vlr_credito']   = $total['vlr_credito']  + $array_cartera['vlr_credito'];
        $total['rendimiento']   = $total['rendimiento']  + $array_cartera['rendimiento'];  
    }  

    $reporte = array(
        'creditos'          => $creditos,
        'total_vlr_fin'     => $total_vlr_fin,
        'total_vlr_credito' => $total_vlr_credito,
        'total_saldo'       => $total_saldo,
        'rango'             => $rango,
        'carteras'          => $array_carteras,
        'total'             => $total
      );


    return $reporte;
    
}

?>