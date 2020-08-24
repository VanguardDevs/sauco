<?php

namespace App\Http\Requests\EconomicActivities;

use Illuminate\Foundation\Http\FormRequest;

class EconomicActivitiesCreateFormRequest extends FormRequest
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
            'code' => 'required',
            'name' => 'required',
            'aliquote' => 'required',
            'min_tax' => 'required',
            'activity_classification_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'code' => 'código',
            'name' => 'nombre',
            'aliquote' => 'alícuota',
            'min_tax' => 'mínimo tributable',
            'activity_classification_id' => 'clasificación'
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Ingrese un :attribute',
            'name.required' => 'Ingrese un :attribute',
            'aliquote.required' => 'Ingrese una :attribute',
            'min_tax.required' => 'Ingrese un :attribute',
            'activity_classification_id.required' => 'Seleccione una :attribute'
        ];
    }
}
