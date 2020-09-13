<?php

namespace App\Traits\Creditos;
use App as _;

trait CreditoUpdateTrait
{
    public function validateCreditoUpdateTr($request)
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

        $credito_->fill($credito);

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

    public function obtener_data_para_editar_credito($credito) 
    {
        $anio = \Carbon\Carbon::now();
        $anios = [$anio->year -1, $anio->year];

        return [
            'info' => $credito,
            'estados' => _\Http\Controllers\getEnumValues('creditos','estado'),
            'estados_castigada' => _\Http\Controllers\getEnumValues('creditos','castigada'),
            'anios' => $anios,
            'meses' => ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            'fecha_pago' => $credito->fecha_pago->fecha_pago
        ];   
    }


    public function rulesCreditoUpdateV2Tr($credito_id)
    {
        return  [
            'num_fact'    => 'required|unique:precreditos,num_fact,'.$credito_id,
            'fecha'       => 'required',
            'cartera_id'  => 'required',
            'vlr_fin'     => 'required',
            'producto_id' => 'required',
            'periodo'     => 'required',
            'meses'       => 'required',
            'mes'         => 'required',
            'anio'        => 'required',
            'vlr_cuota'   => 'required',
        ];
    }

    public function updateV2Tr(Request $request, $id)
    {
    
        // reglas de validacion del formulario
        if($request->input('periodo') == 'Quincenal'){
            $this->validate($request, ['s_fecha' => 'required'],
                                        ['s_fecha.required' => 'La Fecha 2 es requerida.']);
        }  

        $rules_fijos = array(
            'num_fact'      => 'required|unique:precreditos,num_fact,'. Credito::find($id)->precredito->id,
            'fecha'         => 'required',
            'vlr_fin'       => 'required',
            'producto_id'   => 'required',
            'periodo'       => 'required',
            'meses'         => 'required',
            'vlr_cuota'     => 'required',
            'p_fecha'       => 'required|integer|between:1,'.$fin,
            's_fecha'       => $rule_s_fecha_quincena,
            'funcionario_id'=> 'required',
            'fecha_pago'    => 'required',
        );


        
        // mensajes de error del formulario
        $message_fijos = array(
            'num_fact.required'      => 'El Número de Factura es requerido',
            'num_fact.unique'        => 'EL Número de factura ya existe',
            'fecha.required'         => 'La Fecha de afiliación es requerida',
            'vlr_fin.required'       => 'El Centro de Costos es requerido',   
            'producto_id.required'   => 'El Producto es requerido',
            'periodo.required'       => 'El Periodo es requerido',
            'meses.required'         => 'El # de Meses es requerido',
            'vlr_cuota.required'     => 'El Valor de la Cuota es requerido',
            'p_fecha.required'       => 'La Fecha 1 es requerida',
            'p_fecha.between'        => 'La Fecha 1 debe ser menor que la Fecha 2',
            's_fecha.between'        => 'La Fecha 2 debe ser mayor que la Fecha 1', 
            'funcionario_id.required'=> 'El Funcionario es requerido',
            'fecha_pago.required' => 'La Fecha de Pago es requerida',
            );
        
        //validacion

        $this->validate($request,$rules_fijos,$message_fijos);

        //si el periodo es quincenal se validan las dos fechas de pago mensual

        DB::beginTransaction();

        try {

            if($request->input('periodo') == 'Mensual'){ $s_fecha = '';}
            else{ $s_fecha = $request->input('s_fecha');}

            $credito    = Credito::find($id);
            $estado_anterior_credito   = $credito->estado; // se guarda el estado anterior del credito
            $precredito = Precredito::find($credito->precredito->id);
            $cliente    = Cliente::find($credito->precredito->cliente_id);

            $precredito->num_fact       = $request->input('num_fact');
            $precredito->fecha          = $request->input('fecha');
            $precredito->cartera_id     = $request->input('cartera_id');
            $precredito->funcionario_id = $request->input('funcionario_id');
            $precredito->producto_id    = $request->input('producto_id');
            $precredito->vlr_fin        = $request->input('vlr_fin');
            $precredito->periodo        = $request->input('periodo');
            $precredito->meses          = $request->input('meses');
            $precredito->cuotas         = $request->input('cuotas');
            $precredito->vlr_cuota      = $request->input('vlr_cuota');
            $precredito->p_fecha        = $request->input('p_fecha');
            $precredito->s_fecha        = $s_fecha;         
            $precredito->estudio        = $request->input('estudio');
            $precredito->cuota_inicial  = $request->input('cuota_inicial');
            $precredito->aprobado       = $request->input('aprobado');
            $precredito->observaciones  = $request->input('observaciones');
            $precredito->user_update_id = Auth::user()->id;
            $precredito->save();

            // valida y crea registro si se castiga cartera
            $anterior  = $credito->castigada;
            $credito->mes               = $request->input('mes');
            $credito->cuotas_faltantes  = $request->input('cuotas_faltantes');
            $credito->saldo             = $request->input('saldo');
            $credito->saldo_favor       = $request->input('saldo_favor');
            $credito->estado            = $request->input('estado_credito');
            $credito->rendimiento       = $request->input('rendimiento');
            $credito->valor_credito     = $request->input('valor_credito');
            $credito->castigada         = $request->input('castigada');
            $credito->recordatorio      = $request->input('recordatorio');
            $credito->user_update_id    = Auth::user()->id;
            $credito->save();

            $fecha_pago                 = FechaCobro::where('credito_id',$credito->id)->get()[0];
            $fecha_pago->fecha_pago     = inv_fech($request->input('fecha_pago'));
            $fecha_pago->save();

            $this->castigar($credito,$request->input('castigada'),$anterior);

            // calificación del cliente 

            if($request->input('calificacion') != ""){
                $cliente->calificacion    = $request->input('calificacion');
                $cliente->user_update_id  = Auth::user()->id;
                $cliente->save();
            }

            DB::commit();        

            flash()->success('El crédito con Id: '.$precredito->credito->id.' del cliente '.$cliente->nombre.' se editó con éxito!');
            return redirect()->route('start.precreditos.ver',$precredito->id);

        } catch(\Exception $e){

            DB::rollback();

            flash()->error('Ocurrió un error' . $e->getMessage());
            return redirect()->route('start.creditos.index');         

        }
    }




}