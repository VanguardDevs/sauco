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
            'name' => 'required',
            'ordinance' => 'required',
            'law' => 'required',
            'list' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'ordinance' => 'tipo de ordenanza',
            'law' => 'ley u ordenanza',
            'list' => 'listado'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese un :attribute',
            'ordinance.required' => 'Seleccione un :attribute',
            'list.required' => 'Seleccione un :attribute',
            'law.required' => 'Ingrese una :attribute'
        ];
    }
}
