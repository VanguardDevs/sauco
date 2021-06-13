<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConceptsValidateRequest extends FormRequest
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
            'own_income' => 'required',
            'min_amount' => 'required',
            'max_amount' => 'required',
            'ordinance_id' => 'required',
            'interval_id' => 'required',
            'charging_method_id' => 'required',
            'accounting_account_id' => 'required',
            'liquidation_type_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese un nombre',
            'own_income.required' => 'Defina si es un ingreso propio o extraordinario',
            'ordinance_id.required' => 'Seleccione una ordenanza',
            'accounting_account_id.required' => 'Seleccione una cuenta contable',
            'liquidation_type_id.required' => 'Seleccione un tipo de liquidación',
            'charging_method_id.required' => 'Seleccione un método de cobro',
            'min_amount.required' => 'Ingrese un monto mínimo',
            'max_amount.required' => 'Ingrese un monto máximo',
            'interval_id.required' => 'Seleccione un intervalo'
        ];
    }
}
