<?php

namespace App\Traits\Creditos;

trait DatatableCreditoTrait
{
    public function list()
    {
        $creditos = \DB::table('creditos')
          ->join('precreditos','creditos.precredito_id','=','precreditos.id')
          ->join('clientes','precreditos.cliente_id','=','clientes.id')
          ->join('carteras','precreditos.cartera_id','=','carteras.id')
          ->select('creditos.id','carteras.nombre as cartera','clientes.nombre','precreditos.vlr_fin as cc',
                    'clientes.num_doc','creditos.estado','creditos.sanciones_debe as sanciones',
                    'precreditos.id as precredito_id','clientes.id as cliente_id')
          ->where('precreditos.user_create_id',\Auth::user()->id);
 

        return \Datatables::of($creditos)
            ->addColumn('btn', function($creditos) {

                $route_ver = route('start.precreditos.ver',$creditos->precredito_id);
                $route_cliente = route('start.clientes.show',$creditos->cliente_id);
                $route_pagar = route('start.facturas.create',$creditos->id);
                $route_sanciones = route('admin.sanciones.show',$creditos->id);
                $route_multas = route('admin.multas.show',$creditos->id);
                $route_editar = route('start.creditos.edit',$creditos->id);
                $route_llamar = route('call.index_unique',$creditos->id);

                $btn_ver =  '<a href="'.$route_ver.'" class="btn btn-default btn-xs">
                            <span class="glyphicon glyphicon-eye-open"></span></a>';

                $btn_user =  '<a href="'.$route_cliente.'" class="btn btn-default btn-xs">
                              <span class="glyphicon glyphicon-user"></span></a>';

                $btn_pagar =  '<a href="'.$route_pagar.'" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-usd"></span></a>';

                $btn_sanciones =  '<a href="'.$route_sanciones.'" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-record"></span></a>';

                $btn_multas =  '<a href="'.$route_multas.'" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-hourglass"></span></a>';

                $btn_editar =  '<a href="'.$route_editar.'" class="btn btn-default btn-xs">
                                <span class="glyphicon glyphicon-pencil"></span></a>';

                $btn_llamar = '<a href="'.$route_llamar.'" class="btn btn-default btn-xs">
                              <span class="glyphicon glyphicon-phone-alt"></span></a>';


                return $btn_ver.''.$btn_user.''.$btn_pagar.''.$btn_sanciones.''.$btn_multas.''.$btn_editar.
                        $btn_llamar;


            })
            ->make(true);

        return $creditos;
    }   
}