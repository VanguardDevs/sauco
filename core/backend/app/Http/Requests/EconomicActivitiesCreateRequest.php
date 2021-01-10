<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EconomicActivitiesCreateRequest extends FormRequest
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
            'code' => 'required|unique:economic_activities',
            'name' => 'required|min:20',
            'description' => 'required|min:100',
            'aliquote' => 'required',
            'min_tax' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'code' => 'código',
            'name' => 'nombre',
            'aliquote' => 'alícuota',
            'min_tax' => 'mínimo tributable',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Ingrese un :attribute',
            'code.unique' => 'Este código ya está siendo utilizado',
            'name.required' => 'Ingrese un :attribute',
            'name.min' => 'El nombre debe tener 20 caracteres como mínimo',
            'aliquote.required' => 'Ingrese una :attribute',
            'min_tax.required' => 'Ingrese un :attribute',
            'description.required' => 'Ingrese una descripción',
            'description.min' => 'La descripción debe tener 100 caracteres como mínimo',
        ];
    }
}
