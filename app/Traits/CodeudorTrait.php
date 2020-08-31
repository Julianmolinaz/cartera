<?php

namespace App\Traits;

trait CodeudorTrait
{
    public function rulesCodeudorTr() 
    {
		return array(

            // info personal

            'primer_nombre'             => ['required','max:60','regex:/^[a-zA-ZñÑ[:space:]]*$/'],
            'segundo_nombre'            => ['max:30','regex:/^[a-zA-ZñÑ[:space:]]*$/'],
            'primer_apellido'           => ['required','max:30','regex:/^[a-zA-ZñÑ[:space:]]*$/'],
            'segundo_apellido'          => ['max:30','regex:/^[a-zA-ZñÑ[:space:]]*$/'],
            'genero'                    => 'required',
            'tipo_doc'                  => 'required',
            'num_doc'                   => 'required',
            'estado_civil'              => 'required',
            'fecha_exp'                 => 'required',
            'lugar_exp'                 => 'required',         
            'fecha_nacimiento'          => 'required',
            'lugar_nacimiento'          => 'required',
            'nivel_estudios'            => 'required',

            // info ubicación
            'direccion'                 => ['required','max:100', 'regex:/^[a-zA-ZñÑ0-9#\-\.[:space:]]*$/'],
            'barrio'                    => 'required',
            'municipio_id'              => 'required',
            'movil'                     => 'required|max:20|alpha_num',
            // 'antiguedad_movil'          => 'required|integer',
            'antiguedad_movil'          => 'integer',
            'fijo'                      => 'max:20|alpha_num',
            'email'                     => 'required|max:60|email',
            'anos_residencia'           => 'required',
            'meses_residencia'          => 'required',
            'tipo_vivienda'             => 'required',
            'nombre_arrendador'         => 'required_with:telefono_arrendador',
            'telefono_arrendador'       => 'required_with:nombre_arrendador',

            //info laboral

            'tipo_actividad'            => 'required',
            'ocupacion'                 => 'required',
            'empresa'                   => 'required_if:tipo_actividad,Dependiente',
            'dir_empresa'               => 'required_if:tipo_actividad,Dependiente',
            'tel_empresa'               => 'required_if:tipo_actividad,Dependiente',
            'cargo'                     => 'required_if:tipo_actividad,Dependiente',
            'descripcion_actividad'     => 'required_if:tipo_actividad,Independiente',
            'doc_empresa'               => '',
            'fecha_vinculacion'         => 'required_if:tipo_actividad,Independiente|date',
            'tipo_contrato'             => 'required_if:tipo_actividad,Dependiente',

            // info crediticia
            
            'reportado'                 => ''

        );
    }

    public function messagesCodeudorTr()
    {
        return array(
            // info personal

            'primer_nombre.required' => 'El primer nombre es requerido',
            'primer_nombre.max'      => 'El primer nombre excede el tamaño de 60 caracteres',
            'primer_nombre.regex'    => 'El primer nombre no tiene el formato requerido',
            'segundo_nombre.max'     => 'El segundo nombre excede el tamaño de 30 caracteres',
            'segundo_nombre.regex'   => 'El segundo nombre no tiene el formato requerido',
            'primer_apellido.required' => 'El primer apellido es requerido',
            'primer_apellido.max'      => 'El primer apellido excede el tamaño de 30 caracteres',
            'segundo_apellido.max'     => 'El segundo apellido excede el tamaño de 30 caracteres',
            'segundo_apellido.regex'   => 'El segundo apellido no tiene el formato requerido',
            'genero'                    => 'El genero es requerido',
            'tipo_doc'                  => 'El tipo de documento es requerido',
            'num_doc'                   => 'El número del documento es requerido',
            'estado_civil'              => 'El estado civil es requerido',
            'fecha_exp'                 => 'La fecha de expedición del documento es requerido',
            'lugar_exp'                 => 'El lugar de expedición del documento es requerido', 
            'fecha_nacimiento'          => 'La fecha de nacimiento es requerida',
            'lugar_nacimiento'          => 'El lugar de nacimiento es requerido',
            'nivel_estudios'            => 'El nivel de estudios es requerido',

            // info ubicación
            'direccion.required'        => 'La dirección es requerida',
            'direccion.max'             => 'La dirección excede los 100 caracteres',
            'direccion.regex'           => 'La formato de la dirección solo puede contener caracteres y guiones (-)',
            'barrio'                    => 'El barrio es requerido',
            'municipio_id'              => 'El municipio es requerido',
            'movil.required'            => 'El teléfono celular es requerido',
            'movil.max'                 => 'El teléfono celular excede los 20 caracteres',
            'movil.alpha_num'           => 'El teléfono celular no tiene el formato requerido',
            // 'antiguedad_movil'          => 'required|integer',
            'antiguedad_movil'          => 'La antiguedad del movil es requerida',
            'fijo.max'                  => 'El teléfono fijo excede el tamaño permitido',
            'fijo.alpha_num'            => 'El teléfono celular no tiene el formato requerido',
            'email'                     => 'El correo electrónico (email) es requerido',
            'email'                     => 'El correo electrónico (email) excede el número de caracteres permitido',
            'email'                     => 'El correo electrónico (email) no tiene el formato requerido',
            'anos_residencia.required'  => 'Los años de residencia son requeridos, si no tiene digite 0',
            'meses_residencia'          => 'Los meses de residencia son requeridos, si no tiene digite 0',
            'tipo_vivienda'             => 'El tipo de vivienda es requerido',
            'nombre_arrendador.required_with'   => 'El nombre del arrendador es requerido',
            'telefono_arrendador.required_with' => 'El teléfono del arrendador es requerido',

            //info laboral

            'tipo_actividad.required'         => 'El tipo de actividad es requerido',
            'ocupacion.required'              => 'La ocupación es requerida',
            'empresa.required'                => 'La empresa es requerida',
            'dir_empresa.required'            => 'La dirección de la empresa es requerida',
            'tel_empresa.required'            => 'El teléfono de la empresa es requerida',
            'cargo.required'                  => 'El cargo es requerido',
            'descripcion_actividad.required'  => 'La descripción de la actividad es requerida',
            'doc_empresa'                     => '',
            'fecha_vinculacion.required_id'   => 'La fecha de vinculación es requerida',
            'tipo_contrato.required_if'       => 'El tipo de contrato es requerido',

            // info crediticia
            'reportado'                 => ''
        );
    }
}