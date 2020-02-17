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
            'name' => 'required',
            'charging_method' => 'required',
            'ordinance' => 'required',
            'law' => 'required',
            'list' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'value' => 'valor',
            'name' => 'nombre',
            'charging_method' => 'método de cobro',
            'ordinance' => 'tipo de ordenanza',
            'law' => 'ley u ordenanza',
            'list' => 'listado'
        ];
    }

    public function messages()
    {
        return [
            'value.required' => 'Ingrese un :attribute',
            'name.required' => 'Ingrese un :attribute',
            'charging_method.required' => 'Seleccione un :attribute',
            'ordinance.required' => 'Seleccione un :attribute',
            'list.required' => 'Seleccione un :attribute',
            'law.required' => 'Ingrese una :attribute'
        ];
    }
}
