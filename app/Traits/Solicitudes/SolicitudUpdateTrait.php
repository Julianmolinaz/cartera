<?php

namespace App\Traits\Solicitudes;

trait SolicitudUpdateTrait
{
    public function validateSolicitudUpdateTr($request)
    {
        dd($request);

        $rules = [
            'num_fact'    => 'required|unique:precreditos,num_fact,'.$request['id'],
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

    public function saveSolicitudUpdate($rq)
    {
        $changes = 0;

        $solicitud = \App\Precredito::find($rq['id']);

        $estado_anterior_solicitud = $solicitud->aprobado; //toma el estado (aprobado) antes de editar
        $solicitud->fill($rq);

        if ($solicitud->isDirty()) {
          $solicitud->user_update_id = \Auth::user()->id;
          $solicitud->save();
          $changes++;
        } 

        return (object)[
            'solicitud' => $solicitud,
            'changes'   => $changes
        ];

    }

    public function saveProductosUpdateTr($productos) 
    {
        $changes = 0;

        if ($productos) {
            foreach ($productos as $producto) {

                $ref_producto = \App\RefProducto::find($producto['id']);
                $ref_producto->fill($producto);

                if ($ref_producto->isDirty()) {

                    $ref_producto->updated_by = \Auth::user()->id; 
                    $ref_producto->save();
                    $changes++;
                }
            }
        }

        return $changes;
    }
}