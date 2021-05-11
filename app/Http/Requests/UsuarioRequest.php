<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'emailUsuario' => 'required',
            'passwordUsuario' => ['required', 'min:8', 'max:20'],
            'idTipoUsuario' => 'required',
        ];
    }

    public function messages(){
        return[
            'emailUsuario.required' => 'Debe ingresar un correo electronico',
            'passwordUsuario.required' =>'Debe diligenciar una contraseña',
            'passwordUsuario.min' =>'La contraseña debe contener minimo 8 caracteres',
            'passwordUsuario.max' =>'La contraseña debe tener maximo 20 caracteres',
            'idTipoUsuario.required' => 'Debe seleccionar el tipo de usuario' 

        ];
    }
}
