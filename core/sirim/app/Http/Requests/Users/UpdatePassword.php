<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassword extends FormRequest
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
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed'
        ];
    }

    public function attributes()
    {
        return [
            'current-password' => 'contraseña actual',
            'new-password' => 'nueva contraseña' 
        ];
    }

    public function messages()
    {
        return [
            'current-password.required' => 'Ingrese la :attribute',
            'new-password.required' => 'Ingrese la :attribute',
            'new-password.min' => 'La :attribute debe ser mayor a 6 caracteres',
            'new-password.confirmed' => 'Las contraseñas no coinciden'
        ];
    }
}
