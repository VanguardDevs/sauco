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
            'code' => 'required|unique:concepts',
            'name' => 'required',
            'amount' => 'required',
            'ordinance_id' => 'required',
            'charging_method_id' => 'required',
            'list_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'code' => 'code',
            'name' => 'nombre',
            'amount' => 'nombre',
            'ordinance_id' => 'tipo de ordenanza',
            'list_id' => 'listado',
            'charging_method_id' => 'método de cálculo'
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Ingrese un :attribute',
            'code.unique' => 'El :attribute ya existe',
            'name.required' => 'Ingrese un :attribute',
            'ordinance_id.required' => 'Seleccione un :attribute',
            'list_id.required' => 'Seleccione un :attribute',
            'charging_method_id.required' => 'Seleccione un :attribute',
            'amount.required' => 'Ingrese un :attribute'
        ];
    }
}
