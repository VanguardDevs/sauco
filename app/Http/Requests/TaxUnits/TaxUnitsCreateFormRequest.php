<?php

namespace App\Http\Requests\TaxUnits;

use Illuminate\Foundation\Http\FormRequest;

class TaxUnitsCreateFormRequest extends FormRequest
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
            'publication_date' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'law' => 'ley',
            'value' => 'valor',
            'publication_date' => 'fecha de publicación'
        ];
    }

    public function messages()
    {
        return [
            'law.required' => 'Ingrese la :attribute',
            'value.required' => 'Ingrese un :attribute',
            'publication_date.required' => 'Ingrese una :attribute'
        ];
    }
}
