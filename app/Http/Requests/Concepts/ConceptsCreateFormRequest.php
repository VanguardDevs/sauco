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
            'min_amount' => 'required',
            'ordinance_id' => 'required',
            'charging_method_id' => 'required',
            'accounting_account_id' => 'required',
            'liquidation_type_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'min_amount' => 'nombre',
            'ordinance_id' => 'tipo de ordenanza',
            'liquidation_type_id' => 'listado',
            'accounting_account_id' => 'cuenta contable',
            'charging_method_id' => 'método de cálculo'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese un :attribute',
            'ordinance_id.required' => 'Seleccione un :attribute',
            'accounting_account_id.required' => 'Seleccione un :attribute',
            'liquidation_type_id.required' => 'Seleccione un :attribute',
            'charging_method_id.required' => 'Seleccione un :attribute',
            'min_amount.required' => 'Ingrese un :attribute'
        ];
    }
}
