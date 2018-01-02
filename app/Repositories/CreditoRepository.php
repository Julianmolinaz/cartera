<?php

namespace App\Repositories;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Credito;
use App\Criterio;
use App\Llamada;
use App\FechaCobro;
use App\Pago;
use Auth;
use DB;
use Carbon\Carbon;
use App\CallBusqueda;   

class CreditoRepository{

    public function creditosTipoCall(){
        $creditos = 
        DB::table('creditos')
            ->join('precreditos','precreditos.id',      '=','creditos.precredito_id')
            ->join('carteras','precreditos.cartera_id', '=','carteras.id')
            ->join('clientes','precreditos.cliente_id', '=','clientes.id')
            ->join('municipios','clientes.municipio_id','=','municipios.id')
            ->join('fecha_cobros','creditos.id',        '=','fecha_cobros.credito_id')
            ->select(DB::raw('
                carteras.nombre         as cartera,
                creditos.id             as credito_id,
                creditos.saldo          as saldo,
                municipios.nombre       as municipio,
                municipios.departamento as departamento,
                creditos.estado         as estado,
                clientes.nombre         as cliente,
                clientes.num_doc        as doc,
                fecha_cobros.fecha_pago as fecha_pago'))
            ->whereIn('creditos.estado',['Al dia','Mora','Juridico','Prejuridico','Cancelado'])
            ->get();

        return $creditos;        
    }
    
    public function creditosQuery(){
        $creditos = 
        DB::table('creditos')
            ->join('precreditos','precreditos.id','=','creditos.precredito_id')
            ->join('carteras','precreditos.cartera_id', '=','carteras.id')
            ->join('productos','precreditos.producto_id','=','productos.id')
            ->join('clientes','precreditos.cliente_id','=','clientes.id')
            ->join('fecha_cobros','creditos.id','=','fecha_cobros.credito_id')
            ->join('users','creditos.user_create_id','=','users.id')
            ->select(
                'creditos.id as id',
                'carteras.nombre as cartera',
                'productos.nombre as producto',
                'precreditos.fecha as fecha_aprobacion',
                'creditos.estado as estado',
                'creditos.cuotas_faltantes as cuotas_faltantes',
                'precreditos.vlr_fin as centro_costo',
                'creditos.valor_credito as valor_credito',
                'precreditos.periodo as periodo',
                'precreditos.cuotas as cuotas',
                'precreditos.p_fecha as p_fecha',
                'precreditos.s_fecha as s_fecha',
                'precreditos.cuota_inicial as inicial',
                'users.name as funcionario',
                'precreditos.observaciones as observaciones',
                'creditos.castigada as castigada',
                'creditos.refinanciacion as refinanciacion',
                'creditos.credito_refinanciado_id as credito_padre',
                'fecha_cobros.fecha_pago as pago_hasta',
                'clientes.primer_nombre as primer_nombre',
                'clientes.segundo_nombre as segundo_nombre',
                'clientes.primer_apellido as primer_apellido',
                'clientes.segundo_apellido as segundo_apellido',
                'clientes.num_doc as documento')
            ->whereIn('creditos.estado',['Al dia','Mora','Juridico','Prejuridico','Cancelado'])
            ->get();

        return $creditos;

    }

}