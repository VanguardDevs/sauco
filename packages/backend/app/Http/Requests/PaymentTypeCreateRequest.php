<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentTypeCreateRequest extends FormRequest
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
            'description' => 'required|unique:payment_types'
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Ingrese un nombre',
            'description.unique' => 'El nombre ingresado ya ha sido registrado',
        ];
    }
}
