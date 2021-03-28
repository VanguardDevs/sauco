<?php

namespace App\Http\Requests\PropertyTypes;

use Illuminate\Foundation\Http\FormRequest;

class PropertyTypesUpdateFormRequest extends FormRequest
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
            'classification' => 'required',
            'denomination' => 'required',
            'amount' => 'required',
            'charging_method' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'classification' => 'clasificación',
            'denomination' => 'denominación',
            'amount' => 'monto',
            'charging_method' => 'método de cobro'
        ];
    }

    public function messages()
    {
        return [
            'classification.required' => 'Ingrese la :attribute',
            'denomination.required' => 'Ingrese la :attribute',
            'amount.required' => 'Ingrese el :attribute',
            'charging_method.required' => 'Seleccione un :attribute'
        ];
    }
}
