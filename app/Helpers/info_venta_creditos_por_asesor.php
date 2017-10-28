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


// Genera Reporte de Vent de creditos, ingresa el rango de fecha 1 a fecha 2

function reporte_venta_creditos_por_asesor( $fecha_1, $fecha_2 ){

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
    ->join('users','precreditos.funcionario_id','=','users.id')
    ->where([['creditos.estado','<>','Refinanciacion']])
    ->whereBetween('creditos.created_at',[$ini,$fin])
    ->select(
        'creditos.id as id',
        'creditos.castigada as castigada',
        'creditos.saldo as saldo',
        'clientes.nombre as cliente',
        'clientes.num_doc as documento',
        'precreditos.vlr_fin as vlr_fin',
        'precreditos.cuotas as cuotas',
        'precreditos.vlr_cuota as vlr_cuota',
        'precreditos.num_fact as factura',
        'carteras.nombre as cartera',
        'creditos.created_at as created_at',
        'creditos.rendimiento as rendimiento',
        'precreditos.periodo as periodo',
        'productos.nombre as producto',
        'users.name as funcionario', 
        DB::raw('precreditos.vlr_cuota * precreditos.cuotas as vlr_credito'))
    ->get();

    $total_vlr_fin = 0;
    foreach($creditos as $credito){ $total_vlr_fin = $total_vlr_fin + $credito->vlr_fin; }

    $total_vlr_credito = 0;
    foreach($creditos as $credito){ $total_vlr_credito = $total_vlr_credito + $credito->vlr_credito; }


    // Si el credito esta como cartera castigada no se suma el saldo a los totales.

    $total_saldo = 0;
    foreach($creditos as $credito){ 
        if($credito->castigada == 'No'){
            $total_saldo = $total_saldo + $credito->saldo; 
        }
    }

    $funcionarios          = DB::table('users')->select('id','name','email')->orderBy('name')->get()    ;
    $array_funcionarios    = array();

    // array carteras

    foreach($funcionarios as $funcionario){ 

        $temp = array(
            'id'            => $funcionario->id, 
            'nombre'        => $funcionario->name, 
            'email'         => $funcionario->email, 
            'saldo'         => 0,
            'vlr_fin'       => 0,
            'vlr_credito'   => 0, 
            'rendimiento'   => 0);

        array_push($array_funcionarios,$temp);
    }

    for($i = 0; $i < count($creditos); $i++){

        $credito = Credito::find($creditos[$i]->id);

        for($j = 0; $j < count($array_funcionarios); $j++){

            

            if($array_funcionarios[$j]['id'] == $credito->precredito->funcionario_id){

                if($credito->castigada == 'No'){

                    $array_funcionarios[$j]['saldo']    =     $array_funcionarios[$j]['saldo']
                                                        + $credito->saldo;
                }

                $array_funcionarios[$j]['vlr_fin']      =     $array_funcionarios[$j]['vlr_fin'] 
                                                        + $credito->precredito->vlr_fin;

                $array_funcionarios[$j]['vlr_credito']  =     $array_funcionarios[$j]['vlr_credito'] 
                                                        + $credito->valor_credito;

                $array_funcionarios[$j]['rendimiento']  =     $array_funcionarios[$j]['rendimiento'] 
                                                        + $credito->rendimiento;  
                break;
            }}}

    $funcionarios = array();

    for($n = 0; $n < count($array_funcionarios);$n++){
        if($array_funcionarios[$n]['vlr_fin'] > 0){
            array_push($funcionarios,$array_funcionarios[$n]);
        }
    }

    $total = array('vlr_fin' => 0, 'vlr_credito' => 0, 'rendimiento' => 0,'saldo' => 0);

    foreach($array_funcionarios as $array_funcionario){
        $total['saldo']         = $total['saldo']        + $array_funcionario['saldo'];
        $total['vlr_fin']       = $total['vlr_fin']      + $array_funcionario['vlr_fin'];
        $total['vlr_credito']   = $total['vlr_credito']  + $array_funcionario['vlr_credito'];
        $total['rendimiento']   = $total['rendimiento']  + $array_funcionario['rendimiento'];  
    }  

    $reporte = array(
        'creditos'          => $creditos,
        'total_vlr_fin'     => $total_vlr_fin,
        'total_vlr_credito' => $total_vlr_credito,
        'total_saldo'       => $total_saldo,
        'rango'             => $rango,
        'funcionarios'      => $funcionarios,
        'total'             => $total
      );


    return $reporte;
    
}

?>