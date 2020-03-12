<?php

namespace App\Traits\Solicitudes;

trait SolicitudCreateTrait
{
    public function validateSolicitudCreateTr($request)
    {
        $rules = [
            'num_fact'    => 'required|unique:precreditos',
            'fecha'       => 'required',
            'cartera_id'  => 'required',
            'vlr_fin'     => 'required',
            'producto_id' => 'required',
            'periodo'     => 'required',
            'meses'       => 'required',
            'vlr_cuota'   => 'required'
        ];

        $messages = [
            'num_fact.required'      => 'El Número de Formulario es requerido',
            'num_fact.unique'        => 'EL Número de Formulario ya existe',
            'fecha.required'         => 'La Fecha de Solicitud es requerida',
            'cartera_id.required'    => 'La Cartera es requerida',
            'vlr_fin.required'       => 'El Centro de Costos es requerido',
            'producto_id.required'   => 'El Producto es requerido',
            'periodo.required'       => 'El Periodo es requerido',
            'meses.required'         => 'El Número de Meses es requerido',
            'estudio.required'       => 'El Tipo de Estudio es requerido',
            'vlr_cuota.required'     => 'El Valor de la Cuota es requerido'
        ];
    
        $validator = \Validator::make($request,$rules, $messages);
    
        return $validator;
    
    }

    public function procesosPendientes($request)
    {
        $cantidad_precreditos = \DB::table('precreditos')
            ->join('clientes','precreditos.cliente_id','=','clientes.id')
            ->where([['clientes.id','=',$request['cliente_id']],
                     ['precreditos.aprobado','=','En estudio']])
            ->count();

        return ($cantidad_precreditos > 0) ? true : false;  
    }

    public function saveSolicitudCreateTr($request)
    {
        $solicitud = new \App\Precredito($request);
        $solicitud->user_create_id = \Auth::user()->id;
        $solicitud->funcionario_id = \Auth::user()->id;
        $solicitud->save();

        return $solicitud;
    }

    public function saveProductosCreateTr($productos, $solicitud) 
    {
        if ($productos) {
            foreach ($productos as $producto) {
                $ref_producto = new \App\RefProducto($producto);
                $ref_producto->created_by = \Auth::user()->id; 
                $ref_producto->precredito_id = $solicitud->id; 
                $ref_producto->save();
            }
        }
    }
}