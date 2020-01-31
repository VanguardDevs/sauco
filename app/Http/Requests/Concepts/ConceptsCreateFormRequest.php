<?php

namespace App\Http\Requests\Ordinances;

use Illuminate\Foundation\Http\FormRequest;

class OrdinancesCreateFormRequest extends FormRequest
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
            'law' => 'required',
            'value' => 'required',
            'publication_date' => 'required',
            'description' => 'required',
            'charging_method' => 'required',
            'ordinance_type' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'law' => 'ley',
            'value' => 'valor',
            'publication_date' => 'fecha de publicación',
            'description' => 'descripción',
            'charging_method' => 'método de cobro',
            'ordinance_type' => 'tipo de ordenanza'
        ];
    }

    public function messages()
    {
        return [
            'law.required' => 'Ingrese la :attribute',
            'value.required' => 'Ingrese un :attribute',
            'publication_date.required' => 'Ingrese una :attribute',
            'description.required' => 'Ingrese una :attribute',
            'charging_method.required' => 'Seleccione un :attribute',
            'ordinance_type.required' => 'Seleccione un :attribute'
        ];
    }
}
