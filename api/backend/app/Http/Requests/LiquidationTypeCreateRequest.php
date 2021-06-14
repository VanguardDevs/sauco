<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LiquidationTypeCreateRequest extends FormRequest
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
            'name' => 'required|unique:liquidation_types'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese un nombre',
            'name.unique' => 'El nombre ingresado ya ha sido registrado',
        ];
    }
}
