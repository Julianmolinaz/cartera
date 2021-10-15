<?php

namespace App\Traits\Solicitudes;
use App as _;

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

        $range = [];
        $variables = \DB::table('variables')->first();

        foreach (range($variables->meses_min, $variables->meses_max) as $numero) {
            $range[] = $numero;
        }

        $proveedores = _\MyService\Proveedor::getProveedores();

        $data = [
            'productos'            => _\Producto::orderBy('nombre')->where('estado', 1)->get(),
            'carteras'             => _\Cartera::where('estado','Activo')->orderBy('nombre')->get(),
            'proveedores'          => $proveedores,
            'variables'            => _\Variable::find(1),
            'now'                  => \Carbon\Carbon::now(),
            'estados_aprobacion'   => _\Http\Controllers\getEnumValues('precreditos', 'aprobado'),
            'estados_invoices'     => _\Http\Controllers\getEnumValues('invoices', 'estado'),
            'arr_periodos'         => _\Http\Controllers\getEnumValues('precreditos','periodo'),
            'arr_estudios'         => _\Http\Controllers\getEnumValues('precreditos','estudio'),
            'tipo_vehiculos'       => _\TipoVehiculo::orderBY('nombre')->get(),
            'cliente'              => _\Cliente::find($cliente_id),
            'vendedores'           => _\User::orderBy('name')->where('estado','activo')->where('id','<>',1)->get(),
            'rango_meses'          => $range,
            'clientes'             => _\Http\Controllers\getEnumValues('ref_productos', 'expedido_a'),
         ];

         return $data;

    }
}
