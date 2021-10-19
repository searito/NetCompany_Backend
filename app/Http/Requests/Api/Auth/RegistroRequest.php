<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
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
            'nombres'       =>  'required|string|min:3|max:20',
            'apellidos'     =>  'required|string||min:3|max:20',
            'correo'        =>  'required|email|unique:users,email,'.$this->route('id'),
            'password'      =>  'required|min:6|max:10',
        ];
    }

    public function messages()
    {
        return [
            'nombres.required'      =>  'No has ingresado un nombre',
            'nombres.string'        =>  'Formato incorrecto para nombre',
            'nombres.min'           =>  'El nombre debe contener almenos 3 caracteres',
            'nombres.max'           =>  'Nombre demasiado largo',
            'apellidos.required'    =>  'No has ingresado los apellidos',
            'apellidos.string'      =>  'Formato incorrecto para apellidos',
            'apellidos.min'         =>  'Los apellidos deben contener almenos 3 caracteres',
            'apellidos.max'         =>  'Demasiados caracteres para apellidos',
            'correo.required'       =>  'Correo electrónico es un campo obligatorio',
            'correo.email'          =>  'Formato incorrecto para correo electrónico',
            'correo.unique'         =>  'Este correo ya ha sido registrado previamente',
            'password.required'     =>  'Contraseña requerida',
            'password.min'          =>  'Contraseña demasiado corta',
            'password.max'          =>  'Has excedido el límite para contraseña',
        ];
    }
}
