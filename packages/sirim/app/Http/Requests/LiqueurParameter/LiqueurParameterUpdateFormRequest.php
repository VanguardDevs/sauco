<?php

namespace App\Http\Requests\LiqueurParameter;

use Illuminate\Foundation\Http\FormRequest;

class LiqueurParameterUpdateFormRequest extends FormRequest
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
            'description' => 'required',
            'new_registry_amount' => 'required',
            'renew_registry_amount' => 'required',
            'authorization_registry_amount' => 'required',
            'is_mobile' => 'required',
            'liqueur_classification_id' => 'required',
            'liqueur_zone_id' => 'required',
            'charging_method_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'description' => 'descripción',
            'new_registry_amount' => 'registro',
            'renew_registry_amount' => 'renovación',
            'authorization_registry_amount' => 'autorización',
            'is_mobile' => 'Movil',
            'liqueur_classification_id' => 'clasificación',
            'liqueur_zone_id' => 'zona',
            'charging_method_id' => 'método de cobro'
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Ingrese una :attribute',
            'new_registry_amount.required' => 'Ingrese un :attribute',
            'renew_registry_amount.required' => 'Ingrese un :attribute',
            'authorization_registry_amount.required' => 'Ingrese una :attribute',
            'is_mobile.required' => 'Seleccione uno',
            'liqueur_classification_id.required' => 'Seleccione una :attribute',
            'liqueur_zone_id.required' => 'Seleccione una :attribute',
            'charging_method_id.required' => 'Seleccione un :attribute'
        ];
    }
}
