<?php

namespace App\Http\Requests\Affidavits;

use Illuminate\Foundation\Http\FormRequest;

class AffidavitsCreateFormRequest extends FormRequest
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
            'month' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'month' => 'mes'
        ];
    }

    public function messages()
    {
        return [
            'month.required' => 'Seleccione un :attribute'
        ];
    }
}
