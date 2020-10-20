<?php

namespace App\Traits\Creditos;
use App as _;


trait CreditoUpdateTraitV2
{

    public function saveRefProductosTrV2($request, $old_producto_id)
    {

        \Log::error( $request->producto['id'] );
        \Log::error( $old_producto_id );

        try {

            $solicitud = _\Precredito::find($request->solicitud['id']);
    
            if ($request->producto['min_vehiculos'] > 0 ) {
    
                if ($request->producto['id'] == $old_producto_id) {

                    \Log::info('Son iguales los dos productos');
    
                    foreach ($request->ref_productos as $producto) {
        
                        // Salvar vehiculo
                        $this->editVehiculoFromProductoTr($producto); // Creditos/VehiculoTrait
        
                        // Salvar ref producto
                        $this->editRefProductoFromProductoTr($producto); // Creditos/RefProductoTrait
        
                    }//.foreach
    
                } else  {
    
                    \Log::info('ids diferentes');
                    \Log::error($request->ref_productos);
    
                    $collection_productos = collect(\DB::table('ref_productos')
                        ->where('precredito_id',$request->solicitud['id'])
                        ->get());
    
                    $ids_productos = $collection_productos->pluck('id');

                    \Log::info($ids_productos);
    
                    $collection_vehiculos = collect(\DB::table('vehiculos')
                        ->select('vehiculos.id')
                        ->join('ref_productos','vehiculos.id','=','ref_productos.vehiculo_id')
                        ->whereIn('ref_productos.id', $ids_productos->all())
                        ->get());
    
                    $ids_vehiculos = $collection_vehiculos->pluck('id');
    
                    \DB::table('ref_productos')->whereIn('id', $ids_productos)->delete();
                    \DB::table('vehiculos')->whereIn('id', $ids_vehiculos)->delete();
    
                    $count = 0;

                    \Log::info($request->ref_productos);

                    foreach ($request->ref_productos as $producto) {

                        $count++;
                        \Log::info($count);
       
                        // Salvar vehiculo
                        $vehiculo = $this->saveVehiculoFromProductoTr($producto); // Creditos/VehiculoTrait
        
                        // Salvar ref producto
                        $this->saveRefProductoFromProductoTr($producto, $vehiculo, $solicitud); // Creditos/RefProductoTrait
        
                    }//.foreach
    
                }
    
            }  
        } catch (\Exception $e) {

            \Log::error($e);
            return $e;
        }

    }

    public function validateMakeTrV2($request)
    {
        $errorMessages = [];

        // Validar solicitud
        $validatorSolicitud = $this->validateSolicitudUpdateTr($request->solicitud);

        // Validar credito
        $validatorCredito = $this->validateCreditoUpdateTrV2($request->credito);

        // Validar fecha de pago
        $validatorFechaDePago = \Validator::make($request->all(), ['fecha_pago' => 'required'], 
            ['fecha_pago.required' => 'La fecha de pago es requerida']
        );

        if ($request->producto['min_vehiculos'] > 0 ) {

            $arr = [];

            for ($i=0; $i < count($request->ref_productos); $i++) { 
                $temp = $this->arrValidRefProductosTrV2($request->ref_productos[$i], $i+1);

                if ($temp->fails()) {
                    $errorMessages[] = $temp->errors();
                }
            }
        }       

        if ($validatorSolicitud->fails())   $errorMessages[] = $validatorSolicitud->errors();
        if ($validatorCredito->fails())     $errorMessages[] = $validatorCredito->errors();
        if ($validatorFechaDePago->fails()) $errorMessages[] = $validatorFechaDePago->errors();

        return $errorMessages;
    }

    public function arrValidRefProductosTrV2($ref_producto, $index)
    {
        $rules = [
            'nombre'        => 'required',
            'estado'        => '',
            'fecha_exp'     => 'required',
            'costo'         => 'required',
            'iva'           => '',
            'num_fact'      => 'required',
            'extra'         => '',  
            'observaciones' => '',
            '_vehiculo_id'   => 'required',
            'producto_id'   => 'required',
            'proveedor_id'  => 'required',
            'precredito_id' => 'required',
            '_vehiculo_id'  => 'required',
            '_tipo_vehiculo_id' => 'required',
            '_placa'        => 'required',
            '_vencimiento_soat' => 'required',
            '_vencimiento_rtm' => 'required'
        ];
        
        $messages = [
            'nombre.required'    => "El nombre del producto $index es requerido",
            'fecha_exp.required' => "La fecha de expedición de la factura producto $index es requerida",
            'costo.required'     => "El costo del producto $index es requerido",
            'num_fact.required'  => "El número de factura del producto $index es requerido",
            'vehiculo_id.required' => "El vehiculo del producto $index es requerido",
            'proveedor_id.required' => "El proveedor del producto $index es requerid"
        ];

        return  \Validator::make($ref_producto, $rules, $messages);
           
    }


    public function validateCreditoUpdateTrV2($credito)
    {
        $rules = [
            'cuotas_faltantes'  => 'required|integer|min:0',
            'saldo' => 'required|numeric',
            'saldo_favor' => 'numeric|min:0',
            'rendimiento' => 'required|numeric|min:0',
            'valor_credito' => 'required|numeric|min:0'
        ];

        $messages = [
            'cuotas_faltantes.required' => 'Las cuotas faltantes son requeridas',
            'cuotas_faltantes.integer'  => 'El valor de las cuotas debe ser un entero positivo',
            'cuotas_faltantes.min'      => 'El valor de las cuotas debe ser mayor o igual a 0',
            'saldo.required'            => 'El saldo de la deuda es requerido',
            'saldo.numeric'             => 'El saldo debe ser numérico',
            'saldo_favor.numeric'       => 'El saldo a favor debe ser numérico',
            'saldo_favor.min'           => 'El saldo a favor debe ser mayor o igual a 0',
            'rendimiento.required'      => 'El rendimiento es requerido',
            'rendimiento.numeric'       => 'El rendimiento debe ser numérico',
            'rendimiento.min'           => 'El rendimiento debe ser mayor o igual a 0',
            'valor_credito.required'    => 'El valor del credito es requerido',
            'valor_credito.numeric'     => 'El valor del credito debe ser numérico',
            'valor_credito.min'         => 'El valor del credito debe ser mayor o igual a 0'
        ];

        $validator = \Validator::make($credito,$rules, $messages);
    
        return $validator;
    }
}