<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'nombreCliente' => 'required',
            'apellidoCliente' => 'required',
            'telefonoCliente' => 'required',
            'generoCliente' => 'required',
            'idTipoIdentificacion' => 'required',
            'cedulaCliente' => 'required',
            'emailCliente' => 'required|unique:clientes',
            'passwordCliente' => 'required',
        ];
    }

    public function messages(){
        return[
            'nombreCliente.required' => 'Debes ingresar un nombre',
            'apellidoCliente.required' => 'Debes ingresas tu apellido',
            'telefonoCliente.required' => 'Campo telefono no diligenciado',
            'generoCliente.required' => 'Debes seleccionar un genero',
            'idTipoIdentificacion.required' => 'Selecciona tu tipo de documento',
            'cedulaCliente.required' => ''
        ];
    }
}
