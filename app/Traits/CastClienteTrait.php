<?php

namespace App\Traits;

trait CastClienteTrait
{

    public function cast_cliente()
    {
        return $this->struct_general();
    }

    /**
     * Ver public/js/interfaces/cliente.js
     */

    public function struct_general()
    {
        return [
            'id'                 => $this->cliente->id,
            'info_personal'      => $this->struct_info_personal(),
            'info_ubicacion'     => $this->struct_info_ubicacion(),
            'info_economica'     => $this->struct_info_economica(),
            'conyuge'            => $this->struct_conyuge(),
            'calificacion'       => $this->cliente->calificacion
        ];
    }

    public function struct_info_personal()
    {
        return [
            'primer_nombre'      => $this->cliente->primer_nombre,
            'segundo_nombre'     => $this->cliente->segundo_nombre,
            'primer_apellido'    => $this->cliente->primer_apellido,
            'segundo_apellido'   => $this->cliente->segundo_apellido,
            'tipo_doc'           => $this->cliente->tipo_doc,
            'num_doc'            => $this->cliente->num_doc,
            'fecha_nacimiento'   => $this->cliente->fecha_nacimiento,
            'lugar_exp'          => $this->cliente->lugar_exp,
            'fecha_exp'          => $this->cliente->fecha_exp,
            'lugar_nacimiento'   => $this->cliente->lugar_nacimiento,
            'nivel_estudios'     => $this->cliente->nivel_estudios,
            'estado_civil'       => $this->cliente->estado_civil
        ];
    }

    public function struct_info_ubicacion()
    {
        return [
            'direccion'              => $this->cliente->direccion,
            'barrio'                 => $this->cliente->barrio,
            'municipio_id'           => $this->cliente->municipio_id,
            'movil'                  => $this->cliente->movil,
            'fijo'                   => $this->cliente->fijo,
            'email'                  => $this->cliente->email,
            'estrato'                => $this->cliente->estrato,
            'anos_residencia'        => $this->cliente->anos_residencia,
            'meses_residencia'       => $this->cliente->meses_residencia,
            'tipo_vivienda'          => $this->cliente->tipo_vivienda,
            'envio_correspondencia'  => $this->cliente->envio_correspondencia,
            'nombre_arrendador'      => $this->cliente->nombre_arrendador,
            'telefono_arrendador'    => $this->cliente->telefono_arrendador,
        ];
    }

    public function struct_info_economica()
    {
        return [
            'oficio'             => $this->cliente->oficio,
            'tipo_actividad'     => $this->cliente->tipo_actividad,
            'empresa'            => $this->cliente->empresa,
            'tel_empresa'        => $this->cliente->tel_empresa,
            'dir_empresa'        => $this->cliente->dir_empresa,
            'doc_empresa'        => $this->cliente->doc_empresa,
            'cargo'              => $this->cliente->cargo,
            'tipo_contrato'      => $this->cliente->tipo_contrato,
            'fecha_vinculacion'  => $this->cliente->fecha_vinculacion,
            'descripcion_actividad' => $this->cliente->descripcion_actividad
        ];
    }

    public function struct_conyuge()
    {
        if ( !isset($this->cliente->conyuge)) {
            return [];
        }

        return [
            'id'             => $this->cliente->conyuge->id,
            'nombrey'        => $this->cliente->conyuge->nombrey,
		    'p_nombrey'      => $this->cliente->conyuge->p_nombrey,
		    's_nombrey'      => $this->cliente->conyuge->s_nombrey,
		    'p_apellidoy'    => $this->cliente->conyuge->p_apellidoy,
		    's_apellidoy'    => $this->cliente->conyuge->s_apellidoy,
		    'tipo_docy'      => $this->cliente->conyuge->tipo_docy,
		    'num_docy'       => $this->cliente->conyuge->num_docy,
		    'diry'           => $this->cliente->conyuge->diry,
		    'movily'         => $this->cliente->conyuge->movily,
		    'fijo'           => $this->cliente->conyuge->fijo
        ];
    }

}