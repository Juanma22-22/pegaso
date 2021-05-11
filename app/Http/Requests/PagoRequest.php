<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagoRequest extends FormRequest
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
            //'direccion' => 'required',
            'numeroTarjeta' => 'required',
            'nombreTarjeta' => 'required',
            'mes' => 'required',
            'year' => 'required',
            'inputCCV' => 'required',
        ];
    }
    public function messages(){
        return[
            //'direccion.required' => 'Debes ingresar una dirección',
            'numeroTarjeta.required' => 'Debes ingresar un numero de tarjeta',
            'nombreTarjeta.required' => 'Debes ingresar un nombre de tarjeta',
            'mes.required' => 'Debes seleccionar un numero de mes',
            'year.required' => 'Debes seleccionar un año de expiracion',
            'inputCCV.required' => 'Debes ingresar tu CCV',
        ];
    }
}
