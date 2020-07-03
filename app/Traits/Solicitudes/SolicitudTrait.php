<?php

namespace App\Traits\Solicitudes;

trait SolicitudTrait 
{
    public function existen_solicitudes_pendientes_tr($cliente_id)
    {
        $respuesta = false;

        $solicitudes_pendientes =
            \DB::table('precreditos')
            ->join('clientes','precreditos.cliente_id','=','clientes.id')
            ->where([
                ['clientes.id','=',$cliente_id],
                ['precreditos.aprobado','=','En estudio']])
            ->count();


        $creditos_vigentes =
            \DB::table('creditos')
            ->join('precreditos','creditos.precredito_id','=','precreditos.id')
            ->join('clientes','precreditos.cliente_id','=','clientes.id')
            ->where([['clientes.id','=',$cliente_id]])
            ->whereIn('Estado',['Al dia','Mora','Prejuridico','Juridico'])
            ->count();

        if ($solicitudes_pendientes or $creditos_vigentes) {
            $respuesta = true;
        }

        return $respuesta;
    }

    public function obtener_data_para_crear($cliente_id){
        return [
            'productos'            => \App\Producto::orderBy('nombre','DESC')->get(),
            'carteras'             => \App\Cartera::where('estado','Activo')->orderBy('nombre')->get(),
            'proveedores'          => \App\MyService\Proveedor::getProveedores(),
            'variables'            => \App\Variable::find(1),
            'now'                  => \Carbon\Carbon::now(),
            'estados_aprobacion'   => \App\Http\Controllers\getEnumValues('precreditos', 'aprobado'),
            'estados_ref_producto' => \App\Http\Controllers\getEnumValues('ref_productos', 'estado'),
            'arr_periodos'         => \App\Http\Controllers\getEnumValues('precreditos','periodo'),
            'arr_estudios'         => \App\Http\Controllers\getEnumValues('precreditos','estudio'),
            'tipo_vehiculos'       => \App\Http\Controllers\getEnumValues('vehiculos','tipo'),
            'cliente'              => \App\Cliente::find($cliente_id),
            'proveedores'          => \App\Tercero::where('tipo','Proveedor')->orderBy('razon_social')->get()
         ];

    }
}