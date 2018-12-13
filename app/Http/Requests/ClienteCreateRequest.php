<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ClienteCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required',
            'num_doc'=> 'required|numeric',
            'municipio_id' => 'required',
        ];
    }

    public function message()
    {
        return[
           'nombre.required' => 'EL Nombre es requerido',
           'num_doc.required' => 'El Número de documento es requerido',
           'num_doc.numeric' => 'El Número de documento debe ser numérico',
           'municipio_id.required' => 'El Municipio es requerido' , 
        ];
    }
}
