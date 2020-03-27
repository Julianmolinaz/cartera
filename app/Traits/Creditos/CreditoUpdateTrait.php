<?php

namespace App\Traits\Creditos;

trait CreditoUpdateTrait
{
    public function validateCreditoUpdateTr($rq)
    {
        $rules = [
            'num_fact'    => 'required|unique:precreditos,num_fact,'.$request['id'],
            'fecha'       => 'required',
            'cartera_id'  => 'required',
            'vlr_fin'     => 'required',
            'producto_id' => 'required',
            'periodo'     => 'required',
            'meses'       => 'required',
            'vlr_cuota'   => 'required',
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

    public function saveCreditoUpdateTr($credito, $changes) 
    {
        $credito_ = \App\Credito::find($credito['id']);

        //guarda el estado anterior del credito
        $estado_anterior = $credito_->estado;

        // guarda el estado anterior del atributo castigada
        $anterior  = $credito_->castigada;

        \Log::error($credito);

        $credito_->fill($credito);

        \Log::info($credito_);

        if ($credito_->isDirty()) {
            $credito_->user_update_id = \Auth::user()->id;
            $credito_->save();
            $changes ++;
        }
        
        return [
            'estado_anterior' => $estado_anterior,
            'changes' => $changes,
            'credito' => $credito,
            'anterior' => $anterior
        ];
    }

    public function saveFechaPagoUpdateTr($fecha_pago, $credito, $changes)
    {
        $fp = \App\FechaCobro::where('credito_id',$credito['id'])->first();
        $fp->fecha_pago = $fecha_pago;

        if ($fp->isDirty()) {
            $fp->save();
            $changes ++;
        }

        return [
            'fecha_pago' => $fp,
            'changes' => $changes
        ];
    }

}