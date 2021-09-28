<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'El campo :attribute debe ser aceptado.',
    'active_url'           => 'El campo :attribute no es una URL válida.',
    'after'                => 'El campo :attribute debe ser una fecha posterior a :date.',
    'alpha'                => 'EL campo :attribute debe contener solo letras.',
    'alpha_dash'           => 'El campo :attribute solo puede contener letras, números y guiones.',
    'alpha_num'            => 'El campo :attribute debe contener letras y números.',
    'array'                => 'El campo :attribute debe ser una matriz.',
    'before'               => 'El campo :attribute debe ser una fecha anterior :date.',
    'between'              => [
        'numeric' => 'El campo :attribute debe estar entre :min y :max.',
        'file'    => 'El campo :attribute debe estar entre :min y :max kilobytes.',
        'string'  => 'El campo :attribute debe estar entre :min y :max caracteres.',
        'array'   => 'El campo :attribute debe tener entre :min y :max items.',
    ],
    'boolean'              => 'El campo :attribute el campo debe ser verdadero o falso.',
    'confirmed'            => 'El campo :attribute la confirmación no coincide.',
    'date'                 => 'El campo :attribute no es valido.',
    'date_format'          => 'El campo :attribute no coincide con el formato :format.',
    'different'            => 'El campo :attribute y :other debe ser diferente.',
    'digits'               => 'El campo :attribute debe ser :digits digitos.',
    'digits_between'       => 'El campo :attribute debe estar entre :min y :max digitos.',
    'distinct'             => 'El campo :attribute el campo tiene un valor duplicado.',
    'email'                => 'El campo :attribute Debe ser una dirección de correo electrónico válida.',
    'exists'               => 'El campo seleccionado :attribute no es válido.',
    'filled'               => 'El campo :attribute es requerido.',
    'image'                => 'El campo :attribute debe ser una imagen.',
    'in'                   => 'El campo seleccionado :attribute no es válido.',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => 'El campo :attribute debe ser un entero.',
    'ip'                   => 'El campo :attribute debe ser una dirección IP válida.',
    'json'                 => 'El campo :attribute debe ser una cadena JSON válida.',
    'max'                  => [
        'numeric' => 'El campo :attribute puede que no sea mayor que :max.',
        'file'    => 'El campo :attribute puede que no sea mayor que :max kilobytes.',
        'string'  => 'El campo :attribute puede que no sea mayor que :max caracteres.',
        'array'   => 'El campo :attribute puede no tener más de :max items.',
    ],
    'mimes'                => 'El campo :attribute debe ser un archivo de type: :values.',
    'min'                  => [
        'numeric' => 'El campo :attribute debe ser por lo menos :min.',
        'file'    => 'El campo :attribute debe ser por lo menos :min kilobytes.',
        'string'  => 'El campo :attribute debe ser por lo menos :min caracteres.',
        'array'   => 'El campo :attribute debe tener por lo menos :min items.',
    ],
    'not_in'               => 'El campo selected :attribute no es válido.',
    'numeric'              => 'El campo :attribute debe ser un número.',
    'present'              => 'El campo :attribute debe estar presente.',
    'regex'                => 'El campo :attribute formato no es válido.',
    'required'             => 'El campo :attribute es requerido.',
    'required_if'          => 'El campo :attribute es requerido cuando :other es :value.',
    'required_unless'      => 'El campo :attribute es requerido a menos que :other es un :values.',
    'required_with'        => 'El campo :attribute es requerido cuando :values es present.',
    'required_with_all'    => 'El campo :attribute es requerido cuando :values es present.',
    'required_without'     => 'El campo :attribute es requerido cuando :values es not present.',
    'required_without_all' => 'El campo :attribute es requerido cuando none of :values are present.',
    'same'                 => 'El campo :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El campo :attribute debe ser :size.',
        'file'    => 'El campo :attribute debe ser :size kilobytes.',
        'string'  => 'El campo :attribute debe ser :size caracteres.',
        'array'   => 'El campo :attribute debe contener :size items.',
    ],
    'string'               => 'El campo :attribute debe un string.',
    'timezone'             => 'El campo :attribute debe ser una zona válida.',
    'unique'               => 'El campo :attribute ya se ha tomado.',
    'url'                  => 'El campo :attribute tiene un formato no válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [

        // Precredito / Solicitud
        'anio'              => 'Año',
        'cuotas_faltantes'  => 'Cuotas faltantes',
        'fecha_pago'        => 'Fecha de pago',
        'saldo_favor'       => 'Saldo a favor',
        'valor_credito'     => 'Valor del crédito',
        'cuota_inicial'     => 'Cuota inicial',
        'cliente_id'        => 'Clinete Id',
        'p_fecha'           => 'Fecha de pago 1',
        's_fecha'           => 'Fecha de pago 2',
        'num_cuotas'        => 'Número de cuotas',
        'num_fact'          => 'Número de factura',
        'vlr_cuota'         => 'Valor cuota',
        'vlr_fin'           => 'Costo del crédito',
        'expedido_a'        => 'Expedido a',
        'fecha_exp'         => 'Fecha de expedición',
        'producto_id'       => 'Producto',
        'tipo_vehiculo'     => 'Tipo de Vehículo',
        'vencimiento_soat'  => 'Vencimineto SOAT',
        'vencimiento_rtm'   => 'Vencimiento RTM',

        // Ref Productos
        'nombre'            => 'Nombre',
        'expedido_a'        => 'Expedido a',
        'estado'            => 'Estado',
        'fecha_exp'         => 'Fecha de expedición',
        'costo'             => 'Costo',
        'iva'               => 'IVA',
        'num_fact'          => 'Número de factura',
        'otros'             => 'Otros valores',
        'observaciones'     => 'Observaciones',
        'vehiculo_id'       => 'Vehículo id',
        'producto_id'       => 'Producto id',       
        'proveedor_id'      => 'Proveedor id', 
        'precredito_id'     => 'Solicitud id',
        'created_by'        => 'Creado por',
        'updated_by'        => 'Actualizado por',  
        'placa'             => 'Placa',
        'vencimiento_soat'  => 'Vencimiento SOAT',
        'vencimiento_rtm'   => 'Vencimiento RTM',
        'cantidad'          => 'Cantidad',
    ],

];