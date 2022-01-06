<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UsersCreateFormRequest extends FormRequest
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
            'identity_card' => 'required|unique:users',
            'full_name' => 'required',
            'password' => 'required',
            'login' => 'required|unique:users'
        ];
    }

    public function attributes()
    {
        return [
            'identity_card' => 'número de cédula',
            'full_name' => 'primer nombre',
            'password' => 'contraseña',
            'login' => 'login',
        ];
    }

    public function messages()
    {
        return [
            'identity_card.required' => 'Ingrese el :attribute',
            'full_name.required' => 'Ingrese el :attribute',
            'password.required' => 'Ingrese la :attribute',
            'login.required' => 'Ingrese el :attribute',
            'login.unique' => 'El :attribute se encuentra en uso',
        ];
    }
}
