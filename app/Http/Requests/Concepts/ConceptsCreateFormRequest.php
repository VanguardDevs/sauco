<?php

namespace App\Http\Requests\Concepts;

use Illuminate\Foundation\Http\FormRequest;

class ConceptsCreateFormRequest extends FormRequest
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
            'value' => 'required',
            'description' => 'required',
            'charging_method' => 'required',
            'ordinance' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'value' => 'valor',
            'description' => 'descripción',
            'charging_method' => 'método de cobro',
            'ordinance' => 'tipo de ordenanza'
        ];
    }

    public function messages()
    {
        return [
            'value.required' => 'Ingrese un :attribute',
            'description.required' => 'Ingrese una :attribute',
            'charging_method.required' => 'Seleccione un :attribute',
            'ordinance.required' => 'Seleccione un :attribute'
        ];
    }
}
