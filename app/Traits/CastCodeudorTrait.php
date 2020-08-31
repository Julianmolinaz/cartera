<?php

namespace App\Traits;

trait CastCodeudorTrait
{

    public function cast_codeudor()
    {
        return $this->struct_general();
    }

    /**
     * Ver public/js/interfaces/cliente.js
     */

    public function struct_general()
    {
        return [
            'id'                 => $this->codeudor->id,
            'info_personal'      => $this->struct_info_personal(),
            'info_ubicacion'     => $this->struct_info_ubicacion(),
            'info_economica'     => $this->struct_info_economica(),
            'conyuge'            => $this->struct_conyuge(),
            'calificacion'       => '',
            'tipo'               => 'codeudor'
        ];
    }

    public function struct_info_personal()
    {
        return [
            'primer_nombre'      => $this->codeudor->primer_nombre,
            'segundo_nombre'     => $this->codeudor->segundo_nombre,
            'primer_apellido'    => $this->codeudor->primer_apellido,
            'segundo_apellido'   => $this->codeudor->segundo_apellido,
            'tipo_doc'           => $this->codeudor->tipo_doc,
            'num_doc'            => $this->codeudor->num_doc,
            'fecha_nacimiento'   => $this->codeudor->fecha_nacimiento,
            'lugar_exp'          => $this->codeudor->lugar_exp,
            'fecha_exp'          => $this->codeudor->fecha_exp,
            'lugar_nacimiento'   => $this->codeudor->lugar_nacimiento,
            'nivel_estudios'     => $this->codeudor->nivel_estudios,
            'estado_civil'       => $this->codeudor->estado_civil,
            'genero'             => $this->codeudor->genero
        ];
    }

    public function struct_info_ubicacion()
    {
        return [
            'direccion'              => $this->codeudor->direccion,
            'barrio'                 => $this->codeudor->barrio,
            'municipio_id'           => $this->codeudor->municipio_id,
            'movil'                  => $this->codeudor->movil,
            'fijo'                   => $this->codeudor->fijo,
            'email'                  => $this->codeudor->email,
            'estrato'                => $this->codeudor->estrato,
            'anos_residencia'        => $this->codeudor->anos_residencia,
            'meses_residencia'       => $this->codeudor->meses_residencia,
            'tipo_vivienda'          => $this->codeudor->tipo_vivienda,
            'envio_correspondencia'  => $this->codeudor->envio_correspondencia,
            'nombre_arrendador'      => $this->codeudor->nombre_arrendador,
            'telefono_arrendador'    => $this->codeudor->telefono_arrendador,
        ];
    }

    public function struct_info_economica()
    {
        return [

            'ocupacion'          => $this->codeudor->ocupacion,
            'tipo_actividad'     => $this->codeudor->tipo_actividad,
            'empresa'            => $this->codeudor->empresa,
            'tel_empresa'        => $this->codeudor->tel_empresa,
            'dir_empresa'        => $this->codeudor->dir_empresa,
            'doc_empresa'        => $this->codeudor->doc_empresa,
            'cargo'              => $this->codeudor->cargo,
            'tipo_contrato'      => $this->codeudor->tipo_contrato,
            'fecha_vinculacion'  => $this->codeudor->fecha_vinculacion,
            'descripcion_actividad' => $this->codeudor->descripcion_actividad
        ];
    }

    public function struct_conyuge()
    {
        if ( !isset($this->codeudor->conyuge)) {
            return [    
                'nombrey'       => "",
                'p_nombrey'     => "",
                's_nombrey'     => "",
                'p_apellidoy'   => "",
                's_apellidoy'   => "",
                'tipo_docy'     => "",
                'num_docy'      => "",
                'diry'          => "",
                'movily'        => "",
                'fijoy'         => ""
            ];
        }

        return [
            'id'             => $this->codeudor->conyuge->id,
            'nombrey'        => $this->codeudor->conyuge->nombrey,
		    'p_nombrey'      => $this->codeudor->conyuge->p_nombrey,
		    's_nombrey'      => $this->codeudor->conyuge->s_nombrey,
		    'p_apellidoy'    => $this->codeudor->conyuge->p_apellidoy,
		    's_apellidoy'    => $this->codeudor->conyuge->s_apellidoy,
		    'tipo_docy'      => $this->codeudor->conyuge->tipo_docy,
		    'num_docy'       => $this->codeudor->conyuge->num_docy,
		    'diry'           => $this->codeudor->conyuge->diry,
		    'movily'         => $this->codeudor->conyuge->movily,
		    'fijoy'          => $this->codeudor->conyuge->fijoy
        ];
    }

}