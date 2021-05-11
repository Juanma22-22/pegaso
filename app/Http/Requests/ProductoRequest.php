<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
            'codigoProducto' => 'required',
            'nombreProducto' => ['required', 'min:3'],
            'descripcionProducto' => ['required', 'min:8'],
            'precioProducto' => ['required', 'min:3'],
            'direccionImagenProducto' => 'required',
        ];
    }

    public function messages(){
        return[
            'codigoProducto.require' => 'Debe ingresar un codigo',
            'nombreProducto.require' => 'Debe ingresar un nombre para el producto',
            'nombreProducto.min' => 'El nombre del producto debe contener minimo 3 caracteres',
            'descripcionProducto.require' => 'Debe ingresar una descripción para el producto',
            'descripcionProducto.min' => 'La descripción debe ser minimo de 8 caracteres',
            'precioProducto.require' => 'Debe ingresar un valor para precio',
            'precioProducto.min' => 'Debe ingresar un valor para precio mino de 3 digitos',
        ];
    }
}
